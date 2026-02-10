<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP SPP - UKK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, var(--navy-primary) 0%, var(--navy-dark) 50%, #0a2540 100%);
            color: white;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-xl);
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--yellow-accent), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.8; }
        }

        /* SCROLLBAR SIDEBAR */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(0,0,0,.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,215,0,.3);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,215,0,.5);
        }

        .sidebar-brand {
            padding: 28px 22px;
            text-align: center;
            border-bottom: 1px solid rgba(255,215,0,.2);
            flex-shrink: 0;
            background: rgba(255,215,0,0.05);
            backdrop-filter: blur(10px);
        }

        .sidebar-brand i {
            color: var(--yellow-accent);
            font-size: 2.5rem;
            margin-bottom: 8px;
            text-shadow: 0 0 20px rgba(255,215,0,0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .sidebar-brand div {
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .user-info {
            padding: 22px 18px;
            text-align: center;
            border-bottom: 1px solid rgba(255,215,0,.15);
            flex-shrink: 0;
            background: rgba(255,255,255,0.02);
        }

        .user-avatar {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
            color: var(--navy-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin: 0 auto 12px;
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(255,215,0,0.3);
            border: 3px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 6px 20px rgba(255,215,0,0.4);
        }

        .user-info .fw-bold {
            font-size: 1rem;
            margin-bottom: 4px;
            color: white;
        }

        .badge {
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* MENU CONTAINER - AREA YANG SCROLLABLE */
        .menu-container {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 10px;
        }

        .menu-container::-webkit-scrollbar {
            width: 6px;
        }

        .menu-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .menu-container::-webkit-scrollbar-thumb {
            background: rgba(255,215,0,.3);
            border-radius: 10px;
        }

        .menu-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255,215,0,.5);
        }

        .nav-link {
            color: rgba(255,255,255,.85);
            padding: 14px 24px;
            border-radius: 0 25px 25px 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            gap: 14px;
            align-items: center;
            font-size: 0.95rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            margin: 2px 0;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
            transition: width 0.3s ease;
            opacity: 0.1;
        }

        .nav-link:hover {
            background: rgba(255,215,0,.15);
            color: var(--yellow-accent);
            padding-left: 30px;
            transform: translateX(5px);
        }

        .nav-link:hover::before {
            width: 4px;
        }

        .nav-link i {
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
            color: var(--navy-primary);
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(255,215,0,0.3);
            transform: translateX(5px);
        }

        .menu-title {
            font-size: .7rem;
            letter-spacing: 1px;
            color: rgba(255,255,255,.5);
            margin: 15px 20px 6px;
        }

        /* LOGOUT BUTTON - TETAP DI BAWAH */
        .logout-container {
            flex-shrink: 0;
            padding: 12px;
            border-top: 1px solid rgba(255,215,0,.15);
        }

        .btn-logout {
            border: 2px solid rgba(255,215,0,.4);
            background: transparent;
            color: rgba(255,255,255,.9);
            padding: 12px 16px;
            border-radius: 15px;
            width: 100%;
            display: flex;
            gap: 12px;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-logout::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-logout:hover::before {
            left: 100%;
        }

        .btn-logout i {
            color: var(--yellow-accent);
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255,215,0,.15);
            color: var(--yellow-accent);
            transform: translateX(6px) scale(1.02);
            border-color: var(--yellow-accent);
            box-shadow: 0 4px 15px rgba(255,215,0,0.2);
        }

        .btn-logout:hover i {
            transform: rotate(-10deg);
        }

        .content-area {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        /* ALERT STYLES */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            font-weight: 500;
            box-shadow: var(--shadow-md);
            animation: slideInDown 0.5s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert i {
            font-size: 1.1rem;
            margin-right: 8px;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .btn-close:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="sidebar">

    <!-- BRAND - TETAP DI ATAS -->
    <div class="sidebar-brand">
        <i class="fas fa-graduation-cap"></i>
        <div>APP SPP</div>
    </div>

    <!-- USER INFO - TETAP DI ATAS -->
    <div class="user-info">
        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->nama_petugas,0,1)) }}
        </div>
        <div class="fw-bold">{{ auth()->user()->nama_petugas }}</div>
        <span class="badge bg-warning text-dark mt-1">
            {{ strtoupper(auth()->user()->level) }}
        </span>
    </div>

    <!-- MENU - AREA YANG BISA DI-SCROLL -->
    <div class="menu-container">
        <ul class="nav flex-column mt-2">

            {{-- ================= ADMIN ================= --}}
            @if(auth()->user()->level === 'admin')

                <li class="menu-title">DASHBOARD</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard')?'active':'' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <li class="menu-title">DATA MASTER</li>
                <li class="nav-item">
                    <a href="{{ route('siswa.index') }}" class="nav-link {{ Request::is('siswa*')?'active':'' }}">
                        <i class="fas fa-user-graduate"></i> Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelas.index') }}" class="nav-link {{ Request::is('kelas*')?'active':'' }}">
                        <i class="fas fa-school"></i> Data Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('spp.index') }}" class="nav-link {{ Request::is('spp*')?'active':'' }}">
                        <i class="fas fa-money-check-alt"></i> Data SPP
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.index') }}" class="nav-link {{ Request::is('petugas*')?'active':'' }}">
                        <i class="fas fa-user-shield"></i> Data Petugas
                    </a>
                </li>

            @endif

            {{-- ================= TRANSAKSI (ADMIN + PETUGAS) ================= --}}
            <li class="menu-title">TRANSAKSI</li>
            <li class="nav-item">
                <a href="{{ route('pembayaran.create') }}" class="nav-link {{ Request::is('pembayaran/create')?'active':'' }}">
                    <i class="fas fa-cash-register"></i> Entri Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Request::is('pembayaran') || Request::is('pembayaran/*') && !Request::is('pembayaran/create')?'active':'' }}">
                    <i class="fas fa-history"></i> History Pembayaran
                </a>
            </li>

            {{-- ================= LAPORAN (ADMIN SAJA) ================= --}}
            @if(auth()->user()->level === 'admin')
                <li class="menu-title">LAPORAN</li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link {{ Request::is('laporan*')?'active':'' }}">
                        <i class="fas fa-file-excel"></i> Laporan
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <!-- LOGOUT - TETAP DI BAWAH -->
    <div class="logout-container">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="submit" class="btn-logout" onclick="return confirm('Yakin ingin logout?')">
                <i class="fas fa-arrow-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</div>

<div class="content-area">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Auto dismiss alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>

</body>
</html>