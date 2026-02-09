<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * HISTORY PEMBAYARAN - TAMPILKAN SEMUA SISWA YANG SUDAH BAYAR
     */
    public function index(Request $request)
    {
        // Query untuk mendapatkan siswa yang sudah pernah bayar
        $query = Siswa::with(['kelas', 'spp', 'pembayaran.petugas'])
            ->whereHas('pembayaran'); // Hanya siswa yang punya pembayaran
        
        // Filter berdasarkan pencarian nama/NISN
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nisn', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }
        
        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }
        
        // Filter berdasarkan tahun pembayaran
        if ($request->filled('tahun')) {
            $query->whereHas('pembayaran', function($q) use ($request) {
                $q->where('tahun_dibayar', $request->tahun);
            });
        }
        
        $siswa = $query->paginate(15);
        
        // Data untuk filter dropdown
        $kelasList = Kelas::all();
        $tahunList = Pembayaran::select('tahun_dibayar')
            ->distinct()
            ->orderBy('tahun_dibayar', 'desc')
            ->pluck('tahun_dibayar');
        
        // Hitung total keseluruhan
        $totalSiswa = Siswa::whereHas('pembayaran')->count();
        $totalPembayaran = Pembayaran::sum('jumlah_bayar');
        
        return view('pembayaran.index', compact('siswa', 'kelasList', 'tahunList', 'totalSiswa', 'totalPembayaran'));
    }

    public function create()
    {
        $siswa = Siswa::with(['kelas', 'spp'])->orderBy('nama')->get();
        $spp = Spp::orderBy('tahun', 'desc')->get();
        
        return view('pembayaran.create', compact('siswa', 'spp'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'tgl_bayar' => 'required|date',
            'bulan_dibayar' => 'required|array|min:1',
            'bulan_dibayar.*' => 'required|string',
            'tahun_dibayar' => 'required|integer',
            'id_spp' => 'required|exists:spp,id_spp',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai',
        ], [
            'bulan_dibayar.required' => 'Pilih minimal 1 bulan yang akan dibayar',
            'bulan_dibayar.min' => 'Pilih minimal 1 bulan yang akan dibayar',
            'nisn.required' => 'Siswa harus dipilih',
            'nisn.exists' => 'Data siswa tidak ditemukan',
            'tgl_bayar.required' => 'Tanggal bayar harus diisi',
            'tahun_dibayar.required' => 'Tahun dibayar harus diisi',
            'id_spp.required' => 'Tarif SPP harus dipilih',
            'id_spp.exists' => 'Data SPP tidak ditemukan',
            'jumlah_bayar.required' => 'Jumlah bayar harus diisi',
            'metode_pembayaran.required' => 'Metode pembayaran harus dipilih',
        ]);
        
        try {
            DB::beginTransaction();
            
            $bulanArray = $request->bulan_dibayar;
            $spp = Spp::findOrFail($request->id_spp);
            $nominalPerBulan = $spp->nominal;
            $petugas = auth()->user();
            
            $pembayaranBerhasil = [];
            $pembayaranGagal = [];
            
            foreach ($bulanArray as $bulan) {
                // Cek apakah sudah pernah bayar di bulan dan tahun yang sama
                $cekSudahBayar = Pembayaran::where('nisn', $request->nisn)
                    ->where('bulan_dibayar', $bulan)
                    ->where('tahun_dibayar', $request->tahun_dibayar)
                    ->exists();
                
                if ($cekSudahBayar) {
                    $pembayaranGagal[] = $bulan . ' ' . $request->tahun_dibayar . ' (sudah dibayar)';
                    continue;
                }
                
                // Simpan pembayaran
                $pembayaran = new Pembayaran();
                $pembayaran->nisn = $request->nisn;
                $pembayaran->tgl_bayar = $request->tgl_bayar;
                $pembayaran->bulan_dibayar = $bulan;
                $pembayaran->tahun_dibayar = $request->tahun_dibayar;
                $pembayaran->id_spp = $request->id_spp;
                $pembayaran->jumlah_bayar = $nominalPerBulan;
                $pembayaran->metode_pembayaran = $request->metode_pembayaran;
                $pembayaran->id_petugas = $petugas->id_petugas ?? 1;
                $pembayaran->save();
                
                $pembayaranBerhasil[] = $bulan . ' ' . $request->tahun_dibayar;
            }
            
            DB::commit();
            
            // Buat pesan notifikasi
            $message = '';
            if (!empty($pembayaranBerhasil)) {
                $message .= 'Pembayaran berhasil untuk bulan: ' . implode(', ', $pembayaranBerhasil) . '. ';
                $message .= 'Total: Rp ' . number_format(count($pembayaranBerhasil) * $nominalPerBulan, 0, ',', '.');
            }
            
            if (!empty($pembayaranGagal)) {
                $message .= ' | Gagal/Sudah dibayar: ' . implode(', ', $pembayaranGagal);
            }
            
            return redirect()
                ->route('pembayaran.index')
                ->with('success', $message);
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'spp', 'petugas'])->findOrFail($id);
        
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function destroy($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $bulan = $pembayaran->bulan_dibayar;
            $tahun = $pembayaran->tahun_dibayar;
            $siswa = $pembayaran->siswa->nama;
            
            $pembayaran->delete();
            
            return redirect()
                ->route('pembayaran.index')
                ->with('success', "Pembayaran SPP $siswa bulan $bulan $tahun berhasil dihapus");
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakStruk($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'spp', 'petugas'])->findOrFail($id);
        
        return view('pembayaran.struk', compact('pembayaran'));
    }
}