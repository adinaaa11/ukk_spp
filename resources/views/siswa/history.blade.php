<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #27ae60;
            --secondary: #2ecc71;
        }
        body {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px 15px;
        }
        .container-custom {
            max-width: 1000px;
            margin: 0 auto;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .header-back {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
        .table-responsive {
            background: white;
            border-radius: 15px;
            padding: 20px;
        }
        .btn-back {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-back:hover {
            background: #1e8449;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="header-back">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1 fw-bold">Riwayat Pembayaran SPP</h4>
                    <p class="text-muted mb-0">{{ $siswa->nama }} ({{ $siswa->nisn }})</p>
                </div>
                <a href="{{ route('siswa.dashboard') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan/Tahun</th>
                        <th>Nominal</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $index => $p)
                    <tr>
                        <td>{{ $pembayaran->firstItem() + $index }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $p->bulan_dibayar }}</span>
                            <span class="badge bg-secondary">{{ $p->tahun_dibayar }}</span>
                        </td>
                        <td><strong class="text-success">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</strong></td>
                        <td>{{ $p->petugas->nama_petugas }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                            <p>Belum ada riwayat pembayaran</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if($pembayaran->total() > 0)
            <div class="mt-4">
                {{ $pembayaran->links() }}
            </div>
            @endif
        </div>
    </div>
</body>
</html>