<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$levels
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil level user (aman dari null)
        $userLevel = strtolower(Auth::user()->level ?? '');

        // 3. Normalisasi level yang diizinkan (case-insensitive)
        $allowedLevels = array_map('strtolower', $levels);

        // 4. Cek hak akses
        if (in_array($userLevel, $allowedLevels)) {
            return $next($request);
        }

        // 5. Jika tidak punya akses
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
