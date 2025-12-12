<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf; // Gunakan facade PDF

class LaporanController extends Controller
{
    public function laporanPembayaran()
    {
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])->orderBy('tgl_bayar', 'DESC')->get();

        // Kirim data ke view untuk di-render menjadi PDF
        $pdf = Pdf::loadView('laporan.pembayaran', compact('pembayaran')); 

        // Tampilkan langsung di browser
        return $pdf->stream('laporan_pembayaran_spp.pdf');
    }
}