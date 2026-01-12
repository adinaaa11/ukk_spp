@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Tambah Data Siswa</h2>
        <p class="section-subtitle">Masukkan informasi siswa baru</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Form Tambah Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.store') }}" method="POST" id="formSiswa">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                                       value="{{ old('nisn') }}" placeholder="Contoh: 0012345678" 
                                       maxlength="10" pattern="[0-9]{10}" required>
                                <small class="text-muted">10 digit angka</small>
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIS <span class="text-danger">*</span></label>
                                <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" 
                                       value="{{ old('nis') }}" placeholder="Contoh: 12345678" 
                                       maxlength="8" pattern="[0-9]{8}" required>
                                <small class="text-muted">8 digit angka</small>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" 
                                   maxlength="35" minlength="3" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                <select name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tahun SPP <span class="text-danger">*</span></label>
                                <select name="id_spp" class="form-select @error('id_spp') is-invalid @enderror" required>
                                    <option value="">-- Pilih SPP --</option>
                                    @foreach($spp as $s)
                                    <option value="{{ $s->id_spp }}" {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
                                        {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_spp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" placeholder="Masukkan alamat lengkap" 
                                      minlength="10" required>{{ old('alamat') }}</textarea>
                            <small class="text-muted">Minimal 10 karakter</small>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" 
                                   value="{{ old('no_telp') }}" placeholder="Contoh: 081234567890" 
                                   maxlength="13" pattern="[0-9]+" required>
                            <small class="text-muted">Hanya angka, maksimal 13 digit</small>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Info:</strong> Username login siswa akan sama dengan NISN, dan password default: <strong>siswa123</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
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

        <div class="col-md-4">
            <div class="card card-custom" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Panduan Pengisian</h5>
                    <ul class="ps-3">
                        <li class="mb-2"><strong>NISN:</strong> 10 digit angka unik nasional</li>
                        <li class="mb-2"><strong>NIS:</strong> 8 digit angka dari sekolah</li>
                        <li class="mb-2"><strong>Nama:</strong> Minimal 3 karakter, maksimal 35</li>
                        <li class="mb-2"><strong>Alamat:</strong> Minimal 10 karakter</li>
                        <li class="mb-2"><strong>No. Telp:</strong> Hanya angka, maksimal 13 digit</li>
                        <li class="mb-2">Semua field wajib diisi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validasi hanya angka untuk NISN, NIS, dan No Telp
document.querySelectorAll('input[pattern="[0-9]+"], input[pattern="[0-9]{10}"], input[pattern="[0-9]{8}"]').forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
@endsection