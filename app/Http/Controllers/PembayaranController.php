<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     * Halaman History Pembayaran
     */
    public function index(Request $request)
    {
        // Query dasar dengan relasi
        $query = Pembayaran::with(['siswa.kelas', 'siswa.spp', 'petugas']);
        
        // Filter berdasarkan search (nama/nisn/nis)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nisn', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan bulan
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_dibayar', $request->bulan);
        }
        
        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_dibayar', $request->tahun);
        }
        
        // Ambil data dengan pagination (15 per halaman)
        $pembayaran = $query->orderBy('tgl_bayar', 'desc')->paginate(15);
        
        // Append query string ke pagination agar filter tetap ada saat pindah halaman
        $pembayaran->appends($request->all());
        
        // Kirim ke view
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     * Halaman Form Tambah Pembayaran
     */
    public function create()
    {
        // Ambil data siswa yang aktif dengan relasi kelas dan spp
        $siswa = Siswa::with(['kelas', 'spp'])->orderBy('nama', 'asc')->get();
        
        // Ambil data petugas
        $petugas = Petugas::orderBy('nama_petugas', 'asc')->get();
        
        // Daftar bulan
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        // Tahun saat ini
        $tahunSekarang = date('Y');
        
        return view('pembayaran.create', compact('siswa', 'petugas', 'bulan', 'tahunSekarang'));
    }

    /**
     * Store a newly created resource in storage.
     * Proses Simpan Pembayaran Baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'id_petugas' => 'required|exists:petugas,id_petugas',
            'tgl_bayar' => 'required|date',
            'bulan_dibayar' => 'required|string',
            'tahun_dibayar' => 'required|integer',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer',
        ], [
            'nisn.required' => 'Siswa harus dipilih',
            'nisn.exists' => 'Data siswa tidak ditemukan',
            'id_petugas.required' => 'Petugas harus dipilih',
            'id_petugas.exists' => 'Data petugas tidak ditemukan',
            'tgl_bayar.required' => 'Tanggal pembayaran harus diisi',
            'tgl_bayar.date' => 'Format tanggal tidak valid',
            'bulan_dibayar.required' => 'Bulan pembayaran harus dipilih',
            'tahun_dibayar.required' => 'Tahun pembayaran harus diisi',
            'tahun_dibayar.integer' => 'Format tahun tidak valid',
            'jumlah_bayar.required' => 'Jumlah pembayaran harus diisi',
            'jumlah_bayar.numeric' => 'Jumlah pembayaran harus berupa angka',
            'jumlah_bayar.min' => 'Jumlah pembayaran tidak boleh negatif',
            'metode_pembayaran.required' => 'Metode pembayaran harus dipilih',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid',
        ]);

        try {
            // Ambil data siswa untuk mendapatkan id_spp
            $siswa = Siswa::where('nisn', $validated['nisn'])->first();

            if (!$siswa) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Data siswa tidak ditemukan!');
            }

            // Cek apakah sudah pernah bayar di bulan dan tahun yang sama
            $cekDuplikat = Pembayaran::where('nisn', $validated['nisn'])
                ->where('bulan_dibayar', $validated['bulan_dibayar'])
                ->where('tahun_dibayar', $validated['tahun_dibayar'])
                ->first();

            if ($cekDuplikat) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Pembayaran untuk bulan ' . $validated['bulan_dibayar'] . ' ' . $validated['tahun_dibayar'] . ' sudah ada!');
            }

            // Simpan data pembayaran
            $pembayaran = new Pembayaran();
            $pembayaran->id_petugas = $validated['id_petugas'];
            $pembayaran->nisn = $validated['nisn'];
            $pembayaran->tgl_bayar = $validated['tgl_bayar'];
            $pembayaran->bulan_dibayar = $validated['bulan_dibayar'];
            $pembayaran->tahun_dibayar = $validated['tahun_dibayar'];
            $pembayaran->id_spp = $siswa->id_spp;
            $pembayaran->jumlah_bayar = $validated['jumlah_bayar'];
            $pembayaran->metode_pembayaran = $validated['metode_pembayaran'];
            $pembayaran->save();

            // Redirect dengan pesan sukses
            return redirect()->route('pembayaran.index')
                ->with('success', 'Data pembayaran berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * Detail Pembayaran (opsional)
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'siswa.spp', 'petugas'])
            ->findOrFail($id);
        
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     * Halaman Edit Pembayaran
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])->findOrFail($id);
        
        // Ambil data siswa
        $siswa = Siswa::with(['kelas', 'spp'])->orderBy('nama', 'asc')->get();
        
        // Ambil data petugas
        $petugas = Petugas::orderBy('nama_petugas', 'asc')->get();
        
        // Daftar bulan
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        return view('pembayaran.edit', compact('pembayaran', 'siswa', 'petugas', 'bulan'));
    }

    /**
     * Update the specified resource in storage.
     * Proses Update Pembayaran
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'id_petugas' => 'required|exists:petugas,id_petugas',
            'tgl_bayar' => 'required|date',
            'bulan_dibayar' => 'required|string',
            'tahun_dibayar' => 'required|integer',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer',
        ], [
            'nisn.required' => 'Siswa harus dipilih',
            'nisn.exists' => 'Data siswa tidak ditemukan',
            'id_petugas.required' => 'Petugas harus dipilih',
            'id_petugas.exists' => 'Data petugas tidak ditemukan',
            'tgl_bayar.required' => 'Tanggal pembayaran harus diisi',
            'tgl_bayar.date' => 'Format tanggal tidak valid',
            'bulan_dibayar.required' => 'Bulan pembayaran harus dipilih',
            'tahun_dibayar.required' => 'Tahun pembayaran harus diisi',
            'tahun_dibayar.integer' => 'Format tahun tidak valid',
            'jumlah_bayar.required' => 'Jumlah pembayaran harus diisi',
            'jumlah_bayar.numeric' => 'Jumlah pembayaran harus berupa angka',
            'jumlah_bayar.min' => 'Jumlah pembayaran tidak boleh negatif',
            'metode_pembayaran.required' => 'Metode pembayaran harus dipilih',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid',
        ]);

        try {
            $pembayaran = Pembayaran::findOrFail($id);

            // Ambil data siswa untuk mendapatkan id_spp
            $siswa = Siswa::where('nisn', $validated['nisn'])->first();

            if (!$siswa) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Data siswa tidak ditemukan!');
            }

            // Cek duplikat (kecuali data yang sedang diedit)
            $cekDuplikat = Pembayaran::where('nisn', $validated['nisn'])
                ->where('bulan_dibayar', $validated['bulan_dibayar'])
                ->where('tahun_dibayar', $validated['tahun_dibayar'])
                ->where('id_pembayaran', '!=', $id)
                ->first();

            if ($cekDuplikat) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Pembayaran untuk bulan ' . $validated['bulan_dibayar'] . ' ' . $validated['tahun_dibayar'] . ' sudah ada!');
            }

            // Update data pembayaran
            $pembayaran->id_petugas = $validated['id_petugas'];
            $pembayaran->nisn = $validated['nisn'];
            $pembayaran->tgl_bayar = $validated['tgl_bayar'];
            $pembayaran->bulan_dibayar = $validated['bulan_dibayar'];
            $pembayaran->tahun_dibayar = $validated['tahun_dibayar'];
            $pembayaran->id_spp = $siswa->id_spp;
            $pembayaran->jumlah_bayar = $validated['jumlah_bayar'];
            $pembayaran->metode_pembayaran = $validated['metode_pembayaran'];
            $pembayaran->save();

            // Redirect dengan pesan sukses
            return redirect()->route('pembayaran.index')
                ->with('success', 'Data pembayaran berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * Hapus Pembayaran
     */
    public function destroy($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->delete();

            return redirect()->route('pembayaran.index')
                ->with('success', 'Data pembayaran berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * AJAX: Get detail siswa by NISN
     * Untuk mendapatkan info SPP siswa saat input pembayaran
     */
    public function getSiswaDetail($nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'nama' => $siswa->nama,
                'nis' => $siswa->nis,
                'kelas' => $siswa->kelas->nama_kelas ?? '-',
                'kompetensi_keahlian' => $siswa->kelas->kompetensi_keahlian ?? '-',
                'tahun_spp' => $siswa->spp->tahun ?? '-',
                'nominal_spp' => $siswa->spp->nominal ?? 0,
                'nominal_formatted' => 'Rp ' . number_format($siswa->spp->nominal ?? 0, 0, ',', '.')
            ]
        ]);
    }

    /**
     * AJAX: Cek pembayaran yang sudah ada untuk siswa tertentu
     * Untuk menampilkan histori pembayaran saat input
     */
    public function getRiwayatPembayaran($nisn)
    {
        $pembayaran = Pembayaran::with('petugas')
            ->where('nisn', $nisn)
            ->orderBy('tahun_dibayar', 'desc')
            ->orderByRaw("FIELD(bulan_dibayar, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember') DESC")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pembayaran
        ]);
    }

    /**
     * Export/Print Laporan Pembayaran (opsional)
     */
    public function laporan(Request $request)
    {
        $query = Pembayaran::with(['siswa.kelas', 'petugas']);

        // Filter
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('bulan_dibayar', $request->bulan);
        }

        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_dibayar', $request->tahun);
        }

        if ($request->has('metode') && $request->metode != '') {
            $query->where('metode_pembayaran', $request->metode);
        }

        $pembayaran = $query->orderBy('tgl_bayar', 'desc')->get();

        $totalPemasukan = $pembayaran->sum('jumlah_bayar');
        $totalTunai = $pembayaran->where('metode_pembayaran', 'tunai')->sum('jumlah_bayar');
        $totalTransfer = $pembayaran->where('metode_pembayaran', 'transfer')->sum('jumlah_bayar');

        return view('pembayaran.laporan', compact('pembayaran', 'totalPemasukan', 'totalTunai', 'totalTransfer'));
    }

    /**
     * Cetak Struk Pembayaran
     */
    public function cetak($id)
    {
        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas'])->findOrFail($id);
        
        return view('pembayaran.cetak', compact('pembayaran'));
    }
}