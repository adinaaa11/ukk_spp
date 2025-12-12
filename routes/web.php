<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes (Aplikasi Pembayaran SPP - UKK)
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN UTAMA & LOGIN ---

// Arahkan halaman utama (/) langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route login/register bawaan Laravel Breeze
require __DIR__.'/auth.php';


// --- 2. DASHBOARD (SETELAH LOGIN) ---

// Menggunakan DashboardController untuk mengarahkan pengguna sesuai level
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// --- 3. GRUP ADMIN (Hanya Level 'admin') ---
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    
    // CRUD Data Master
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);

    // Laporan/Cetak
    Route::get('laporan/pembayaran', [LaporanController::class, 'laporanPembayaran'])->name('laporan.pembayaran');
});


// --- 4. GRUP ADMIN & PETUGAS (Level 'admin' dan 'petugas') ---
Route::middleware(['auth', 'ceklevel:admin,petugas'])->group(function () {
    
    // Halaman Index History Pembayaran (Semua Transaksi)
    Route::get('/history-pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // Halaman Form Entri Pembayaran (Pencarian Siswa Awal)
    Route::get('/entri-pembayaran', [PembayaranController::class, 'create'])->name('pembayaran.create');
    
    // Proses Cari Siswa dan Tampilkan Halaman Transaksi
    Route::get('/cari-siswa', [PembayaranController::class, 'cari'])->name('pembayaran.cari');
    
    // Proses POST data pembayaran (Logika Commit & Rollback ada di sini)
    Route::post('/simpan-pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
});


// --- 5. GRUP SISWA (Level 'siswa') ---
Route::middleware(['auth', 'ceklevel:siswa'])->group(function () {
    
    // History Pembayaran untuk Siswa yang sedang login
    Route::get('/history-ku', [PembayaranController::class, 'historySiswa'])->name('siswa.history');

});