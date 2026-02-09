@extends('layouts.main')

@section('title', 'Detail Siswa')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="section-title">Detail Siswa</h2>
        <p class="section-subtitle">Informasi lengkap siswa</p>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Info Siswa -->
        <div class="col-md-4">
            <div class="card card-custom text-center">
                <div class="card-body p-4">
                    <img src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=001f3f&color=FFD700&size=200" 
                         class="rounded-circle mb-3" 
                         alt="Avatar {{ $siswa->nama }}"
                         style="width: 150px; height: 150px; border: 4px solid var(--yellow-accent);">
                    
                    <h4 class="fw-bold mb-1" style="color: var(--navy-primary);">{{ $siswa->nama }}</h4>
                    <p class="text-muted mb-3">NISN: {{ $siswa->nisn }}</p>
                    
                    <div class="mb-3">
                        <span class="badge badge-custom bg-primary">{{ $siswa->kelas->nama_kelas }}</span>
                        <span class="badge badge-custom bg-info mt-1 d-block">{{ $siswa->kelas->kompetensi_keahlian }}</span>
                    </div>

                    <hr>

                    <div class="text-start">
                        <div class="mb-2">
                            <small class="text-muted">NIS</small>
                            <p class="mb-0 fw-bold">{{ $siswa->nis }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">No. Telepon</small>
                            <p class="mb-0 fw-bold">{{ $siswa->no_telp }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Alamat</small>
                            <p class="mb-0">{{ $siswa->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="card card-custom mt-3">
                <div class="card-body">
                    <a href="{{ route('siswa.edit', $siswa->nisn) }}" class="btn btn-warning-custom w-100 mb-2">
                        <i class="fas fa-edit me-2"></i>Edit Data Siswa
                    </a>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Informasi SPP & Riwayat -->
        <div class="col-md-8">
            <!-- Info SPP -->
            <div class="card card-custom mb-3">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-money-check-alt me-2"></i>Informasi SPP</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid var(--navy-primary);">
                                <small class="text-muted d-block">Tahun SPP</small>
                                <h4 class="mb-0" style="color: var(--navy-primary);">{{ $siswa->spp->tahun }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #27ae60;">
                                <small class="text-muted d-block">Nominal/Bulan</small>
                                <h4 class="mb-0 text-success">Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid var(--yellow-accent);">
                                <small class="text-muted d-block">Total Dibayar</small>
                                <h4 class="mb-0" style="color: var(--yellow-hover);">
                                    {{ $siswa->pembayaran->count() ?? 0 }} Bulan
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pembayaran -->
            <div class="card card-custom">
                <div class="card-header-custom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Pembayaran</h5>
                    <span class="badge bg-light text-dark">
                        {{ $siswa->pembayaran->count() ?? 0 }} Transaksi
                    </span>
                </div>
                <div class="card-body p-0">
                    @if($siswa->pembayaran && $siswa->pembayaran->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-custom mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="25%">Bulan/Tahun</th>
                                    <th width="20%">Nominal</th>
                                    <th width="15%">Metode</th>
                                    <th width="20%">Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa->pembayaran->sortByDesc('tgl_bayar') as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-custom bg-primary">
                                            {{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-success">
                                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        @if($p->metode_pembayaran == 'tunai')
                                            <span class="badge badge-custom bg-success">Tunai</span>
                                        @else
                                            <span class="badge badge-custom bg-info">Transfer</span>
                                        @endif
                                    </td>
                                    <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot style="background: #f8f9fa;">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total Pembayaran:</td>
                                    <td colspan="3">
                                        <strong class="text-success" style="font-size: 1.1rem;">
                                            Rp {{ number_format($siswa->pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                        <p class="text-muted mb-0">Belum ada riwayat pembayaran</p>
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-primary-custom mt-3">
                            <i class="fas fa-plus me-2"></i>Input Pembayaran
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection