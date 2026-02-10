@extends('layouts.main')

@section('title', 'Detail Petugas')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">
            <i class="fas fa-user-shield me-2"></i>Detail Petugas
        </h2>
        <p class="section-subtitle">Informasi lengkap data petugas</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg">
                <div class="card-header-custom bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi Petugas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-primary">Username</label>
                            <div class="p-3 bg-light rounded">
                                <span class="badge bg-secondary fs-6">{{ $petugas->username }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-primary">Nama Lengkap</label>
                            <div class="p-3 bg-light rounded">
                                <h5 class="mb-0">{{ $petugas->nama_petugas }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-success">Level</label>
                            <div class="p-3 bg-light rounded">
                                @if($petugas->level == 'admin')
                                    <span class="badge bg-danger fs-6">
                                        <i class="fas fa-crown me-1"></i>ADMIN
                                    </span>
                                @else
                                    <span class="badge bg-info fs-6">
                                        <i class="fas fa-user-check me-1"></i>PETUGAS
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-info">Status</label>
                            <div class="p-3 bg-light rounded">
                                <span class="badge bg-success fs-6">
                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-warning">Terdaftar Sejak</label>
                            <div class="p-3 bg-light rounded">
                                <h5 class="mb-0">{{ $petugas->created_at->format('d F Y') }}</h5>
                                <small class="text-muted">{{ $petugas->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-warning">Terakhir Update</label>
                            <div class="p-3 bg-light rounded">
                                <h5 class="mb-0">{{ $petugas->updated_at->format('d F Y') }}</h5>
                                <small class="text-muted">{{ $petugas->updated_at->diffForHumans() }}</small>
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
                        @if($petugas->id_petugas != auth()->id())
                            <a href="{{ route('petugas.edit', $petugas->id_petugas) }}" class="btn btn-warning btn-lg">
                                <i class="fas fa-edit me-2"></i>Edit Data
                            </a>
                        @endif
                        <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>Hak Akses
                    </h6>
                </div>
                <div class="card-body">
                    @if($petugas->level == 'admin')
                        <div class="text-center">
                            <i class="fas fa-crown fa-3x text-warning mb-3 d-block"></i>
                            <h5 class="text-warning">Administrator</h5>
                            <p class="text-muted mb-0">Akses penuh ke semua fitur sistem</p>
                        </div>
                    @else
                        <div class="text-center">
                            <i class="fas fa-user-check fa-3x text-info mb-3 d-block"></i>
                            <h5 class="text-info">Petugas</h5>
                            <p class="text-muted mb-0">Hanya dapat mengakses fitur pembayaran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="card card-custom mt-4">
        <div class="card-header-custom">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>Informasi Tambahan
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info border-0">
                        <h6 class="alert-heading">
                            <i class="fas fa-key me-2"></i>Informasi Login
                        </h6>
                        <p class="mb-2">
                            <strong>Username:</strong> {{ $petugas->username }}
                        </p>
                        <p class="mb-0">
                            <strong>Level:</strong> {{ ucfirst($petugas->level) }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-warning border-0">
                        <h6 class="alert-heading">
                            <i class="fas fa-exclamation-triangle me-2"></i>Penting
                        </h6>
                        <p class="mb-0">
                            Data petugas yang sudah terdaftar tidak dapat dihapus jika memiliki riwayat transaksi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
