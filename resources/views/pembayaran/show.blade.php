@extends('layouts.main')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-receipt me-2"></i>Detail Pembayaran
            </h4>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>NISN</th>
                    <td>{{ $pembayaran->siswa->nisn }}</td>
                </tr>
                <tr>
                    <th>Nama Siswa</th>
                    <td>{{ $pembayaran->siswa->nama }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $pembayaran->siswa->kelas->nama_kelas }}</td>
                </tr>
                <tr>
                    <th>Bulan / Tahun</th>
                    <td>{{ $pembayaran->bulan_dibayar }} / {{ $pembayaran->tahun_dibayar }}</td>
                </tr>
                <tr>
                    <th>Jumlah Bayar</th>
                    <td><strong>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <th>Metode</th>
                    <td>{{ ucfirst($pembayaran->metode_pembayaran) }}</td>
                </tr>
                <tr>
                    <th>Petugas</th>
                    <td>{{ $pembayaran->petugas->nama_petugas }}</td>
                </tr>
                <tr>
                    <th>Tanggal Bayar</th>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->isoFormat('D MMMM Y') }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <a href="{{ route('pembayaran.struk', $pembayaran->id_pembayaran) }}" 
                   class="btn btn-success" target="_blank">
                    <i class="fas fa-print me-1"></i>Cetak Struk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
