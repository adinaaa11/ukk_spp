@extends('layouts.main')

@section('title', 'Detail Kelas')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">
            <i class="fas fa-school me-2"></i>Detail Kelas
        </h2>
        <p class="section-subtitle">Informasi lengkap data kelas</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg">
                <div class="card-header-custom bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-info-circle me-2"></i>Informasi Kelas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold text-primary">Nama Kelas</label>
                            <div class="p-3 bg-light rounded">
                                <span class="badge bg-primary fs-6">{{ $kelas->nama_kelas }}</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold text-primary">Kompetensi Keahlian</label>
                            <div class="p-3 bg-light rounded">
                                <h5 class="mb-0">{{ $kelas->kompetensi_keahlian }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-success">Jumlah Siswa</label>
                            <div class="p-3 bg-light rounded">
                                <h4 class="mb-0 text-success">{{ $kelas->siswa_count }} Siswa</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-info">Kapasitas Maksimal</label>
                            <div class="p-3 bg-light rounded">
                                <h4 class="mb-0 text-info">35 Siswa</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold text-warning">Status Kapasitas</label>
                            <div class="p-3 bg-light rounded">
                                @if($kelas->siswa_count < 35)
                                    <div class="progress mb-2" style="height: 25px;">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                             style="width: {{ ($kelas->siswa_count / 35) * 100 }}%">
                                            {{ $kelas->siswa_count }} / 35 siswa
                                        </div>
                                    </div>
                                    <span class="badge bg-success">Tersedia {{ 35 - $kelas->siswa_count }} tempat</span>
                                @else
                                    <div class="progress mb-2" style="height: 25px;">
                                        <div class="progress-bar bg-danger" role="progressbar" 
                                             style="width: 100%">
                                            Penuh
                                        </div>
                                    </div>
                                    <span class="badge bg-danger">Kelas Penuh</span>
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
                        <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit me-2"></i>Edit Kelas
                        </a>
                        <a href="{{ route('siswa.create') }}?kelas={{ $kelas->id_kelas }}" class="btn btn-success btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Tambah Siswa
                        </a>
                        <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistik
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h3 class="text-primary mb-0">{{ $kelas->siswa_count }}</h3>
                        <small class="text-muted">Total Siswa</small>
                    </div>
                    <div class="text-center">
                        <h3 class="text-success mb-0">{{ 35 - $kelas->siswa_count }}</h3>
                        <small class="text-muted">Sisa Kuota</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa -->
    @if($kelas->siswa_count > 0)
    <div class="card card-custom mt-4">
        <div class="card-header-custom">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>Daftar Siswa di Kelas {{ $kelas->nama_kelas }}
            </h5>
            <span class="badge bg-info">{{ $kelas->siswa_count }} siswa</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">NISN</th>
                            <th width="15%">NIS</th>
                            <th width="35%">Nama</th>
                            <th width="15%">SPP</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas->siswa as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>Rp {{ number_format($siswa->spp->nominal ?? 0, 0, ',', '.') }}</td>
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
</div>
@endsection
