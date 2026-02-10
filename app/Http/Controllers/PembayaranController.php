<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * ============================
     *  HISTORY PEMBAYARAN
     * ============================
     */
    public function index(Request $request)
    {
        $pembayaran = Pembayaran::with([
                'siswa.kelas',
                'siswa.spp',
                'petugas'
            ])
            ->orderBy('tgl_bayar', 'desc')
            ->paginate(10);

        return view('pembayaran.history', compact('pembayaran'));
    }

    /**
     * ============================
     *  DETAIL PEMBAYARAN
     * ============================
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with([
            'siswa.kelas',
            'siswa.spp',
            'petugas'
        ])->findOrFail($id);

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * ============================
     *  CETAK STRUK
     * ============================
     */
    public function cetakStruk($id)
    {
        $pembayaran = Pembayaran::with([
            'siswa.kelas',
            'siswa.spp',
            'petugas'
        ])->findOrFail($id);

        return view('pembayaran.struk', compact('pembayaran'));
    }

    /**
     * ============================
     *  FORM ENTRI PEMBAYARAN
     * ============================
     */
    public function create()
    {
        $siswa = Siswa::with(['kelas', 'spp'])
            ->orderBy('nama')
            ->get();

        $petugas = Petugas::orderBy('nama_petugas')->get();

        // ✅ BULAN FIX (ANTI ERROR)
        $bulan = [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        // ✅ TAHUN SEKARANG
        $tahunSekarang = date('Y');

        return view('pembayaran.create', compact(
            'siswa',
            'petugas',
            'bulan',
            'tahunSekarang'
        ));
    }

    /**
     * ============================
     *  SIMPAN PEMBAYARAN
     * ============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'           => 'required|exists:siswa,nisn',
            'id_petugas'     => 'required|exists:petugas,id_petugas',
            'tgl_bayar'      => 'required|date',
            'bulan_dibayar'  => 'required|array|min:1',
            'tahun_dibayar'  => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $siswa   = Siswa::with('spp')->where('nisn', $request->nisn)->firstOrFail();
            $nominal = $siswa->spp->nominal;
            $bulanList = $request->bulan_dibayar;

            // ❗ Cegah double bayar untuk setiap bulan
            foreach ($bulanList as $bulan) {
                $cek = Pembayaran::where('nisn', $request->nisn)
                    ->where('bulan_dibayar', $bulan)
                    ->where('tahun_dibayar', $request->tahun_dibayar)
                    ->exists();

                if ($cek) {
                    throw new \Exception("Bulan $bulan tahun $request->tahun_dibayar sudah dibayar.");
                }
            }

            // ✅ Gabungkan semua bulan menjadi SATU transaksi
            $jumlahBulan = count($bulanList);
            $totalBayar = $nominal * $jumlahBulan;
            $bulanGabung = implode(', ', $bulanList);

            Pembayaran::create([
                'id_petugas'        => $request->id_petugas,
                'nisn'              => $request->nisn,
                'tgl_bayar'         => $request->tgl_bayar,
                'bulan_dibayar'     => $bulanGabung, // Simpan semua bulan dalam satu field
                'tahun_dibayar'     => $request->tahun_dibayar,
                'id_spp'            => $siswa->id_spp,
                'jumlah_bayar'      => $totalBayar, // Total semua bulan
                'metode_pembayaran' => 'tunai',
            ]);

            DB::commit();

            return redirect()
                ->route('pembayaran.index')
                ->with('success', "Pembayaran berhasil untuk $jumlahBulan bulan ($bulanGabung) sebesar Rp " . number_format($totalBayar, 0, ',', '.'));

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * ============================
     *  HAPUS PEMBAYARAN
     * ============================
     */
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return back()->with('success', 'Data pembayaran berhasil dihapus');
    }
}
