@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title">Data SPP</h2>
            <p class="section-subtitle">Kelola data tarif SPP</p>
        </div>
        <a href="{{ route('spp.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah SPP
        </a>
    </div>

    <div class="card card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-money-check-alt me-2"></i>Daftar SPP</h5>
            <span class="badge bg-light text-dark">Total: {{ $spp->total() }} data</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="20%">Tahun</th>
                            <th width="30%">Nominal</th>
                            <th width="20%" class="text-center">Jumlah Siswa</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($spp as $index => $s)
                        <tr>
                            <td>{{ $spp->firstItem() + $index }}</td>
                            <td><span class="badge badge-custom bg-primary">{{ $s->tahun }}</span></td>
                            <td><strong class="text-success">Rp {{ number_format($s->nominal, 0, ',', '.') }}</strong></td>
                            <td class="text-center">
                                <span class="badge badge-custom bg-info">{{ $s->siswa_count }} siswa</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('spp.edit', $s->id_spp) }}" class="btn btn-sm btn-warning-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('spp.destroy', $s->id_spp) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger-custom" 
                                            onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">Belum ada data SPP</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $spp->links() }}
        </div>
    </div>
</div>
@endsection