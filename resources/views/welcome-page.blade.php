<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 1 Purwosari - Aplikasi SPP Digital</title>
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
            background: var(--navy-dark);
        }

        /* ═══════════════════════════════════════════════════════════
           NAVBAR
           ═══════════════════════════════════════════════════════════ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 31, 63, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }

        .navbar-logo i {
            font-size: 40px;
            color: var(--yellow-accent);
        }

        .navbar-logo h2 {
            font-size: 24px;
            font-weight: 700;
        }

        .navbar-logo p {
            font-size: 12px;
            opacity: 0.8;
            margin: 0;
        }

        .navbar-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-nav {
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s;
            display: inline-block;
        }

        .btn-admin-nav {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-primary);
            border: 2px solid transparent;
        }

        .btn-admin-nav:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
        }

        .btn-siswa-nav {
            background: transparent;
            color: white;
            border: 2px solid var(--yellow-accent);
        }

        .btn-siswa-nav:hover {
            background: var(--yellow-accent);
            color: var(--navy-primary);
            transform: translateY(-3px);
        }

        /* ═══════════════════════════════════════════════════════════
           HERO SECTION
           ═══════════════════════════════════════════════════════════ */
        .hero-section {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

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
            text-align: center;
        }

        .hero-content h1 {
            font-size: 64px;
            color: var(--yellow-accent);
            margin-bottom: 20px;
            font-weight: 800;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: fadeInDown 1s ease-out;
        }

        .hero-content .subtitle {
            font-size: 28px;
            color: white;
            margin-bottom: 15px;
            animation: fadeInDown 1s ease-out 0.2s both;
        }

        .hero-content .tagline {
            font-size: 20px;
            color: var(--yellow-accent);
            margin-bottom: 50px;
            font-style: italic;
            animation: fadeInDown 1s ease-out 0.4s both;
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

        .hero-buttons {
            display: flex;
            gap: 30px;
            justify-content: center;
            margin-bottom: 60px;
            animation: fadeInUp 1s ease-out 0.6s both;
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

        .btn-hero {
            padding: 20px 50px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .btn-admin {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            color: var(--navy-primary);
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }

        .btn-admin:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(255, 215, 0, 0.5);
        }

        .btn-siswa {
            background: transparent;
            color: white;
            border: 3px solid var(--yellow-accent);
        }

        .btn-siswa:hover {
            background: var(--yellow-accent);
            color: var(--navy-primary);
            transform: translateY(-5px);
        }

        /* ═══════════════════════════════════════════════════════════
           SOCIAL MEDIA
           ═══════════════════════════════════════════════════════════ */
        .social-media {
            display: flex;
            gap: 20px;
            justify-content: center;
            animation: fadeInUp 1s ease-out 0.8s both;
        }

        .social-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 28px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
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
        }

        .social-btn:hover::before {
            width: 100px;
            height: 100px;
        }

        .social-instagram {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: white;
        }

        .social-facebook {
            background: #1877F2;
            color: white;
        }

        .social-tiktok {
            background: linear-gradient(180deg, #00f2ea 0%, #ff0050 100%);
            color: white;
        }

        .social-btn:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .social-label {
            color: white;
            margin-top: 80px;
            font-size: 16px;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 1s both;
        }

        /* ═══════════════════════════════════════════════════════════
           FEATURES SECTION
           ═══════════════════════════════════════════════════════════ */
        .features-section {
            background: white;
            padding: 100px 50px;
            text-align: center;
        }

        .features-section h2 {
            font-size: 48px;
            color: var(--navy-primary);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .features-section .subtitle {
            font-size: 20px;
            color: #666;
            margin-bottom: 80px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-box {
            padding: 50px 30px;
            border-radius: 20px;
            background: #f8f9fa;
            transition: all 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .feature-box i {
            font-size: 60px;
            margin-bottom: 25px;
        }

        .feature-box:nth-child(1) i { color: var(--navy-primary); }
        .feature-box:nth-child(2) i { color: var(--yellow-accent); }
        .feature-box:nth-child(3) i { color: #27ae60; }
        .feature-box:nth-child(4) i { color: #e74c3c; }

        .feature-box h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-box p {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
        }

        /* ═══════════════════════════════════════════════════════════
           FOOTER
           ═══════════════════════════════════════════════════════════ */
        .footer {
            background: var(--navy-dark);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .footer p {
            margin: 8px 0;
            opacity: 0.9;
        }

        /* ═══════════════════════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .navbar-logo h2 {
                font-size: 20px;
            }

            .navbar-buttons {
                width: 100%;
                justify-content: center;
            }

            .btn-nav {
                padding: 10px 20px;
                font-size: 13px;
            }

            .hero-content h1 {
                font-size: 36px;
            }

            .hero-content .subtitle {
                font-size: 20px;
            }

            .hero-content .tagline {
                font-size: 16px;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .btn-hero {
                padding: 15px 35px;
                font-size: 16px;
            }

            .features-section h2 {
                font-size: 32px;
            }

            .features-section {
                padding: 60px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- ═══════════════════════════════════════════════════════════
         NAVBAR
         ═══════════════════════════════════════════════════════════ -->
    <div class="navbar">
        <div class="navbar-logo">
            <i class="fas fa-graduation-cap"></i>
            <div>
                <h2>SMKN 1 PURWOSARI</h2>
                <p>Aplikasi SPP Digital</p>
            </div>
        </div>
        <div class="navbar-buttons">
            <a href="{{ route('login') }}" class="btn-nav btn-admin-nav">
                <i class="fas fa-user-shield"></i> Login Admin
            </a>
            <a href="{{ route('login.siswa') }}" class="btn-nav btn-siswa-nav">
                <i class="fas fa-user-graduate"></i> Login Siswa
            </a>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
         HERO SECTION
         ═══════════════════════════════════════════════════════════ -->
    <div class="hero-section">
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="hero-content">
            <h1>APLIKASI SPP DIGITAL</h1>
            <p class="subtitle">SMKN 1 PURWOSARI</p>
            <p class="tagline">Sistem Pembayaran Modern, Mudah, Cepat & Aman</p>

            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn-hero btn-admin">
                    <i class="fas fa-user-shield"></i>
                    Login Admin / Petugas
                </a>
                <a href="{{ route('login.siswa') }}" class="btn-hero btn-siswa">
                    <i class="fas fa-user-graduate"></i>
                    Login Siswa
                </a>
            </div>

            <p class="social-label">Ikuti Kami di Social Media</p>
            <div class="social-media">
                <a href="https://www.instagram.com/smkn1purwosari/" target="_blank" class="social-btn social-instagram" title="Instagram SMKN 1 Purwosari">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://web.facebook.com/smkn1pur" target="_blank" class="social-btn social-facebook" title="Facebook SMKN 1 Purwosari">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.tiktok.com/@smkn1purwosari" target="_blank" class="social-btn social-tiktok" title="TikTok SMKN 1 Purwosari">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
         FEATURES SECTION
         ═══════════════════════════════════════════════════════════ -->
    <div class="features-section">
        <h2>Keunggulan Sistem Kami</h2>
        <p class="subtitle">Aplikasi SPP Digital dengan fitur terlengkap</p>
        
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

    <!-- ═══════════════════════════════════════════════════════════
         FOOTER
         ═══════════════════════════════════════════════════════════ -->
    <div class="footer">
        <p><strong>SMKN 1 PURWOSARI - APLIKASI SPP DIGITAL</strong></p>
        <p>Jl. Raya Purwosari No. 1, Pasuruan, Jawa Timur</p>
        <p>&copy; {{ date('Y') }} SMKN 1 Purwosari. All Rights Reserved.</p>
        <p>Developed with <i class="fas fa-heart" style="color: var(--yellow-accent);"></i> by 4ddnnn</p>
    </div>
</body>
</html>