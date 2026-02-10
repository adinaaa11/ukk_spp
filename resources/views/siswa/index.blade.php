@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
<div class="container-fluid py-4">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title mb-1">
                <i class="fas fa-user-graduate me-2"></i>Data Siswa
            </h2>
            <p class="section-subtitle mb-0">Kelola data seluruh siswa</p>
        </div>
        @if(auth()->user()->level === 'admin')
            <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus-circle me-2"></i>Tambah Siswa
            </a>
        @endif
    </div>

    <!-- STATISTIK KARTU -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Siswa</h6>
                            <h3 class="fw-bold mb-0 text-primary">{{ $siswa->total() }}</h3>
                        </div>
                        <div class="text-primary opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-users"></i>
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
                            <h6 class="text-muted mb-1">Siswa Aktif</h6>
                            <h3 class="fw-bold mb-0 text-success">{{ $siswa->total() }}</h3>
                        </div>
                        <div class="text-success opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-user-check"></i>
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
                            <h6 class="text-muted mb-1">Total Kelas</h6>
                            <h3 class="fw-bold mb-0 text-warning">{{ $kelas->count() }}</h3>
                        </div>
                        <div class="text-warning opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-school"></i>
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
                            <h6 class="text-muted mb-1">Rata-rata SPP</h6>
                            <h3 class="fw-bold mb-0 text-info">{{ number_format(150000, 0, ',', '.') }}</h3>
                        </div>
                        <div class="text-info opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="card card-custom shadow-sm mb-4">
        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
            <h5 class="mb-0 text-white">
                <i class="fas fa-filter me-2"></i>Filter & Pencarian
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-search me-1 text-primary"></i>Cari Siswa
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="NISN / NIS / Nama"
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-school me-1 text-success"></i>Kelas
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white">
                            <i class="fas fa-graduation-cap"></i>
                        </span>
                        <select name="kelas" class="form-select">
                            <option value="">-- Semua Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id_kelas }}"
                                    {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary btn-lg w-100">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- DATA TABLE -->
    <div class="card card-custom shadow">
        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">
                    <i class="fas fa-table me-2"></i>Daftar Siswa
                </h5>
                <span class="badge bg-light text-dark fs-6">
                    <i class="fas fa-users me-1"></i>{{ $siswa->total() }} siswa
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">
                                <i class="fas fa-hashtag me-1"></i>No
                            </th>
                            <th width="12%" class="text-center">
                                <i class="fas fa-fingerprint me-1"></i>NISN
                            </th>
                            <th width="10%" class="text-center">
                                <i class="fas fa-id-badge me-1"></i>NIS
                            </th>
                            <th width="20%">
                                <i class="fas fa-user me-1"></i>Nama Lengkap
                            </th>
                            <th width="15%" class="text-center">
                                <i class="fas fa-school me-1"></i>Kelas
                            </th>
                            <th width="15%" class="text-center">
                                <i class="fas fa-money-bill-wave me-1"></i>SPP
                            </th>
                            <th width="13%" class="text-center">
                                <i class="fas fa-cogs me-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $index => $s)
                            <tr>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $siswa->firstItem() + $index }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $s->nisn }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $s->nis }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                            {{ substr($s->nama, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $s->nama }}</div>
                                            <small class="text-muted">{{ $s->alamat }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">{{ $s->kelas->nama_kelas ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="fw-bold text-success">Rp {{ number_format($s->spp->nominal ?? 0, 0, ',', '.') }}</div>
                                    <small class="text-muted">/bulan</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- DETAIL -->
                                        <a href="{{ route('siswa.show', $s->nisn) }}"
                                           class="btn btn-sm btn-info"
                                           title="Detail Siswa">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if(auth()->user()->level === 'admin')
                                            <!-- EDIT -->
                                            <a href="{{ route('siswa.edit', $s->nisn) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit Siswa">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- DELETE -->
                                            <form action="{{ route('siswa.destroy', $s->nisn) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('⚠️ Yakin ingin menghapus data siswa: {{ $s->nama }}?')"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Hapus Siswa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <h5 class="text-muted">Data siswa tidak ditemukan</h5>
                                    <p class="text-muted">Coba ubah filter atau tambah siswa baru</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }}
                        dari {{ $siswa->total() }} data
                    </small>
                </div>
                <div>
                    {{ $siswa->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
