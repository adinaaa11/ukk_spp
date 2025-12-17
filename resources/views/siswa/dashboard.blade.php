<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #27ae60;
            --secondary: #2ecc71;
            --dark: #1e8449;
        }
        body {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 15px;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        .header-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
        }
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
        }
        .stat-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        .btn-logout {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-logout:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <!-- Header Profile -->
        <div class="card-custom header-card">
            <img src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=27ae60&color=fff&size=200" class="avatar" alt="Avatar">
            <h3 class="fw-bold mb-1">{{ $siswa->nama }}</h3>
            <p class="text-muted mb-2">NISN: {{ $siswa->nisn }}</p>
            <span class="badge bg-success">{{ $siswa->kelas->nama_kelas }}</span>
            <span class="badge bg-info">{{ $siswa->kelas->kompetensi_keahlian }}</span>
            <hr>
            <form method="POST" action="{{ route('siswa.logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>

        <!-- Statistik -->
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card-custom stat-card" style="border-left: 5px solid #3498db;">
                    <div class="stat-icon text-primary">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4 class="fw-bold">{{ $jumlah_bulan_bayar }}</h4>
                    <p class="text-muted mb-0">Bulan Terbayar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom stat-card" style="border-left: 5px solid #27ae60;">
                    <div class="stat-icon text-success">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h4 class="fw-bold">Rp {{ number_format($total_bayar, 0, ',', '.') }}</h4>
                    <p class="text-muted mb-0">Total Dibayar</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom stat-card" style="border-left: 5px solid #f39c12;">
                    <div class="stat-icon text-warning">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h4 class="fw-bold">Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</h4>
                    <p class="text-muted mb-0">SPP/Bulan</p>
                </div>
            </div>
        </div>

        <!-- Riwayat Pembayaran Terbaru -->
        <div class="card-custom" style="background: white;">
            <div class="card-body">
                <h5 class="fw-bold mb-4"><i class="fas fa-history me-2 text-success"></i>Riwayat Pembayaran Terbaru</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th>Tanggal</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran_terbaru as $p)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                                <td><span class="badge bg-primary">{{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}</span></td>
                                <td><strong class="text-success">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</strong></td>
                                <td>{{ $p->petugas->nama_petugas }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="fas fa-info-circle me-2"></i>Belum ada riwayat pembayaran
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pembayaran_terbaru->count() > 0)
                <div class="text-center mt-3">
                    <a href="{{ route('siswa.history') }}" class="btn btn-success">
                        <i class="fas fa-list me-2"></i>Lihat Semua Riwayat
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>