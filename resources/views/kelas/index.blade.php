@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title">Data Kelas</h2>
            <p class="section-subtitle">Kelola data kelas sekolah</p>
        </div>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Kelas
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-school me-2"></i>Daftar Kelas</h5>
            <span class="badge bg-light text-dark">Total: {{ $kelas->total() }} kelas</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="8%">No</th>
                            <th width="20%">Nama Kelas</th>
                            <th width="40%">Kompetensi Keahlian</th>
                            <th width="15%" class="text-center">Jumlah Siswa</th>
                            <th width="17%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $index => $k)
                        <tr>
                            <td>{{ $kelas->firstItem() + $index }}</td>
                            <td><span class="badge badge-custom bg-primary">{{ $k->nama_kelas }}</span></td>
                            <td>{{ $k->kompetensi_keahlian }}</td>
                            <td class="text-center">
                                <span class="badge badge-custom bg-info">{{ $k->siswa_count }} siswa</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kelas.edit', $k->id_kelas) }}" class="btn btn-sm btn-warning-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kelas.destroy', $k->id_kelas) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger-custom" 
                                            onclick="return confirm('Yakin ingin menghapus kelas ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">Belum ada data kelas</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $kelas->links() }}
        </div>
    </div>
</div>
@endsection