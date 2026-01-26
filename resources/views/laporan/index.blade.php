@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Laporan Pembayaran SPP</h2>
        <p class="section-subtitle">Export data pembayaran ke Excel dengan filter yang dapat disesuaikan</p>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card card-custom border-start border-4" style="border-color: var(--navy-primary) !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Transaksi</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--navy-primary);">{{ number_format($stats['total_transaksi']) }}</h3>
                        </div>
                        <div class="fs-1 opacity-50" style="color: var(--navy-primary);">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Pendapatan</h6>
                            <h3 class="fw-bold mb-0 text-success">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h3>
                        </div>
                        <div class="fs-1 text-success opacity-50">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pembayaran Tunai</h6>
                            <h3 class="fw-bold mb-0 text-warning">{{ number_format($stats['pembayaran_tunai']) }}</h3>
                        </div>
                        <div class="fs-1 text-warning opacity-50">
                            <i class="fas fa-money-bill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pembayaran Transfer</h6>
                            <h3 class="fw-bold mb-0 text-info">{{ number_format($stats['pembayaran_transfer']) }}</h3>
                        </div>
                        <div class="fs-1 text-info opacity-50">
                            <i class="fas fa-university"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Filter Laporan -->
    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Laporan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.pembayaran') }}" method="GET">
                        <div class="row g-3">
                            <!-- Periode Tanggal -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                            </div>

                            <!-- Filter Bulan -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Bulan</label>
                                <select name="bulan" class="form-select">
                                    <option value="">-- Semua Bulan --</option>
                                    <option value="Januari" {{ request('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                                    <option value="Februari" {{ request('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                                    <option value="Maret" {{ request('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                                    <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                                    <option value="Mei" {{ request('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                                    <option value="Juni" {{ request('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                                    <option value="Juli" {{ request('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                                    <option value="Agustus" {{ request('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                    <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September</option>
                                    <option value="Oktober" {{ request('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                    <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                                    <option value="Desember" {{ request('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                                </select>
                            </div>

                            <!-- Filter Tahun -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tahun</label>
                                <select name="tahun" class="form-select">
                                    <option value="">-- Semua Tahun --</option>
                                    @for($i = date('Y'); $i >= 2020; $i--)
                                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filter Metode Pembayaran -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Metode Pembayaran</label>
                                <select name="metode" class="form-select">
                                    <option value="">-- Semua Metode --</option>
                                    <option value="tunai" {{ request('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-redo me-2"></i>Reset Filter
                            </a>
                            <button type="submit" class="btn btn-success-custom btn-lg">
                                <i class="fas fa-file-excel me-2"></i>Download Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="col-md-4">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);">
                <div class="card-body text-white p-4">
                    <h5 class="mb-3 fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Informasi Laporan
                    </h5>
                    <ul class="ps-3 mb-0">
                        <li class="mb-2">Laporan akan didownload dalam format <strong>Excel (.xlsx)</strong></li>
                        <li class="mb-2">Data mencakup semua informasi pembayaran lengkap</li>
                        <li class="mb-2">Gunakan filter untuk memilih data spesifik</li>
                        <li class="mb-2">File dapat dibuka dengan Microsoft Excel atau Google Sheets</li>
                        <li class="mb-0">Laporan sudah terformat dengan warna dan border</li>
                    </ul>
                </div>
            </div>

            <div class="card card-custom mt-3" style="background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--navy-primary);">
                        <i class="fas fa-chart-bar me-2"></i>Data yang Tersedia
                    </h6>
                    <div class="row text-center">
                        <div class="col-6 mb-2">
                            <small style="color: var(--navy-primary);">Data Siswa</small>
                            <h5 class="fw-bold mb-0" style="color: var(--navy-primary);">✓</h5>
                        </div>
                        <div class="col-6 mb-2">
                            <small style="color: var(--navy-primary);">Data Pembayaran</small>
                            <h5 class="fw-bold mb-0" style="color: var(--navy-primary);">✓</h5>
                        </div>
                        <div class="col-6">
                            <small style="color: var(--navy-primary);">Data Transfer</small>
                            <h5 class="fw-bold mb-0" style="color: var(--navy-primary);">✓</h5>
                        </div>
                        <div class="col-6">
                            <small style="color: var(--navy-primary);">Data Petugas</small>
                            <h5 class="fw-bold mb-0" style="color: var(--navy-primary);">✓</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Download Buttons -->
    <div class="card card-custom mt-4">
        <div class="card-header-custom">
            <h5 class="mb-0"><i class="fas fa-download me-2"></i>Download Cepat</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="{{ route('laporan.pembayaran') }}" class="btn btn-primary-custom w-100">
                        <i class="fas fa-file-excel me-2"></i>Semua Data
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('laporan.pembayaran', ['bulan' => date('F'), 'tahun' => date('Y')]) }}" class="btn btn-success-custom w-100">
                        <i class="fas fa-calendar-alt me-2"></i>Bulan Ini
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('laporan.pembayaran', ['metode' => 'tunai']) }}" class="btn btn-warning-custom w-100">
                        <i class="fas fa-money-bill me-2"></i>Tunai Saja
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('laporan.pembayaran', ['metode' => 'transfer']) }}" class="btn btn-info text-white w-100">
                        <i class="fas fa-university me-2"></i>Transfer Saja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 