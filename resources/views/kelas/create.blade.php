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
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Pengisian</h5>
                    <ul class="ps-3">
                        <li class="mb-2">Nama kelas biasanya menggunakan format: [Tingkat] [Jurusan] [Nomor Kelas]</li>
                        <li class="mb-2">Contoh: X RPL 1, XI TKJ 2, XII OTKP 1</li>
                        <li class="mb-2">Kompetensi keahlian harus sesuai dengan kurikulum</li>
                        <li class="mb-2">Pastikan tidak ada duplikasi nama kelas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection