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

// ===================== HALAMAN AWAL =====================
Route::get('/', function () {
    return view('welcome-page');
})->name('home');

// ===================== AUTH DEFAULT =====================
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// ===================== AUTH SISWA =====================
Route::prefix('siswa')->group(function () {

    Route::middleware('guest:siswa')->group(function () {
        Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])
            ->name('login.siswa');
        Route::post('/login', [SiswaAuthController::class, 'login']);
    });

    Route::middleware('auth:siswa')->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('siswa.dashboard');
        Route::get('/history', [SiswaDashboardController::class, 'history'])
            ->name('siswa.history');
        Route::post('/logout', [SiswaAuthController::class, 'logout'])
            ->name('siswa.logout');
    });
});

// ===================== DASHBOARD ADMIN =====================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// ===================== KHUSUS ADMIN =====================
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {

    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('siswa', SiswaController::class);

    Route::get('/siswa/{nisn}/detail', [SiswaController::class, 'getDetail'])
        ->name('siswa.detail');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');
    Route::get('/laporan/excel', [LaporanController::class, 'downloadExcel'])
        ->name('laporan.download.excel');
    Route::get('/laporan/pdf', [LaporanController::class, 'downloadPDF'])
        ->name('laporan.download.pdf');
});

// ===================== ADMIN & PETUGAS =====================
Route::middleware(['auth', 'ceklevel:admin,petugas'])->group(function () {

    Route::prefix('pembayaran')->group(function () {

        // History
        Route::get('/', [PembayaranController::class, 'index'])
            ->name('pembayaran.index');

        // Form Entri
        Route::get('/create', [PembayaranController::class, 'create'])
            ->name('pembayaran.create');

        // Simpan
        Route::post('/store', [PembayaranController::class, 'store'])
            ->name('pembayaran.store');

        // CETAK STRUK (HARUS DI ATAS DETAIL)
        Route::get('/{id}/struk', [PembayaranController::class, 'cetakStruk'])
            ->name('pembayaran.struk');

        // DETAIL
        Route::get('/{id}', [PembayaranController::class, 'show'])
            ->name('pembayaran.show');

        // HAPUS
        Route::delete('/{id}', [PembayaranController::class, 'destroy'])
            ->name('pembayaran.destroy');
    });
});
