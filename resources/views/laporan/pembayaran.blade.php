<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran SPP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #001f3f;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
            color: #001f3f;
        }
        .header p {
            margin: 3px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #001f3f;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            margin-top: 80px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PEMBAYARAN SPP</h2>
        <p>SMK NEGERI 1 EXAMPLE</p>
        <p>Periode: {{ now()->isoFormat('MMMM Y') }}</p>
        <p>Dicetak pada: {{ now()->isoFormat('dddd, D MMMM Y HH:mm') }} WIB</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="12%">NISN</th>
                <th width="20%">Nama Siswa</th>
                <th width="15%">Bulan/Tahun</th>
                <th width="15%">Nominal</th>
                <th width="18%">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($pembayaran as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                <td>{{ $p->nisn }}</td>
                <td>{{ $p->siswa->nama }}</td>
                <td>{{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}</td>
                <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                <td>{{ $p->petugas->nama_petugas }}</td>
            </tr>
            @php $total += $p->jumlah_bayar; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p>Total Pembayaran: <span style="color: #001f3f;">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
        <p>Jumlah Transaksi: <span style="color: #001f3f;">{{ $pembayaran->count() }}</span></p>
    </div>

    <div class="footer">
        <p>Mengetahui,</p>
        <div class="signature">
            <p>_______________________</p>
            <p><strong>Kepala Sekolah</strong></p>
        </div>
    </div>
</body>
</html>