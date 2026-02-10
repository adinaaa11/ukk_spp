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
            background: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat fixed;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 31, 63, 0.85);
            z-index: -1;
        }
        
        /* ═══════════════════════════════════════════════════════════
           NAVBAR (TANPA TOMBOL LOGIN)
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
            justify-content: center;
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

        /* ═══════════════════════════════════════════════════════════
           HERO SECTION
           ═══════════════════════════════════════════════════════════ */
        .hero-section {
            background: transparent;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 215, 0, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 215, 0, 0.12) 0%, transparent 50%);
            z-index: 2;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
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
            background: rgba(255, 215, 0, 0.2);
            border-radius: 50%;
            animation: float 25s infinite;
            filter: blur(2px);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
        }

        .particle:nth-child(1) { width: 150px; height: 150px; top: 5%; left: 5%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 100px; height: 100px; top: 15%; left: 85%; animation-delay: 4s; }
        .particle:nth-child(3) { width: 180px; height: 180px; top: 55%; left: 15%; animation-delay: 8s; }
        .particle:nth-child(4) { width: 120px; height: 120px; top: 75%; left: 75%; animation-delay: 3s; }
        .particle:nth-child(5) { width: 80px; height: 80px; top: 35%; left: 45%; animation-delay: 6s; }
        .particle:nth-child(6) { width: 110px; height: 110px; top: 25%; left: 65%; animation-delay: 9s; }
        .particle:nth-child(7) { width: 90px; height: 90px; top: 65%; left: 35%; animation-delay: 7s; }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0) translateX(0) rotate(0deg) scale(1);
                opacity: 0.2;
            }
            25% { 
                transform: translateY(-100px) translateX(80px) rotate(90deg) scale(1.1);
                opacity: 0.4;
            }
            50% { 
                transform: translateY(-200px) translateX(-60px) rotate(180deg) scale(0.9);
                opacity: 0.3;
            }
            75% { 
                transform: translateY(-80px) translateX(100px) rotate(270deg) scale(1.05);
                opacity: 0.5;
            }
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
            font-size: 72px;
            color: var(--yellow-accent);
            margin-bottom: 25px;
            font-weight: 900;
            text-shadow: 
                0 4px 20px rgba(0,0,0,0.4),
                0 0 40px rgba(255, 215, 0, 0.4),
                0 0 60px rgba(255, 215, 0, 0.2);
            animation: fadeInDown 1.2s ease-out, glow 3s ease-in-out infinite alternate;
            letter-spacing: 2px;
            position: relative;
        }

        @keyframes glow {
            from { text-shadow: 
                0 4px 20px rgba(0,0,0,0.4),
                0 0 40px rgba(255, 215, 0, 0.4),
                0 0 60px rgba(255, 215, 0, 0.2);
            }
            to { text-shadow: 
                0 4px 20px rgba(0,0,0,0.4),
                0 0 50px rgba(255, 215, 0, 0.6),
                0 0 80px rgba(255, 215, 0, 0.3);
            }
        }

        .hero-content h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--yellow-accent), transparent);
            animation: slideIn 1.5s ease-out 0.5s both;
        }

        @keyframes slideIn {
            from {
                width: 0;
                opacity: 0;
            }
            to {
                width: 100px;
                opacity: 1;
            }
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
            margin-bottom: 100px;
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
            padding: 22px 55px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 15px;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-hero::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-hero:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-admin {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 50%, #FFB300 100%);
            color: var(--navy-primary);
            box-shadow: 
                0 10px 30px rgba(255, 215, 0, 0.3),
                0 0 20px rgba(255, 215, 0, 0.1);
            border: 2px solid transparent;
        }

        .btn-admin:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 
                0 20px 40px rgba(255, 215, 0, 0.4),
                0 0 30px rgba(255, 215, 0, 0.2);
        }

        .btn-siswa {
            background: transparent;
            color: white;
            border: 3px solid var(--yellow-accent);
            position: relative;
        }

        .btn-siswa::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--yellow-accent);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: -1;
        }

        .btn-siswa:hover {
            color: var(--navy-primary);
            transform: translateY(-8px) scale(1.05);
            border-color: var(--yellow-hover);
        }

        .btn-siswa:hover::after {
            transform: scaleX(1);
        }

        /* ═══════════════════════════════════════════════════════════
           SOCIAL MEDIA (WARNA SESUAI TEMA)
           ═══════════════════════════════════════════════════════════ */
        .social-media {
            display: flex;
            gap: 20px;
            justify-content: center;
            animation: fadeInUp 1s ease-out 0.8s both;
        }

        .social-btn {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 30px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
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
            width: 120px;
            height: 120px;
        }

        .social-btn::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--yellow-accent), var(--yellow-hover), var(--yellow-accent));
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .social-btn:hover::after {
            opacity: 1;
        }

        /* WARNA SESUAI TEMA NAVY & YELLOW */
        .social-instagram {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            border: 2px solid var(--yellow-accent);
        }

        .social-facebook {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            border: 2px solid var(--yellow-accent);
        }

        .social-tiktok {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            color: var(--yellow-accent);
            border: 2px solid var(--yellow-accent);
        }

        .social-btn:hover {
            transform: translateY(-8px) scale(1.15) rotate(5deg);
            box-shadow: 
                0 15px 35px rgba(255, 215, 0, 0.4),
                0 0 25px rgba(255, 215, 0, 0.2);
            background: var(--yellow-accent) !important;
            color: var(--navy-primary) !important;
            border-color: var(--yellow-hover) !important;
        }

        .social-label {
            color: white;
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 16px;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 1s both;
        }

        /* ═══════════════════════════════════════════════════════════
           FEATURES SECTION
           ═══════════════════════════════════════════════════════════ */
        .features-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 50%, #ffffff 100%);
            padding: 120px 50px;
            text-align: center;
            position: relative;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--yellow-accent), transparent);
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
            border-radius: 25px;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 31, 63, 0.1);
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.1), transparent);
            transition: left 0.6s;
        }

        .feature-box:hover::before {
            left: 100%;
        }

        .feature-box:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 
                0 25px 50px rgba(0,0,0,0.15),
                0 0 30px rgba(255, 215, 0, 0.1);
            border-color: var(--yellow-accent);
        }

        .feature-box i {
            font-size: 70px;
            margin-bottom: 25px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-block;
        }

        .feature-box:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .feature-box:nth-child(1) i { color: var(--navy-primary); }
        .feature-box:nth-child(2) i { color: var(--yellow-accent); }
        .feature-box:nth-child(3) i { color: #3498db; }
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
            background: linear-gradient(135deg, var(--navy-dark) 0%, #0a2540 100%);
            color: white;
            padding: 50px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--yellow-accent), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .footer p {
            margin: 8px 0;
            opacity: 0.9;
        }

        /* ═══════════════════════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 48px;
            }

            .hero-content .subtitle {
                font-size: 18px;
            }

            .hero-content .tagline {
                font-size: 14px;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 15px;
                margin-bottom: 60px;
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
         NAVBAR (HANYA LOGO, TANPA TOMBOL)
         ═══════════════════════════════════════════════════════════ -->
    <div class="navbar">
        <div class="navbar-logo">
            <i class="fas fa-graduation-cap"></i>
            <div>
                <h2>SMKN 1 PURWOSARI</h2>
                <p>Aplikasi SPP Digital</p>
            </div>
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
                <i class="fas fa-desktop"></i>
                <h3>Desktop Optimized</h3>
                <p>Dirancang khusus untuk akses melalui laptop dan komputer dengan performa optimal</p>
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