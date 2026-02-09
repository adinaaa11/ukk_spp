@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-navy text-white" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-2" style="font-size: 32px;">
                                <i class="fas fa-tachometer-alt me-3"></i>Dashboard Admin
                            </h2>
                            <p class="mb-0 opacity-75" style="font-size: 18px;">
                                Selamat datang, <strong>{{ Auth::user()->nama_petugas }}</strong>
                            </p>
                            <p class="mb-0 opacity-50" style="font-size: 16px;">
                                {{ now()->isoFormat('dddd, D MMMM Y') }}
                            </p>
                        </div>
                        <div>
                            <i class="fas fa-user-shield fa-4x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards - HANYA 4 CARD -->
    <div class="row g-4 mb-4">
        <!-- Total Siswa -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg hover-lift" style="border-radius: 15px; height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-primary bg-opacity-10 p-3" style="border-radius: 12px;">
                            <i class="fas fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1">Total Siswa</h6>
                            <h2 class="mb-0 fw-bold" style="color:#001f3f;">
                                {{ number_format($total_siswa, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg hover-lift" style="border-radius: 15px; height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-success bg-opacity-10 p-3" style="border-radius: 12px;">
                            <i class="fas fa-school fa-2x text-success"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1">Total Kelas</h6>
                            <h2 class="mb-0 fw-bold text-success">
                                {{ number_format($total_kelas, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg hover-lift" style="border-radius: 15px; height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-warning bg-opacity-10 p-3" style="border-radius: 12px;">
                            <i class="fas fa-receipt fa-2x text-warning"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1">Total Transaksi</h6>
                            <h2 class="mb-0 fw-bold text-warning">
                                {{ number_format($total_transaksi, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-lg hover-lift" style="border-radius: 15px; height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-danger bg-opacity-10 p-3" style="border-radius: 12px;">
                            <i class="fas fa-wallet fa-2x text-danger"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1">Total Pendapatan</h6>
                            <h2 class="mb-0 fw-bold text-danger">
                                Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pembayaran Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 py-4">
                    <h4 class="fw-bold">
                        <i class="fas fa-history me-2"></i>Pembayaran Terbaru
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Bulan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi_terbaru as $index => $pembayaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->isoFormat('D MMM Y') }}</td>
                                    <td>{{ $pembayaran->siswa->nisn }}</td>
                                    <td>{{ $pembayaran->siswa->nama }}</td>
                                    <td>{{ $pembayaran->siswa->kelas->nama_kelas }}</td>
                                    <td>{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</td>
                                    <td class="text-success fw-bold">
                                        Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lunas</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        Belum ada transaksi
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-navy {
    background: linear-gradient(135deg, #001f3f, #001529);
}
.hover-lift {
    transition: .3s;
}
.hover-lift:hover {
    transform: translateY(-6px);
}
</style>
@endsection