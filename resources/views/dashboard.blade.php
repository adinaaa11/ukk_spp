@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4 fade-in-up">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-navy text-white" style="border-radius: 20px;">
                <div class="card-body p-5" style="position: relative; z-index: 2;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-3" style="font-size: 36px; font-weight: 800;">
                                <i class="fas fa-tachometer-alt me-3" style="color: var(--yellow-accent);"></i>
                                Dashboard Admin
                            </h2>
                            <p class="mb-2 opacity-90" style="font-size: 20px;">
                                Selamat datang, <strong>{{ Auth::user()->nama_petugas }}</strong>
                            </p>
                            <p class="mb-0 opacity-75" style="font-size: 16px;">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ now()->isoFormat('dddd, D MMMM Y') }}
                            </p>
                        </div>
                        <div class="text-center">
                            <div class="user-avatar-large" style="
                                width: 100px;
                                height: 100px;
                                background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
                                color: var(--navy-primary);
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: 700;
                                font-size: 2rem;
                                margin: 0 auto;
                                box-shadow: 0 8px 25px rgba(255,215,0,0.3);
                                border: 4px solid rgba(255,255,255,0.2);
                                animation: pulse 2s infinite;
                            ">
                                {{ strtoupper(substr(Auth::user()->nama_petugas,0,1)) }}
                            </div>
                            <div class="mt-2">
                                <span class="badge" style="
                                    background: var(--yellow-accent);
                                    color: var(--navy-primary);
                                    padding: 8px 16px;
                                    font-weight: 700;
                                    border-radius: 20px;
                                ">
                                    {{ strtoupper(Auth::user()->level) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards - HANYA 4 CARD -->
    <div class="row g-4 mb-4">
        <!-- Total Siswa -->
        <div class="col-xl-3 col-lg-6 col-md-6 fade-in-up delay-1">
            <div class="stat-card hover-lift" style="height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-primary-custom text-white">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Siswa</h6>
                            <h2 class="mb-0 fw-bold text-primary-custom" style="font-size: 2rem;">
                                {{ number_format($total_siswa, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-primary-custom" style="width: 100%"></div>
                    </div>
                    <div class="mt-2 text-end">
                        <small class="text-muted">
                            <i class="fas fa-arrow-up text-success"></i> 100% Terdaftar
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="col-xl-3 col-lg-6 col-md-6 fade-in-up delay-2">
            <div class="stat-card hover-lift" style="height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-success-custom text-white">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Kelas</h6>
                            <h2 class="mb-0 fw-bold text-success-custom" style="font-size: 2rem;">
                                {{ number_format($total_kelas, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-success-custom" style="width: 100%"></div>
                    </div>
                    <div class="mt-2 text-end">
                        <small class="text-muted">
                            <i class="fas fa-check-circle text-success"></i> Aktif
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-xl-3 col-lg-6 col-md-6 fade-in-up delay-3">
            <div class="stat-card hover-lift" style="height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-warning-custom text-white">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Transaksi</h6>
                            <h2 class="mb-0 fw-bold text-warning-custom" style="font-size: 2rem;">
                                {{ number_format($total_transaksi, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-warning-custom" style="width: 100%"></div>
                    </div>
                    <div class="mt-2 text-end">
                        <small class="text-muted">
                            <i class="fas fa-chart-line text-warning"></i> Semua Transaksi
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-xl-3 col-lg-6 col-md-6 fade-in-up delay-4">
            <div class="stat-card hover-lift" style="height: 100%;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-box bg-danger-custom text-white">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-muted mb-1" style="font-size: 0.9rem; font-weight: 600;">Total Pendapatan</h6>
                            <h2 class="mb-0 fw-bold text-danger-custom" style="font-size: 1.8rem;">
                                Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-danger-custom" style="width: 100%"></div>
                    </div>
                    <div class="mt-2 text-end">
                        <small class="text-muted">
                            <i class="fas fa-money-bill-wave text-success"></i> Terkumpul
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pembayaran Terbaru -->
    <div class="row fade-in-up delay-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-white border-0 py-4" style="border-bottom: 3px solid var(--yellow-accent);">
                    <h4 class="fw-bold mb-0" style="color: var(--navy-primary);">
                        <i class="fas fa-history me-2" style="color: var(--yellow-accent);"></i>
                        Pembayaran Terbaru
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th style="border-radius: 10px 0 0 0;">No</th>
                                    <th>Tanggal</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Bulan</th>
                                    <th>Jumlah</th>
                                    <th style="border-radius: 0 10px 0 0;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi_terbaru as $index => $pembayaran)
                                <tr>
                                    <td><strong>{{ $index + 1 }}</strong></td>
                                    <td>
                                        <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                        {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->isoFormat('D MMM Y') }}
                                    </td>
                                    <td><code>{{ $pembayaran->siswa->nisn }}</code></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar-small me-2" style="
                                                width: 30px;
                                                height: 30px;
                                                background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
                                                color: var(--navy-primary);
                                                border-radius: 50%;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                font-weight: 700;
                                                font-size: 0.8rem;
                                            ">
                                                {{ strtoupper(substr($pembayaran->siswa->nama,0,1)) }}
                                            </div>
                                            {{ $pembayaran->siswa->nama }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge" style="
                                            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
                                            color: white;
                                        ">
                                            {{ $pembayaran->siswa->kelas->nama_kelas }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            {{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}
                                        </span>
                                    </td>
                                    <td class="text-success fw-bold">
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge" style="
                                            background: linear-gradient(135deg, #28a745, #20c997);
                                            color: white;
                                            padding: 8px 12px;
                                        ">
                                            <i class="fas fa-check-circle me-1"></i> Lunas
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <div style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <h5>Belum ada transaksi</h5>
                                        <p class="mb-0">Transaksi pembayaran akan muncul di sini</p>
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
    :root {
        --navy-primary: #001f3f;
        --navy-dark: #001529;
        --navy-light: #0a2540;
        --yellow-accent: #FFD700;
        --yellow-hover: #FFC000;
        --yellow-light: #FFED4E;
        --text-primary: #2c3e50;
        --text-secondary: #6c757d;
        --border-color: #e9ecef;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.08);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.12);
        --shadow-lg: 0 8px 25px rgba(0,0,0,0.15);
        --shadow-xl: 0 15px 35px rgba(0,0,0,0.2);
    }

    .bg-gradient-navy {
        background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 50%, var(--navy-light) 100%);
        position: relative;
        overflow: hidden;
    }

    .bg-gradient-navy::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(255, 215, 0, 0.08) 0%, transparent 50%);
        z-index: 1;
    }

    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .hover-lift:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
    }

    .card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid var(--yellow-accent);
        font-weight: 700;
        color: var(--navy-primary);
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-md);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: var(--shadow-xl);
    }

    .stat-card .card-body {
        padding: 30px;
        position: relative;
        z-index: 2;
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .icon-box::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
        transform: rotate(45deg);
        transition: all 0.6s;
        opacity: 0;
    }

    .stat-card:hover .icon-box::before {
        animation: shine 0.6s ease;
    }

    @keyframes shine {
        0% {
            top: -50%;
            left: -50%;
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            top: 150%;
            left: 150%;
            opacity: 0;
        }
    }

    .table {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table thead th {
        background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
        color: white;
        font-weight: 600;
        text-transform: uppercase;
            font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        padding: 15px 12px;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: rgba(255, 215, 0, 0.05);
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        border-color: var(--border-color);
    }

    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .progress {
        height: 8px;
        border-radius: 10px;
        overflow: hidden;
        background: rgba(0,0,0,0.05);
    }

    .progress-bar {
        border-radius: 10px;
        transition: width 1s ease;
    }

    .text-primary-custom {
        color: var(--navy-primary) !important;
    }

    .text-success-custom {
        color: #28a745 !important;
    }

    .text-warning-custom {
        color: #ffc107 !important;
    }

    .text-danger-custom {
        color: #dc3545 !important;
    }

    .bg-primary-custom {
        background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark)) !important;
    }

    .bg-success-custom {
        background: linear-gradient(135deg, #28a745, #20c997) !important;
    }

    .bg-warning-custom {
        background: linear-gradient(135deg, #ffc107, #fd7e14) !important;
    }

    .bg-danger-custom {
        background: linear-gradient(135deg, #dc3545, #e83e8c) !important;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>
@endsection