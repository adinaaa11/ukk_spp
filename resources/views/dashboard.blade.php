@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div class="mb-2 mb-md-0">
            <h2 class="fw-bold mb-1" style="color: var(--navy-primary);">Dashboard</h2>
            <p class="text-muted mb-0">Selamat datang, <strong>{{ auth()->user()->nama_petugas }}</strong> ({{ ucfirst(auth()->user()->level) }})</p>
        </div>
        <div>
            <span class="badge px-3 py-2" style="background: var(--yellow-accent); color: var(--navy-dark);">
                <i class="fas fa-calendar-day me-2"></i>{{ now()->isoFormat('dddd, D MMMM Y') }}
            </span>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card card-custom border-start border-4" style="border-color: var(--navy-primary) !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1" style="font-size: 0.75rem;">Total Siswa</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--navy-primary); font-size: 1.5rem;">{{ $total_siswa }}</h3>
                        </div>
                        <div class="d-none d-md-block" style="font-size: 2rem; color: var(--navy-primary); opacity: 0.3;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card card-custom border-start border-4" style="border-color: var(--yellow-accent) !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1" style="font-size: 0.75rem;">Total Jurusan</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--yellow-hover); font-size: 1.5rem;">10</h3>
                            <small class="text-muted" style="font-size: 0.65rem;">{{ $total_kelas }} Kelas</small>
                        </div>
                        <div class="d-none d-md-block" style="font-size: 2rem; color: var(--yellow-accent); opacity: 0.3;">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card card-custom border-start border-4 border-info">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1" style="font-size: 0.75rem;">Total Petugas</h6>
                            <h3 class="fw-bold mb-0 text-info" style="font-size: 1.5rem;">{{ $total_petugas }}</h3>
                        </div>
                        <div class="d-none d-md-block" style="font-size: 2rem; color: #3498db; opacity: 0.3;">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card card-custom border-start border-4 border-success">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1" style="font-size: 0.75rem;">Total Transaksi</h6>
                            <h3 class="fw-bold mb-0 text-success" style="font-size: 1.5rem;">{{ $total_transaksi }}</h3>
                        </div>
                        <div class="d-none d-md-block" style="font-size: 2rem; color: #27ae60; opacity: 0.3;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);">
                <div class="card-body text-white p-3 p-md-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2 mb-md-3"><i class="fas fa-coins me-2"></i>Total Pendapatan Keseluruhan</h5>
                            <h2 class="fw-bold mb-0" style="color: var(--yellow-accent); font-size: clamp(1.5rem, 5vw, 2.5rem);">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h2>
                            <small class="opacity-75">Dari {{ $total_transaksi }} transaksi</small>
                        </div>
                        <div class="col-md-4 text-center mt-3 mt-md-0">
                            <div style="font-size: clamp(3rem, 10vw, 5rem); opacity: 0.2;">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info 10 Jurusan -->
    <div class="card card-custom mb-4">
        <div class="card-header-navy">
            <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>10 Jurusan yang Tersedia</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold text-primary mb-3">📱 Bidang IT</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="font-size: 0.85rem;">✓ RPL - Rekayasa Perangkat Lunak</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ DKV - Desain Komunikasi Visual</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ MKT - Mekatronika</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ TKJ - Teknik Komputer dan Jaringan</li>
                    </ul>
                </div>
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold text-warning mb-3">⚙️ Bidang Permesinan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="font-size: 0.85rem;">✓ TPM - Teknik Permesinan</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ TL - Teknik Pengelasan</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ TBKR - Teknik Body Kendaraan Ringan</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ TKR - Teknik Kendaraan Ringan</li>
                    </ul>
                </div>
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold text-success mb-3">🌾 Bidang Pertanian</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2" style="font-size: 0.85rem;">✓ APHP - Agribisnis Pengolahan Hasil Pertanian</li>
                        <li class="mb-2" style="font-size: 0.85rem;">✓ ATPH - Agribisnis Tanaman Pangan dan Hortikultura</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="card card-custom">
        <div class="card-header-navy">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Transaksi Terbaru</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th>Tanggal</th>
                            <th>NISN</th>
                            <th class="d-none d-md-table-cell">Nama Siswa</th>
                            <th>Bulan</th>
                            <th>Nominal</th>
                            <th class="d-none d-lg-table-cell">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi_terbaru as $t)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($t->tgl_bayar)->format('d/m/Y') }}</td>
                            <td><span class="badge bg-secondary">{{ $t->nisn }}</span></td>
                            <td class="d-none d-md-table-cell">{{ $t->siswa->nama }}</td>
                            <td><span class="badge" style="background: var(--navy-primary); color: white;">{{ $t->bulan_dibayar }} {{ $t->tahun_dibayar }}</span></td>
                            <td><strong class="text-success">Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</strong></td>
                            <td class="d-none d-lg-table-cell">{{ $t->petugas->nama_petugas }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
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

<style>
/* Additional responsive styles for dashboard */
@media (max-width: 576px) {
    .card-body {
        padding: 10px !important;
    }
    
    h3 {
        font-size: 1.3rem !important;
    }
    
    .table {
        font-size: 0.65rem !important;
    }
}
</style>
@endsection