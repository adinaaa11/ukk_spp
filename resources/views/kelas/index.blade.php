@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title mb-1">
                <i class="fas fa-school me-2"></i>Data Kelas
            </h2>
            <p class="section-subtitle mb-0">Kelola data kelas dan kompetensi keahlian</p>
        </div>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus-circle me-2"></i>Tambah Kelas
        </a>
    </div>

    <!-- STATISTIK KARTU -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom border-start border-4 border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Kelas</h6>
                            <h3 class="fw-bold mb-0 text-primary">{{ $kelas->total() }}</h3>
                        </div>
                        <div class="text-primary opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-school"></i>
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
                            <h3 class="fw-bold mb-0 text-success">{{ $kelas->sum('siswa_count') }}</h3>
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
                            <h6 class="text-muted mb-1">Rata-rata/Kelas</h6>
                            <h3 class="fw-bold mb-0 text-warning">{{ $kelas->total() > 0 ? round($kelas->sum('siswa_count') / $kelas->total()) : 0 }}</h3>
                        </div>
                        <div class="text-warning opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-chart-bar"></i>
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
                            <h6 class="text-muted mb-1">Kapasitas Total</h6>
                            <h3 class="fw-bold mb-0 text-info">{{ $kelas->total() * 35 }}</h3>
                        </div>
                        <div class="text-info opacity-25" style="font-size: 2.5rem;">
                            <i class="fas fa-couch"></i>
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
                    <i class="fas fa-table me-2"></i>Daftar Kelas
                </h5>
                <span class="badge bg-light text-dark fs-6">
                    <i class="fas fa-school me-1"></i>{{ $kelas->total() }} kelas
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="8%" class="text-center">
                                <i class="fas fa-hashtag me-1"></i>No
                            </th>
                            <th width="20%">
                                <i class="fas fa-tag me-1"></i>Nama Kelas
                            </th>
                            <th width="35%">
                                <i class="fas fa-graduation-cap me-1"></i>Kompetensi Keahlian
                            </th>
                            <th width="12%" class="text-center">
                                <i class="fas fa-users me-1"></i>Jumlah Siswa
                            </th>
                            <th width="15%" class="text-center">
                                <i class="fas fa-chart-pie me-1"></i>Kapasitas
                            </th>
                            <th width="10%" class="text-center">
                                <i class="fas fa-cogs me-1"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $index => $k)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $kelas->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                        {{ substr($k->nama_kelas, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $k->nama_kelas }}</div>
                                        <small class="text-muted">ID: {{ $k->id_kelas }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-graduation-cap me-2 text-primary" style="font-size: 1rem;"></i>
                                    <div>
                                        <div class="fw-bold">{{ $k->kompetensi_keahlian }}</div>
                                        <small class="text-muted">Jurusan</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="badge bg-info fs-6">{{ $k->siswa_count }} siswa</span>
                                    <small class="text-muted">terdaftar</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="w-100">
                                    <div class="progress mb-1" style="height: 20px;">
                                        @if($k->siswa_count <= 35)
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: {{ ($k->siswa_count / 35) * 100 }}%">
                                                {{ $k->siswa_count }}/35
                                            </div>
                                        @else
                                            <div class="progress-bar bg-danger" role="progressbar" 
                                                 style="width: 100%">
                                                Penuh
                                            </div>
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        @if($k->siswa_count < 35)
                                            {{ 35 - $k->siswa_count }} tersedia
                                        @else
                                            <span class="text-danger">Penuh</span>
                                        @endif
                                    </small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('kelas.show', $k->id_kelas) }}" class="btn btn-sm btn-info" title="Detail Kelas">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kelas.edit', $k->id_kelas) }}" class="btn btn-sm btn-warning" title="Edit Kelas">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $k->id_kelas) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('⚠️ Yakin ingin menghapus kelas: {{ $k->nama_kelas }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Kelas">
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
                                    <i class="fas fa-school-slash"></i>
                                </div>
                                <h5 class="text-muted">Belum ada data kelas</h5>
                                <p class="text-muted">Tambahkan kelas baru untuk memulai</p>
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
                        Menampilkan {{ $kelas->firstItem() }} - {{ $kelas->lastItem() }}
                        dari {{ $kelas->total() }} data
                    </small>
                </div>
                <div>
                    {{ $kelas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- INFO JURUSAN -->
    <div class="card card-custom mt-4">
        <div class="card-header bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
            <h5 class="mb-0 text-white">
                <i class="fas fa-graduation-cap me-2"></i>Daftar Jurusan & Kelas yang Tersedia
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Bidang IT -->
                <div class="col-md-4">
                    <div class="p-3 rounded border-start border-4 border-primary" style="background-color: #f0f8ff;">
                        <h6 class="fw-bold text-primary mb-2">
                            <i class="fas fa-laptop-code me-2"></i>Bidang IT
                        </h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.85rem;">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>RPL - Rekayasa Perangkat Lunak</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>DKV - Desain Komunikasi Visual</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>MKT - Mekatronika</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2"></i>TKJ - Teknik Komputer dan Jaringan</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Bidang Permesinan & Otomotif -->
                <div class="col-md-4">
                    <div class="p-3 rounded border-start border-4 border-warning" style="background-color: #fff8e1;">
                        <h6 class="fw-bold text-warning mb-2">
                            <i class="fas fa-cogs me-2"></i>Bidang Permesinan & Otomotif
                        </h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.85rem;">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>TPM - Teknik Permesinan</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>TL1 - Teknik Pengelasan 1</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>TL2 - Teknik Pengelasan 2</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>TBKR - Teknik Body Kendaraan Ringan</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2"></i>TKR2 - Teknik Kendaraan Ringan 2</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Bidang Pertanian -->
                <div class="col-md-4">
                    <div class="p-3 rounded border-start border-4 border-success" style="background-color: #e8f5e9;">
                        <h6 class="fw-bold text-success mb-2">
                            <i class="fas fa-seedling me-2"></i>Bidang Pertanian
                        </h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.85rem;">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>APHP1 - Agribisnis Pengolahan Hasil Pertanian 1</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>APHP2 - Agribisnis Pengolahan Hasil Pertanian 2</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>APHP3 - Agribisnis Pengolahan Hasil Pertanian 3</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>ATPH1 - Agribisnis Tanaman Pangan dan Hortikultura 1</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2"></i>ATPH2 - Agribisnis Tanaman Pangan dan Hortikultura 2</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Total Info -->
            <div class="alert alert-info mt-3 mb-0">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                    <div>
                        <strong>Catatan:</strong> Setiap kelas dirancang untuk menampung maksimal <strong>35 siswa</strong>. 
                        Total terdapat <strong>14 jurusan</strong> dengan masing-masing tingkat (X, XI, XII), sehingga total ada sekitar <strong>42 kelas</strong> di seluruh sekolah.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection