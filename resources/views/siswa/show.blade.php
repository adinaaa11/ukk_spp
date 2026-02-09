@extends('layouts.main')

@section('title', 'Detail Siswa')

@section('content')
<div class="container-fluid py-3">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-navy mb-0">
            <i class="fas fa-user-graduate me-2"></i> Detail Siswa
        </h4>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- CARD DETAIL SISWA -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">

                <!-- DATA SISWA -->
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3 text-primary">Data Siswa</h6>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th width="40%">NISN</th>
                            <td>: {{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>: <strong>{{ $siswa->nama }}</strong></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>: {{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No. Telp</th>
                            <td>: {{ $siswa->no_telp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $siswa->alamat }}</td>
                        </tr>
                    </table>
                </div>

                <!-- DATA SPP -->
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3 text-primary">Data SPP</h6>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th width="40%">Tahun SPP</th>
                            <td>: {{ $siswa->spp->tahun ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>: 
                                <span class="text-success fw-bold">
                                    Rp {{ number_format($siswa->spp->nominal ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: 
                                <span class="badge bg-success">Aktif</span>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- RIWAYAT PEMBAYARAN -->
    <div class="card shadow-sm">
        <div class="card-header bg-light fw-bold">
            <i class="fas fa-history me-1"></i> Riwayat Pembayaran
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa->pembayaran as $i => $p)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                            <td>{{ $p->bulan_dibayar }}</td>
                            <td>{{ $p->tahun_dibayar }}</td>
                            <td class="text-success fw-bold">
                                Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                            </td>
                            <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada pembayaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
