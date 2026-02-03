<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * HALAMAN HISTORY PEMBAYARAN
     */
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas'])
            ->orderByDesc('tgl_bayar')
            ->paginate(10);

        return view('pembayaran.history', compact('pembayaran'));
    }

    /**
     * FORM CARI SISWA (ENTRI PEMBAYARAN)
     */
    public function create(Request $request)
    {
        // ⬅️ WAJIB collection, bukan null
        $siswa = collect();

        if ($request->filled('search')) {
            $search = $request->search;

            $siswa = Siswa::with(['kelas', 'spp'])
                ->where('nisn', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->get();
        }

        return view('pembayaran.create', compact('siswa'));
    }

    /**
     * FORM TRANSAKSI PEMBAYARAN SISWA
     */
    public function transaksi($nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp'])
            ->where('nisn', $nisn)
            ->firstOrFail();

        $history = Pembayaran::with('petugas')
            ->where('nisn', $nisn)
            ->orderByDesc('tgl_bayar')
            ->get();

        return view('pembayaran.transaksi', compact('siswa', 'history'));
    }

    /**
     * SIMPAN PEMBAYARAN
     */
    public function store(Request $request)
    {
        $rules = [
            'nisn' => 'required|exists:siswa,nisn',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required|digits:4',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer',
        ];

        if ($request->metode_pembayaran === 'transfer') {
            $rules += [
                'bank_tujuan' => 'required',
                'no_rekening_pengirim' => 'required',
                'nama_pengirim' => 'required',
                'tanggal_transfer' => 'required|date',
            ];
        }

        $validated = $request->validate($rules);

        $siswa = Siswa::findOrFail($validated['nisn']);

        // ❌ CEK DOUBLE BAYAR
        $cek = Pembayaran::where('nisn', $validated['nisn'])
            ->where('bulan_dibayar', $validated['bulan_dibayar'])
            ->where('tahun_dibayar', $validated['tahun_dibayar'])
            ->exists();

        if ($cek) {
            return back()->with('error', 'SPP bulan tersebut sudah dibayar');
        }

        DB::beginTransaction();
        try {
            Pembayaran::create([
                'id_petugas' => Auth::user()->id_petugas,
                'nisn' => $validated['nisn'],
                'tgl_bayar' => now(),
                'bulan_dibayar' => $validated['bulan_dibayar'],
                'tahun_dibayar' => $validated['tahun_dibayar'],
                'id_spp' => $siswa->id_spp,
                'jumlah_bayar' => $validated['jumlah_bayar'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'bank_tujuan' => $request->bank_tujuan,
                'no_rekening_pengirim' => $request->no_rekening_pengirim,
                'nama_pengirim' => $request->nama_pengirim,
                'tanggal_transfer' => $request->tanggal_transfer,
                'catatan' => $request->catatan,
            ]);

            DB::commit();
            return back()->with('success', 'Pembayaran berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * CETAK STRUK
     */
    public function cetakStruk($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->findOrFail($id);

        return view('pembayaran.struk', compact('pembayaran'));
    }
}
