@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Tambah Kelas</h2>
        <p class="section-subtitle">Masukkan informasi kelas baru</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-school me-2"></i>Form Tambah Kelas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kelas" 
                                   class="form-control @error('nama_kelas') is-invalid @enderror" 
                                   value="{{ old('nama_kelas') }}" 
                                   placeholder="Contoh: XII RPL 1" maxlength="10" required>
                            <small class="text-muted">Maksimal 10 karakter</small>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kompetensi Keahlian <span class="text-danger">*</span></label>
                            <input type="text" name="kompetensi_keahlian" 
                                   class="form-control @error('kompetensi_keahlian') is-invalid @enderror" 
                                   value="{{ old('kompetensi_keahlian') }}" 
                                   placeholder="Contoh: Rekayasa Perangkat Lunak" maxlength="50" required>
                            <small class="text-muted">Maksimal 50 karakter</small>
                            @error('kompetensi_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-success-custom">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-custom" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white;">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">
                        <i class="fas fa-info-circle me-2" style="font-size: 0.9rem;"></i>
                        Panduan Pengisian
                    </h5>
                    <ul class="ps-3 mb-0" style="font-size: 0.85rem; line-height: 1.8;">
                        <li class="mb-2">Nama kelas biasanya menggunakan format: [Tingkat] [Jurusan] [Nomor Kelas]</li>
                        <li class="mb-2">Contoh: X RPL 1, XI TKJ 2, XII OTKP 1</li>
                        <li class="mb-2">Kompetensi keahlian harus sesuai dengan kurikulum</li>
                        <li class="mb-0">Pastikan tidak ada duplikasi nama kelas</li>
                    </ul>
                </div>
            </div>

            <!-- Info 10 Jurusan -->
            <div class="card card-custom mt-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: var(--navy-primary);">
                        <i class="fas fa-graduation-cap me-2" style="font-size: 0.85rem;"></i>
                        10 Jurusan Tersedia
                    </h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>RPL</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>DKV</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>MKT</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>TKJ</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>TPM</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>TL</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>TBKR</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>TKR</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>APHP</strong>
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1 text-muted">
                                <i class="fas fa-check-circle text-success me-1" style="font-size: 0.7rem;"></i>
                                <strong>ATPH</strong>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection