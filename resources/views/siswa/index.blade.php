@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title mb-0">Data Siswa</h2>
            <p class="section-subtitle">Kelola data siswa dan riwayat pembayaran SPP</p>
        </div>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>Tambah Siswa
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="card card-custom mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('siswa.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari NISN atau Nama..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="kelas" class="form-select">
                        <option value="">Semua Kelas</option>
                        @foreach(\App\Models\Kelas::all() as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Siswa</h5>
            <span class="badge bg-light text-dark">Total: {{ $siswa->total() }} siswa</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">NISN</th>
                            <th width="8%">NIS</th>
                            <th width="20%">Nama Siswa</th>
                            <th width="15%">Kelas</th>
                            <th width="12%">No. Telp</th>
                            <th width="12%">Tagihan SPP</th>
                            <th width="18%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $index => $s)
                        <tr>
                            <td>{{ $siswa->firstItem() + $index }}</td>
                            <td><span class="badge badge-custom bg-primary">{{ $s->nisn }}</span></td>
                            <td>{{ $s->nis }}</td>
                            <td>
                                <strong>{{ $s->nama }}</strong>
                            </td>
                            <td>
                                <span class="badge badge-custom bg-info">{{ $s->kelas->nama_kelas }}</span><br>
                                <small class="text-muted">{{ $s->kelas->kompetensi_keahlian }}</small>
                            </td>
                            <td>{{ $s->no_telp }}</td>
                            <td><strong class="text-success">Rp {{ number_format($s->spp->nominal, 0, ',', '.') }}</strong></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info text-white" onclick="showDetail('{{ $s->nisn }}')" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('siswa.edit', $s->nisn) }}" class="btn btn-sm btn-warning-custom" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('siswa.destroy', $s->nisn) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger-custom" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">Belum ada data siswa</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $siswa->links() }}
        </div>
    </div>
</div>

<!-- Modal Detail Siswa -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                <h5 class="modal-title"><i class="fas fa-user-graduate me-2"></i>Detail Siswa & Riwayat Pembayaran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showDetail(nisn) {
    $('#modalDetail').modal('show');
    $('#detailContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `);

    fetch(`/siswa/${nisn}/detail`)
        .then(response => response.json())
        .then(data => {
            let totalBayar = 0;
            let riwayatHTML = '';
            
            if(data.pembayaran.length > 0) {
                data.pembayaran.forEach((p, i) => {
                    totalBayar += parseInt(p.jumlah_bayar);
                    riwayatHTML += `
                        <tr>
                            <td>${i+1}</td>
                            <td>${p.tgl_bayar}</td>
                            <td><span class="badge bg-primary">${p.bulan_dibayar}</span></td>
                            <td>Rp ${parseInt(p.jumlah_bayar).toLocaleString('id-ID')}</td>
                            <td>${p.petugas.nama_petugas}</td>
                        </tr>
                    `;
                });
            } else {
                riwayatHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-info-circle me-2"></i>Belum ada riwayat pembayaran
                        </td>
                    </tr>
                `;
            }

            $('#detailContent').html(`
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=${data.siswa.nama}&background=3498db&color=fff&size=150" 
                             class="rounded-circle mb-3" alt="Avatar">
                        <h5 class="fw-bold">${data.siswa.nama}</h5>
                        <p class="text-muted mb-1">${data.siswa.nisn}</p>
                        <span class="badge bg-info">${data.siswa.kelas.nama_kelas}</span>
                    </div>
                    <div class="col-md-8">
                        <h6 class="fw-bold mb-3">Informasi Siswa</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="35%"><strong>NIS</strong></td>
                                <td>: ${data.siswa.nis}</td>
                            </tr>
                            <tr>
                                <td><strong>Kelas</strong></td>
                                <td>: ${data.siswa.kelas.nama_kelas}</td>
                            </tr>
                            <tr>
                                <td><strong>Jurusan</strong></td>
                                <td>: ${data.siswa.kelas.kompetensi_keahlian}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: ${data.siswa.alamat}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Telp</strong></td>
                                <td>: ${data.siswa.no_telp}</td>
                            </tr>
                            <tr>
                                <td><strong>Tagihan SPP</strong></td>
                                <td>: <strong class="text-success">Rp ${parseInt(data.siswa.spp.nominal).toLocaleString('id-ID')}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0">Riwayat Pembayaran</h6>
                    <div>
                        <span class="badge bg-success">Total: Rp ${totalBayar.toLocaleString('id-ID')}</span>
                        <span class="badge bg-info">${data.pembayaran.length} Transaksi</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${riwayatHTML}
                        </tbody>
                    </table>
                </div>
            `);
        })
        .catch(error => {
            $('#detailContent').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan saat memuat data
                </div>
            `);
        });
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection