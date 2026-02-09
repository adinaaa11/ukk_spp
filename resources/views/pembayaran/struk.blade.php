<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran SPP - {{ $pembayaran->siswa->nama }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            padding: 20px;
            background: #f5f5f5;
        }

        .struk-container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border: 2px dashed #001f3f;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #001f3f;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            color: #001f3f;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header p {
            font-size: 12px;
            color: #666;
            margin: 3px 0;
        }

        .struk-title {
            text-align: center;
            background: #001f3f;
            color: #FFD700;
            padding: 10px;
            margin: 20px -30px;
            font-weight: bold;
            font-size: 16px;
            letter-spacing: 2px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px dotted #ddd;
        }

        .info-label {
            font-weight: bold;
            color: #001f3f;
            width: 40%;
        }

        .info-value {
            text-align: right;
            width: 60%;
            color: #333;
        }

        .total-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #001f3f;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            color: #001f3f;
            padding: 10px 0;
        }

        .total-amount {
            color: #27ae60;
            font-size: 24px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px dashed #001f3f;
            text-align: center;
        }

        .footer p {
            font-size: 11px;
            color: #666;
            margin: 5px 0;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature-line {
            border-top: 1px solid #001f3f;
            width: 150px;
            margin: 50px 0 5px auto;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #001f3f;
            color: #FFD700;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .print-button:hover {
            background: #003366;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-top: 5px;
        }

        .badge-success {
            background: #27ae60;
            color: white;
        }

        .badge-info {
            background: #3498db;
            color: white;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk-container {
                max-width: 100%;
                border: none;
                box-shadow: none;
                padding: 20px;
            }

            .print-button {
                display: none;
            }

            .struk-title {
                margin: 20px 0;
            }
        }

        @page {
            size: 80mm auto;
            margin: 0;
        }
    </style>
</head>
<body>
    <button class="print-button" onclick="window.print()">
        🖨️ CETAK STRUK
    </button>

    <div class="struk-container">
        <!-- Header Sekolah -->
        <div class="header">
            <h1>SMK NEGERI 1 JAKARTA</h1>
            <p>Jl. Pendidikan No. 123, Jakarta</p>
            <p>Telp: (021) 1234567 | Email: info@smkn1jkt.sch.id</p>
        </div>

        <!-- Judul Struk -->
        <div class="struk-title">
            *** BUKTI PEMBAYARAN SPP ***
        </div>

        <!-- Informasi Pembayaran -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">No. Transaksi</span>
                <span class="info-value">#{{ str_pad($pembayaran->id_pembayaran, 6, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Tanggal</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d/m/Y H:i') }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Petugas</span>
                <span class="info-value">{{ $pembayaran->petugas->nama_petugas ?? '-' }}</span>
            </div>
        </div>

        <!-- Garis Pemisah -->
        <div style="border-top: 2px solid #001f3f; margin: 20px 0;"></div>

        <!-- Data Siswa -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">NISN</span>
                <span class="info-value">{{ $pembayaran->siswa->nisn }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">NIS</span>
                <span class="info-value">{{ $pembayaran->siswa->nis }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Nama Siswa</span>
                <span class="info-value">{{ $pembayaran->siswa->nama }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Kelas</span>
                <span class="info-value">{{ $pembayaran->siswa->kelas->nama_kelas ?? '-' }}</span>
            </div>

            <div class="info-row">
                <span class="info-label">Jurusan</span>
                <span class="info-value">{{ $pembayaran->siswa->kelas->kompetensi_keahlian ?? '-' }}</span>
            </div>
        </div>

        <!-- Garis Pemisah -->
        <div style="border-top: 2px solid #001f3f; margin: 20px 0;"></div>

        <!-- Detail Pembayaran -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">Periode</span>
                <span class="info-value">
                    <strong>{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</strong>
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Metode Bayar</span>
                <span class="info-value">
                    @if($pembayaran->metode_pembayaran == 'tunai')
                        <span class="badge badge-success">💵 TUNAI</span>
                    @else
                        <span class="badge badge-info">💳 TRANSFER</span>
                    @endif
                </span>
            </div>
        </div>

        <!-- Total Pembayaran -->
        <div class="total-section">
            <div class="total-row">
                <span>TOTAL BAYAR</span>
                <span class="total-amount">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Tanda Tangan -->
        <div class="signature">
            <p style="margin-bottom: 60px;">Petugas,</p>
            <div class="signature-line"></div>
            <p style="font-weight: bold; color: #001f3f;">{{ $pembayaran->petugas->nama_petugas ?? '-' }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>*** TERIMA KASIH ***</p>
            <p>Simpan struk ini sebagai bukti pembayaran yang sah</p>
            <p style="font-size: 10px; margin-top: 10px;">Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <script>
        // Auto print saat halaman dibuka (opsional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>