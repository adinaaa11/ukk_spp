<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --navy-primary: #001f3f;
            --navy-dark: #001529;
            --navy-light: #0a2540;
            --yellow-accent: #FFD700;
            --yellow-hover: #FFC000;
            --yellow-light: #FFED4E;
            --text-primary: #2c3e50;
            --text-secondary: #6c757d;
            --border-color: #e9ecef;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.12);
            --shadow-lg: 0 8px 25px rgba(0,0,0,0.15);
            --shadow-xl: 0 15px 35px rgba(0,0,0,0.2);
        }

        body {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 50%, var(--navy-light) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 15px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 215, 0, 0.08) 0%, transparent 50%);
            z-index: 1;
            pointer-events: none;
        }
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .header-back {
            background: linear-gradient(145deg, rgba(255,255,255,0.9), rgba(255,255,255,0.95));
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .header-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
        }
        .table-responsive {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 18px 15px;
            position: relative;
        }

        .table thead th:first-child {
            border-radius: 15px 0 0 0;
        }

        .table thead th:last-child {
            border-radius: 0 15px 0 0;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 215, 0, 0.05);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: var(--border-color);
            font-size: 0.95rem;
        }

        .badge {
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
            color: white;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }
        .btn-back {
            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
            color: var(--yellow-accent);
            border: none;
            padding: 14px 30px;
            border-radius: 25px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,31,63,0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, var(--navy-dark), var(--navy-light));
            color: var(--yellow-light);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0,31,63,0.4);
            text-decoration: none;
        }

        .btn-back:hover::before {
            left: 100%;
        }

        .user-avatar-small {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
            color: var(--navy-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 3px 10px rgba(255,215,0,0.3);
            transition: all 0.3s ease;
        }

        .user-avatar-small:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 5px 15px rgba(255,215,0,0.4);
        }

        /* Pagination */
        .pagination {
            margin-top: 30px;
        }

        .page-link {
            color: var(--navy-primary);
            border-color: var(--border-color);
            padding: 10px 16px;
            margin: 0 2px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: var(--yellow-accent);
            color: var(--navy-primary);
            border-color: var(--yellow-accent);
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
            border-color: var(--navy-primary);
            box-shadow: 0 4px 12px rgba(0,31,63,0.3);
        }

        /* Animations */
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

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="header-back fade-in-up">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-2 fw-bold" style="color: var(--navy-primary); font-size: 1.5rem;">
                        <i class="fas fa-history me-2" style="color: var(--yellow-accent);"></i>
                        Riwayat Pembayaran SPP
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 1.1rem;">
                        <i class="fas fa-user-graduate me-2"></i>
                        {{ $siswa->nama }} ({{ $siswa->nisn }})
                    </p>
                </div>
                <a href="{{ route('siswa.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="table-responsive fade-in-up delay-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="border-radius: 15px 0 0 0;"><i class="fas fa-hashtag me-1"></i> No</th>
                        <th><i class="fas fa-calendar-alt me-1"></i> Tanggal Bayar</th>
                        <th><i class="fas fa-calendar me-1"></i> Bulan/Tahun</th>
                        <th><i class="fas fa-money-bill-wave me-1"></i> Nominal</th>
                        <th style="border-radius: 0 15px 0 0;"><i class="fas fa-user-tie me-1"></i> Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $index => $p)
                    <tr>
                        <td><strong>{{ $pembayaran->firstItem() + $index }}</strong></td>
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
                            @php
                                $bulans = explode(', ', $p->bulan_dibayar);
                            @endphp
                            @foreach($bulans as $bulan)
                                <span class="badge badge-primary me-1 mb-1">
                                    <i class="fas fa-calendar-day me-1"></i>{{ $bulan }}
                                </span>
                            @endforeach
                            <span class="badge badge-secondary">
                                <i class="fas fa-calendar me-1"></i>{{ $p->tahun_dibayar }}
                            </span>
                        </td>
                        <td class="fw-bold text-success">
                            <i class="fas fa-coins me-1"></i>
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar-small me-2">
                                    {{ strtoupper(substr($p->petugas->nama_petugas,0,1)) }}
                                </div>
                                {{ $p->petugas->nama_petugas }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <div style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h5>Belum ada riwayat pembayaran</h5>
                            <p class="mb-0">Riwayat pembayaran akan muncul di sini</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($pembayaran->total() > 0)
            <div class="mt-4">
                {{ $pembayaran->links() }}
            </div>
            @endif
        </div>
    </div>
</body>
</html>