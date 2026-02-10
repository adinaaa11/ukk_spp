@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title mb-1">
                <i class="fas fa-user-shield me-2"></i>Data Petugas
            </h2>
            <p class="section-subtitle mb-0">Kelola data petugas dan administrator</p>
        </div>
        <a href="{{ route('petugas.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus-circle me-2"></i>Tambah Petugas
        </a>
    </div>

    <!-- STATISTIK KARTU -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Petugas</h6>
                            <h3 class="fw-bold mb-0 text-primary">{{ $petugas->total() }}</h3>
                        </div>
                        <div class="text-primary opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-danger shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Administrator</h6>
                            <h3 class="fw-bold mb-0 text-danger">{{ $petugas->where('level', 'admin')->count() }}</h3>
                        </div>
                        <div class="text-danger opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-crown"></i>
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
                            <h6 class="text-muted mb-1">Petugas</h6>
                            <h3 class="fw-bold mb-0 text-info">{{ $petugas->where('level', 'petugas')->count() }}</h3>
                        </div>
                        <div class="text-info opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-user-check"></i>
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
                            <h6 class="text-muted mb-1">Aktif Hari Ini</h6>
                            <h3 class="fw-bold mb-0 text-success">{{ $petugas->count() }}</h3>
                        </div>
                        <div class="text-success opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-user-clock"></i>
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
            <form method="GET" action="{{ route('petugas.index') }}" class="row g-3">
                <div class="col-md-5">
                    <label class="form-label fw-bold">
                        <i class="fas fa-search me-1 text-primary"></i>Cari Username/Nama
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Masukkan username atau nama..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-user-tag me-1 text-warning"></i>Level
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-warning text-dark">
                            <i class="fas fa-shield-alt"></i>
                        </span>
                        <select name="level" class="form-select">
                            <option value="">Semua Level</option>
                            <option value="admin" {{ request('level') == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="petugas" {{ request('level') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">&nbsp;</label>
                    <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary btn-lg w-100">
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
                    <i class="fas fa-table me-2"></i>Daftar Petugas
                </h5>
                <span class="badge bg-light text-dark fs-6">
                    <i class="fas fa-user-shield me-1"></i>{{ $petugas->total() }} petugas
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
                            <th width="20%">
                                <i class="fas fa-user me-1"></i>Username
                            </th>
                            <th width="30%">
                                <i class="fas fa-id-card me-1"></i>Nama Petugas
                            </th>
                            <th width="15%" class="text-center">
                                <i class="fas fa-shield-alt me-1"></i>Level
                            </th>
                            <th width="15%">
                                <i class="fas fa-calendar me-1"></i>Terdaftar
                            </th>
                            <th width="15%" class="text-center">
                                <i class="fas fa-cogs me-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($petugas as $index => $p)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $petugas->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                        {{ substr($p->username, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $p->username }}</div>
                                        <small class="text-muted">ID: {{ $p->id_petugas }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                        {{ substr($p->nama_petugas, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $p->nama_petugas }}</div>
                                        @if($p->id_petugas == auth()->id())
                                            <small class="text-success"><i class="fas fa-user me-1"></i>Anda</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($p->level == 'admin')
                                    <span class="badge bg-danger fs-6">
                                        <i class="fas fa-crown me-1"></i>ADMIN
                                    </span>
                                @else
                                    <span class="badge bg-info fs-6">
                                        <i class="fas fa-user-check me-1"></i>PETUGAS
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold">{{ $p->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $p->created_at->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('petugas.show', $p->id_petugas) }}" class="btn btn-sm btn-info" title="Detail Petugas">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('petugas.edit', $p->id_petugas) }}" class="btn btn-sm btn-warning" title="Edit Petugas">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($p->id_petugas != auth()->id())
                                    <form action="{{ route('petugas.destroy', $p->id_petugas) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('⚠️ Yakin ingin menghapus petugas: {{ $p->nama_petugas }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Petugas">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                                    <i class="fas fa-user-slash"></i>
                                </div>
                                <h5 class="text-muted">
                                    @if(request('search') || request('level'))
                                        Tidak ada data petugas yang sesuai dengan filter
                                    @else
                                        Belum ada data petugas
                                    @endif
                                </h5>
                                <p class="text-muted">Tambahkan petugas baru untuk memulai</p>
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
                        Menampilkan {{ $petugas->firstItem() }} - {{ $petugas->lastItem() }}
                        dari {{ $petugas->total() }} data
                    </small>
                </div>
                <div>
                    {{ $petugas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection