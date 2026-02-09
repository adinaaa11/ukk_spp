@extends('layouts.main')

@section('title', 'History Pembayaran')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="section-title">History Pembayaran SPP</h2>
        <p class="section-subtitle">Riwayat seluruh transaksi pembayaran SPP</p>
    </div>

    <!-- Filter & Search -->
    <div class="card card-custom mb-4">
        <div class="card-body">
            <form action="{{ route('pembayaran.index') }}" method="GET" class="row g-3">
                <!-- Search -->
                <div class="col-md-4">
                    <label for="search" class="form-label-custom">
                        <i class="fas fa-search me-1"></i>Cari Siswa
                    </label>
                    <input type="text" 
                           class="form-control form-control-custom" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Nama/NISN/NIS">
                </div>

                <!-- Filter Bulan -->
                <div class="col-md-3">
                    <label for="bulan" class="form-label-custom">
                        <i class="fas fa-calendar me-1"></i>Bulan
                    </label>
                    <select class="form-select form-control-custom" id="bulan" name="bulan">
                        <option value="">Semua Bulan</option>
                        <option value="Januari" {{ request('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ request('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ request('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ request('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ request('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ request('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ request('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September</option>
                        <option value="Oktober" {{ request('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ request('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="col-md-2">
                    <label for="tahun" class="form-label-custom">
                        <i class="fas fa-calendar-alt me-1"></i>Tahun
                    </label>
                    <select class="form-select form-control-custom" id="tahun" name="tahun">
                        <option value="">Semua</option>
                        @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Tombol -->
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary-custom flex-fill">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-custom text-center" style="border-left: 4px solid var(--navy-primary);">
                <div class="card-body">
                    <i class="fas fa-receipt fa-2x mb-2" style="color: var(--navy-primary);"></i>
                    <h5 class="mb-0">{{ $pembayaran->total() }}</h5>
                    <small class="text-muted">Total Transaksi</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom text-center" style="border-left: 4px solid #27ae60;">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave fa-2x mb-2 text-success"></i>
                    <h5 class="mb-0 text-success">
                        Rp {{ number_format($pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}
                    </h5>
                    <small class="text-muted">Total Pemasukan</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom text-center" style="border-left: 4px solid var(--yellow-accent);">
                <div class="card-body">
                    <i class="fas fa-hand-holding-usd fa-2x mb-2" style="color: var(--yellow-hover);"></i>
                    <h5 class="mb-0">
                        {{ $pembayaran->where('metode_pembayaran', 'tunai')->count() }}
                    </h5>
                    <small class="text-muted">Pembayaran Tunai</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom text-center" style="border-left: 4px solid #3498db;">
                <div class="card-body">
                    <i class="fas fa-credit-card fa-2x mb-2 text-info"></i>
                    <h5 class="mb-0">
                        {{ $pembayaran->where('metode_pembayaran', 'transfer')->count() }}
                    </h5>
                    <small class="text-muted">Pembayaran Transfer</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel History -->
    <div class="card card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Daftar Transaksi Pembayaran</h5>
            {{-- PERBAIKAN: Ganti route 'entri-pembayaran' menjadi 'pembayaran.create' --}}
            <a href="{{ route('pembayaran.create') }}" class="btn btn-warning-custom">
                <i class="fas fa-plus me-2"></i>Tambah Pembayaran
            </a>
        </div>
        <div class="card-body p-0">
            @if($pembayaran->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tanggal</th>
                            <th width="20%">Nama Siswa</th>
                            <th width="10%">NISN</th>
                            <th width="15%">Bulan/Tahun</th>
                            <th width="15%">Nominal</th>
                            <th width="10%">Metode</th>
                            <th width="10%">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $index => $p)
                        <tr>
                            <td>{{ $pembayaran->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('siswa.show', $p->siswa->nisn) }}" 
                                   class="text-decoration-none fw-bold" 
                                   style="color: var(--navy-primary);">
                                    {{ $p->siswa->nama }}
                                </a>
                            </td>
                            <td>{{ $p->nisn }}</td>
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
                                    <span class="badge badge-custom bg-success">
                                        <i class="fas fa-money-bill-wave me-1"></i>Tunai
                                    </span>
                                @else
                                    <span class="badge badge-custom bg-info">
                                        <i class="fas fa-credit-card me-1"></i>Transfer
                                    </span>
                                @endif
                            </td>
                            <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background: #f8f9fa;">
                        <tr>
                            <td colspan="5" class="text-end fw-bold">Total di Halaman Ini:</td>
                            <td colspan="3">
                                <strong class="text-success" style="font-size: 1.1rem;">
                                    Rp {{ number_format($pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-3">
                {{ $pembayaran->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                <p class="text-muted mb-0">Tidak ada data pembayaran ditemukan</p>
                @if(request('search') || request('bulan') || request('tahun'))
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-redo me-2"></i>Reset Filter
                    </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Form Label Custom */
.form-label-custom {
    font-weight: 600;
    color: var(--navy-primary);
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
}

/* Form Control Custom */
.form-control-custom,
.form-select.form-control-custom {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.form-control-custom:focus,
.form-select.form-control-custom:focus {
    border-color: var(--yellow-accent);
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    outline: none;
}

.form-control-custom:hover:not(:focus),
.form-select.form-control-custom:hover:not(:focus) {
    border-color: var(--navy-primary);
}

/* Card Custom */
.card-custom {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.card-header-custom {
    background: linear-gradient(135deg, var(--navy-primary) 0%, #003366 100%);
    color: var(--yellow-accent);
    padding: 1.25rem 1.5rem;
    border: none;
}

.card-header-custom h5 {
    margin: 0;
    font-weight: 600;
}

/* Button Styles */
.btn-primary-custom {
    background: linear-gradient(135deg, var(--navy-primary) 0%, #003366 100%);
    border: none;
    color: var(--yellow-accent);
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 31, 63, 0.2);
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #003366 0%, var(--navy-primary) 100%);
    color: var(--yellow-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 31, 63, 0.3);
}

.btn-warning-custom {
    background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
    border: none;
    color: var(--navy-primary);
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(255, 215, 0, 0.2);
}

.btn-warning-custom:hover {
    background: linear-gradient(135deg, var(--yellow-hover) 0%, var(--yellow-accent) 100%);
    color: var(--navy-primary);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(255, 215, 0, 0.3);
}

.btn-secondary {
    background: #6c757d;
    border: none;
    color: white;
    padding: 0.6rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

/* Table Custom */
.table-custom thead {
    background: linear-gradient(135deg, var(--navy-primary) 0%, #003366 100%);
    color: var(--yellow-accent);
}

.table-custom thead th {
    font-weight: 600;
    padding: 1rem;
    border: none;
}

.table-custom tbody tr {
    transition: background-color 0.2s ease;
}

.table-custom tbody tr:hover {
    background-color: rgba(255, 215, 0, 0.1);
}

.table-custom tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-color: #f0f0f0;
}

/* Badge Custom */
.badge-custom {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
}

/* Section Title */
.section-title {
    color: var(--navy-primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header-custom h5 {
        font-size: 1rem;
    }
    
    .btn-warning-custom,
    .btn-primary-custom,
    .btn-secondary {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
    }
    
    .table-custom {
        font-size: 0.85rem;
    }
    
    .table-custom thead th,
    .table-custom tbody td {
        padding: 0.75rem 0.5rem;
    }
}
</style>
@endsection