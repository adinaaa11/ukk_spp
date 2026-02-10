<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Siswa')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
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

        body {
            background: linear-gradient(135deg, var(--navy-primary) 0%, var(--navy-dark) 50%, var(--navy-light) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 215, 0, 0.08) 0%, transparent 50%);
            z-index: 1;
            pointer-events: none;
        }

        .container-dashboard {
            max-width: 1200px;
            margin: auto;
            padding: 30px 15px;
            position: relative;
            z-index: 2;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
        }

        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 5px solid var(--yellow-accent);
            box-shadow: 0 8px 25px rgba(255,215,0,0.3);
            transition: all 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 35px rgba(255,215,0,0.4);
        }

        .badge-yellow {
            background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
            color: var(--navy-primary);
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
            box-shadow: 0 4px 12px rgba(255,215,0,0.3);
            transition: all 0.3s ease;
        }

        .badge-yellow:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,215,0,0.4);
        }

        .stat-card {
            text-align: center;
            padding: 30px;
            border-radius: 20px;
            background: linear-gradient(145deg, rgba(255,255,255,0.9), rgba(255,255,255,0.95));
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255,215,0,0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--yellow-accent), var(--yellow-hover));
        }

        .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-xl);
            background: linear-gradient(145deg, rgba(255,255,255,0.95), rgba(255,255,255,1));
        }

        .stat-icon {
            font-size: 42px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .stat-card h4 {
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 2rem;
        }

        .stat-card .text-muted {
            font-size: 0.95rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
            color: var(--yellow-accent);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,31,63,0.3);
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, var(--navy-dark), var(--navy-light));
            color: var(--yellow-light);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0,31,63,0.4);
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            padding: 10px 25px;
            border-radius: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(220,53,69,0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220,53,69,0.4);
        }

        /* Table Styles */
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            background: white;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 15px 12px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 215, 0, 0.05);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 12px;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        .badge {
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>

<div class="container-dashboard">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
