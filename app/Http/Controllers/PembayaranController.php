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
     * Halaman History / Riwayat Pembayaran (Semua Transaksi)
     */
    public function index()
    {
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])
            ->latest('tgl_bayar')
            ->paginate(10);
        
        return view('pembayaran.history', compact('pembayaran'));
    }

    /**
     * Halaman Form Pencarian Siswa untuk Entri Pembayaran
     */
    public function create(Request $request)
    {
        $siswa = null;
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            
            $siswa = Siswa::with(['kelas', 'spp'])
                ->where('nisn', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->get();
        }
        
        return view('pembayaran.create', compact('siswa'));
    }

    /**
     * Halaman Form Transaksi Pembayaran untuk Siswa Tertentu
     */
    public function transaksi($nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp'])
            ->where('nisn', $nisn)
            ->first();
        
        if (!$siswa) {
            return redirect()
                ->route('pembayaran.create')
                ->with('error', 'Siswa tidak ditemukan!');
        }

        $history = Pembayaran::where('nisn', $siswa->nisn)
            ->with('petugas')
            ->latest('tgl_bayar')
            ->get();

        return view('pembayaran.transaksi', compact('siswa', 'history'));
    }

    /**
     * Proses Simpan Pembayaran
     */
    public function store(Request $request)
    {
        $rules = [
            'nisn' => 'required|string|size:10|exists:siswa,nisn',
            'bulan_dibayar' => 'required|string|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_dibayar' => 'required|numeric|digits:4|min:2020|max:2030',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer'
        ];

        if ($request->metode_pembayaran == 'transfer') {
            $rules['bank_tujuan'] = 'required|string|max:50';
            $rules['no_rekening_pengirim'] = 'required|string|max:50';
            $rules['nama_pengirim'] = 'required|string|max:100';
            $rules['tanggal_transfer'] = 'required|date';
        }

        $validated = $request->validate($rules);

        $siswa = Siswa::with('spp')
            ->where('nisn', $validated['nisn'])
            ->first();

        if (!$siswa) {
            return back()->with('error', 'Siswa tidak ditemukan!');
        }

        $cek = Pembayaran::where([
            ['nisn', $validated['nisn']],
            ['bulan_dibayar', $validated['bulan_dibayar']],
            ['tahun_dibayar', $validated['tahun_dibayar']]
        ])->exists();

        if ($cek) {
            return back()->with(
                'error',
                'Bulan ' . $validated['bulan_dibayar'] . ' ' . $validated['tahun_dibayar'] . ' sudah dibayar!'
            );
        }

        DB::beginTransaction();

        try {
            $data = [
                'id_petugas' => Auth::user()->id_petugas,
                'nisn' => $validated['nisn'],
                'tgl_bayar' => now(),
                'bulan_dibayar' => $validated['bulan_dibayar'],
                'tahun_dibayar' => $validated['tahun_dibayar'],
                'id_spp' => $siswa->id_spp,
                'jumlah_bayar' => $validated['jumlah_bayar'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
            ];

            if ($validated['metode_pembayaran'] == 'transfer') {
                $data['bank_tujuan'] = $request->bank_tujuan;
                $data['no_rekening_pengirim'] = $request->no_rekening_pengirim;
                $data['nama_pengirim'] = $request->nama_pengirim;
                $data['tanggal_transfer'] = $request->tanggal_transfer;
                $data['catatan'] = $request->catatan;
            }

            Pembayaran::create($data);

            DB::commit();

            return back()->with(
                'success',
                '✅ Pembayaran berhasil disimpan!'
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(
                'error',
                '❌ Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    /**
     * CETAK STRUK PEMBAYARAN
     */
    public function cetakStruk($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->findOrFail($id);

        return view('pembayaran.struk', compact('pembayaran'));
    }
}
