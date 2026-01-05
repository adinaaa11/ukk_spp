<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf; 

class LaporanController extends Controller
{
    public function laporanPembayaran()
    {
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])->orderBy('tgl_bayar', 'DESC')->get();

        $pdf = Pdf::loadView('laporan.pembayaran', compact('pembayaran')); 

        
        return $pdf->stream('laporan_pembayaran_spp.pdf');
    }
}