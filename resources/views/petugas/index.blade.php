@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title">Data Petugas</h2>
            <p class="section-subtitle">Kelola data petugas/admin</p>
        </div>
        <a href="{{ route('petugas.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Petugas
        </a>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="card card-custom mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('petugas.index') }}" class="row g-3">
                <div class="col-md-5">
                    <label class="form-label fw-bold">Cari Username/Nama</label>
                    <input type="text" name="search" class="form-control" 
                           placeholder="Masukkan username atau nama..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Level</label>
                    <select name="level" class="form-select">
                        <option value="">Semua Level</option>
                        <option value="admin" {{ request('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ request('level') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">&nbsp;</label>
                    <button type="submit" class="btn btn-success-custom w-100">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">&nbsp;</label>
                    <a href="{{ route('petugas.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-redo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Daftar Petugas</h5>
            <span class="badge bg-light text-dark">Total: {{ $petugas->total() }} petugas</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Username</th>
                            <th width="30%">Nama Petugas</th>
                            <th width="15%" class="text-center">Level</th>
                            <th width="15%">Terdaftar</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($petugas as $index => $p)
                        <tr>
                            <td>{{ $petugas->firstItem() + $index }}</td>
                            <td><span class="badge badge-custom bg-secondary">{{ $p->username }}</span></td>
                            <td><strong>{{ $p->nama_petugas }}</strong></td>
                            <td class="text-center">
                                @if($p->level == 'admin')
                                    <span class="badge badge-custom bg-danger">ADMIN</span>
                                @else
                                    <span class="badge badge-custom bg-info">PETUGAS</span>
                                @endif
                            </td>
                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('petugas.edit', $p->id_petugas) }}" class="btn btn-sm btn-warning-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($p->id_petugas != auth()->id())
                                <form action="{{ route('petugas.destroy', $p->id_petugas) }}" method="POST" class="d-inline" onsubmit="return confirm('⚠️ Yakin ingin menghapus petugas {{ $p->nama_petugas }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger-custom" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">
                                    @if(request('search') || request('level'))
                                        Tidak ada data petugas yang sesuai dengan filter
                                    @else
                                        Belum ada data petugas
                                    @endif
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $petugas->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection