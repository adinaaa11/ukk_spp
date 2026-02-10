<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Pembayaran SPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* ═══════════════════════════════════════════════════════════
           COLOR VARIABLES (NAVY & YELLOW THEME)
           ═══════════════════════════════════════════════════════════ */
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

        /* ═══════════════════════════════════════════════════════════
           BODY & BACKGROUND
           ═══════════════════════════════════════════════════════════ */
        body {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* ═══════════════════════════════════════════════════════════
           ANIMATED BACKGROUND PARTICLES (YELLOW)
           ═══════════════════════════════════════════════════════════ */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 50%;
            animation: float 15s infinite;
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0) translateX(0); 
            }
            25% { 
                transform: translateY(-50px) translateX(50px); 
            }
            50% { 
                transform: translateY(-100px) translateX(-50px); 
            }
            75% { 
                transform: translateY(-50px) translateX(50px); 
            }
        }

        /* Particle positions and sizes */
        .particle:nth-child(1) { 
            width: 100px; 
            height: 100px; 
            top: 10%; 
            left: 10%; 
            animation-delay: 0s; 
        }
        .particle:nth-child(2) { 
            width: 60px; 
            height: 60px; 
            top: 50%; 
            left: 80%; 
            animation-delay: 2s; 
        }
        .particle:nth-child(3) { 
            width: 80px; 
            height: 80px; 
            top: 70%; 
            left: 20%; 
            animation-delay: 4s; 
        }
        .particle:nth-child(4) { 
            width: 50px; 
            height: 50px; 
            top: 30%; 
            left: 70%; 
            animation-delay: 1s; 
        }
        .particle:nth-child(5) { 
            width: 70px; 
            height: 70px; 
            top: 60%; 
            left: 50%; 
            animation-delay: 3s; 
        }

        /* ═══════════════════════════════════════════════════════════
           LOGIN CONTAINER
           ═══════════════════════════════════════════════════════════ */
        .login-container {
            max-width: 450px;
            width: 100%;
            margin: 20px;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ═══════════════════════════════════════════════════════════
           LOGIN HEADER (NAVY BACKGROUND WITH YELLOW ACCENT)
           ═══════════════════════════════════════════════════════════ */
        .login-header {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        /* Decorative wave at bottom of header */
        .login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background: white;
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        .login-header .icon-box {
            width: 80px;
            height: 80px;
            background: var(--yellow-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { 
                transform: scale(1); 
            }
            50% { 
                transform: scale(1.05); 
            }
        }

        .login-header .icon-box i {
            font-size: 40px;
            color: var(--navy-primary);
        }

        .login-header h4 {
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--yellow-accent);
            letter-spacing: 1px;
        }

        .login-header p {
            color: white;
            opacity: 0.9;
            font-size: 15px;
        }

        /* ═══════════════════════════════════════════════════════════
           LOGIN BODY
           ═══════════════════════════════════════════════════════════ */
        .login-body {
            padding: 40px 30px;
        }

        /* ═══════════════════════════════════════════════════════════
           FORM CONTROLS
           ═══════════════════════════════════════════════════════════ */
        .form-floating {
            margin-bottom: 20px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            height: 56px;
            transition: all 0.3s;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: var(--yellow-accent);
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
            outline: none;
        }

        .form-floating label {
            padding: 1rem 15px;
            color: #666;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            opacity: 0.65;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }

        .form-check {
            margin-bottom: 25px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 0.2em;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--yellow-accent);
            border-color: var(--yellow-accent);
        }

        .form-check-input:focus {
            border-color: var(--yellow-accent);
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
        }

        .form-check-label {
            margin-left: 8px;
            cursor: pointer;
            user-select: none;
        }

        /* ═══════════════════════════════════════════════════════════
           LOGIN BUTTON (YELLOW WITH NAVY TEXT)
           ═══════════════════════════════════════════════════════════ */
        .btn-login {
            background: linear-gradient(135deg, var(--yellow-accent) 0%, var(--yellow-hover) 100%);
            border: none;
            color: var(--navy-primary);
            padding: 15px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(0, 31, 63, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* ═══════════════════════════════════════════════════════════
           ALERTS
           ═══════════════════════════════════════════════════════════ */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .alert-danger {
            background-color: #fee;
            color: #c33;
        }

        .alert-success {
            background-color: #efe;
            color: #3c3;
        }

        .alert i {
            margin-right: 8px;
        }

        .btn-close {
            padding: 0.5rem;
        }

        /* Invalid feedback */
        .invalid-feedback {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* ═══════════════════════════════════════════════════════════
           LINK TO ADMIN
           ═══════════════════════════════════════════════════════════ */
        .link-to-admin {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .link-to-admin p {
            color: #666;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .link-to-admin a {
            color: var(--navy-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            display: inline-block;
        }

        .link-to-admin a:hover {
            color: var(--yellow-hover);
            transform: translateX(5px);
        }

        .link-to-admin a i {
            margin-right: 8px;
        }

        /* ═══════════════════════════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════════════════════════ */
        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-body {
                padding: 30px 20px;
            }

            .login-header h4 {
                font-size: 24px;
            }

            .btn-login {
                padding: 12px;
                font-size: 14px;
            }

            .form-control {
                height: 52px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- ═══════════════════════════════════════════════════════════
         ANIMATED PARTICLES BACKGROUND
         ═══════════════════════════════════════════════════════════ -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
         LOGIN CARD
         ═══════════════════════════════════════════════════════════ -->
    <div class="login-container">
        <div class="login-card">
            <!-- HEADER -->
            <div class="login-header">
                <div class="icon-box">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4>PORTAL SISWA</h4>
                <p>Cek Pembayaran SPP Anda</p>
            </div>

            <!-- BODY -->
            <div class="login-body">
                <!-- ERROR MESSAGES -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- SUCCESS MESSAGES -->
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- LOGIN FORM -->
                <form method="POST" action="{{ url('/siswa/login') }}">
                    @csrf

                    <!-- NISN INPUT -->
                    <div class="form-floating mb-4">
                        <input 
                            type="text" 
                            class="form-control @error('nisn') is-invalid @enderror" 
                            id="nisn" 
                            name="nisn" 
                            placeholder="NISN"
                            value="{{ old('nisn') }}"
                            maxlength="10"
                            pattern="[0-9]{10}"
                            required 
                            autofocus
                        >
                        <label for="nisn">
                            <i class="fas fa-id-card me-2"></i>NISN (10 digit)
                        </label>
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PASSWORD INPUT -->
                    <div class="form-floating mb-4">
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Password"
                            required
                        >
                        <label for="password">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- REMEMBER ME CHECKBOX -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                </form>

                <!-- LINK TO ADMIN LOGIN -->
                <div class="link-to-admin">
                    <p class="text-muted mb-2">Login sebagai Admin/Petugas?</p>
                    <a href="{{ route('login') }}">
                        <i class="fas fa-user-shield"></i>Klik di sini
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
         JAVASCRIPT
         ═══════════════════════════════════════════════════════════ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validasi NISN - hanya angka yang diperbolehkan
        document.getElementById('nisn').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>