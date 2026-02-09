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
    /**
     * =============================
     *  INDEX DATA SISWA
     * =============================
     */
    public function index(Request $request)
    {
        $query = Siswa::with(['kelas', 'spp']);

        // 🔍 SEARCH (NISN, NIS, NAMA)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nisn', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // 🎓 FILTER KELAS
        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }

        // 📄 PAGINATION
        $siswa = $query
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        // ⚠️ INI YANG SEBELUMNYA KURANG
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.index', compact('siswa', 'kelas'));
    }

    /**
     * =============================
     *  FORM TAMBAH SISWA
     * =============================
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $spp   = Spp::orderBy('tahun', 'desc')->get();

        return view('siswa.create', compact('kelas', 'spp'));
    }

    /**
     * =============================
     *  SIMPAN DATA SISWA
     * =============================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => [
                'required', 'size:10', 'regex:/^[0-9]+$/', 'unique:siswa,nisn'
            ],
            'nis' => [
                'required', 'size:8', 'regex:/^[0-9]+$/'
            ],
            'nama' => [
                'required', 'string', 'min:3', 'max:35'
            ],
            'id_kelas' => [
                'required', 'exists:kelas,id_kelas'
            ],
            'alamat' => [
                'required', 'string', 'min:10'
            ],
            'no_telp' => [
                'required', 'regex:/^[0-9]+$/', 'max:13'
            ],
            'id_spp' => [
                'required', 'exists:spp,id_spp'
            ],
        ]);

        // DEFAULT AKUN SISWA
        $validated['username'] = $validated['nisn'];
        $validated['password'] = Hash::make('siswa123');

        Siswa::create($validated);

        return redirect()
            ->route('siswa.index')
            ->with('success', '✅ Data siswa berhasil ditambahkan! Password default: siswa123');
    }

    /**
     * =============================
     *  DETAIL SISWA
     * =============================
     */
    public function show(string $nisn)
    {
        $siswa = Siswa::with([
                'kelas',
                'spp',
                'pembayaran.petugas'
            ])
            ->where('nisn', $nisn)
            ->firstOrFail();

        return view('siswa.show', compact('siswa'));
    }

    /**
     * =============================
     *  FORM EDIT SISWA
     * =============================
     */
    public function edit(string $nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $spp   = Spp::orderBy('tahun', 'desc')->get();

        return view('siswa.edit', compact('siswa', 'kelas', 'spp'));
    }

    /**
     * =============================
     *  UPDATE DATA SISWA
     * =============================
     */
    public function update(Request $request, string $nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();

        $validated = $request->validate([
            'nisn' => [
                'required',
                'size:10',
                'regex:/^[0-9]+$/',
                Rule::unique('siswa', 'nisn')->ignore($siswa->nisn, 'nisn'),
            ],
            'nis' => [
                'required', 'size:8', 'regex:/^[0-9]+$/'
            ],
            'nama' => [
                'required', 'string', 'min:3', 'max:35'
            ],
            'id_kelas' => [
                'required', 'exists:kelas,id_kelas'
            ],
            'alamat' => [
                'required', 'string', 'min:10'
            ],
            'no_telp' => [
                'required', 'regex:/^[0-9]+$/', 'max:13'
            ],
            'id_spp' => [
                'required', 'exists:spp,id_spp'
            ],
        ]);

        $siswa->update($validated);

        return redirect()
            ->route('siswa.index')
            ->with('success', '✅ Data siswa berhasil diperbarui!');
    }

    /**
     * =============================
     *  HAPUS SISWA
     * =============================
     */
    public function destroy(string $nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();

        if ($siswa->pembayaran()->count() > 0) {
            return redirect()
                ->route('siswa.index')
                ->with('error', '❌ Siswa tidak dapat dihapus karena memiliki riwayat pembayaran');
        }

        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', '✅ Data siswa berhasil dihapus');
    }

    /**
     * =============================
     *  AJAX DETAIL SISWA
     * =============================
     */
    public function getDetail(string $nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran.petugas'])
            ->where('nisn', $nisn)
            ->firstOrFail();

        return response()->json([
            'siswa' => $siswa,
            'pembayaran' => $siswa->pembayaran->map(function ($p) {
                return [
                    'tgl_bayar'     => $p->tgl_bayar->format('d/m/Y'),
                    'bulan_dibayar' => $p->bulan_dibayar,
                    'tahun_dibayar' => $p->tahun_dibayar,
                    'jumlah_bayar'  => $p->jumlah_bayar,
                    'petugas'       => $p->petugas->nama_petugas ?? '-',
                ];
            })
        ]);
    }
}
