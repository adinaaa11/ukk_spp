@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Transaksi Pembayaran SPP</h2>
        <p class="section-subtitle">Pilih siswa untuk melakukan pembayaran</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>Cari Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pembayaran.create') }}" method="GET">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-bold">Cari berdasarkan NISN atau Nama</label>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Masukkan NISN atau Nama Siswa" 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">&nbsp;</label>
                                <button type="submit" class="btn btn-success-custom w-100">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(isset($siswa) && $siswa->count() > 0)
                        <hr>
                        <h6 class="mb-3">Hasil Pencarian ({{ $siswa->count() }} siswa)</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswa as $s)
                                    <tr>
                                        <td>{{ $s->nisn }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->kelas->nama_kelas ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('pembayaran.transaksi', $s->nisn) }}" 
                                               class="btn btn-sm btn-success-custom">
                                                <i class="fas fa-cash-register me-1"></i>Bayar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif(request('search'))
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Siswa dengan NISN atau nama "{{ request('search') }}" tidak ditemukan.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Panduan</h5>
                    <ul class="ps-3">
                        <li class="mb-2">Masukkan NISN atau Nama siswa</li>
                        <li class="mb-2">Klik tombol "Cari" untuk mencari</li>
                        <li class="mb-2">Pilih siswa dari hasil pencarian</li>
                        <li class="mb-2">Klik "Bayar" untuk melakukan transaksi</li>
                    </ul>
                </div>
            </div>

            <div class="card card-custom mt-3">
                <div class="card-body text-center">
                    <a href="{{ route('siswa.create') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-user-plus me-2"></i>Tambah Siswa Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection