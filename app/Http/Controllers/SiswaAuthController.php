<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
            'nisn' => 'required|string',
            'password' => 'required|string',
        ], [
            'nisn.required' => 'NISN harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        // Coba login dengan guard 'siswa'
        $credentials = [
            'nisn' => $request->nisn,
            'password' => $request->password,
        ];

        if (Auth::guard('siswa')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('siswa.dashboard'));
        }

        // Jika gagal login
        throw ValidationException::withMessages([
            'nisn' => 'NISN atau password salah.',
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
        
        return redirect()->route('login.siswa')->with('status', 'Anda telah logout.');
    }
}