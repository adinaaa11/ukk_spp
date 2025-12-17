<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;

class SiswaDashboardController extends Controller
{
    /**
     * Dashboard utama siswa
     */
    public function index()
    {
        /** @var Siswa|null $siswa */
        $siswa = auth()->guard('siswa')->user();

        // Jika belum login sebagai siswa
        if (!$siswa) {
            return redirect()->route('siswa.login');
        }

        // Load relasi
        $siswa->load([
            'kelas',
            'spp',
            'pembayaran.petugas'
        ]);

        // Statistik pembayaran
        $total_bayar = $siswa->pembayaran->sum('jumlah_bayar');
        $jumlah_bulan_bayar = $siswa->pembayaran->count();

        // Pembayaran terbaru
        $pembayaran_terbaru = $siswa->pembayaran()
            ->with('petugas')
            ->orderBy('tgl_bayar', 'desc')
            ->limit(5)
            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'total_bayar',
            'jumlah_bulan_bayar',
            'pembayaran_terbaru'
        ));
    }

    /**
     * History pembayaran siswa
     */
    public function history()
    {
        /** @var Siswa|null $siswa */
        $siswa = auth()->guard('siswa')->user();

        if (!$siswa) {
            return redirect()->route('siswa.login');
        }

        $pembayaran = Pembayaran::where('nisn', $siswa->nisn)
            ->with(['petugas', 'spp'])
            ->orderBy('tgl_bayar', 'desc')
            ->paginate(12);

        return view('siswa.history', compact('siswa', 'pembayaran'));
    }
}
