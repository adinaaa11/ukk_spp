@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-users"></i> Data Siswa
        </h1>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Siswa
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Card Siswa -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-list"></i> Daftar Siswa untuk Pembayaran SPP
            </h6>
        </div>
        <div class="card-body">
            <!-- Filter dan Pencarian -->
            <form method="GET" action="{{ route('siswa.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Cari NISN, NIS, atau Nama..." 
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="kelas" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kelas</option>
                            @foreach(App\Models\Kelas::all() as $k)
                            <option value="{{ $k->id_kelas }}" 
                                {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        @if(request('search') || request('kelas'))
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                        @endif
                    </div>
                </div>
            </form>

            <!-- Info Pagination -->
            <div class="mb-3">
                <small class="text-muted">
                    Menampilkan {{ $siswa->firstItem() ?? 0 }} - {{ $siswa->lastItem() ?? 0 }} 
                    dari {{ $siswa->total() }} siswa
                </small>
            </div>

            <!-- Tabel Siswa -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="10%">NISN</th>
                            <th width="10%">NIS</th>
                            <th width="20%">Nama Siswa</th>
                            <th width="12%">Kelas</th>
                            <th width="10%">No. Telp</th>
                            <th width="13%">Tahun SPP</th>
                            <th width="10%">Nominal SPP</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                        <tr>
                            <td class="text-center">
                                {{ $siswa->firstItem() + $index }}
                            </td>
                            <td>{{ $s->nisn }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>
                                <strong>{{ $s->nama }}</strong>
                                @if($s->created_at->diffInDays(now()) < 7)
                                <span class="badge bg-success ms-2">
                                    <i class="fas fa-star"></i> Baru
                                </span>
                                @endif
                            </td>
                            <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $s->no_telp }}</td>
                            <td>{{ $s->spp->tahun ?? '-' }}</td>
                            <td class="text-end">
                                <strong class="text-success">
                                    Rp {{ number_format($s->spp->nominal ?? 0, 0, ',', '.') }}
                                </strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('siswa.show', $s->nisn) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('siswa.edit', $s->nisn) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('siswa.destroy', $s->nisn) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus siswa ini?')"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada data siswa</p>
                                <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Siswa Baru
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($siswa->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <p class="text-muted mb-0">
                        Halaman {{ $siswa->currentPage() }} dari {{ $siswa->lastPage() }}
                    </p>
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        {{-- Previous Button --}}
                        @if($siswa->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i> Previous
                            </span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $siswa->previousPageUrl() }}">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                        </li>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach(range(1, $siswa->lastPage()) as $page)
                            @if($page == $siswa->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $siswa->url($page) }}">
                                    {{ $page }}
                                </a>
                            </li>
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if($siswa->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $siswa->nextPageUrl() }}">
                                Next <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link">
                                Next <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Styling untuk tabel */
    .table-hover tbody tr:hover {
        background-color: #f8f9fc;
    }

    /* Badge baru */
    .badge.bg-success {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }

    /* Pagination styling */
    .pagination {
        margin: 0;
    }

    .page-link {
        color: #001f3f;
        border-color: #dee2e6;
    }

    .page-link:hover {
        color: #001f3f;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        background-color: #001f3f;
        border-color: #001f3f;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
    }

    /* Button group */
    .btn-group .btn {
        margin: 0 2px;
    }
</style>
@endsection