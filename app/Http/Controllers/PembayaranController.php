<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])->latest()->paginate(10);
        return view('pembayaran.history', compact('pembayaran'));
    }

    public function create()
    {
        return view('pembayaran.create');
    }

    public function cari(Request $request)
    {
        $request->validate(['nisn' => 'required']);
        $siswa = Siswa::with(['kelas', 'spp'])->where('nisn', $request->nisn)->first();
        
        if(!$siswa) return back()->with('error', 'Siswa tidak ditemukan!');

        // Ambil history pembayaran siswa ini
        $history = Pembayaran::where('nisn', $siswa->nisn)->latest()->get();

        return view('pembayaran.transaksi', compact('siswa', 'history'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nisn' => 'required',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required',
            'jumlah_bayar' => 'required|numeric'
        ]);

        $siswa = Siswa::with('spp')->find($request->nisn);

        // Cek Double Bayar
        $cek = Pembayaran::where([
            ['nisn', $request->nisn],
            ['bulan_dibayar', $request->bulan_dibayar],
            ['tahun_dibayar', $request->tahun_dibayar]
        ])->exists();

        if($cek) return back()->with('error', 'Bulan tersebut sudah dibayar!');

        // Transaksi Database
        DB::beginTransaction();
        try {
            Pembayaran::create([
                'id_petugas' => Auth::user()->id_petugas,
                'nisn' => $request->nisn,
                'tgl_bayar' => now(),
                'bulan_dibayar' => $request->bulan_dibayar,
                'tahun_dibayar' => $request->tahun_dibayar,
                'id_spp' => $siswa->id_spp,
                'jumlah_bayar' => $request->jumlah_bayar
            ]);

            DB::commit();
            return back()->with('success', 'Pembayaran Berhasil Disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }
}