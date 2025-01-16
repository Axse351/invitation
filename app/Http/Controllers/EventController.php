<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventExport;

class EventController extends Controller
{
    // Method untuk menampilkan daftar event
    public function index()
    {
        // Ambil semua event dari database
        $events = Event::all(); // Mengambil semua data event
        $totalHadir = Event::where('hadir', true)->count(); // Menghitung total kehadiran

        return view('admin.rumah', compact('events', 'totalHadir'));
    }

    // Method untuk menampilkan form tambah event
    public function create()
    {
        return view('event.create'); // Tampilkan form untuk tambah event
    }

    // Method untuk menyimpan event baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'sales' => 'required',
            'sh' => 'required',
            'brand' => 'required',
        ]);

        // Menyimpan event ke database
        $event = new Event();
        $event->nama = $request->nama;
        $event->alamat = $request->alamat;
        $event->nohp = $request->nohp;
        $event->sales = $request->sales;
        $event->sh = $request->sh;
        $event->brand = $request->brand;
        $event->hadir = false; // Default belum hadir
        $event->save();

        // Menyimpan nomor antrian ke session
        $nomorAntrian = $event->id_event; // Gunakan ID event sebagai nomor antrian
        session([
            'success' => 'Data berhasil disimpan! Lihat Nomor Antrian Anda Lalu ScreenShoot',
            'nomorAntrian' => $nomorAntrian,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'sales' => $request->sales,
            'sh' => $request->sh,
            'brand' => $request->brand,
        ]);

        // Kembali ke halaman form dengan success message
        return redirect()->back();
    }


    // Menampilkan data yang disubmit di admin/rumah (ini tidak digunakan lagi dalam kasus ini)
    public function showEvents()
    {
        $events = Event::all(); // Pastikan nomor_antrian ada dalam model
        $totalHadir = Event::where('hadir', true)->count();
        $totalRegist = Event::count(); // Menghitung total pendaftar

        // Kirimkan data ke view
        return view('rumah.admin', compact('events', 'totalHadir', 'totalRegist'));
    }
    // Method untuk menampilkan form edit event
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    // Method untuk mengupdate data event
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nohp' => 'required|string|max:15',
            'sales' => 'required|string|max:255',
            'sh' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        // Temukan dan update data event
        $event = Event::findOrFail($id);
        $event->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'sales' => $request->sales,
            'sh' => $request->sh,
            'brand' => $request->brand,
        ]);

        // Redirect setelah berhasil
        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui.');
    }
    public function konfirmasiHadir($id)
    {
        $event = Event::findOrFail($id);
        $event->hadir = true;
        $event->save();

        // Update total kehadiran
        $totalHadir = Event::where('hadir', true)->count();

        // Get total registrants
        $totalDaftar = Event::count();

        // Return the updated counts
        return response()->json([
            'success' => true,
            'totalHadir' => $totalHadir,
            'totalRegist' => $totalDaftar
        ]);
    }


    public function export()
    {
        return Excel::download(new EventExport, 'data_event.xlsx');
    }
    public function show()
    {
        // Ambil data dari database
        $events = Event::all(); // Pastikan nomor_antrian ada dalam model
        $totalHadir = Event::where('hadir', true)->count();

        // Kirimkan data ke view
        return view('event.index', compact('events', 'totalHadir'));
    }


    // Method untuk menghapus event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('event.index')->with('success', 'Event berhasil dihapus.');
    }
}
