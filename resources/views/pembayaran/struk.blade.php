<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran SPP - {{ $pembayaran->siswa->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .kwitansi-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 0;
            box-shadow: 0 10px 50px rgba(0,0,0,0.3);
            border: 3px solid #001f3f;
            position: relative;
        }
        
        /* Ornamen Sudut */
        .corner-ornament {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid #FFD700;
        }
        
        .corner-ornament.top-left {
            top: 10px;
            left: 10px;
            border-right: none;
            border-bottom: none;
        }
        
        .corner-ornament.top-right {
            top: 10px;
            right: 10px;
            border-left: none;
            border-bottom: none;
        }
        
        .corner-ornament.bottom-left {
            bottom: 10px;
            left: 10px;
            border-right: none;
            border-top: none;
        }
        
        .corner-ornament.bottom-right {
            bottom: 10px;
            right: 10px;
            border-left: none;
            border-top: none;
        }
        
        /* Header Kwitansi */
        .header-kwitansi {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            padding: 30px 40px;
            text-align: center;
            color: white;
            border-bottom: 5px solid #FFD700;
        }
        
        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
        .logo-circle {
            width: 80px;
            height: 80px;
            background: #FFD700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            border: 3px solid white;
        }
        
        .logo-circle i {
            font-size: 40px;
            color: #001f3f;
        }
        
        .school-info h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .school-info p {
            font-size: 14px;
            margin: 3px 0;
            opacity: 0.95;
        }
        
        .document-title {
            background: #FFD700;
            color: #001f3f;
            padding: 15px;
            margin: 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 3px;
            border-bottom: 3px double #001f3f;
        }
        
        /* Body Kwitansi */
        .kwitansi-body {
            padding: 40px 50px;
        }
        
        .nomor-kwitansi {
            text-align: right;
            font-size: 14px;
            margin-bottom: 30px;
            color: #666;
            font-style: italic;
        }
        
        .info-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        
        .info-table tr {
            border-bottom: 1px solid #eee;
        }
        
        .info-table td {
            padding: 12px 0;
            font-size: 16px;
        }
        
        .info-table td:first-child {
            width: 180px;
            font-weight: 600;
            color: #333;
        }
        
        .info-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }
        
        .info-table td:last-child {
            color: #555;
        }
        
        .payment-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #001f3f;
            padding: 25px;
            margin: 30px 0;
            border-radius: 10px;
            position: relative;
        }
        
        .payment-box::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border: 2px solid #FFD700;
            border-radius: 10px;
            z-index: -1;
        }
        
        .payment-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .payment-amount {
            font-size: 32px;
            font-weight: bold;
            color: #001f3f;
            margin-bottom: 10px;
        }
        
        .payment-terbilang {
            font-size: 14px;
            font-style: italic;
            color: #555;
            padding: 10px;
            background: white;
            border-left: 4px solid #FFD700;
            margin-top: 15px;
        }
        
        /* Signature Area */
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #eee;
        }
        
        .signature-box {
            text-align: center;
            width: 45%;
        }
        
        .signature-date {
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
        }
        
        .signature-role {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 60px;
            color: #001f3f;
        }
        
        .signature-name {
            border-top: 2px solid #001f3f;
            padding-top: 10px;
            font-weight: 600;
            display: inline-block;
            min-width: 200px;
        }
        
        /* Footer */
        .kwitansi-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 3px double #001f3f;
            font-size: 12px;
            color: #666;
        }
        
        .kwitansi-footer p {
            margin: 5px 0;
        }
        
        .official-stamp {
            position: absolute;
            right: 80px;
            bottom: 150px;
            width: 120px;
            height: 120px;
            border: 3px solid rgba(231, 76, 60, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-15deg);
            background: rgba(231, 76, 60, 0.05);
        }
        
        .official-stamp span {
            color: rgba(231, 76, 60, 0.5);
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            line-height: 1.2;
        }
        
        /* Print Buttons */
        .print-buttons {
            text-align: center;
            margin: 30px 0;
        }
        
        .btn {
            padding: 15px 40px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Segoe UI', sans-serif;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .btn-print {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            color: #FFD700;
        }
        
        .btn-print:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        .btn-close {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }
        
        .btn-close:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }
        
        .badge-payment {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .badge-tunai {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }
        
        .badge-transfer {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .kwitansi-container {
                box-shadow: none;
                border: 2px solid #001f3f;
            }
            
            .print-buttons {
                display: none;
            }
            
            .corner-ornament {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .kwitansi-body {
                padding: 30px 20px;
            }
            
            .signature-area {
                flex-direction: column;
                gap: 40px;
            }
            
            .signature-box {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Print Buttons -->
    <div class="print-buttons">
        <button class="btn btn-print" onclick="window.print()">
            <i class="fas fa-print me-2"></i> CETAK KWITANSI
        </button>
        <button class="btn btn-close" onclick="window.close()">
            <i class="fas fa-times me-2"></i> TUTUP
        </button>
    </div>

    <div class="kwitansi-container">
        <!-- Corner Ornaments -->
        <div class="corner-ornament top-left"></div>
        <div class="corner-ornament top-right"></div>
        <div class="corner-ornament bottom-left"></div>
        <div class="corner-ornament bottom-right"></div>
        
        <!-- Header -->
        <div class="header-kwitansi">
            <div class="logo-wrapper">
                <div class="logo-circle">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="school-info">
                    <h1>SMK NEGERI 1 PURWOSARI</h1>
                    <p>Jl. Raya Purwosari No. 1, Pasuruan, Jawa Timur</p>
                    <p>Telp: (0343) 612345 | Email: smkn1purwosari@sch.id</p>
                </div>
            </div>
        </div>
        
        <div class="document-title">
            KWITANSI PEMBAYARAN SPP
        </div>
        
        <!-- Body -->
        <div class="kwitansi-body">
            <div class="nomor-kwitansi">
                No. Kwitansi: <strong>{{ date('Y') }}/SPP/{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</strong>
            </div>
            
            <table class="info-table">
                <tr>
                    <td>Telah Terima Dari</td>
                    <td>:</td>
                    <td><strong>{{ $pembayaran->siswa->nama }}</strong></td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td>{{ $pembayaran->nisn }}</td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }} - {{ $pembayaran->siswa->kelas->kompetensi_keahlian ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Untuk Pembayaran</td>
                    <td>:</td>
                    <td><strong>SPP Bulan {{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</strong></td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>:</td>
                    <td>
                        @if($pembayaran->metode_pembayaran == 'transfer')
                            <span class="badge-payment badge-transfer">TRANSFER BANK</span>
                        @else
                            <span class="badge-payment badge-tunai">TUNAI</span>
                        @endif
                    </td>
                </tr>
                @if($pembayaran->metode_pembayaran == 'transfer')
                <tr>
                    <td>Bank Tujuan</td>
                    <td>:</td>
                    <td>{{ $pembayaran->bank_tujuan }}</td>
                </tr>
                <tr>
                    <td>Nama Pengirim</td>
                    <td>:</td>
                    <td>{{ $pembayaran->nama_pengirim }}</td>
                </tr>
                @endif
            </table>
            
            <div class="payment-box">
                <div class="payment-label">Jumlah Uang</div>
                <div class="payment-amount">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</div>
                <div class="payment-terbilang">
                </div>
            </div>
            
            <!-- Official Stamp -->
            <div class="official-stamp">
                <span>LUNAS<br>DIBAYAR</span>
            </div>
            
            <!-- Signature Area -->
            <div class="signature-area">
                <div class="signature-box">
                    <div class="signature-date">
                        Pasuruan, {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->isoFormat('D MMMM Y') }}
                    </div>
                    <div class="signature-role">Yang Menerima,</div>
                    <div class="signature-name">
                        {{ $pembayaran->petugas->nama_petugas }}
                    </div>
                </div>
                
                <div class="signature-box">
                    <div class="signature-date">
                        &nbsp;
                    </div>
                    <div class="signature-role">Yang Menyerahkan,</div>
                    <div class="signature-name">
                        {{ $pembayaran->siswa->nama }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="kwitansi-footer">
            <p><strong>Kwitansi ini merupakan bukti pembayaran yang sah</strong></p>
            <p>Harap disimpan dengan baik untuk keperluan administrasi</p>
            <p style="margin-top: 10px; font-size: 10px;">Dicetak pada: {{ now()->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
        </div>
    </div>
</body>
</html>