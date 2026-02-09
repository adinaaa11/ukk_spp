@extends('layouts.main')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="card-header bg-gradient-navy text-white py-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center">
                    <div class="icon-box me-3">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">Detail Pembayaran SPP</h4>
                        <small class="opacity-75">
                            ID Transaksi #{{ $pembayaran->id_pembayaran }}
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- BODY -->
        <div class="card-body p-4">

            <div class="row g-4">

                <!-- DATA SISWA -->
                <div class="col-lg-6">
                    <div class="info-card">
                        <div class="info-title">
                            <i class="fas fa-user-graduate me-2"></i>Data Siswa
                        </div>

                        <div class="info-row">
                            <span>NISN</span>
                            <strong>{{ $pembayaran->siswa->nisn }}</strong>
                        </div>
                        <div class="info-row">
                            <span>Nama</span>
                            <strong>{{ $pembayaran->siswa->nama }}</strong>
                        </div>
                        <div class="info-row">
                            <span>Kelas</span>
                            <strong>{{ $pembayaran->siswa->kelas->nama_kelas }}</strong>
                        </div>
                    </div>
                </div>

                <!-- DATA PEMBAYARAN -->
                <div class="col-lg-6">
                    <div class="info-card">
                        <div class="info-title">
                            <i class="fas fa-money-check-alt me-2"></i>Data Pembayaran
                        </div>

                        <div class="info-row">
                            <span>Bulan / Tahun</span>
                            <strong>{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</strong>
                        </div>
                        <div class="info-row">
                            <span>Metode</span>
                            <strong>{{ ucfirst($pembayaran->metode_pembayaran) }}</strong>
                        </div>
                        <div class="info-row">
                            <span>Petugas</span>
                            <strong>{{ $pembayaran->petugas->nama_petugas }}</strong>
                        </div>
                        <div class="info-row">
                            <span>Tanggal Bayar</span>
                            <strong>{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d F Y') }}</strong>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOTAL -->
            <div class="total-box mt-4">
                <span>Total Pembayaran</span>
                <h3>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</h3>
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
                <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>

                <a href="{{ route('pembayaran.struk', $pembayaran->id_pembayaran) }}"
                   target="_blank"
                   class="btn btn-success px-4 shadow">
                    <i class="fas fa-print me-1"></i>Cetak Struk
                </a>
            </div>

        </div>
    </div>
</div>

<style>
.bg-gradient-navy {
    background: linear-gradient(135deg, #001f3f, #003366);
}

.icon-box {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,.15);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 20px;
}

.info-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
    height: 100%;
}

.info-title {
    font-weight: 600;
    margin-bottom: 15px;
    color: #0d6efd;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px dashed #e5e7eb;
}

.info-row:last-child {
    border-bottom: none;
}

.total-box {
    background: linear-gradient(135deg, #e7f0ff, #d0e2ff);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.total-box h3 {
    margin: 0;
    color: #003366;
    font-weight: 700;
}
</style>
@endsection
