<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventExport;

use App\Models\Event;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua event dari database
        $events = Event::all(); // Mengambil semua data event
        $totalHadir = Event::where('hadir', true)->count(); // Menghitung total kehadiran

        return view('admin.rumah', compact('events', 'totalHadir'));
    }
    public function export()
    {
        return Excel::download(new EventExport, 'data_event.xlsx');
    }
}
