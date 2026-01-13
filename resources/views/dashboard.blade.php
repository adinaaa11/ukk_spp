@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
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
        <div class="col-md-3">
            <div class="card card-custom border-start border-4" style="border-color: var(--navy-primary) !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Siswa</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--navy-primary);">{{ $total_siswa }}</h3>
                        </div>
                        <div class="fs-1 opacity-50" style="color: var(--navy-primary);">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom border-start border-4" style="border-color: var(--yellow-accent) !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Jurusan</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--yellow-hover);">10</h3>
                            <small class="text-muted">{{ $total_kelas }} Kelas</small>
                        </div>
                        <div class="fs-1 opacity-50" style="color: var(--yellow-accent);">
                            <i class="fas fa-school"></i>
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
                            <h6 class="text-muted mb-1">Transaksi Hari Ini</h6>
                            <h3 class="fw-bold mb-0 text-success">{{ $transaksi_hari_ini }}</h3>
                            <small class="text-muted">{{ now()->format('d/m/Y') }}</small>
                        </div>
                        <div class="fs-1 text-success opacity-50">
                            <i class="fas fa-chart-line"></i>
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
                            <h6 class="text-muted mb-1">Pendapatan Hari Ini</h6>
                            <h3 class="fw-bold mb-0 text-info">Rp {{ number_format($pendapatan_hari_ini, 0, ',', '.') }}</h3>
                            <small class="text-muted">{{ now()->format('d/m/Y') }}</small>
                        </div>
                        <div class="fs-1 text-info opacity-50">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);">
                <div class="card-body text-white p-4">
                    <h5 class="mb-3"><i class="fas fa-coins me-2"></i>Total Pendapatan Keseluruhan</h5>
                    <h2 class="fw-bold mb-0" style="color: var(--yellow-accent);">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h2>
                    <small class="opacity-75">Dari {{ $total_transaksi }} transaksi</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);">
                <div class="card-body p-4">
                    <h5 class="mb-3" style="color: var(--navy-primary);"><i class="fas fa-user-shield me-2"></i>Total Petugas</h5>
                    <h2 class="fw-bold mb-0" style="color: var(--navy-primary);">{{ $total_petugas }}</h2>
                    <small style="color: var(--navy-primary);" class="opacity-75">Petugas aktif</small>
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
                <div class="col-md-4">
                    <h6 class="fw-bold text-primary mb-3">📱 Bidang IT</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">✓ RPL - Rekayasa Perangkat Lunak</li>
                        <li class="mb-2">✓ DKV - Desain Komunikasi Visual</li>
                        <li class="mb-2">✓ MKT - Mekatronika</li>
                        <li class="mb-2">✓ TKJ - Teknik Komputer dan Jaringan</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold text-warning mb-3">⚙️ Bidang Permesinan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">✓ TPM - Teknik Permesinan</li>
                        <li class="mb-2">✓ TL - Teknik Pengelasan</li>
                        <li class="mb-2">✓ TBKR - Teknik Body Kendaraan Ringan</li>
                        <li class="mb-2">✓ TKR - Teknik Kendaraan Ringan</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold text-success mb-3">🌾 Bidang Pertanian</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">✓ APHP - Agribisnis Pengolahan Hasil Pertanian</li>
                        <li class="mb-2">✓ ATPH - Agribisnis Tanaman Pangan dan Hortikultura</li>
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
                            <th>Nama Siswa</th>
                            <th>Bulan</th>
                            <th>Nominal</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi_terbaru as $t)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($t->tgl_bayar)->format('d/m/Y') }}</td>
                            <td><span class="badge bg-secondary">{{ $t->nisn }}</span></td>
                            <td>{{ $t->siswa->nama }}</td>
                            <td><span class="badge" style="background: var(--navy-primary);">{{ $t->bulan_dibayar }} {{ $t->tahun_dibayar }}</span></td>
                            <td><strong class="text-success">Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</strong></td>
                            <td>{{ $t->petugas->nama_petugas }}</td>
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
@endsection