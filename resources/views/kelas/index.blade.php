@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title">Data Kelas</h2>
            <p class="section-subtitle">Kelola data kelas sekolah</p>
        </div>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Kelas
        </a>
    </div>

    <!-- Info Total Kelas -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card card-custom border-start border-4" style="border-color: var(--navy-primary) !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1" style="font-size: 0.85rem;">Total Seluruh Kelas (10-12)</h6>
                            <h3 class="fw-bold mb-0" style="color: var(--navy-primary); font-size: 2rem;">{{ $kelas->total() }} Kelas</h3>
                        </div>
                        <div style="font-size: 3rem; color: var(--navy-primary); opacity: 0.2;">
                            <i class="fas fa-school"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
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
                            <th width="45%">Kompetensi Keahlian</th>
                            <th width="12%" class="text-center">Jumlah Siswa</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $index => $k)
                        <tr>
                            <td class="text-center">{{ $kelas->firstItem() + $index }}</td>
                            <td>
                                <span class="badge badge-custom bg-primary">{{ $k->nama_kelas }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-graduation-cap me-2 text-primary" style="font-size: 0.8rem;"></i>
                                    <span>{{ $k->kompetensi_keahlian }}</span>
                                </div>
                            </td>
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
                                <div style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <p class="text-muted mb-0">Belum ada data kelas</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 10 Jurusan Info dengan Total Siswa @35 per Kelas -->
    <div class="card card-custom mt-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 text-muted">
                <i class="fas fa-info-circle me-2" style="font-size: 0.9rem;"></i>
                Daftar Jurusan & Kelas yang Tersedia
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Bidang IT -->
                <div class="col-md-4">
                    <div class="p-3 rounded" style="background-color: #f0f8ff; border-left: 4px solid #3498db;">
                        <h6 class="fw-bold text-primary mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-laptop-code me-2" style="font-size: 0.8rem;"></i>Bidang IT
                        </h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.75rem;">
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>RPL - Rekayasa Perangkat Lunak (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>DKV - Desain Komunikasi Visual (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>MKT - Mekatronika (35 siswa/kelas)</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>TKJ - Teknik Komputer dan Jaringan (35 siswa/kelas)</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Bidang Permesinan & Otomotif -->
                <div class="col-md-4">
                    <div class="p-3 rounded" style="background-color: #fff8e1; border-left: 4px solid #ffc107;">
                        <h6 class="fw-bold text-warning mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-cogs me-2" style="font-size: 0.8rem;"></i>Bidang Permesinan & Otomotif
                        </h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.75rem;">
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>TPM - Teknik Permesinan (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>TL1 - Teknik Pengelasan 1 (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>TL2 - Teknik Pengelasan 2 (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>TBKR - Teknik Body Kendaraan Ringan (35 siswa/kelas)</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>TKR2 - Teknik Kendaraan Ringan 2 (35 siswa/kelas)</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Bidang Pertanian -->
                <div class="col-md-4">
                    <div class="p-3 rounded" style="background-color: #e8f5e9; border-left: 4px solid #27ae60;">
                        <h6 class="fw-bold text-success mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-seedling me-2" style="font-size: 0.8rem;"></i>Bidang Pertanian
                        </h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.75rem;">
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>APHP1 - Agribisnis Pengolahan Hasil Pertanian 1 (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>APHP2 - Agribisnis Pengolahan Hasil Pertanian 2 (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>APHP3 - Agribisnis Pengolahan Hasil Pertanian 3 (35 siswa/kelas)</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>ATPH1 - Agribisnis Tanaman Pangan dan Hortikultura 1 (35 siswa/kelas)</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2" style="font-size: 0.7rem;"></i>ATPH2 - Agribisnis Tanaman Pangan dan Hortikultura 2 (35 siswa/kelas)</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Total Info -->
            <div class="alert alert-info mt-3 mb-0" style="font-size: 0.8rem;">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Catatan:</strong> Setiap kelas dirancang untuk menampung maksimal <strong>35 siswa</strong>. 
                Total terdapat <strong>14 jurusan</strong> dengan masing-masing tingkat (X, XI, XII), sehingga total ada sekitar <strong>42 kelas</strong> di seluruh sekolah.
            </div>
        </div>
    </div>
</div>
@endsection