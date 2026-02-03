<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Pembayaran;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya user login yang bisa akses dashboard
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $userLevel = strtolower($user->level ?? '');

        // ===============================
        // Dashboard Admin & Petugas
        // ===============================
        if (in_array($userLevel, ['admin', 'petugas'])) {

            return view('dashboard', [
                'total_siswa' => Siswa::count(),
                'total_petugas' => Petugas::count(),
                'total_kelas' => Kelas::count(),
                'total_transaksi' => Pembayaran::count(),
                'total_pendapatan' => Pembayaran::sum('jumlah_bayar'),
                'transaksi_hari_ini' => Pembayaran::whereDate('tgl_bayar', now())->count(),
                'pendapatan_hari_ini' => Pembayaran::whereDate('tgl_bayar', now())->sum('jumlah_bayar'),
                'transaksi_terbaru' => Pembayaran::with(['siswa', 'petugas'])
                    ->orderByDesc('tgl_bayar')
                    ->limit(5)
                    ->get(),
            ]);
        }

        // ===============================
        // Jika Siswa Login
        // ===============================
        if ($userLevel === 'siswa') {
            return redirect()->route('siswa.history');
        }

        // ===============================
        // Role tidak dikenal
        // ===============================
        abort(403, 'Akses tidak diizinkan');
    }
}
