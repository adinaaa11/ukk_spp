<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$levels
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Ambil level user yang sedang login
        // Normalisasi level dan parameter yang diizinkan agar case-insensitive
        $userLevel = strtolower(auth()->user()->level ?? '');
        $allowed = array_map('strtolower', $levels);

        // Cek apakah level user termasuk dalam level yang diizinkan
        if (in_array($userLevel, $allowed)) {
            return $next($request);
        }

        // Jika tidak punya akses, redirect dengan pesan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}