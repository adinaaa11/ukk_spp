<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Struk Pembayaran SPP</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f1f4f9;
    margin: 0;
    padding: 20px;
}

.struk {
    width: 360px;
    margin: auto;
    background: white;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,.2);
    overflow: hidden;
}

.header {
    background: linear-gradient(135deg, #001f3f, #003366);
    color: white;
    padding: 24px;
    text-align: center;
}

.header h2 {
    margin: 0;
    font-size: 18px;
}

.header small {
    opacity: .8;
}

.content {
    padding: 20px;
    font-size: 13px;
}

.row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px dashed #ddd;
}

.row:last-child {
    border-bottom: none;
}

.label {
    color: #555;
}

.value {
    font-weight: 600;
    text-align: right;
}

.total {
    background: #f0f6ff;
    border-radius: 12px;
    padding: 16px;
    margin-top: 16px;
    display: flex;
    justify-content: space-between;
    font-size: 15px;
    font-weight: bold;
    color: #003366;
}

.footer {
    text-align: center;
    font-size: 12px;
    color: #666;
    padding: 16px;
}

button {
    margin-top: 10px;
    padding: 8px 20px;
    border: none;
    background: #0d6efd;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

@media print {
    body {
        background: white;
    }
    button {
        display: none;
    }
}
</style>
</head>

<body onload="window.print()">

<div class="struk">

    <div class="header">
        <h2>STRUK PEMBAYARAN SPP</h2>
        <small>SMK NEGERI 1 PURWOSARI</small>
    </div>

    <div class="content">

        <div class="row">
            <span class="label">NISN</span>
            <span class="value">{{ $pembayaran->siswa->nisn }}</span>
        </div>

        <div class="row">
            <span class="label">Nama</span>
            <span class="value">{{ $pembayaran->siswa->nama }}</span>
        </div>

        <div class="row">
            <span class="label">Kelas</span>
            <span class="value">{{ $pembayaran->siswa->kelas->nama_kelas }}</span>
        </div>

        <div class="row">
            <span class="label">Bulan</span>
            <span class="value">{{ $pembayaran->bulan_dibayar }} {{ $pembayaran->tahun_dibayar }}</span>
        </div>

        <div class="row">
            <span class="label">Metode</span>
            <span class="value">{{ ucfirst($pembayaran->metode_pembayaran) }}</span>
        </div>

        <div class="row">
            <span class="label">Petugas</span>
            <span class="value">{{ $pembayaran->petugas->nama_petugas }}</span>
        </div>

        <div class="row">
            <span class="label">Tanggal</span>
            <span class="value">{{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d M Y') }}</span>
        </div>

        <div class="total">
            <span>Total Bayar</span>
            <span>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        Terima kasih 🙏<br>
        Simpan struk ini sebagai bukti pembayaran
        <br>
        <button onclick="window.print()">Cetak</button>
    </div>

</div>

</body>
</html>
