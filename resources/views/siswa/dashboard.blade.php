@extends('siswa.layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')

<!-- ================= PROFIL SISWA ================= -->
<div class="card mb-4 fade-in-up">
    <div class="card-body text-center p-4">
        <div class="position-relative d-inline-block mb-3">
            <img
                src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=001f3f&color=FFD700&size=200"
                class="avatar"
                alt="{{ $siswa->nama }}"
            >
            <div class="position-absolute bottom-0 end-0" style="
                width: 30px;
                height: 30px;
                background: linear-gradient(135deg, #28a745, #20c997);
                border-radius: 50%;
                border: 3px solid white;
                display: flex;
                align-items: center;
                justify-content: center;
            ">
                <i class="fas fa-check text-white" style="font-size: 0.8rem;"></i>
            </div>
        </div>
        <h3 class="fw-bold mb-2" style="color: var(--navy-primary); font-size: 1.8rem;">
            {{ $siswa->nama }}
        </h3>
        <div class="text-muted mb-3" style="font-size: 1.1rem;">
            <i class="fas fa-id-card me-2"></i>NISN : {{ $siswa->nisn }}
        </div>

        <div class="mb-4">
            <span class="badge-yellow me-2">
                <i class="fas fa-school me-1"></i>{{ $siswa->kelas->nama_kelas }}
            </span>
            <span class="badge bg-light text-dark" style="
                padding: 8px 16px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.8rem;
            ">
                <i class="fas fa-cogs me-1"></i>{{ $siswa->kelas->kompetensi_keahlian }}
            </span>
        </div>

        <div class="mt-3">
            <form method="POST" action="{{ route('siswa.logout') }}">
                @csrf
                <button class="btn btn-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ================= STATISTIK ================= -->
<div class="row g-4 mb-4">

    <div class="col-md-4 fade-in-up delay-1">
        <div class="stat-card">
            <div class="stat-icon text-primary">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h4 class="fw-bold">{{ $jumlah_bulan_bayar }}</h4>
            <div class="text-muted">
                <i class="fas fa-clock me-1"></i>Bulan Terbayar
            </div>
            <div class="mt-3">
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: {{ ($jumlah_bulan_bayar / 12) * 100 }}%"></div>
                </div>
                <small class="text-muted mt-1 d-block">
                    {{ round(($jumlah_bulan_bayar / 12) * 100) }}% dari 12 bulan
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-4 fade-in-up delay-2">
        <div class="stat-card">
            <div class="stat-icon text-success">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <h4 class="fw-bold">
                Rp {{ number_format($total_bayar, 0, ',', '.') }}
            </h4>
            <div class="text-muted">
                <i class="fas fa-wallet me-1"></i>Total Dibayar
            </div>
            <div class="mt-3">
                <small class="text-success">
                    <i class="fas fa-arrow-up me-1"></i>
                    {{ $jumlah_bulan_bayar }} bulan lunas
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-4 fade-in-up delay-3">
        <div class="stat-card">
            <div class="stat-icon text-warning">
                <i class="fas fa-receipt"></i>
            </div>
            <h4 class="fw-bold">
                Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}
            </h4>
            <div class="text-muted">
                <i class="fas fa-tag me-1"></i>SPP / Bulan
            </div>
            <div class="mt-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    {{ 12 - $jumlah_bulan_bayar }} bulan tersisa
                </small>
            </div>
        </div>
    </div>

</div>

<!-- ================= RIWAYAT PEMBAYARAN ================= -->
<div class="card fade-in-up delay-3">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4" style="color: var(--navy-primary);">
            <i class="fas fa-history me-2" style="color: var(--yellow-accent);"></i> 
            Riwayat Pembayaran Terbaru
        </h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th style="border-radius: 10px 0 0 0;"><i class="fas fa-calendar-alt me-1"></i> Tanggal</th>
                    <th><i class="fas fa-calendar me-1"></i> Bulan</th>
                    <th><i class="fas fa-money-bill-wave me-1"></i> Nominal</th>
                    <th style="border-radius: 0 10px 0 0;"><i class="fas fa-user-tie me-1"></i> Petugas</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pembayaran_terbaru as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-2" style="
                                    width: 8px;
                                    height: 8px;
                                    background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
                                    border-radius: 50%;
                                "></div>
                                {{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}
                            </div>
                        </td>
                        <td>
                            <span class="badge" style="
                                background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
                                color: white;
                            ">
                                <i class="fas fa-calendar-day me-1"></i>
                                {{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}
                            </span>
                        </td>
                        <td class="fw-bold text-success">
                            <i class="fas fa-coins me-1"></i>
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar-small me-2" style="
                                    width: 32px;
                                    height: 32px;
                                    background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
                                    color: var(--navy-primary);
                                    border-radius: 50%;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-weight: 700;
                                    font-size: 0.8rem;
                                ">
                                    {{ strtoupper(substr($p->petugas->nama_petugas,0,1)) }}
                                </div>
                                {{ $p->petugas->nama_petugas }}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">
                            <div style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h5>Belum ada pembayaran</h5>
                            <p class="mb-0">Riwayat pembayaran akan muncul di sini</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($pembayaran_terbaru->count())
            <div class="text-center mt-4">
                <a href="{{ route('siswa.history') }}" class="btn btn-primary-custom">
                    <i class="fas fa-list me-2"></i> Lihat Semua Riwayat
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
