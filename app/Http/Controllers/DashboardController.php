<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Pembayaran;
use App\Models\Kelas;
use App\Models\Spp;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Normalisasi level (tangani null dan variasi kapitalisasi)
        $userLevel = strtolower($user->level ?? '');

        // Statistik untuk Admin/Petugas
        if (in_array($userLevel, ['admin', 'petugas'])) {
            $data = [
                'total_siswa' => Siswa::count(),
                'total_petugas' => Petugas::count(),
                'total_kelas' => Kelas::count(),
                'total_transaksi' => Pembayaran::count(),
                'total_pendapatan' => Pembayaran::sum('jumlah_bayar'),
                'transaksi_hari_ini' => Pembayaran::whereDate('tgl_bayar', today())->count(),
                'pendapatan_hari_ini' => Pembayaran::whereDate('tgl_bayar', today())->sum('jumlah_bayar'),
                'transaksi_terbaru' => Pembayaran::with(['siswa', 'petugas'])
                    ->latest('tgl_bayar')
                    ->take(5)
                    ->get(),
            ];
            
            return view('dashboard', $data);
        }
        
        // Jika siswa login (untuk fitur masa depan)
        if ($userLevel == 'siswa') {
            return redirect()->route('siswa.history');
        }
        
        abort(403, 'Akses tidak diizinkan');
    }
}