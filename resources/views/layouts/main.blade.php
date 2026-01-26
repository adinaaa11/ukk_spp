<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi SPP - UKK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
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
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            min-height: 100vh;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,215,0,0.3);
            border-radius: 10px;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin-bottom: 5px;
            border-radius: 0 25px 25px 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,215,0,0.1);
            color: var(--yellow-accent);
            padding-left: 25px;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-dark);
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
        }

        .sidebar-brand {
            padding: 25px 20px;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-align: center;
            border-bottom: 1px solid rgba(255,215,0,0.2);
            background: rgba(255,215,0,0.05);
        }

        .sidebar-brand i {
            color: var(--yellow-accent);
            font-size: 2rem;
        }

        .user-info {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,215,0,0.2);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--yellow-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 24px;
            color: var(--navy-dark);
            font-weight: bold;
        }

        .content-area {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
            border: none;
        }

        .card-header-custom h5 {
            font-size: 1rem;
            margin: 0;
        }

        .card-header-navy {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: white;
            padding: 15px 20px;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            border: none;
            padding: 8px 20px;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 31, 63, 0.4);
            color: var(--yellow-light);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
        }

        .btn-warning-custom {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-dark);
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .btn-navy {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            border: none;
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-yellow {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-dark);
            border: none;
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* TABEL - UKURAN DIPERKECIL */
        .table {
            font-size: 0.75rem !important;
            margin-bottom: 0;
        }

        .table thead th {
            padding: 8px 6px !important;
            font-size: 0.75rem !important;
            font-weight: 600;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 6px !important;
            font-size: 0.75rem !important;
            vertical-align: middle;
        }

        .table-custom {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom thead {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
        }

        .table-custom tbody tr {
            transition: background 0.3s;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }

        /* BADGE - UKURAN DIPERKECIL */
        .badge {
            padding: 3px 8px !important;
            font-size: 0.7rem !important;
            border-radius: 12px;
            font-weight: 500;
        }

        .badge-custom {
            padding: 3px 8px !important;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.7rem !important;
            white-space: nowrap;
        }

        /* BUTTON DI TABEL - UKURAN DIPERKECIL */
        .table .btn-sm {
            padding: 4px 8px !important;
            font-size: 0.7rem !important;
        }

        .table .btn-sm i {
            font-size: 0.7rem;
        }

        /* SMALL TEXT */
        .table small,
        small {
            font-size: 0.65rem !important;
        }

        /* PAGINATION - UKURAN DIPERKECIL */
        .pagination {
            margin: 0;
            font-size: 0.75rem;
        }

        .pagination .page-link {
            color: var(--navy-primary);
            border: 1px solid #dee2e6;
            padding: 0.25rem 0.5rem !important;
            font-size: 0.75rem !important;
            line-height: 1.2;
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--navy-primary);
            border-color: var(--navy-primary);
            color: var(--yellow-accent);
        }

        .pagination .page-link:hover {
            color: var(--yellow-accent);
            background-color: var(--navy-primary);
            border-color: var(--navy-primary);
        }

        .section-title {
            color: var(--navy-primary);
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.5rem;
        }

        .section-subtitle {
            color: #7f8c8d;
            font-size: 0.875rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--yellow-accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: rgba(0, 31, 63, 0.3);
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                width: 260px;
                transform: translateX(0);
            }
            
            .content-area {
                margin-left: 0;
            }

            .table {
                font-size: 0.7rem !important;
            }

            .table thead th {
                padding: 6px 4px !important;
                font-size: 0.65rem !important;
            }

            .table tbody td {
                padding: 5px 4px !important;
                font-size: 0.7rem !important;
            }

            .badge,
            .badge-custom {
                padding: 2px 6px !important;
                font-size: 0.65rem !important;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-graduation-cap"></i>
                <div class="mt-2">APP SPP</div>
            </div>

            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nama_petugas, 0, 1)) }}
                </div>
                <div class="fw-bold">{{ auth()->user()->nama_petugas }}</div>
                <small class="badge" style="background: var(--yellow-accent); color: var(--navy-dark);">{{ strtoupper(auth()->user()->level) }}</small>
            </div>

            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                
                @if(auth()->user()->level == 'admin')
                <li class="nav-item mt-3">
                    <small class="text-white-50 px-3 d-block mb-2">DATA MASTER</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('siswa*') ? 'active' : '' }}" href="{{ route('siswa.index') }}">
                        <i class="fas fa-user-graduate me-2"></i> Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}" href="{{ route('kelas.index') }}">
                        <i class="fas fa-school me-2"></i> Data Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('spp*') ? 'active' : '' }}" href="{{ route('spp.index') }}">
                        <i class="fas fa-money-check-alt me-2"></i> Data SPP
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('petugas*') ? 'active' : '' }}" href="{{ route('petugas.index') }}">
                        <i class="fas fa-user-shield me-2"></i> Data Petugas
                    </a>
                </li>
                @endif
                
                <li class="nav-item mt-3">
                    <small class="text-white-50 px-3 d-block mb-2">TRANSAKSI</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('entri-pembayaran*') ? 'active' : '' }}" href="{{ route('pembayaran.create') }}">
                        <i class="fas fa-cash-register me-2"></i> Entri Pembayaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('history-pembayaran') ? 'active' : '' }}" href="{{ route('pembayaran.index') }}">
                        <i class="fas fa-history me-2"></i> History Pembayaran
                    </a>
                </li>
                
                @if(auth()->user()->level == 'admin')
                <li class="nav-item mt-3">
                    <small class="text-white-50 px-3 d-block mb-2">LAPORAN</small>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('laporan*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                        <i class="fas fa-file-excel me-2"></i> Laporan Excel
                    </a>
                </li>
                @endif
                
                <li class="nav-item mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent" style="color: #e74c3c;">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="content-area">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}'
    });
</script>
@endif

</body>
</html>