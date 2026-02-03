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

// ===================================================
// 1. HALAMAN UTAMA
// ===================================================
Route::get('/', function () {
    return view('welcome-page');
})->name('home');

// ===================================================
// 2. AUTH ADMIN / PETUGAS (Laravel Breeze / Fortify)
// ===================================================
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// ===================================================
// 3. AUTH SISWA (GUARD TERPISAH)
// ===================================================
Route::prefix('siswa')->group(function () {

    // -------- GUEST SISWA --------
    Route::middleware('guest:siswa')->group(function () {
        Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])
            ->name('login.siswa');
        Route::post('/login', [SiswaAuthController::class, 'login']);
    });

    // -------- AUTH SISWA --------
    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('siswa.dashboard');

        Route::get('/history', [SiswaDashboardController::class, 'history'])
            ->name('siswa.history');

        Route::post('/logout', [SiswaAuthController::class, 'logout'])
            ->name('siswa.logout');
    });
});

// ===================================================
// 4. DASHBOARD ADMIN / PETUGAS
// ===================================================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ===================================================
// 5. GRUP ADMIN (LEVEL: admin)
// ===================================================
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {

    // CRUD MASTER DATA
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);

    // DETAIL SISWA (AJAX)
    Route::get('siswa/{nisn}/detail', [SiswaController::class, 'getDetail'])
        ->name('siswa.detail');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/pembayaran/excel', [LaporanController::class, 'laporanPembayaran'])
        ->name('laporan.pembayaran');
});

// ===================================================
// 6. GRUP ADMIN & PETUGAS (LEVEL: admin, petugas)
// ===================================================
Route::middleware(['auth', 'ceklevel:admin,petugas'])->group(function () {

    // -------- PEMBAYARAN --------

    // History Pembayaran
    Route::get('/history-pembayaran', [PembayaranController::class, 'index'])
        ->name('pembayaran.index');

    // Entri Pembayaran (Cari Siswa)
    Route::get('/entri-pembayaran', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');

    // Form Transaksi Pembayaran per Siswa
    Route::get('/pembayaran/transaksi/{nisn}', [PembayaranController::class, 'transaksi'])
        ->name('pembayaran.transaksi');

    // Simpan Pembayaran
    Route::post('/simpan-pembayaran', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');

    // Cetak Struk
    Route::get('/pembayaran/struk/{id}', [PembayaranController::class, 'cetakStruk'])
        ->name('pembayaran.struk');
});
