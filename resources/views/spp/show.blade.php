@extends('layouts.main')

@section('title', 'Detail SPP')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">
            <i class="fas fa-money-check-alt me-2"></i>Detail SPP
        </h2>
        <p class="section-subtitle">Informasi lengkap data SPP</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg">
                <div class="card-header-custom bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi SPP
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-primary">Tahun Ajaran</label>
                            <div class="p-3 bg-light rounded">
                                <span class="badge bg-primary fs-6">{{ $spp->tahun }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-primary">Nominal per Bulan</label>
                            <div class="p-3 bg-light rounded">
                                <h4 class="mb-0 text-success">Rp {{ number_format($spp->nominal, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-success">Jumlah Siswa</label>
                            <div class="p-3 bg-light rounded">
                                <h4 class="mb-0 text-success">{{ $spp->siswa_count }} Siswa</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-info">Total Per Bulan</label>
                            <div class="p-3 bg-light rounded">
                                <h4 class="mb-0 text-info">Rp {{ number_format($spp->nominal * $spp->siswa_count, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-warning">Total Per Tahun</label>
                            <div class="p-3 bg-light rounded">
                                <h4 class="mb-0 text-warning">Rp {{ number_format($spp->nominal * $spp->siswa_count * 12, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-danger">Status</label>
                            <div class="p-3 bg-light rounded">
                                @if($spp->siswa_count > 0)
                                    <span class="badge bg-success fs-6">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary fs-6">
                                        <i class="fas fa-times-circle me-1"></i>Belum Ada Siswa
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-cog me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('spp.edit', $spp->id_spp) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit me-2"></i>Edit SPP
                        </a>
                        <a href="{{ route('siswa.create') }}?spp={{ $spp->id_spp }}" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Tambah Siswa
                        </a>
                        <a href="{{ route('spp.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Statistik
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h3 class="text-primary mb-0">{{ $spp->siswa_count }}</h3>
                        <small class="text-muted">Total Siswa</small>
                    </div>
                    <div class="text-center mb-3">
                        <h3 class="text-success mb-0">Rp {{ number_format($spp->nominal, 0, ',', '.') }}</h3>
                        <small class="text-muted">Nominal/Bulan</small>
                    </div>
                    <div class="text-center">
                        <h3 class="text-info mb-0">Rp {{ number_format($spp->nominal * 12, 0, ',', '.') }}</h3>
                        <small class="text-muted">Nominal/Tahun/Siswa</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa -->
    @if($spp->siswa_count > 0)
    <div class="card card-custom mt-4">
        <div class="card-header-custom">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>Daftar Siswa dengan SPP Tahun {{ $spp->tahun }}
            </h5>
            <span class="badge bg-info">{{ $spp->siswa_count }} siswa</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">NISN</th>
                            <th width="15%">NIS</th>
                            <th width="30%">Nama</th>
                            <th width="20%">Kelas</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($spp->siswa as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            <td>
                                <a href="{{ route('siswa.show', $siswa->nisn) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Ringkasan Pembayaran -->
    @if($spp->siswa_count > 0)
    <div class="card card-custom mt-4">
        <div class="card-header-custom">
            <h5 class="mb-0">
                <i class="fas fa-calculator me-2"></i>Ringkasan Pembayaran
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center p-3 bg-light rounded">
                        <h4 class="text-primary mb-0">{{ $spp->siswa_count }}</h4>
                        <small class="text-muted">Siswa Aktif</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3 bg-light rounded">
                        <h4 class="text-success mb-0">Rp {{ number_format($spp->nominal, 0, ',', '.') }}</h4>
                        <small class="text-muted">Per Bulan</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-3 bg-light rounded">
                        <h4 class="text-info mb-0">Rp {{ number_format($spp->nominal * $spp->siswa_count * 12, 0, ',', '.') }}</h4>
                        <small class="text-muted">Per Tahun (Total)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
