<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * HALAMAN HISTORY PEMBAYARAN
     */
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->orderByDesc('tgl_bayar')
            ->get();

        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * HALAMAN ENTRI PEMBAYARAN
     */
    public function create(Request $request)
    {
        // ✅ AMBIL SEMUA SISWA (INI YANG MEMPERBAIKI DROPDOWN)
        $siswa = Siswa::with(['kelas', 'spp'])
            ->orderBy('nama')
            ->get();

        // Data SPP
        $spp = Spp::orderByDesc('tahun')->get();

        // Optional: jika pakai search
        if ($request->filled('search')) {
            $search = $request->search;

            $siswa = Siswa::with(['kelas', 'spp'])
                ->where('nisn', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->get();
        }

        return view('pembayaran.create', compact('siswa', 'spp'));
    }

    /**
     * SIMPAN PEMBAYARAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'             => 'required|exists:siswa,nisn',
            'id_spp'           => 'required|exists:spp,id_spp',
            'bulan_dibayar'    => 'required',
            'tahun_dibayar'    => 'required',
            'tgl_bayar'        => 'required|date',
            'jumlah_bayar'     => 'required|numeric|min:0',
            'metode_pembayaran'=> 'required',
        ]);

        Pembayaran::create([
            'id_petugas'       => Auth::user()->id_petugas ?? Auth::id(),
            'nisn'             => $request->nisn,
            'id_spp'           => $request->id_spp,
            'tgl_bayar'        => $request->tgl_bayar,
            'bulan_dibayar'    => $request->bulan_dibayar,
            'tahun_dibayar'    => $request->tahun_dibayar,
            'jumlah_bayar'     => $request->jumlah_bayar,
            'metode_pembayaran'=> $request->metode_pembayaran,
        ]);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil disimpan');
    }

    /**
     * DETAIL PEMBAYARAN
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->findOrFail($id);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * HAPUS PEMBAYARAN
     */
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Data pembayaran berhasil dihapus');
    }
}
