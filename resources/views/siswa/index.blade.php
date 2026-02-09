@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">📘 Data Siswa</h4>

        @if(auth()->user()->level === 'admin')
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                + Tambah Siswa
            </a>
        @endif
    </div>

    {{-- FILTER & SEARCH --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Cari Siswa</label>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="NISN / NIS / Nama"
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Kelas</label>
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

                <div class="col-md-2">
                    <button class="btn btn-secondary w-100">
                        🔍 Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width:5%">No</th>
                        <th style="width:12%">NISN</th>
                        <th style="width:10%">NIS</th>
                        <th style="width:20%">Nama</th>
                        <th style="width:15%">Kelas</th>
                        <th style="width:15%">SPP</th>
                        <th style="width:13%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $index => $s)
                        <tr>
                            <td>{{ $siswa->firstItem() + $index }}</td>
                            <td>{{ $s->nisn }}</td>
                            <td>{{ $s->nis }}</td>
                            <td class="text-start">{{ $s->nama }}</td>
                            <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                            <td>Rp {{ number_format($s->spp->nominal ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('siswa.show', $s->nisn) }}"
                                       class="btn btn-sm btn-info"
                                       title="Detail">
                                        👁
                                    </a>

                                    @if(auth()->user()->level === 'admin')
                                        {{-- EDIT --}}
                                        <a href="{{ route('siswa.edit', $s->nisn) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit">
                                            ✏
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('siswa.destroy', $s->nisn) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus data siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Hapus">
                                                🗑
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">
                                Data siswa tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION (FIX RAPI & NORMAL) --}}
        <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }}
                dari {{ $siswa->total() }} data
            </small>

            {{ $siswa->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
