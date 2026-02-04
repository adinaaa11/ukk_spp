<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * ===============================
     * HISTORI PEMBAYARAN
     * ===============================
     */
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->orderBy('tgl_bayar', 'desc')
            ->paginate(10);

        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * ===============================
     * FORM ENTRI PEMBAYARAN
     * ===============================
     */
    public function create()
    {
        $siswa = Siswa::with('kelas')->orderBy('nama')->get();
        $spp   = Spp::orderBy('tahun', 'desc')->get();

        return view('pembayaran.create', compact('siswa', 'spp'));
    }

    /**
     * ===============================
     * SIMPAN PEMBAYARAN (SUDAH FIX)
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'              => 'required|exists:siswa,nisn',
            'id_spp'            => 'required|exists:spp,id_spp',
            'tgl_bayar'         => 'required|date',
            'bulan_dibayar'     => 'required',
            'tahun_dibayar'     => 'required',
            'jumlah_bayar'      => 'required|numeric|min:0',
            'metode_pembayaran' => 'required',
        ]);

        // Ambil data petugas BERDASARKAN USERNAME
        $petugas = Petugas::where('username', Auth::user()->username)->first();

        if (!$petugas) {
            return back()->with('error', 'Petugas tidak ditemukan');
        }

        Pembayaran::create([
            'id_petugas'        => $petugas->id_petugas,
            'nisn'              => $request->nisn,
            'id_spp'            => $request->id_spp,
            'tgl_bayar'         => $request->tgl_bayar,
            'bulan_dibayar'     => $request->bulan_dibayar,
            'tahun_dibayar'     => $request->tahun_dibayar,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil disimpan');
    }

    /**
     * ===============================
     * DETAIL PEMBAYARAN
     * ===============================
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->findOrFail($id);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * ===============================
     * CETAK STRUK
     * ===============================
     */
    public function cetakStruk($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->findOrFail($id);

        return view('pembayaran.struk', compact('pembayaran'));
    }

    /**
     * ===============================
     * HAPUS DATA
     * ===============================
     */
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
