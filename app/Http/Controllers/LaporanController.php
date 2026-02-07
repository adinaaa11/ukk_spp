<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Halaman Form Filter Laporan
     */
    public function index()
    {
        return view('laporan.index');
    }

    /**
     * Download Laporan Pembayaran ke Excel
     */
    public function downloadExcel(Request $request)
    {
        // Ambil data pembayaran dengan relasi
        $query = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->orderBy('tgl_bayar', 'DESC');

        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal_mulai') && $request->tanggal_mulai != '') {
            $query->whereDate('tgl_bayar', '>=', $request->tanggal_mulai);
        }

        if ($request->has('tanggal_akhir') && $request->tanggal_akhir != '') {
            $query->whereDate('tgl_bayar', '<=', $request->tanggal_akhir);
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
     * Download Laporan Pembayaran ke PDF
     */
    public function downloadPDF(Request $request)
    {
        // Ambil data pembayaran dengan relasi
        $query = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->orderBy('tgl_bayar', 'DESC');

        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal_mulai') && $request->tanggal_mulai != '') {
            $query->whereDate('tgl_bayar', '>=', $request->tanggal_mulai);
        }

        if ($request->has('tanggal_akhir') && $request->tanggal_akhir != '') {
            $query->whereDate('tgl_bayar', '<=', $request->tanggal_akhir);
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

        // Hitung total
        $totalPembayaran = $pembayaran->sum('jumlah_bayar');
        $jumlahTransaksi = $pembayaran->count();

        // Generate PDF
        $pdf = PDF::loadView('laporan.pdf', [
            'pembayaran' => $pembayaran,
            'totalPembayaran' => $totalPembayaran,
            'jumlahTransaksi' => $jumlahTransaksi,
            'tanggalCetak' => Carbon::now(),
            'filter' => [
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
            ]
        ]);

        // Set paper size dan orientation
        $pdf->setPaper('a4', 'landscape');

        // Generate nama file
        $filename = 'Laporan_Pembayaran_SPP_' . Carbon::now()->format('d-m-Y_His') . '.pdf';

        // Download PDF
        return $pdf->download($filename);
    }
}