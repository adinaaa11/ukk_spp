@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- KOLOM KIRI: Data Siswa -->
        <div class="col-lg-4 col-md-5 mb-3">
            <div class="card card-custom">
                <div class="card-header-navy">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i> Data Siswa</h5>
                </div>
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=001f3f&color=FFD700&size=128" 
                             class="rounded-circle shadow-sm" alt="Profile">
                    </div>
                    <h4 class="fw-bold mb-0">{{ $siswa->nama }}</h4>
                    <p class="text-muted mb-3">{{ $siswa->nisn }}</p>
                    <hr>
                    <div class="text-start">
                        <p class="mb-2"><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas }}</p>
                        <p class="mb-2"><strong>Jurusan:</strong> {{ $siswa->kelas->kompetensi_keahlian }}</p>
                        <p class="mb-0"><strong>Tagihan SPP:</strong> <span class="text-success fw-bold">Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}/bulan</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Form Pembayaran -->
        <div class="col-lg-8 col-md-7">
            <div class="card card-custom mb-3">
                <div class="card-header-navy d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-cash-register me-2"></i> Form Pembayaran</h5>
                    <span class="badge bg-warning text-dark">Petugas: {{ Auth::user()->nama_petugas }}</span>
                </div>
                <div class="card-body">
                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Tab Navigation --}}
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tunai-tab" data-bs-toggle="tab" 
                                    data-bs-target="#tunai" type="button" role="tab">
                                <i class="fas fa-money-bill-wave me-2"></i>Pembayaran Tunai
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="transfer-tab" data-bs-toggle="tab" 
                                    data-bs-target="#transfer" type="button" role="tab">
                                <i class="fas fa-university me-2"></i>Transfer Bank
                            </button>
                        </li>
                    </ul>

                    {{-- Tab Content --}}
                    <div class="tab-content">
                        {{-- TUNAI TAB --}}
                        <div class="tab-pane fade show active" id="tunai" role="tabpanel">
                            <form action="{{ route('pembayaran.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                                <input type="hidden" name="metode_pembayaran" value="tunai">
                                
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Tahun Bayar <span class="text-danger">*</span></label>
                                        <input type="number" name="tahun_dibayar" class="form-control form-control-lg" 
                                               value="{{ date('Y') }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Bulan Bayar <span class="text-danger">*</span></label>
                                        <select name="bulan_dibayar" class="form-select form-select-lg" required>
                                            <option value="">-- Pilih Bulan --</option>
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="September">September</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Jumlah Bayar</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="jumlah_bayar" class="form-control" 
                                                   value="{{ $siswa->spp->nominal }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-navy btn-lg py-3" style="font-size: 1.1rem;">
                                        <i class="fas fa-save me-2"></i> Simpan Transaksi Tunai
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- TRANSFER TAB --}}
                        <div class="tab-pane fade" id="transfer" role="tabpanel">
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Informasi Transfer:</strong> Pastikan siswa telah melakukan transfer ke rekening sekolah sebelum memproses pembayaran ini.
                            </div>

                            <form action="{{ route('pembayaran.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                                <input type="hidden" name="metode_pembayaran" value="transfer">
                                
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Tahun Bayar <span class="text-danger">*</span></label>
                                        <input type="number" name="tahun_dibayar" class="form-control form-control-lg" 
                                               value="{{ date('Y') }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Bulan Bayar <span class="text-danger">*</span></label>
                                        <select name="bulan_dibayar" class="form-select form-select-lg" required>
                                            <option value="">-- Pilih Bulan --</option>
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="September">September</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Jumlah Bayar</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="jumlah_bayar" class="form-control" 
                                                   value="{{ $siswa->spp->nominal }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Bank Tujuan <span class="text-danger">*</span></label>
                                        <select name="bank_tujuan" class="form-select form-select-lg" required>
                                            <option value="">-- Pilih Bank --</option>
                                            <option value="BRI">BRI - Bank Rakyat Indonesia</option>
                                            <option value="BNI">BNI - Bank Negara Indonesia</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="BCA">BCA - Bank Central Asia</option>
                                        </select>
                                        <small class="text-muted">Pilih bank tujuan transfer</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nomor Rekening Pengirim <span class="text-danger">*</span></label>
                                        <input type="text" name="no_rekening_pengirim" class="form-control form-control-lg" 
                                               placeholder="Contoh: 1234567890" required>
                                        <small class="text-muted">Nomor rekening yang mentransfer</small>
                                    </div>
                                </div>

                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nama Pengirim <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_pengirim" class="form-control form-control-lg" 
                                               placeholder="Nama pemilik rekening" required>
                                        <small class="text-muted">Nama sesuai rekening bank</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Tanggal Transfer <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_transfer" class="form-control form-control-lg" 
                                               value="{{ date('Y-m-d') }}" required>
                                        <small class="text-muted">Tanggal melakukan transfer</small>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label fw-bold">Catatan (Opsional)</label>
                                    <textarea name="catatan" class="form-control form-control-lg" rows="2" 
                                              placeholder="Catatan tambahan jika ada..."></textarea>
                                </div>
                                
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-navy btn-lg py-3" style="font-size: 1.1rem;">
                                        <i class="fas fa-check-circle me-2"></i> Konfirmasi Pembayaran Transfer
                                    </button>
                                </div>
                            </form>

                            {{-- Info Rekening Sekolah --}}
                            <div class="card mt-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border: 2px dashed var(--navy-primary);">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3" style="color: var(--navy-primary);">
                                        <i class="fas fa-university me-2"></i>Rekening Sekolah
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <strong>BRI:</strong> 0012-3456-7890-1234<br>
                                            <small class="text-muted">a.n. SMK Negeri 1 Purwosari</small>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong>BNI:</strong> 9876-5432-1098-7654<br>
                                            <small class="text-muted">a.n. SMK Negeri 1 Purwosari</small>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong>Mandiri:</strong> 1357-2468-9012-3456<br>
                                            <small class="text-muted">a.n. SMK Negeri 1 Purwosari</small>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <strong>BCA:</strong> 5678-9012-3456-7890<br>
                                            <small class="text-muted">a.n. SMK Negeri 1 Purwosari</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Riwayat Pembayaran --}}
            <div class="card card-custom">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-muted"><i class="fas fa-history me-2"></i> Riwayat Pembayaran {{ $siswa->nama }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0" style="font-size: 0.9rem;">
                            <thead style="background-color: #f8f9fa;">
                                <tr>
                                    <th style="padding: 12px;">Tanggal</th>
                                    <th style="padding: 12px;">Bulan</th>
                                    <th style="padding: 12px;">Nominal</th>
                                    <th style="padding: 12px;">Metode</th>
                                    <th style="padding: 12px;">Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($history as $h)
                                <tr>
                                    <td style="padding: 12px;">{{ \Carbon\Carbon::parse($h->tgl_bayar)->format('d/m/Y') }}</td>
                                    <td style="padding: 12px;">
                                        <span class="badge bg-primary" style="font-size: 0.85rem; padding: 5px 10px;">
                                            {{ $h->bulan_dibayar }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px;">Rp {{ number_format($h->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td style="padding: 12px;">
                                        @if(isset($h->metode_pembayaran) && $h->metode_pembayaran == 'transfer')
                                            <span class="badge bg-info" style="font-size: 0.85rem; padding: 5px 10px;">Transfer</span>
                                        @else
                                            <span class="badge bg-success" style="font-size: 0.85rem; padding: 5px 10px;">Tunai</span>
                                        @endif
                                    </td>
                                    <td style="padding: 12px;">{{ $h->petugas->nama_petugas }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-muted">Belum ada riwayat pembayaran.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    color: #666;
    font-weight: 600;
    border: none;
    border-bottom: 3px solid transparent;
    transition: all 0.3s;
}

.nav-tabs .nav-link:hover {
    color: var(--navy-primary);
    border-bottom-color: var(--yellow-accent);
}

.nav-tabs .nav-link.active {
    color: var(--navy-primary);
    background: transparent;
    border-bottom-color: var(--yellow-accent);
}
</style>
@endsection