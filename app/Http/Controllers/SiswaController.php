<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $query = Siswa::with(['kelas', 'spp']);

        // Filter pencarian
        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('nisn', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // Filter kelas
        if (request()->has('kelas') && request('kelas') != '') {
            $query->where('id_kelas', request('kelas'));
        }

        $siswa = $query->paginate(10);
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('siswa.create', compact('kelas', 'spp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|size:10|unique:siswa,nisn',
            'nis' => 'required|string|size:8',
            'nama' => 'required|string|max:35',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|exists:spp,id_spp',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(string $nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran'])->findOrFail($nisn);
        return view('siswa.show', compact('siswa'));
    }

    public function edit(string $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'spp'));
    }

    public function update(Request $request, string $nisn)
    {
        $request->validate([
            'nisn' => 'required|string|size:10|unique:siswa,nisn,' . $nisn . ',nisn',
            'nis' => 'required|string|size:8',
            'nama' => 'required|string|max:35',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:13',
            'id_spp' => 'required|exists:spp,id_spp',
        ]);

        $siswa = Siswa::findOrFail($nisn);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy(string $nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        
        // Cek apakah siswa memiliki history pembayaran
        if ($siswa->pembayaran()->count() > 0) {
            return redirect()->route('siswa.index')
                ->with('error', 'Tidak dapat menghapus siswa yang memiliki riwayat pembayaran!');
        }

        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }

    // Method untuk Ajax detail siswa
    public function getDetail(string $nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran.petugas'])
            ->findOrFail($nisn);

        return response()->json([
            'siswa' => $siswa,
            'pembayaran' => $siswa->pembayaran->map(function($p) {
                return [
                    'tgl_bayar' => \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y'),
                    'bulan_dibayar' => $p->bulan_dibayar,
                    'tahun_dibayar' => $p->tahun_dibayar,
                    'jumlah_bayar' => $p->jumlah_bayar,
                    'petugas' => [
                        'nama_petugas' => $p->petugas->nama_petugas
                    ]
                ];
            })
        ]);
    }
}