@extends('layouts.main')

@section('content')
<div class="card card-custom">
    <div class="card-header-navy d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-list-alt me-2"></i> Data Riwayat Pembayaran</h4>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-yellow btn-sm">
            <i class="fas fa-plus me-1"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Petugas</th>
                        <th>Siswa</th>
                        <th>Tanggal</th>
                        <th>Bulan & Tahun</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->petugas->nama_petugas }}</td>
                        <td>
                            <strong>{{ $p->siswa->nama }}</strong><br>
                            <small class="text-muted">{{ $p->nisn }}</small>
                        </td>
                        <td>{{ $p->tgl_bayar }}</td>
                        <td>{{ $p->bulan_dibayar }} - {{ $p->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar) }}</td>
                        <td>
                            <button class="btn btn-sm btn-info text-white"><i class="fas fa-print"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pembayaran->links() }}
        </div>
    </div>
</div>
@endsection