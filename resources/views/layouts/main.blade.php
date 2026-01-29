<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi SPP - UKK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* =====================================================
           VARIABLES & RESET
           ===================================================== */
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

        /* =====================================================
           SIDEBAR
           ===================================================== */
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

        /* STYLE UNTUK TOMBOL LOGOUT */
        .btn-logout {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            width: 100%;
            transition: all 0.3s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }

        .btn-logout:active {
            transform: translateY(0);
        }

        .content-area {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        /* =====================================================
           CARD STYLES
           ===================================================== */
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

        /* =====================================================
           BUTTON STYLES
           ===================================================== */
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
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 0.7rem;
        }

        .btn-warning-custom {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-dark);
            border: none;
            padding: 5px 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.7rem;
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

        /* =====================================================
           TABLE STYLES - DIPERKECIL MAKSIMAL
           ===================================================== */
        .table {
            font-size: 0.7rem !important;
            margin-bottom: 0;
        }

        .table thead th {
            padding: 6px 4px !important;
            font-size: 0.7rem !important;
            font-weight: 600;
            white-space: nowrap;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 5px 4px !important;
            font-size: 0.7rem !important;
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

        /* =====================================================
           BADGE STYLES - DIPERKECIL
           ===================================================== */
        .badge {
            padding: 2px 6px !important;
            font-size: 0.65rem !important;
            border-radius: 8px;
            font-weight: 500;
        }

        .badge-custom {
            padding: 2px 6px !important;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.65rem !important;
            white-space: nowrap;
        }

        /* =====================================================
           BUTTON IN TABLE - DIPERKECIL
           ===================================================== */
        .table .btn-sm {
            padding: 3px 6px !important;
            font-size: 0.65rem !important;
        }

        .table .btn-sm i {
            font-size: 0.65rem;
        }

        /* =====================================================
           ICON SIZES - DIPERKECIL
           ===================================================== */
        .table i {
            font-size: 0.7rem !important;
        }

        .card-header-custom i,
        .btn i {
            font-size: 0.85rem;
        }

        .sidebar .nav-link i {
            font-size: 0.9rem;
            margin-right: 10px;
        }

        /* =====================================================
           SMALL TEXT
           ===================================================== */
        .table small,
        small {
            font-size: 0.6rem !important;
        }

        /* =====================================================
           PAGINATION - ULTRA COMPACT
           ===================================================== */
        .pagination {
            margin: 0;
            font-size: 0.65rem !important;
            gap: 2px;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            color: var(--navy-primary);
            border: 1px solid #dee2e6;
            padding: 0.2rem 0.4rem !important;
            font-size: 0.65rem !important;
            line-height: 1;
            min-width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--navy-primary);
            border-color: var(--navy-primary);
            color: var(--yellow-accent);
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 31, 63, 0.2);
        }

        .pagination .page-link:hover {
            color: white;
            background-color: var(--navy-light);
            border-color: var(--navy-light);
            transform: translateY(-1px);
            transition: all 0.2s;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            cursor: not-allowed;
        }

        .pagination .page-link[rel="prev"],
        .pagination .page-link[rel="next"] {
            font-weight: 600;
            min-width: auto;
            padding: 0.2rem 0.5rem !important;
        }

        /* =====================================================
           SECTION TITLES
           ===================================================== */
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

        /* =====================================================
           FORM CONTROLS
           ===================================================== */
        .form-control:focus, .form-select:focus {
            border-color: var(--yellow-accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
        }

        .form-control, .form-select {
            padding: 8px 12px;
            font-size: 0.85rem;
        }

        /* =====================================================
           TABLE RESPONSIVE
           ===================================================== */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            max-width: 100%;
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

        /* =====================================================
           CARD BODY & FOOTER
           ===================================================== */
        .card-body {
            padding: 15px;
        }

        .card-footer {
            padding: 0.5rem 1rem !important;
            background-color: #f8f9fa;
        }

        /* =====================================================
           TABLE COLUMN WIDTH OPTIMIZATION
           ===================================================== */
        .table th[width],
        .table td[width] {
            max-width: none;
        }

        .table th:first-child,
        .table td:first-child {
            width: 40px;
            min-width: 40px;
            max-width: 40px;
            text-align: center;
        }

        .table th:last-child,
        .table td:last-child {
            width: auto;
            min-width: 100px;
            text-align: center;
        }

        /* =====================================================
           RESPONSIVE STYLES
           ===================================================== */
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
                font-size: 0.65rem !important;
            }

            .table thead th {
                padding: 4px 2px !important;
                font-size: 0.6rem !important;
            }

            .table tbody td {
                padding: 4px 2px !important;
                font-size: 0.65rem !important;
            }

            .badge,
            .badge-custom {
                padding: 1px 4px !important;
                font-size: 0.6rem !important;
            }

            .table .btn-sm {
                padding: 2px 4px !important;
                font-size: 0.6rem !important;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .pagination {
                font-size: 0.6rem !important;
            }
            
            .pagination .page-link {
                padding: 0.15rem 0.3rem !important;
                font-size: 0.6rem !important;
                min-width: 22px;
                height: 22px;
            }
        }

        /* =====================================================
           ADDITIONAL UTILITIES
           ===================================================== */
        .text-navy {
            color: var(--navy-primary);
        }

        .bg-navy {
            background-color: var(--navy-primary);
        }

        .text-yellow {
            color: var(--yellow-accent);
        }

        .bg-yellow {
            background-color: var(--yellow-accent);
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

            <!-- ═══════════════════════════════════════════════════════════
                 USER INFO SECTION (DENGAN TOMBOL LOGOUT)
                 ═══════════════════════════════════════════════════════════ -->
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nama_petugas, 0, 1)) }}
                </div>
                <div class="fw-bold">{{ auth()->user()->nama_petugas }}</div>
                <small class="badge" style="background: var(--yellow-accent); color: var(--navy-dark);">
                    {{ strtoupper(auth()->user()->level) }}
                </small>
                
                <!-- TOMBOL LOGOUT BARU -->
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

            <!-- NAVIGATION MENU -->
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