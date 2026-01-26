<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Download Laporan Pembayaran ke Excel
     */
    public function laporanPembayaran(Request $request)
    {
        // Ambil data pembayaran dengan relasi
        $query = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->orderBy('tgl_bayar', 'DESC');

        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal_mulai') && $request->has('tanggal_akhir')) {
            $query->whereBetween('tgl_bayar', [
                $request->tanggal_mulai,
                $request->tanggal_akhir
            ]);
        }

        // Filter berdasarkan metode pembayaran
        if ($request->has('metode') && $request->metode != '') {
            $query->where('metode_pembayaran', $request->metode);
        }

        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_dibayar', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_dibayar', $request->tahun);
        }

        $pembayaran = $query->get();

        // Generate nama file dengan timestamp
        $filename = 'Laporan_Pembayaran_SPP_' . Carbon::now()->format('d-m-Y_His') . '.xlsx';

        // Download Excel
        return Excel::download(new PembayaranExport($pembayaran), $filename);
    }

    /**
     * Halaman Form Filter Laporan
     */
    public function index()
    {
        // Statistik untuk dashboard laporan
        $stats = [
            'total_transaksi' => Pembayaran::count(),
            'total_pendapatan' => Pembayaran::sum('jumlah_bayar'),
            'pembayaran_tunai' => Pembayaran::where('metode_pembayaran', 'tunai')->count(),
            'pembayaran_transfer' => Pembayaran::where('metode_pembayaran', 'transfer')->count(),
        ];

        return view('laporan.index', compact('stats'));
    }
}