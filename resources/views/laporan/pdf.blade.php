<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran SPP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #001f3f;
        }
        
        .header h1 {
            font-size: 20px;
            color: #001f3f;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header h2 {
            font-size: 16px;
            color: #001f3f;
            margin-bottom: 3px;
        }
        
        .header p {
            font-size: 10px;
            color: #666;
        }
        
        .info-section {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 5px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            color: #001f3f;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        table thead {
            background-color: #001f3f;
            color: white;
        }
        
        table th {
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        table tbody tr {
            border-bottom: 1px solid #dee2e6;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        table tbody tr:hover {
            background-color: #e9ecef;
        }
        
        table td {
            padding: 8px;
            font-size: 10px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #fff3cd;
            border-left: 4px solid #FFD700;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 12px;
        }
        
        .summary-label {
            font-weight: bold;
            color: #001f3f;
        }
        
        .summary-value {
            font-weight: bold;
            color: #001f3f;
        }
        
        .total-row {
            font-size: 14px;
            padding-top: 10px;
            border-top: 2px solid #001f3f;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #666;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>SMKN 1 Purwosari</h1>
        <h2>Laporan Pembayaran SPP</h2>
        <p>Jl. Raya Purwosari No. 1, Pasuruan, Jawa Timur</p>
    </div>

    <!-- Info Section -->
    <div class="info-section">
        <div class="info-row">
            <div>
                <span class="info-label">Tanggal Cetak:</span>
                {{ $tanggalCetak->isoFormat('dddd, D MMMM Y HH:mm') }} WIB
            </div>
            <div>
                <span class="info-label">Total Transaksi:</span>
                {{ $jumlahTransaksi }} transaksi
            </div>
        </div>
        
        @if($filter['tanggal_mulai'] || $filter['tanggal_akhir'])
        <div class="info-row">
            <div>
                <span class="info-label">Periode:</span>
                @if($filter['tanggal_mulai'] && $filter['tanggal_akhir'])
                    {{ \Carbon\Carbon::parse($filter['tanggal_mulai'])->isoFormat('D MMMM Y') }} - 
                    {{ \Carbon\Carbon::parse($filter['tanggal_akhir'])->isoFormat('D MMMM Y') }}
                @elseif($filter['tanggal_mulai'])
                    Dari {{ \Carbon\Carbon::parse($filter['tanggal_mulai'])->isoFormat('D MMMM Y') }}
                @elseif($filter['tanggal_akhir'])
                    Sampai {{ \Carbon\Carbon::parse($filter['tanggal_akhir'])->isoFormat('D MMMM Y') }}
                @endif
            </div>
        </div>
        @endif
        
        @if($filter['bulan'])
        <div class="info-row">
            <div>
                <span class="info-label">Bulan Dibayar:</span>
                {{ $filter['bulan'] }}
            </div>
        </div>
        @endif
        
        @if($filter['tahun'])
        <div class="info-row">
            <div>
                <span class="info-label">Tahun Dibayar:</span>
                {{ $filter['tahun'] }}
            </div>
        </div>
        @endif
    </div>

    <!-- Tabel Data -->
    @if($pembayaran->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 12%;">NISN</th>
                <th style="width: 18%;">Nama Siswa</th>
                <th style="width: 8%;">Kelas</th>
                <th style="width: 10%;">Bulan</th>
                <th style="width: 7%;">Tahun</th>
                <th style="width: 12%;">Nominal</th>
                <th style="width: 10%;">Metode</th>
                <th style="width: 10%;">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $index => $bayar)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($bayar->tgl_bayar)->isoFormat('D MMM Y') }}</td>
                <td>{{ $bayar->siswa->nisn }}</td>
                <td>{{ $bayar->siswa->nama }}</td>
                <td>{{ $bayar->siswa->kelas->nama_kelas }}</td>
                <td>{{ $bayar->bulan_dibayar }}</td>
                <td class="text-center">{{ $bayar->tahun_dibayar }}</td>
                <td class="text-right">Rp {{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                <td class="text-center">{{ ucfirst($bayar->metode_pembayaran) }}</td>
                <td>{{ $bayar->petugas->nama_petugas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Summary -->
    <div class="summary">
        <div class="summary-row">
            <span class="summary-label">Jumlah Transaksi:</span>
            <span class="summary-value">{{ $jumlahTransaksi }} transaksi</span>
        </div>
        <div class="summary-row total-row">
            <span class="summary-label">TOTAL PEMBAYARAN:</span>
            <span class="summary-value">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
        </div>
    </div>
    @else
    <div class="no-data">
        <p>Tidak ada data pembayaran untuk ditampilkan</p>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dicetak secara otomatis oleh Sistem Pembayaran SPP SMKN 1 Purwosari</p>
        <p>© {{ date('Y') }} SMKN 1 Purwosari - Semua Hak Dilindungi</p>
    </div>
</body>
</html>