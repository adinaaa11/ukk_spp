<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Siswa - SPP SMKN 1 Purwosari')</title>
    
    <!-- Bootstrap 5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6.0.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: #f8f9fa;
        }
        
        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            color: #FFD700 !important;
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
        }
        
        .navbar-brand:hover {
            color: #FFC000 !important;
        }
        
        /* User Profile in Navbar */
        .user-profile-nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info-nav {
            text-align: right;
        }
        
        .user-name-nav {
            color: #FFD700;
            font-weight: 600;
            font-size: 0.95rem;
            margin: 0;
        }
        
        .user-nisn-nav {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75rem;
            margin: 0;
        }
        
        .user-avatar-nav {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FFD700 0%, #FFC000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .user-avatar-nav i {
            font-size: 22px;
            color: #001f3f;
        }
        
        /* LOGOUT BUTTON - NAVBAR VERSION */
        .logout-btn-nav {
            padding: 10px 24px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 12px rgba(220, 53, 69, 0.3);
            cursor: pointer;
            text-decoration: none;
        }
        
        .logout-btn-nav:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 18px rgba(220, 53, 69, 0.5);
            border-color: rgba(255, 255, 255, 0.4);
            color: white;
        }
        
        .logout-btn-nav:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.4);
        }
        
        .logout-btn-nav i {
            font-size: 1.1rem;
        }
        
        /* Alternative Logout Style (Gold Outlined) */
        .logout-btn-gold {
            background: transparent;
            border: 2px solid #FFD700;
            color: #FFD700;
            box-shadow: none;
        }
        
        .logout-btn-gold:hover {
            background: #FFD700;
            color: #001f3f;
            border-color: #FFD700;
            box-shadow: 0 3px 12px rgba(255, 215, 0, 0.3);
        }
        
        /* Main Content */
        .main-content {
            padding: 30px 0;
            min-height: calc(100vh - 80px);
        }
        
        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
            color: #FFD700;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
            color: rgba(255, 255, 255, 0.8);
            padding: 20px 0;
            margin-top: 50px;
        }
        
        .footer a {
            color: #FFD700;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: #FFC000;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .user-info-nav {
                display: none;
            }
            
            .logout-btn-nav {
                padding: 8px 16px;
                font-size: 0.85rem;
            }
            
            .logout-btn-nav span {
                display: none;
            }
        }
        
        /* Stats Card */
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }
        
        .stats-icon.primary {
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
            color: #FFD700;
        }
        
        .stats-icon.success {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
        }
        
        .stats-icon.warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: white;
        }
        
        .stats-icon.info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('siswa.dashboard') }}">
                <i class="fas fa-graduation-cap"></i>
                <span>SPP SMKN 1 Purwosari</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}" 
                           href="{{ route('siswa.dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link {{ request()->routeIs('siswa.history') ? 'active' : '' }}" 
                           href="{{ route('siswa.history') }}">
                            <i class="fas fa-history"></i> History
                        </a>
                    </li>
                    
                    <!-- User Profile -->
                    <li class="nav-item me-3">
                        <div class="user-profile-nav">
                            <div class="user-info-nav">
                                <p class="user-name-nav">{{ auth('siswa')->user()->nama ?? 'Siswa' }}</p>
                                <p class="user-nisn-nav">NISN: {{ auth('siswa')->user()->nisn ?? '-' }}</p>
                            </div>
                            <div class="user-avatar-nav">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </li>
                    
                    <!-- LOGOUT BUTTON -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('siswa.logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn-nav">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                        
                        <!-- Alternative: Gold Outlined Style (uncomment to use) -->
                        <!-- 
                        <form method="POST" action="{{ route('siswa.logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn-nav logout-btn-gold">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                        -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} <a href="#">SMKN 1 Purwosari</a>. 
                Sistem Pembayaran SPP.
            </p>
            <p class="mb-0 mt-1" style="font-size: 0.85rem;">
                <i class="fas fa-code"></i> Dibuat dengan 
                <i class="fas fa-heart" style="color: #dc3545;"></i>
            </p>
        </div>
    </footer>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Confirm logout
        document.getElementById('logout-form')?.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin keluar?')) {
                e.preventDefault();
            }
        });
        
        // Auto dismiss alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>