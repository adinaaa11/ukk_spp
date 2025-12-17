<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Admin/Petugas)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    
    // Halaman Login Admin/Petugas
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Proses Login Admin/Petugas
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Halaman Register (Opsional, bisa dinonaktifkan)
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    
    // Logout Admin/Petugas
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});