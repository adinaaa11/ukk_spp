@extends('layouts.main')

@section('title', 'Histori Pembayaran SPP')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-header bg-gradient-navy text-white py-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="mb-1">
                                <i class="fas fa-history me-2"></i>Histori Pembayaran SPP
                            </h3>
                            <p class="mb-0 opacity-75">Daftar semua transaksi pembayaran SPP</p>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <a href="{{ route('pembayaran.create') }}" class="btn btn-warning btn-lg shadow">
                                <i class="fas fa-plus-circle me-2"></i>Input Pembayaran
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">

                    <!-- Summary -->
                    <div class="alert alert-info shadow-sm mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Total Transaksi:</strong>
                                <span class="badge bg-primary ms-2">
                                    {{ $pembayaran->total() }}
                                </span>
                            </div>
                            <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                <strong>Total Pendapatan:</strong>
                                <span class="badge bg-success ms-2">
                                    Rp {{ number_format($pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembayaran as $index => $bayar)
                                <tr>
                                    <td>
                                        {{ $pembayaran->firstItem() + $index }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($bayar->tgl_bayar)->format('d M Y') }}
                                    </td>
                                    <td><strong>{{ $bayar->siswa->nisn }}</strong></td>
                                    <td>{{ $bayar->siswa->nama }}</td>
                                    <td>{{ $bayar->siswa->kelas->nama_kelas }}</td>
                                    <td>
                                        @php
                                            $bulans = explode(', ', $bayar->bulan_dibayar);
                                            $badgeColors = ['primary', 'success', 'warning', 'info', 'secondary'];
                                        @endphp
                                        @foreach($bulans as $index => $bulan)
                                            <span class="badge bg-{{ $badgeColors[$index % count($badgeColors)] }} me-1 mb-1">
                                                {{ $bulan }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>{{ $bayar->tahun_dibayar }}</td>
                                    <td class="text-success fw-bold">
                                        Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ ucfirst($bayar->metode_pembayaran) }}
                                        </span>
                                    </td>
                                    <td>{{ $bayar->petugas->nama_petugas }}</td>
                                    <td>
                                        <a href="{{ route('pembayaran.show', $bayar->id_pembayaran) }}"
                                           class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                        <a href="{{ route('pembayaran.struk', $bayar->id_pembayaran) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-success">
                                            Struk
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4">
                                        <em>Belum ada data pembayaran</em>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($pembayaran->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                        <div>
                            Menampilkan
                            <strong>{{ $pembayaran->firstItem() }}</strong>
                            sampai
                            <strong>{{ $pembayaran->lastItem() }}</strong>
                            dari
                            <strong>{{ $pembayaran->total() }}</strong>
                            transaksi
                        </div>
                        <div>
                            {{ $pembayaran->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-navy {
    background: linear-gradient(135deg, #001f3f, #001529);
}
</style>
@endsection
