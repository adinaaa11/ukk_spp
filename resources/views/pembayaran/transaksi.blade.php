@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-custom mb-3">
            <div class="card-header-navy">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i> Data Siswa</h5>
            </div>
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=001f3f&color=FFD700&size=128" class="rounded-circle shadow-sm" alt="Profile">
                </div>
                <h4 class="fw-bold mb-0">{{ $siswa->nama }}</h4>
                <p class="text-muted">{{ $siswa->nisn }}</p>
                <hr>
                <div class="text-start">
                    <p class="mb-1"><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas }}</p>
                    <p class="mb-1"><strong>Jurusan:</strong> {{ $siswa->kelas->kompetensi_keahlian }}</p>
                    <p class="mb-0"><strong>Tagihan SPP:</strong> Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}/bulan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        
        <div class="card card-custom mb-4">
            <div class="card-header-navy d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-cash-register me-2"></i> Form Pembayaran</h5>
                <span class="badge bg-warning text-dark">Petugas: {{ Auth::user()->nama_petugas }}</span>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tahun Bayar</label>
                            <input type="number" name="tahun_dibayar" class="form-control" value="{{ date('Y') }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Bulan Bayar</label>
                            <select name="bulan_dibayar" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Bulan --</option>
                                @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $bulan }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Jumlah Bayar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="jumlah_bayar" class="form-control" value="{{ $siswa->spp->nominal }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-navy btn-lg">
                            <i class="fas fa-save me-2"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 text-muted"><i class="fas fa-history me-2"></i> Riwayat Pembayaran {{ $siswa->nama }}</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>Tanggal</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $h)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($h->tgl_bayar)->format('d/m/Y') }}</td>
                                <td><span class="badge bg-primary">{{ $h->bulan_dibayar }}</span></td>
                                <td>Rp {{ number_format($h->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ $h->petugas->nama_petugas }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">Belum ada riwayat pembayaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection