<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input login

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman rumah
            return redirect()->route('admin.rumah');
        }

        // Jika login gagal
        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Menangani logout
    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect()->route('login'); // Arahkan ke halaman login
    }

    // Menampilkan halaman dashboard
    public function rumah()
    {
        $totalHadir = Event::where('hadir', true)->count(); // Ambil jumlah hadir

        // Mengambil semua data event
        $events = Event::all();
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        // Mengirim data ke view
        return view('admin.rumah', compact('events', 'totalHadir'));
    }
}
