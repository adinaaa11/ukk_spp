@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title mb-1">
                <i class="fas fa-money-check-alt me-2"></i>Data SPP
            </h2>
            <p class="section-subtitle mb-0">Kelola data tarif SPP per tahun</p>
        </div>
        <a href="{{ route('spp.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus-circle me-2"></i>Tambah SPP
        </a>
    </div>

    <!-- STATISTIK KARTU -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total SPP</h6>
                            <h3 class="fw-bold mb-0 text-primary">{{ $spp->total() }}</h3>
                        </div>
                        <div class="text-primary opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Siswa</h6>
                            <h3 class="fw-bold mb-0 text-success">{{ $spp->sum('siswa_count') }}</h3>
                        </div>
                        <div class="text-success opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Rata-rata SPP</h6>
                            <h3 class="fw-bold mb-0 text-warning">{{ $spp->avg('nominal') ? number_format($spp->avg('nominal'), 0, ',', '.') : 0 }}</h3>
                        </div>
                        <div class="text-warning opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total/Bulan</h6>
                            <h3 class="fw-bold mb-0 text-info">{{ number_format($spp->sum('siswa_count') * ($spp->avg('nominal') ?? 0), 0, ',', '.') }}</h3>
                        </div>
                        <div class="text-info opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DATA TABLE -->
    <div class="card card-custom shadow">
        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">
                    <i class="fas fa-table me-2"></i>Daftar SPP
                </h5>
                <span class="badge bg-light text-dark fs-6">
                    <i class="fas fa-money-check-alt me-1"></i>{{ $spp->total() }} data
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="10%" class="text-center">
                                <i class="fas fa-hashtag me-1"></i>No
                            </th>
                            <th width="20%" class="text-center">
                                <i class="fas fa-calendar me-1"></i>Tahun
                            </th>
                            <th width="25%" class="text-center">
                                <i class="fas fa-money-bill-wave me-1"></i>Nominal
                            </th>
                            <th width="20%" class="text-center">
                                <i class="fas fa-users me-1"></i>Jumlah Siswa
                            </th>
                            <th width="15%" class="text-center">
                                <i class="fas fa-chart-pie me-1"></i>Total/Bulan
                            </th>
                            <th width="10%" class="text-center">
                                <i class="fas fa-cogs me-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($spp as $index => $s)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $spp->firstItem() + $index }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="badge bg-info fs-6">{{ $s->tahun }}</span>
                                    <small class="text-muted">Tahun Ajaran</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="fw-bold text-success">Rp {{ number_format($s->nominal, 0, ',', '.') }}</div>
                                    <small class="text-muted">per bulan</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="badge bg-warning fs-6">{{ $s->siswa_count }} siswa</span>
                                    <small class="text-muted">terdaftar</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="fw-bold text-info">Rp {{ number_format($s->nominal * $s->siswa_count, 0, ',', '.') }}</div>
                                    <small class="text-muted">per bulan</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('spp.show', $s->id_spp) }}" class="btn btn-sm btn-info" title="Detail SPP">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('spp.edit', $s->id_spp) }}" class="btn btn-sm btn-warning" title="Edit SPP">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('spp.destroy', $s->id_spp) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('⚠️ Yakin ingin menghapus SPP tahun {{ $s->tahun }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus SPP">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                                    <i class="fas fa-money-bill-slash"></i>
                                </div>
                                <h5 class="text-muted">Belum ada data SPP</h5>
                                <p class="text-muted">Tambahkan SPP baru untuk memulai</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Menampilkan {{ $spp->firstItem() }} - {{ $spp->lastItem() }}
                        dari {{ $spp->total() }} data
                    </small>
                </div>
                <div>
                    {{ $spp->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- INFO SPP -->
    <div class="card card-custom mt-4">
        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
            <h5 class="mb-0 text-white">
                <i class="fas fa-info-circle me-2"></i>Informasi SPP
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success border-0">
                        <h6 class="alert-heading">
                            <i class="fas fa-lightbulb me-2"></i>Tentang SPP
                        </h6>
                        <p class="mb-2">
                            SPP (Sumbangan Pembinaan Pendidikan) adalah biaya yang dibayarkan siswa setiap bulan untuk mendukung operasional sekolah dan peningkatan kualitas pendidikan.
                        </p>
                        <ul class="mb-0">
                            <li>Dibayarkan setiap bulan (12 kali/tahun)</li>
                            <li>Nominal dapat berbeda setiap tahun ajaran</li>
                            <li>Digunakan untuk pengembangan fasilitas sekolah</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info border-0">
                        <h6 class="alert-heading">
                            <i class="fas fa-calculator me-2"></i>Perhitungan SPP
                        </h6>
                        <div class="mb-3">
                            <strong>Total per siswa per tahun:</strong>
                            <div class="fw-bold text-info fs-5">
                                Rp {{ number_format(($spp->avg('nominal') ?? 0) * 12, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="mb-0">
                            <strong>Total semua siswa per bulan:</strong>
                            <div class="fw-bold text-success fs-5">
                                Rp {{ number_format($spp->sum('siswa_count') * ($spp->avg('nominal') ?? 0), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection