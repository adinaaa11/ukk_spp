<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi SPP - Sistem Pembayaran SPP Digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --navy-primary: #001f3f;
            --navy-dark: #001529;
            --yellow-accent: #FFD700;
            --yellow-hover: #FFC000;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Particles */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 50%;
            animation: float 15s infinite;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 60px; height: 60px; top: 20%; left: 80%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 100px; height: 100px; top: 60%; left: 20%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 70px; height: 70px; top: 80%; left: 70%; animation-delay: 1s; }
        .particle:nth-child(5) { width: 50px; height: 50px; top: 40%; left: 50%; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            25% { transform: translateY(-50px) translateX(50px); }
            50% { transform: translateY(-100px) translateX(-50px); }
            75% { transform: translateY(-50px) translateX(50px); }
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 1400px;
            width: 100%;
            padding: 50px 20px;
        }

        /* Header dengan Logo */
        .header-section {
            text-align: center;
            margin-bottom: 60px;
            animation: fadeInDown 1s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            width: 120px;
            height: 120px;
            background: var(--yellow-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 20px 60px rgba(255, 215, 0, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo-container i {
            font-size: 60px;
            color: var(--navy-primary);
        }

        .header-section h1 {
            font-size: 56px;
            color: var(--yellow-accent);
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            font-weight: 700;
            letter-spacing: 2px;
        }

        .header-section p {
            font-size: 20px;
            color: white;
            opacity: 0.95;
        }

        .tagline {
            font-size: 16px;
            color: var(--yellow-accent);
            margin-top: 10px;
            font-style: italic;
        }

        /* Cards Container */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card Styling */
        .login-card {
            background: white;
            border-radius: 25px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 30px 90px rgba(0,0,0,0.4);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,0.1), transparent);
            transition: left 0.5s;
        }

        .login-card:hover::before {
            left: 100%;
        }

        .login-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
        }

        .card-icon-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
            transition: all 0.4s;
        }

        .login-card:hover .card-icon-wrapper {
            transform: rotateY(360deg);
        }

        .admin-card .card-icon-wrapper {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            box-shadow: 0 10px 30px rgba(0, 31, 63, 0.4);
        }

        .siswa-card .card-icon-wrapper {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
        }

        .card-icon-wrapper i {
            font-size: 50px;
        }

        .admin-card .card-icon-wrapper i {
            color: white;
        }

        .siswa-card .card-icon-wrapper i {
            color: var(--navy-primary);
        }

        .login-card h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .login-card p {
            color: #666;
            font-size: 17px;
            margin-bottom: 35px;
            line-height: 1.7;
        }

        .features-list {
            text-align: left;
            margin: 25px 0;
            padding: 0;
            list-style: none;
        }

        .features-list li {
            padding: 10px 0;
            color: #555;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .features-list li i {
            margin-right: 12px;
            font-size: 18px;
        }

        .admin-card .features-list li i {
            color: var(--navy-primary);
        }

        .siswa-card .features-list li i {
            color: var(--yellow-accent);
        }

        /* Button Styling */
        .btn-login {
            display: inline-block;
            padding: 18px 50px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 17px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-admin {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            box-shadow: 0 10px 30px rgba(0, 31, 63, 0.3);
        }

        .btn-admin:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 31, 63, 0.4);
        }

        .btn-siswa {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-primary);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }

        .btn-siswa:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
        }

        .btn-login i {
            margin-right: 10px;
            transition: transform 0.3s;
        }

        .btn-login:hover i {
            transform: translateX(5px);
        }

        /* Features Section */
        .features-section {
            background: white;
            padding: 80px 20px;
            text-align: center;
        }

        .features-section h2 {
            font-size: 42px;
            color: var(--navy-primary);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .features-section p {
            font-size: 18px;
            color: #666;
            margin-bottom: 60px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-box {
            padding: 40px 30px;
            border-radius: 20px;
            background: #f8f9fa;
            transition: all 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .feature-box i {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .feature-box:nth-child(1) i { color: var(--navy-primary); }
        .feature-box:nth-child(2) i { color: var(--yellow-accent); }
        .feature-box:nth-child(3) i { color: #27ae60; }
        .feature-box:nth-child(4) i { color: #e74c3c; }

        .feature-box h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-box p {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Footer */
        .footer {
            background: var(--navy-dark);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 36px;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .features-section h2 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <!-- Animated Particles -->
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="hero-content">
            <!-- Header -->
            <div class="header-section">
                <div class="logo-container">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1>APLIKASI SPP DIGITAL</h1>
                <p>Sistem Pembayaran SPP Modern & Terpercaya</p>
                <p class="tagline">Mudah, Cepat, dan Aman</p>
            </div>

            <!-- Login Cards -->
            <div class="cards-grid">
                <!-- Admin Card -->
                <div class="login-card admin-card">
                    <div class="card-icon-wrapper">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h2>Admin / Petugas</h2>
                    <p>Portal khusus untuk administrator dan petugas mengelola sistem pembayaran SPP</p>
                    
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Kelola Data Siswa</li>
                        <li><i class="fas fa-check-circle"></i> Proses Pembayaran</li>
                        <li><i class="fas fa-check-circle"></i> Laporan Lengkap</li>
                        <li><i class="fas fa-check-circle"></i> Monitoring Real-time</li>
                    </ul>

                    <a href="{{ route('login') }}" class="btn-login btn-admin">
                        <i class="fas fa-sign-in-alt"></i>
                        Login Admin
                    </a>
                </div>

                <!-- Siswa Card -->
                <div class="login-card siswa-card">
                    <div class="card-icon-wrapper">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h2>Siswa</h2>
                    <p>Portal khusus untuk siswa melihat riwayat dan melakukan pembayaran SPP</p>
                    
                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Cek Riwayat Pembayaran</li>
                        <li><i class="fas fa-check-circle"></i> Transfer Online</li>
                        <li><i class="fas fa-check-circle"></i> Cetak Bukti Bayar</li>
                        <li><i class="fas fa-check-circle"></i> Notifikasi Status</li>
                    </ul>

                    <a href="{{ route('login.siswa') }}" class="btn-login btn-siswa">
                        <i class="fas fa-sign-in-alt"></i>
                        Login Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <h2>Keunggulan Sistem Kami</h2>
        <p>Aplikasi SPP Digital dengan fitur terlengkap untuk kemudahan Anda</p>
        
        <div class="features-grid">
            <div class="feature-box">
                <i class="fas fa-shield-alt"></i>
                <h3>Keamanan Terjamin</h3>
                <p>Sistem keamanan berlapis dengan enkripsi data untuk melindungi informasi Anda</p>
            </div>
            
            <div class="feature-box">
                <i class="fas fa-bolt"></i>
                <h3>Proses Cepat</h3>
                <p>Pembayaran diproses secara real-time dan langsung tercatat dalam sistem</p>
            </div>
            
            <div class="feature-box">
                <i class="fas fa-mobile-alt"></i>
                <h3>Mobile Friendly</h3>
                <p>Akses dari mana saja menggunakan smartphone, tablet, atau komputer</p>
            </div>
            
            <div class="feature-box">
                <i class="fas fa-headset"></i>
                <h3>Dukungan 24/7</h3>
                <p>Tim support kami siap membantu Anda kapan saja jika ada kendala</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>APLIKASI SPP DIGITAL</strong></p>
        <p>&copy; {{ date('Y') }} SMK NEGERI 1 PURWOSARI. All Rights Reserved.</p>
        <p>Developed with <i class="fas fa-heart" style="color: var(--yellow-accent);"></i> 4ddnnn </p>
    </div>
</body>
</html>