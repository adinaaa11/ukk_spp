@extends('layouts.main')

@section('title', 'Histori Pembayaran SPP')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-header bg-gradient-navy text-white py-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="mb-1" style="font-size: 28px;">
                                <i class="fas fa-history me-2"></i>Histori Pembayaran SPP
                            </h3>
                            <p class="mb-0 opacity-75" style="font-size: 16px;">Daftar semua transaksi pembayaran SPP</p>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <a href="{{ route('pembayaran.create') }}" class="btn btn-warning btn-lg shadow" style="font-size: 18px; border-radius: 10px;">
                                <i class="fas fa-plus-circle me-2"></i>Input Pembayaran Baru
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <!-- Filter Section -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold" style="font-size: 16px;">
                                <i class="fas fa-search text-navy me-2"></i>Cari Siswa
                            </label>
                            <input type="text" 
                                   id="searchInput" 
                                   class="form-control form-control-lg shadow-sm" 
                                   placeholder="Cari berdasarkan NISN atau nama..."
                                   style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold" style="font-size: 16px;">
                                <i class="fas fa-calendar-day text-navy me-2"></i>Bulan
                            </label>
                            <select id="filterBulan" class="form-select form-select-lg shadow-sm" style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                                <option value="">Semua Bulan</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold" style="font-size: 16px;">
                                <i class="fas fa-calendar text-navy me-2"></i>Tahun
                            </label>
                            <select id="filterTahun" class="form-select form-select-lg shadow-sm" style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                                <option value="">Semua Tahun</option>
                                @for($y = date('Y'); $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="resetFilter" class="btn btn-secondary btn-lg w-100 shadow" style="font-size: 18px; padding: 15px; border-radius: 10px;">
                                <i class="fas fa-redo me-2"></i>Reset
                            </button>
                        </div>
                    </div>

                    <!-- Summary Info -->
                    <div class="alert alert-info shadow-sm mb-4" style="font-size: 16px; border-radius: 10px; padding: 20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="fas fa-list-ol me-2"></i>Total Transaksi:</strong>
                                <span id="totalTransaksi" class="ms-2 badge bg-primary" style="font-size: 16px; padding: 8px 15px;">{{ $pembayaran->count() }}</span>
                            </div>
                            <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                <strong><i class="fas fa-money-bill-wave me-2"></i>Total Pendapatan:</strong>
                                <span id="totalPendapatan" class="ms-2 badge bg-success" style="font-size: 16px; padding: 8px 15px;">
                                    Rp {{ number_format($pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="pembayaranTable" style="font-size: 16px;">
                            <thead class="bg-light">
                                <tr>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">No</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Tanggal</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">NISN</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Nama Siswa</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Kelas</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Bulan</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Tahun</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Jumlah</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Metode</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Petugas</th>
                                    <th style="padding: 18px; font-size: 17px; font-weight: 600;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayaran as $index => $bayar)
                                <tr>
                                    <td style="padding: 18px;">{{ $index + 1 }}</td>
                                    <td style="padding: 18px;">{{ \Carbon\Carbon::parse($bayar->tgl_bayar)->isoFormat('D MMM Y') }}</td>
                                    <td style="padding: 18px;"><strong>{{ $bayar->siswa->nisn }}</strong></td>
                                    <td style="padding: 18px;">{{ $bayar->siswa->nama }}</td>
                                    <td style="padding: 18px;">{{ $bayar->siswa->kelas->nama_kelas }}</td>
                                    <td style="padding: 18px;">{{ $bayar->bulan_dibayar }}</td>
                                    <td style="padding: 18px;">{{ $bayar->tahun_dibayar }}</td>
                                    <td style="padding: 18px;">
                                        <strong class="text-success">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</strong>
                                    </td>
                                    <td style="padding: 18px;">
                                        <span class="badge bg-info px-3 py-2" style="font-size: 14px;">
                                            <i class="fas fa-money-bill-wave me-1"></i>{{ ucfirst($bayar->metode_pembayaran) }}
                                        </span>
                                    </td>
                                    <td style="padding: 18px;">{{ $bayar->petugas->nama_petugas }}</td>
                                    <td style="padding: 18px;">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pembayaran.show', $bayar->id_pembayaran) }}" 
                                               class="btn btn-sm btn-primary" 
                                               style="font-size: 14px; padding: 10px 15px;">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                            <a href="{{ route('pembayaran.struk', $bayar->id_pembayaran) }}" 
                                               class="btn btn-sm btn-success" 
                                               target="_blank"
                                               style="font-size: 14px; padding: 10px 15px;">
                                                <i class="fas fa-print me-1"></i>Struk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3 d-block"></i>
                                        <p class="text-muted mb-0" style="font-size: 18px;">Belum ada data pembayaran</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-navy {
        background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
    }
    
    .text-navy {
        color: #001f3f;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #FFD700;
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 31, 63, 0.05);
        cursor: pointer;
    }
    
    .btn-group .btn {
        border-radius: 8px !important;
        margin: 0 3px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const filterBulan = document.getElementById('filterBulan');
        const filterTahun = document.getElementById('filterTahun');
        const resetBtn = document.getElementById('resetFilter');
        const table = document.getElementById('pembayaranTable');
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const bulan = filterBulan.value;
            const tahun = filterTahun.value;
            let visibleCount = 0;

            rows.forEach(row => {
                const nisn = row.cells[2]?.textContent.toLowerCase() || '';
                const nama = row.cells[3]?.textContent.toLowerCase() || '';
                const rowBulan = row.cells[5]?.textContent || '';
                const rowTahun = row.cells[6]?.textContent || '';

                const matchSearch = nisn.includes(searchTerm) || nama.includes(searchTerm);
                const matchBulan = !bulan || rowBulan === bulan;
                const matchTahun = !tahun || rowTahun === tahun;

                if (matchSearch && matchBulan && matchTahun) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('totalTransaksi').textContent = visibleCount;
        }

        searchInput.addEventListener('input', filterTable);
        filterBulan.addEventListener('change', filterTable);
        filterTahun.addEventListener('change', filterTable);

        resetBtn.addEventListener('click', function() {
            searchInput.value = '';
            filterBulan.value = '';
            filterTahun.value = '';
            filterTable();
        });
    });
</script>
@endsection