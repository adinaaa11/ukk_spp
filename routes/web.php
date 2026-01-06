<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\SiswaDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes (Aplikasi Pembayaran SPP - UKK)
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN UTAMA ---
Route::get('/', function () {
    return view('welcome-page');
})->name('home');

// --- 2. AUTH ADMIN/PETUGAS ---
require __DIR__.'/auth.php';

// --- 3. AUTH SISWA (Login Terpisah) ---
Route::middleware('guest:siswa')->group(function () {
    Route::get('/login-siswa', [SiswaAuthController::class, 'showLoginForm'])->name('login.siswa');
    Route::post('/login-siswa', [SiswaAuthController::class, 'login'])->name('siswa.login.submit');
});

Route::middleware('auth:siswa')->group(function () {
    Route::post('/logout-siswa', [SiswaAuthController::class, 'logout'])->name('siswa.logout');
});

// --- 4. DASHBOARD ADMIN/PETUGAS ---
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- 5. GRUP ADMIN (Hanya Level 'admin') ---
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    
    // CRUD Data Master
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);
    
    // Route untuk detail siswa (Ajax)
    Route::get('siswa/{nisn}/detail', [SiswaController::class, 'getDetail'])->name('siswa.detail');

    // Laporan/Cetak
    Route::get('laporan/pembayaran', [LaporanController::class, 'laporanPembayaran'])->name('laporan.pembayaran');
});

// --- 6. GRUP ADMIN & PETUGAS (Level 'admin' dan 'petugas') ---
Route::middleware(['auth', 'ceklevel:admin,petugas'])->group(function () {
    
    // Halaman Index History Pembayaran (Semua Transaksi)
    Route::get('/history-pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    // Halaman Form Entri Pembayaran (dengan Pencarian Siswa)
    Route::get('/entri-pembayaran', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');
    
    // Halaman Form Transaksi Pembayaran untuk Siswa Tertentu (PERBAIKAN: tambahkan route ini)
    Route::get('/pembayaran/transaksi/{nisn}', [PembayaranController::class, 'transaksi'])
        ->name('pembayaran.transaksi');
    
    // DEPRECATED: Proses Cari Siswa (untuk backward compatibility)
    Route::get('/cari-siswa', [PembayaranController::class, 'cari'])
        ->name('pembayaran.cari');
    
    // Proses POST data pembayaran (Logika Commit & Rollback)
    Route::post('/simpan-pembayaran', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');
});

// --- 7. GRUP SISWA (Setelah Login) ---
Route::middleware(['auth:siswa'])->group(function () {
    
    // Dashboard Siswa
    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
        ->name('siswa.dashboard');
    
    // History Pembayaran Siswa
    Route::get('/siswa/history', [SiswaDashboardController::class, 'history'])
        ->name('siswa.history');
});