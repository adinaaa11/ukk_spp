
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - {{ $siswa->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* ═══════════════════════════════════════════════════════════
           COLOR VARIABLES (NAVY & YELLOW THEME)
           ═══════════════════════════════════════════════════════════ */
        :root {
            --navy-primary: #001f3f;
            --navy-dark: #001529;
            --navy-light: #003d73;
            --yellow-accent: #FFD700;
            --yellow-hover: #FFC000;
            --yellow-light: #FFED4E;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════════════════════════
           ANIMATED BACKGROUND PARTICLES
           ═══════════════════════════════════════════════════════════ */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 215, 0, 0.08);
            border-radius: 50%;
            animation: float 20s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0) rotate(0deg); }
            25% { transform: translateY(-100px) translateX(100px) rotate(90deg); }
            50% { transform: translateY(-200px) translateX(-100px) rotate(180deg); }
            75% { transform: translateY(-100px) translateX(100px) rotate(270deg); }
        }

        .particle:nth-child(1) { width: 120px; height: 120px; top: 10%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 80px; height: 80px; top: 50%; left: 85%; animation-delay: 3s; }
        .particle:nth-child(3) { width: 100px; height: 100px; top: 70%; left: 15%; animation-delay: 6s; }
        .particle:nth-child(4) { width: 60px; height: 60px; top: 30%; left: 75%; animation-delay: 2s; }
        .particle:nth-child(5) { width: 90px; height: 90px; top: 60%; left: 50%; animation-delay: 4s; }

        /* ═══════════════════════════════════════════════════════════
           CONTAINER
           ═══════════════════════════════════════════════════════════ */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 15px;
            position: relative;
            z-index: 10;
        }

        /* ═══════════════════════════════════════════════════════════
           CARD STYLES
           ═══════════════════════════════════════════════════════════ */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        /* ═══════════════════════════════════════════════════════════
           HEADER CARD (PROFILE)
           ═══════════════════════════════════════════════════════════ */
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
            border: 4px solid var(--yellow-accent);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .header-card h3 {
            color: var(--navy-primary);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header-card p {
            color: #666;
            margin-bottom: 15px;
        }

        .header-card .badge {
            font-size: 14px;
            padding: 8px 15px;
            margin: 0 5px;
        }

        .badge-navy {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
        }

        .badge-yellow {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-primary);
        }

        /* ═══════════════════════════════════════════════════════════
           LOGOUT BUTTON
           ═══════════════════════════════════════════════════════════ */
        .btn-logout {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 600;
            margin-top: 15px;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
            color: white;
        }

        /* ═══════════════════════════════════════════════════════════
           STAT CARDS
           ═══════════════════════════════════════════════════════════ */
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            height: 100%;
        }

        .stat-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .stat-card h4 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-card p {
            color: #666;
            margin: 0;
            font-size: 14px;
        }

        /* Color variations for stat cards */
        .stat-card.stat-navy {
            border-left: 5px solid var(--navy-primary);
        }

        .stat-card.stat-navy .stat-icon {
            color: var(--navy-primary);
        }

        .stat-card.stat-navy h4 {
            color: var(--navy-primary);
        }

        .stat-card.stat-yellow {
            border-left: 5px solid var(--yellow-accent);
        }

        .stat-card.stat-yellow .stat-icon {
            color: var(--yellow-accent);
        }

        .stat-card.stat-yellow h4 {
            color: var(--yellow-hover);
        }

        .stat-card.stat-success {
            border-left: 5px solid #27ae60;
        }

        .stat-card.stat-success .stat-icon {
            color: #27ae60;
        }

        .stat-card.stat-success h4 {
            color: #27ae60;
        }

        /* ═══════════════════════════════════════════════════════════
           TABLE STYLES
           ═══════════════════════════════════════════════════════════ */
        .table-responsive {
            background: white;
            border-radius: 15px;
            padding: 0;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }

        /* ═══════════════════════════════════════════════════════════
           BADGES IN TABLE
           ═══════════════════════════════════════════════════════════ */
        .badge-table {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
        }

        .badge-primary {
            background: var(--navy-primary);
            color: white;
        }

        /* ═══════════════════════════════════════════════════════════
           BUTTONS
           ═══════════════════════════════════════════════════════════ */
        .btn-navy {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-navy:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 31, 63, 0.4);
            color: var(--yellow-light);
        }

        /* ═══════════════════════════════════════════════════════════
           EMPTY STATE
           ═══════════════════════════════════════════════════════════ */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        /* ═══════════════════════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .container-custom {
                padding: 20px 10px;
            }

            .header-card {
                padding: 20px;
            }

            .avatar {
                width: 80px;
                height: 80px;
            }

            .stat-card {
                padding: 20px;
                margin-bottom: 15px;
            }

            .stat-icon {
                font-size: 32px;
            }

            .table {
                font-size: 13px;
            }

            .table thead th,
            .table tbody td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- ═══════════════════════════════════════════════════════════
         ANIMATED PARTICLES BACKGROUND
         ═══════════════════════════════════════════════════════════ -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container-custom">
        <!-- ═══════════════════════════════════════════════════════════
             HEADER PROFILE CARD
             ═══════════════════════════════════════════════════════════ -->
        <div class="card-custom header-card">
            <img src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=001f3f&color=FFD700&size=200" 
                 class="avatar" 
                 alt="Avatar {{ $siswa->nama }}">
            <h3 class="fw-bold mb-1">{{ $siswa->nama }}</h3>
            <p class="text-muted mb-2">NISN: {{ $siswa->nisn }}</p>
            <div class="mb-3">
                <span class="badge badge-navy">{{ $siswa->kelas->nama_kelas }}</span>
                <span class="badge badge-yellow">{{ $siswa->kelas->kompetensi_keahlian }}</span>
            </div>
            <hr>
            <form method="POST" action="{{ route('siswa.logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>

        <!-- ═══════════════════════════════════════════════════════════
             STATISTIK CARDS
             ═══════════════════════════════════════════════════════════ -->
        <div class="row g-3">
            <!-- Card 1: Bulan Terbayar -->
            <div class="col-md-4">
                <div class="card-custom stat-card stat-navy">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4>{{ $jumlah_bulan_bayar }}</h4>
                    <p class="mb-0">Bulan Terbayar</p>
                </div>
            </div>

            <!-- Card 2: Total Dibayar -->
            <div class="col-md-4">
                <div class="card-custom stat-card stat-success">
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h4>Rp {{ number_format($total_bayar, 0, ',', '.') }}</h4>
                    <p class="mb-0">Total Dibayar</p>
                </div>
            </div>

            <!-- Card 3: SPP per Bulan -->
            <div class="col-md-4">
                <div class="card-custom stat-card stat-yellow">
                    <div class="stat-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h4>Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</h4>
                    <p class="mb-0">SPP/Bulan</p>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════════════════════════
             RIWAYAT PEMBAYARAN TERBARU
             ═══════════════════════════════════════════════════════════ -->
        <div class="card-custom" style="background: white;">
            <div class="card-body">
                <h5 class="fw-bold mb-4" style="color: var(--navy-primary);">
                    <i class="fas fa-history me-2" style="color: var(--yellow-accent);"></i>
                    Riwayat Pembayaran Terbaru
                </h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Tanggal</th>
                                <th width="25%">Bulan</th>
                                <th width="30%">Nominal</th>
                                <th width="30%">Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran_terbaru as $p)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-table badge-primary">
                                        {{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}
                                    </span>
                                </td>
                                <td>
                                    <strong class="text-success">
                                        Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td>{{ $p->petugas->nama_petugas }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p class="mb-0">Belum ada riwayat pembayaran</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($pembayaran_terbaru->count() > 0)
                <div class="text-center mt-3">
                    <a href="{{ route('siswa.history') }}" class="btn btn-navy">
                        <i class="fas fa-list me-2"></i>Lihat Semua Riwayat
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>