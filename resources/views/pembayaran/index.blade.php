@extends('layouts.main')

@section('title', 'History Pembayaran SPP')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-history"></i> History Pembayaran SPP</h2>
        <a href="{{ route('entri-pembayaran') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Entri Pembayaran Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Statistik -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Siswa Sudah Bayar</h6>
                            <h3 class="mb-0">{{ $totalSiswa ?? 0 }} Siswa</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 text-success rounded p-3">
                                <i class="fas fa-money-bill-wave fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Pembayaran</h6>
                            <h3 class="mb-0">Rp {{ number_format($totalPembayaran ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('history-pembayaran') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Cari Siswa (NISN/Nama)</label>
                        <input type="text" class="form-control" name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Ketik NISN atau Nama...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filter Kelas</label>
                        <select class="form-select" name="kelas">
                            <option value="">Semua Kelas</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id_kelas }}" 
                                    {{ request('kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }} - {{ $kelas->kompetensi_keahlian }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filter Tahun</label>
                        <select class="form-select" name="tahun">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('history-pembayaran') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Siswa yang Sudah Bayar -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Siswa yang Sudah Membayar SPP</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 12%;">NISN</th>
                            <th style="width: 20%;">Nama Siswa</th>
                            <th style="width: 18%;">Kelas</th>
                            <th style="width: 12%;" class="text-center">Tarif SPP</th>
                            <th style="width: 10%;" class="text-center">Bulan Terbayar</th>
                            <th style="width: 13%;" class="text-end">Total Dibayar</th>
                            <th style="width: 10%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                            @php
                                // Hitung total bulan terbayar
                                $totalBulan = $s->pembayaran->count();
                                
                                // Hitung total nominal yang sudah dibayar
                                $totalDibayar = $s->pembayaran->sum('jumlah_bayar');
                                
                                // Ambil pembayaran terakhir
                                $pembayaranTerakhir = $s->pembayaran->sortByDesc('tgl_bayar')->first();
                            @endphp
                            <tr>
                                <td>{{ $siswa->firstItem() + $index }}</td>
                                <td><strong>{{ $s->nisn }}</strong></td>
                                <td>{{ $s->nama }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $s->kelas->nama_kelas }}</span><br>
                                    <small class="text-muted">{{ $s->kelas->kompetensi_keahlian }}</small>
                                </td>
                                <td class="text-center">
                                    <strong class="text-primary">
                                        Rp {{ number_format($s->spp->nominal ?? 0, 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success fs-6">{{ $totalBulan }} Bulan</span>
                                </td>
                                <td class="text-end">
                                    <strong class="text-success">
                                        Rp {{ number_format($totalDibayar, 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detailModal{{ $s->nisn }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Detail Pembayaran per Siswa -->
                            <div class="modal fade" id="detailModal{{ $s->nisn }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">
                                                <i class="fas fa-file-invoice-dollar"></i> 
                                                Detail Pembayaran - {{ $s->nama }}
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Info Siswa -->
                                            <div class="card border-primary mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="mb-1"><strong>NISN:</strong> {{ $s->nisn }}</p>
                                                            <p class="mb-1"><strong>Nama:</strong> {{ $s->nama }}</p>
                                                            <p class="mb-0"><strong>Kelas:</strong> {{ $s->kelas->nama_kelas }} - {{ $s->kelas->kompetensi_keahlian }}</p>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <p class="mb-1"><strong>Tarif SPP:</strong> <span class="text-primary">Rp {{ number_format($s->spp->nominal ?? 0, 0, ',', '.') }}</span></p>
                                                            <p class="mb-1"><strong>Total Bulan:</strong> <span class="badge bg-success">{{ $totalBulan }} Bulan</span></p>
                                                            <p class="mb-0"><strong>Total Dibayar:</strong> <span class="text-success fs-5">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Riwayat Pembayaran -->
                                            <h6 class="mb-3"><i class="fas fa-history"></i> Riwayat Pembayaran</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal Bayar</th>
                                                            <th>Bulan/Tahun</th>
                                                            <th class="text-end">Jumlah</th>
                                                            <th>Metode</th>
                                                            <th>Petugas</th>
                                                            <th class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($s->pembayaran->sortByDesc('tgl_bayar') as $idx => $p)
                                                            <tr>
                                                                <td>{{ $idx + 1 }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                                                                <td>
                                                                    <strong>{{ $p->bulan_dibayar }}</strong> {{ $p->tahun_dibayar }}
                                                                </td>
                                                                <td class="text-end">
                                                                    Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                                                </td>
                                                                <td>
                                                                    @if($p->metode_pembayaran == 'tunai')
                                                                        <span class="badge bg-success">Tunai</span>
                                                                    @else
                                                                        <span class="badge bg-primary">Transfer</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                                                                <td class="text-center">
                                                                    <a href="{{ route('pembayaran.struk', $p->id_pembayaran) }}" 
                                                                       class="btn btn-sm btn-warning" 
                                                                       target="_blank">
                                                                        <i class="fas fa-print"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="table-light">
                                                        <tr>
                                                            <td colspan="3" class="text-end"><strong>TOTAL</strong></td>
                                                            <td class="text-end">
                                                                <strong class="text-success">
                                                                    Rp {{ number_format($totalDibayar, 0, ',', '.') }}
                                                                </strong>
                                                            </td>
                                                            <td colspan="3"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i> Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Belum ada siswa yang melakukan pembayaran SPP</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($siswa->hasPages())
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $siswa->firstItem() }} - {{ $siswa->lastItem() }} dari {{ $siswa->total() }} siswa
                    </div>
                    <div>
                        {{ $siswa->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        white-space: nowrap;
    }
    
    .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .modal-dialog-scrollable .modal-body {
        max-height: 70vh;
    }
    
    .badge {
        padding: 0.4em 0.8em;
    }
</style>
@endsection