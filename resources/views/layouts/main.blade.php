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
            --primary: #2c3e50;
            --primary-dark: #1a252f;
            --secondary: #3498db;
            --accent: #e74c3c;
            --success: #27ae60;
            --warning: #f39c12;
            --light: #ecf0f1;
            --text-light: #f8f9fa;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
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
            background-color: rgba(255,255,255,0.1);
            color: white;
            padding-left: 25px;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, var(--secondary) 0%, #2980b9 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .sidebar-brand {
            padding: 25px 20px;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
        }

        .sidebar-brand i {
            color: var(--secondary);
            font-size: 2rem;
        }

        .user-info {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 24px;
            color: white;
        }

        .content-area {
            margin-left: 260px;
            padding: 30px;
        }

        /* Card Styling */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
            border: none;
        }

        /* Button Styling */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-success-custom {
            background: var(--success);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
        }

        .btn-danger-custom {
            background: var(--accent);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
        }

        .btn-warning-custom {
            background: var(--warning);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
        }

        /* Table Styling */
        .table-custom {
            border-radius: 10px;
            overflow: hidden;
        }

        .table-custom thead {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }

        .table-custom tbody tr {
            transition: background 0.3s;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        /* Badge Custom */
        .badge-custom {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        /* Alert Custom */
        .alert-custom {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .section-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .section-subtitle {
            color: #7f8c8d;
            font-size: 14px;
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
                    <i class="fas fa-user"></i>
                </div>
                <div class="fw-bold">{{ auth()->user()->nama_petugas }}</div>
                <small class="badge" style="background: var(--secondary);">{{ strtoupper(auth()->user()->level) }}</small>
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
                    <a class="nav-link" href="{{ route('laporan.pembayaran') }}" target="_blank">
                        <i class="fas fa-file-pdf me-2"></i> Cetak Laporan
                    </a>
                </li>
                @endif
                
                <li class="nav-item mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent text-danger">
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