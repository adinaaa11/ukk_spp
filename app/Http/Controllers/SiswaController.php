<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with(['kelas', 'spp']);

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nisn', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // Filter kelas
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('id_kelas', $request->kelas);
        }

        $siswa = $query->paginate(5);
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
        // VALIDASI LENGKAP
        $validated = $request->validate([
            'nisn' => [
                'required',
                'string',
                'size:10',
                'unique:siswa,nisn',
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'nis' => [
                'required',
                'string',
                'size:8',
                'regex:/^[0-9]+$/',
            ],
            'nama' => [
                'required',
                'string',
                'max:35',
                'min:3',
            ],
            'id_kelas' => [
                'required',
                'exists:kelas,id_kelas',
            ],
            'alamat' => [
                'required',
                'string',
                'min:10',
            ],
            'no_telp' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'id_spp' => [
                'required',
                'exists:spp,id_spp',
            ],
        ], [
            'nisn.required' => 'NISN harus diisi',
            'nisn.size' => 'NISN harus 10 digit',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.regex' => 'NISN hanya boleh berisi angka',
            'nis.required' => 'NIS harus diisi',
            'nis.size' => 'NIS harus 8 digit',
            'nis.regex' => 'NIS hanya boleh berisi angka',
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.max' => 'Nama maksimal 35 karakter',
            'id_kelas.required' => 'Kelas harus dipilih',
            'id_kelas.exists' => 'Kelas tidak valid',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'no_telp.required' => 'No. Telepon harus diisi',
            'no_telp.regex' => 'No. Telepon hanya boleh berisi angka',
            'id_spp.required' => 'SPP harus dipilih',
            'id_spp.exists' => 'SPP tidak valid',
        ]);

        // Tambahkan username dan password default
        $validated['username'] = $validated['nisn'];
        $validated['password'] = Hash::make('siswa123'); // Password default

        Siswa::create($validated);

        return redirect()->route('siswa.index')
            ->with('success', '✅ Data siswa berhasil ditambahkan! Password default: siswa123');
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
        $siswa = Siswa::findOrFail($nisn);

        // VALIDASI LENGKAP
        $validated = $request->validate([
            'nisn' => [
                'required',
                'string',
                'size:10',
                'regex:/^[0-9]+$/',
                Rule::unique('siswa', 'nisn')->ignore($nisn, 'nisn'),
            ],
            'nis' => [
                'required',
                'string',
                'size:8',
                'regex:/^[0-9]+$/',
            ],
            'nama' => [
                'required',
                'string',
                'max:35',
                'min:3',
            ],
            'id_kelas' => [
                'required',
                'exists:kelas,id_kelas',
            ],
            'alamat' => [
                'required',
                'string',
                'min:10',
            ],
            'no_telp' => [
                'required',
                'string',
                'max:13',
                'regex:/^[0-9]+$/',
            ],
            'id_spp' => [
                'required',
                'exists:spp,id_spp',
            ],
        ], [
            'nisn.required' => 'NISN harus diisi',
            'nisn.size' => 'NISN harus 10 digit',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.regex' => 'NISN hanya boleh berisi angka',
            'nis.required' => 'NIS harus diisi',
            'nis.size' => 'NIS harus 8 digit',
            'nis.regex' => 'NIS hanya boleh berisi angka',
            'nama.required' => 'Nama harus diisi',
            'nama.min' => 'Nama minimal 3 karakter',
            'id_kelas.required' => 'Kelas harus dipilih',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.min' => 'Alamat minimal 10 karakter',
            'no_telp.required' => 'No. Telepon harus diisi',
            'no_telp.regex' => 'No. Telepon hanya boleh berisi angka',
            'id_spp.required' => 'SPP harus dipilih',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')
            ->with('success', '✅ Data siswa berhasil diupdate!');
    }

    public function destroy(string $nisn)
    {
        try {
            $siswa = Siswa::findOrFail($nisn);
            
            // VALIDASI: Cek apakah siswa memiliki history pembayaran
            if ($siswa->pembayaran()->count() > 0) {
                return redirect()->route('siswa.index')
                    ->with('error', '❌ Tidak dapat menghapus siswa yang memiliki riwayat pembayaran!');
            }

            $siswa->delete();

            return redirect()->route('siswa.index')
                ->with('success', '✅ Data siswa berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('siswa.index')
                ->with('error', '❌ Terjadi kesalahan: ' . $e->getMessage());
        }
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