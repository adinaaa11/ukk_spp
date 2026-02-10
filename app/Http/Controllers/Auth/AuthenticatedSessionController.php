<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login_id' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'username' => $request->login_id,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();

            if (auth()->user()->level === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('pembayaran.index');
        }

        return back()->withErrors([
            'login_id' => 'Username atau password salah',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
