@extends('layouts.main')

@section('content')
<div class="card card-custom">
    <div class="card-header-navy d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fas fa-list-alt me-2"></i> Data Riwayat Pembayaran</h4>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-yellow btn-sm">
            <i class="fas fa-plus me-1"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Tanggal</th>
                        <th width="15%">NISN</th>
                        <th width="20%">Siswa</th>
                        <th width="15%">Bulan/Tahun</th>
                        <th width="15%">Jumlah</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $index => $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                        <td><span class="badge bg-secondary">{{ $p->nisn }}</span></td>
                        <td>
                            <strong>{{ $p->siswa->nama }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $p->bulan_dibayar }}</span>
                            <span class="badge bg-secondary">{{ $p->tahun_dibayar }}</span>
                        </td>
                        <td><strong class="text-success">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</strong></td>
                        <td class="text-center">
                            <a href="{{ route('pembayaran.struk', $p->id_pembayaran) }}" 
                               class="btn btn-sm btn-info text-white" 
                               target="_blank"
                               title="Cetak Struk">
                                <i class="fas fa-print"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada data pembayaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection