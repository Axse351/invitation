<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Exports\EventExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/

// Halaman welcome untuk mengisi form
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route untuk menampilkan daftar event
Route::get('/events', [EventController::class, 'index'])->name('event.index');

// Route untuk menampilkan form tambah event
Route::get('/events/create', [EventController::class, 'create'])->name('event.create');

// Route untuk menyimpan event baru
Route::post('/events', [EventController::class, 'store'])->name('event.store');

// Route untuk menampilkan detail event
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.show');

// Route untuk menampilkan form edit event
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('event.edit');

// Route untuk mengupdate event
Route::put('/events/{id}', [EventController::class, 'update'])->name('event.update');

// Route untuk menghapus event
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('event.destroy');
Route::post('/event/hadir/{id}', [EventController::class, 'konfirmasiHadir']);
Route::post('/event/hadir/{id}', [EventController::class, 'konfirmasiHadir'])->name('event.hadir');
Route::post('/event/hadir/{id}', [EventController::class, 'konfirmasiHadir']);
// Rute untuk mengonfirmasi kehadiran
Route::post('/event/hadir/{id}', [EventController::class, 'konfirmasiHadir'])->name('event.hadir');
Route::get('/event/export', [EventController::class, 'export']);
// Rute untuk menampilkan data kehadiran dan daftar peserta
Route::get('/admin/event', [EventController::class, 'index'])->name('admin.event');
Route::get('/event/export', function () {
    return Excel::download(new EventExport, 'data_event.xlsx');
});
Route::get('/event/export', [EventController::class, 'export']);
// Route tanpa login untuk mengakses halaman /admin/rumah
// Route::get('/admin/rumah', [AdminController::class, 'index'])->name('admin.rumah');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('rumah', [AuthController::class, 'rumah'])->middleware('auth')->name('admin.rumah');
