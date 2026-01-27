@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Edit Kelas</h2>
        <p class="section-subtitle">Perbarui informasi kelas</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-school me-2"></i>Form Edit Kelas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kelas" 
                                   class="form-control @error('nama_kelas') is-invalid @enderror" 
                                   value="{{ old('nama_kelas', $kelas->nama_kelas) }}" 
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
                                   value="{{ old('kompetensi_keahlian', $kelas->kompetensi_keahlian) }}" 
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
                            <button type="submit" class="btn btn-warning-custom">
                                <i class="fas fa-save me-2"></i>Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-school" style="font-size: 3rem; color: var(--navy-primary); opacity: 0.7;"></i>
                    </div>
                    <h5 class="fw-bold">{{ $kelas->nama_kelas }}</h5>
                    <p class="text-muted">{{ $kelas->kompetensi_keahlian }}</p>
                    <hr>
                    <div class="row text-center">
                        <div class="col-12">
                            <h3 class="text-primary mb-0" style="font-size: 2rem;">{{ $kelas->siswa->count() }}</h3>
                            <small class="text-muted">Total Siswa</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Info -->
            <div class="alert alert-info mt-3" style="font-size: 0.85rem;">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Info:</strong> Perubahan data kelas akan mempengaruhi {{ $kelas->siswa->count() }} siswa yang terdaftar.
            </div>
        </div>
    </div>
</div>
@endsection