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
     * Halaman History/Riwayat Pembayaran (Semua Transaksi)
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
        
        // Jika ada pencarian
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
     * DEPRECATED: Gunakan transaksi() sebagai gantinya
     * Method ini tetap ada untuk backward compatibility
     */
    public function cari(Request $request)
    {
        $request->validate(['nisn' => 'required']);
        
        $siswa = Siswa::with(['kelas', 'spp'])
            ->where('nisn', $request->nisn)
            ->first();
        
        if(!$siswa) {
            return back()->with('error', 'Siswa tidak ditemukan!');
        }

        // Ambil history pembayaran siswa ini
        $history = Pembayaran::where('nisn', $siswa->nisn)
            ->with('petugas')
            ->latest('tgl_bayar')
            ->get();

        return view('pembayaran.transaksi', compact('siswa', 'history'));
    }

    /**
     * Halaman Form Transaksi Pembayaran untuk Siswa Tertentu
     */
    public function transaksi($nisn)
    {
        // Cari siswa berdasarkan NISN
        $siswa = Siswa::with(['kelas', 'spp'])
            ->where('nisn', $nisn)
            ->first();
        
        if(!$siswa) {
            return redirect()
                ->route('pembayaran.create')
                ->with('error', 'Siswa tidak ditemukan!');
        }

        // Ambil history pembayaran siswa ini
        $history = Pembayaran::where('nisn', $siswa->nisn)
            ->with('petugas')
            ->latest('tgl_bayar')
            ->get();

        return view('pembayaran.transaksi', compact('siswa', 'history'));
    }

    /**
     * Proses Simpan Pembayaran dengan Transaction (Commit & Rollback)
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'nisn' => 'required',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric|min:0'
        ]);

        // Cari siswa berdasarkan NISN (PERBAIKAN: gunakan where()->first())
        $siswa = Siswa::with('spp')
            ->where('nisn', $request->nisn)
            ->first();

        if(!$siswa) {
            return back()->with('error', 'Siswa tidak ditemukan!');
        }

        // Cek apakah bulan tersebut sudah dibayar (Hindari Double Payment)
        $cek = Pembayaran::where([
            ['nisn', $request->nisn],
            ['bulan_dibayar', $request->bulan_dibayar],
            ['tahun_dibayar', $request->tahun_dibayar]
        ])->exists();

        if($cek) {
            return back()->with('error', 'Bulan ' . $request->bulan_dibayar . ' ' . $request->tahun_dibayar . ' sudah dibayar!');
        }

        // Transaksi Database dengan Commit & Rollback (Sesuai Standar UKK)
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
            
            return back()->with('success', '✅ Pembayaran berhasil disimpan!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', '❌ Terjadi Kesalahan: ' . $e->getMessage());
        }
    }
}