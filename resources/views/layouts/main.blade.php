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
            --navy-dark: #001226;
            --yellow-accent: #FFD700;
            --yellow-hover: #e6c200;
            --text-light: #f8f9fa;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: var(--navy-primary);
            min-height: 100vh;
            color: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin-bottom: 5px;
            border-radius: 0 25px 25px 0;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--yellow-accent);
            color: var(--navy-primary);
            font-weight: bold;
        }

        .sidebar-brand {
            padding: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--yellow-accent);
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* Card Styling */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        
        .card-header-navy {
            background-color: var(--navy-primary);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }

        /* Button Styling */
        .btn-navy {
            background-color: var(--navy-primary);
            color: var(--yellow-accent);
            border: 1px solid var(--navy-primary);
        }
        
        .btn-navy:hover {
            background-color: var(--navy-dark);
            color: #fff;
        }

        .btn-yellow {
            background-color: var(--yellow-accent);
            color: var(--navy-primary);
            font-weight: bold;
        }

        .btn-yellow:hover {
            background-color: var(--yellow-hover);
        }

    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar px-0">
            <div class="sidebar-brand">
                <i class="fas fa-school me-2"></i> APP SPP
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                @if(auth()->user()->level == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-database me-2"></i> Data Siswa
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('entri-pembayaran*') ? 'active' : '' }}" href="{{ route('pembayaran.create') }}">
                        <i class="fas fa-money-bill-wave me-2"></i> Entri Pembayaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('history-pembayaran') ? 'active' : '' }}" href="{{ route('pembayaran.index') }}">
                        <i class="fas fa-history me-2"></i> History
                    </a>
                </li>
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

        <div class="col-md-9 col-lg-10 py-4 px-4">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>