<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi SPP - Sistem Pembayaran SPP Digital</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            width: 100%;
        }
        
        .header {
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        
        .header-icon {
            width: 100px;
            height: 100px;
            background: #FFD700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        }
        
        .header-icon svg {
            width: 60px;
            height: 60px;
            fill: #001f3f;
        }
        
        .header h1 {
            font-size: 48px;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            color: #FFD700;
        }
        
        .header p {
            font-size: 18px;
            opacity: 0.9;
        }
        
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
        
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        }
        
        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .card-icon svg {
            width: 50px;
            height: 50px;
            fill: white;
        }
        
        .card.admin .card-icon {
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
        }
        
        .card.siswa .card-icon {
            background: linear-gradient(135deg, #FFD700 0%, #FFC000 100%);
        }
        
        .card h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 15px;
        }
        
        .card p {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .btn {
            display: inline-block;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .btn-admin {
            background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
        }
        
        .btn-siswa {
            background: linear-gradient(135deg, #FFD700 0%, #FFC000 100%);
            color: #001f3f;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
                </svg>
            </div>
            <h1>APLIKASI SPP</h1>
            <p>Sistem Pembayaran SPP Digital</p>
        </div>

        <div class="cards-container">
            <!-- Card Admin -->
            <div class="card admin">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        <path d="M18 8h2v2h-2v2h-2v-2h-2V8h2V6h2v2z"/>
                    </svg>
                </div>
                <h2>Admin / Petugas</h2>
                <p>Login untuk mengelola data siswa, pembayaran, dan laporan</p>
                <a href="{{ route('login') }}" class="btn btn-admin">
                    <svg style="width:20px;height:20px;display:inline;margin-right:8px;vertical-align:middle;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                        <path d="M10 17v-3H3v-4h7V7l5 5-5 5m0-15a2 2 0 012 2v3h-2V4H4v16h6v-3h2v3a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h6z"/>
                    </svg>
                    LOGIN ADMIN
                </a>
            </div>

            <!-- Card Siswa -->
            <div class="card siswa">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
                    </svg>
                </div>
                <h2>Siswa</h2>
                <p>Login untuk melihat riwayat pembayaran SPP Anda</p>
                <a href="{{ route('login.siswa') }}" class="btn btn-siswa">
                    <svg style="width:20px;height:20px;display:inline;margin-right:8px;vertical-align:middle;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#001f3f">
                        <path d="M10 17v-3H3v-4h7V7l5 5-5 5m0-15a2 2 0 012 2v3h-2V4H4v16h6v-3h2v3a2 2 0 01-2 2H4a2 2 0 01-2-2V4a2 2 0 012-2h6z"/>
                    </svg>
                    LOGIN SISWA
                </a>
            </div>
        </div>
    </div>
</body>
</html>