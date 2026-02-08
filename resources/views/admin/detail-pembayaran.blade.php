@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Breadcrumb & Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2">
                        <i class="fas fa-receipt text-primary me-2"></i>
                        Detail Pembayaran
                    </h2>
                    <nav style="--bs-breadcrumb-divider: '›';" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('history.pembayaran') }}">History Pembayaran</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('history.pembayaran') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fas fa-print me-2"></i>Cetak Struk
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Left Column - Main Info -->
        <div class="col-lg-8">
            <!-- Student Information Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-user-graduate me-2"></i>
                        Informasi Siswa
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <span class="text-muted small mb-2 text-uppercase fw-semibold">NISN</span>
                                <span class="fs-5 fw-bold text-dark">{{ $pembayaran->siswa->nisn ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex flex-column">
                                <span class="text-muted small mb-2 text-uppercase fw-semibold">Nama Lengkap</span>
                                <span class="fs-5 fw-bold text-dark">{{ $pembayaran->siswa->nama ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column">
                                <span class="text-muted small mb-2 text-uppercase fw-semibold">Kelas</span>
                                <span class="badge bg-info text-dark fs-6 align-self-start px-3 py-2">
                                    {{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex flex-column">
                                <span class="text-muted small mb-2 text-uppercase fw-semibold">Alamat</span>
                                <span class="text-dark">{{ $pembayaran->siswa->alamat ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient-success text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Detail Transaksi Pembayaran
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Periode Pembayaran -->
                        <div class="col-md-6">
                            <div class="payment-info-box">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-semibold">Periode</small>
                                        <strong class="fs-6">{{ $pembayaran->bulan_dibayar ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Bayar -->
                        <div class="col-md-6">
                            <div class="payment-info-box">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                                        <i class="fas fa-money-bill"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-semibold">Jumlah Dibayar</small>
                                        <strong class="fs-5 text-success">
                                            Rp {{ number_format($pembayaran->jumlah_dibayar ?? 0, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-md-6">
                            <div class="payment-info-box">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-box bg-info bg-opacity-10 text-info me-3">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-semibold">Metode Pembayaran</small>
                                        <strong class="fs-6">{{ ucfirst($pembayaran->metode_pembayaran ?? '-') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Bayar -->
                        <div class="col-md-6">
                            <div class="payment-info-box">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-semibold">Tanggal Bayar</small>
                                        <strong class="fs-6">
                                            {{ $pembayaran->tgl_bayar ? \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d F Y') : '-' }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Petugas -->
                        <div class="col-md-12">
                            <div class="payment-info-box">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="icon-box bg-secondary bg-opacity-10 text-secondary me-3">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-semibold">Diproses Oleh</small>
                                        <strong class="fs-6">{{ $pembayaran->petugas->nama_petugas ?? '-' }}</strong>
                                        <span class="badge bg-secondary ms-2">{{ $pembayaran->petugas->level ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($pembayaran->keterangan)
                        <!-- Keterangan -->
                        <div class="col-12">
                            <div class="alert alert-light border border-primary border-2 mb-0">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle text-primary me-3 mt-1"></i>
                                    <div>
                                        <strong class="d-block mb-2 text-uppercase small">Keterangan:</strong>
                                        <p class="mb-0">{{ $pembayaran->keterangan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Summary & Info -->
        <div class="col-lg-4">
            <!-- Payment Summary -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-dark text-white py-3">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-file-invoice me-2"></i>
                        Ringkasan Pembayaran
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="status-badge-large bg-success bg-opacity-10 text-success p-4 rounded mb-3">
                            <i class="fas fa-check-circle fa-3x mb-2"></i>
                            <div class="fw-bold fs-5">LUNAS</div>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">ID Pembayaran</span>
                            <strong>#{{ $pembayaran->id_pembayaran }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Status</span>
                            <span class="badge bg-success">Terbayar</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Dibuat</span>
                            <small class="text-end">
                                {{ $pembayaran->created_at ? $pembayaran->created_at->format('d/m/Y H:i') : '-' }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SPP Info -->
            <div class="card border-0 shadow-sm bg-gradient-info text-white">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi SPP
                    </h6>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2">
                            <i class="fas fa-check me-2"></i>
                            Pembayaran telah terverifikasi
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check me-2"></i>
                            Data tersimpan di sistem
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check me-2"></i>
                            Dapat dicetak kapan saja
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Gradient Backgrounds */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #0cebeb 0%, #20e3b2 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

/* Card Styling */
.card {
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
}

.card-header {
    border-bottom: none;
    border-radius: 12px 12px 0 0 !important;
}

/* Payment Info Box */
.payment-info-box {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #0d6efd;
    transition: all 0.3s ease;
}

.payment-info-box:hover {
    background: #e9ecef;
    border-left-width: 6px;
}

/* Icon Box */
.icon-box {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 1.5rem;
}

/* Status Badge */
.status-badge-large {
    border-radius: 15px;
}

/* Breadcrumb */
.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #0d6efd;
}

.breadcrumb-item.active {
    color: #495057;
    font-weight: 500;
}

/* Button Enhancements */
.btn {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Print Styles */
@media print {
    body {
        background: white !important;
    }

    .btn,
    nav,
    .breadcrumb,
    .card-header,
    .col-lg-4 {
        display: none !important;
    }

    .col-lg-8 {
        width: 100% !important;
        max-width: 100% !important;
    }

    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
        page-break-inside: avoid;
    }

    .payment-info-box {
        background: white !important;
        border: 1px solid #dee2e6 !important;
    }

    .icon-box {
        background: none !important;
        border: 1px solid #dee2e6 !important;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .d-flex.gap-2 {
        width: 100%;
    }

    .d-flex.gap-2 .btn {
        flex: 1;
    }

    .card-body {
        padding: 1.5rem !important;
    }

    .payment-info-box {
        padding: 15px !important;
    }

    .icon-box {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
}
</style>
@endsection