<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\SiswaDashboardController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
| Aplikasi Pembayaran SPP
|--------------------------------------------------------------------------
*/

// ======================================================
// HALAMAN AWAL
// ======================================================
Route::get('/', function () {
    return view('welcome-page');
})->name('home');

// ======================================================
// AUTH ADMIN / PETUGAS (Laravel Breeze / Fortify / dll)
// ======================================================
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// ======================================================
// AUTH SISWA (LOGIN TERPISAH)
// ======================================================
Route::prefix('siswa')->group(function () {

    // Guest siswa
    Route::middleware('guest:siswa')->group(function () {
        Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])
            ->name('login.siswa');
        Route::post('/login', [SiswaAuthController::class, 'login']);
    });

    // Auth siswa
    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('siswa.dashboard');
        Route::get('/history', [SiswaDashboardController::class, 'history'])
            ->name('siswa.history');
        Route::post('/logout', [SiswaAuthController::class, 'logout'])
            ->name('siswa.logout');
    });
});

// ======================================================
// DASHBOARD ADMIN & PETUGAS
// ======================================================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ======================================================
// KHUSUS ADMIN
// ======================================================
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {

    // CRUD Resources
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);

    // Detail siswa (AJAX)
    Route::get('/siswa/{nisn}/detail', [SiswaController::class, 'getDetail'])
        ->name('siswa.detail');

    // ================= LAPORAN =================
    
    // Halaman Form Filter Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // Download Laporan Excel
    Route::get('/laporan/excel', [LaporanController::class, 'downloadExcel'])
        ->name('laporan.download.excel');

    // Download Laporan PDF
    Route::get('/laporan/pdf', [LaporanController::class, 'downloadPDF'])
        ->name('laporan.download.pdf');
});

// ======================================================
// ADMIN & PETUGAS (PEMBAYARAN)
// ======================================================
Route::middleware(['auth', 'ceklevel:admin,petugas'])->group(function () {

    // ================= PEMBAYARAN =================

    // History Pembayaran
    Route::get('/history-pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    // Entri Pembayaran
    Route::get('/entri-pembayaran', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');

    // Simpan Pembayaran
    Route::post('/simpan-pembayaran', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');

    // Detail Pembayaran
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])
        ->name('pembayaran.show');

    // Cetak Struk Pembayaran
    Route::get('/pembayaran/struk/{id}', [PembayaranController::class, 'cetakStruk'])
        ->name('pembayaran.struk');

    // Hapus Pembayaran
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])
        ->name('pembayaran.destroy');
});