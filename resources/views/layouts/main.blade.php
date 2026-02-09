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
            --navy: #001f3f;
            --navy-dark: #001529;
            --yellow: #FFD700;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, var(--navy), var(--navy-dark));
            color: white;
            display: flex;
            flex-direction: column;
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
            padding: 22px;
            text-align: center;
            border-bottom: 1px solid rgba(255,215,0,.2);
            flex-shrink: 0;
        }

        .sidebar-brand i {
            color: var(--yellow);
            font-size: 2rem;
        }

        .user-info {
            padding: 18px;
            text-align: center;
            border-bottom: 1px solid rgba(255,215,0,.15);
            flex-shrink: 0;
        }

        .user-avatar {
            width: 55px;
            height: 55px;
            background: var(--yellow);
            color: var(--navy-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 8px;
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
            color: rgba(255,255,255,.8);
            padding: 12px 20px;
            border-radius: 0 20px 20px 0;
            transition: .25s;
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: .9rem;
        }

        .nav-link:hover {
            background: rgba(255,215,0,.15);
            color: var(--yellow);
            padding-left: 26px;
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--yellow), #ffcc00);
            color: var(--navy-dark);
            font-weight: 600;
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
            border: 1px solid rgba(255,215,0,.4);
            background: transparent;
            color: rgba(255,255,255,.8);
            padding: 10px 14px;
            border-radius: 12px;
            width: 100%;
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: .85rem;
            transition: .25s;
        }

        .btn-logout i {
            color: var(--yellow);
        }

        .btn-logout:hover {
            background: rgba(255,215,0,.15);
            color: var(--yellow);
            transform: translateX(4px);
        }

        .content-area {
            margin-left: 260px;
            padding: 20px;
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
                <a href="{{ route('pembayaran.create') }}" class="nav-link {{ Request::is('entri-pembayaran*')?'active':'' }}">
                    <i class="fas fa-cash-register"></i> Entri Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Request::is('history-pembayaran*')?'active':'' }}">
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
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-logout">
                <i class="fas fa-arrow-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</div>

<div class="content-area">
    @yield('content')
</div>

</body>
</html>