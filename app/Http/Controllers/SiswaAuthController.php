<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class SiswaAuthController extends Controller
{
    /**
     * Tampilkan halaman login siswa
     */
    public function showLoginForm()
    {
        return view('auth.login-siswa');
    }

    /**
     * Proses login siswa
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nisn' => [
                'required',
                'string',
                'size:10',
                'regex:/^[0-9]+$/',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ], [
            'nisn.required' => 'NISN harus diisi',
            'nisn.size' => 'NISN harus 10 digit',
            'nisn.regex' => 'NISN harus berupa angka',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Rate limiting
        $this->ensureIsNotRateLimited($request);

        // Coba login dengan guard 'siswa'
        $credentials = [
            'nisn' => $request->nisn,
            'password' => $request->password,
        ];

        if (Auth::guard('siswa')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Clear rate limiter
            RateLimiter::clear($this->throttleKey($request));
            
            return redirect()->intended(route('siswa.dashboard'));
        }

        // Jika gagal login, hit rate limiter
        RateLimiter::hit($this->throttleKey($request));

        // Jika gagal login
        throw ValidationException::withMessages([
            'nisn' => '❌ NISN atau password salah.',
        ]);
    }

    /**
     * Logout siswa
     */
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // PERBAIKAN: Langsung redirect ke login siswa
        return redirect()->route('login.siswa');
    }

    /**
     * Ensure the login request is not rate limited
     */
    protected function ensureIsNotRateLimited(Request $request)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'nisn' => '⚠️ Terlalu banyak percobaan login. Silakan coba lagi dalam ' . ceil($seconds / 60) . ' menit.',
        ]);
    }

    /**
     * Get the rate limiting throttle key
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('nisn')) . '|' . $request->ip();
    }
}