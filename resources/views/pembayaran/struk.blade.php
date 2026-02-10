<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran SPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --navy-primary: #001f3f;
            --navy-dark: #001529;
            --yellow-accent: #FFD700;
            --yellow-hover: #FFC000;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .struk-container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            border: 2px solid var(--navy-primary);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: var(--navy-primary);
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 3px solid var(--yellow-accent);
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: var(--yellow-accent);
        }

        .header .school-name {
            font-size: 14px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .content {
            padding: 20px;
            font-size: 13px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #666;
            font-weight: 600;
            font-size: 12px;
        }

        .value {
            font-weight: bold;
            text-align: right;
            color: #333;
            font-size: 13px;
        }

        .total-section {
            background: var(--navy-primary);
            color: white;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
        }

        .total-label {
            font-size: 14px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: var(--yellow-accent);
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            padding: 15px;
            border-top: 1px solid #eee;
            background: #f9f9f9;
        }

        .footer-text {
            margin: 3px 0;
        }

        .print-btn {
            margin-top: 15px;
            padding: 10px 25px;
            border: none;
            background: var(--yellow-accent);
            color: var(--navy-primary);
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .print-btn:hover {
            background: var(--yellow-hover);
            transform: translateY(-2px);
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .struk-container {
                border: 1px solid #000;
                box-shadow: none;
                max-width: 100%;
            }
            
            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

<div class="struk-container">
    <div class="header">
        <h2>STRUK PEMBAYARAN SPP</h2>
        <div class="school-name">SMK NEGERI 1 PURWOSARI</div>
    </div>

    <div class="content">
        <div class="info-row">
            <span class="label">NISN</span>
            <span class="value">{{ $pembayaran->siswa->nisn }}</span>
        </div>

        <div class="info-row">
            <span class="label">Nama</span>
            <span class="value">{{ $pembayaran->siswa->nama }}</span>
        </div>

        <div class="info-row">
            <span class="label">Kelas</span>
            <span class="value">{{ $pembayaran->siswa->kelas->nama_kelas }}</span>
        </div>

        <div class="info-row">
            <span class="label">Bulan</span>
            <span class="value">
                @php
                    $bulans = explode(', ', $pembayaran->bulan_dibayar);
                    echo implode(', ', $bulans);
                @endphp
                {{ $pembayaran->tahun_dibayar }}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Metode</span>
            <span class="value">{{ ucfirst($pembayaran->metode_pembayaran) }}</span>
        </div>

        <div class="info-row">
            <span class="label">Petugas</span>
            <span class="value">{{ $pembayaran->petugas->nama_petugas }}</span>
        </div>

        <div class="info-row">
            <span class="label">Tanggal</span>
            <span class="value">{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d M Y') }}</span>
        </div>

        <div class="total-section">
            <span class="total-label">Total Bayar</span>
            <span class="total-amount">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p class="footer-text"><strong>Terima Kasih</strong></p>
        <p class="footer-text">Simpan struk ini sebagai bukti pembayaran yang sah</p>
        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print me-2"></i>Cetak Struk
        </button>
    </div>

</div>

</body>
</html>