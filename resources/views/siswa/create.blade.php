@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">
            <i class="fas fa-user-graduate me-2"></i>Tambah Data Siswa
        </h2>
        <p class="section-subtitle">Masukkan informasi lengkap siswa baru</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg">
                <div class="card-header-custom bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-user-plus me-2"></i>Form Pendaftaran Siswa
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('siswa.store') }}" method="POST" id="formSiswa">
                        @csrf

                        <!-- Data Identitas -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-id-card me-2"></i>Data Identitas
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-hashtag me-1 text-primary"></i>NISN 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-fingerprint"></i>
                                        </span>
                                        <input type="text" name="nisn"
                                            class="form-control @error('nisn') is-invalid @enderror"
                                            value="{{ old('nisn') }}"
                                            placeholder="10 digit angka"
                                            maxlength="10" pattern="[0-9]{10}" required>
                                    </div>
                                    <small class="text-muted">Format: 10 digit angka (contoh: 0012345678)</small>
                                    @error('nisn')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-hashtag me-1 text-primary"></i>NIS 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-id-badge"></i>
                                        </span>
                                        <input type="text" name="nis"
                                            class="form-control @error('nis') is-invalid @enderror"
                                            value="{{ old('nis') }}"
                                            placeholder="8 digit angka"
                                            maxlength="8" pattern="[0-9]{8}" required>
                                    </div>
                                    <small class="text-muted">Format: 8 digit angka (contoh: 12345678)</small>
                                    @error('nis')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user me-1 text-primary"></i>Nama Lengkap 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama') }}"
                                        placeholder="Masukkan nama lengkap sesuai ijazah"
                                        minlength="3" maxlength="35" required>
                                </div>
                                @error('nama')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Akademis -->
                        <div class="mb-4">
                            <h6 class="text-success fw-bold mb-3">
                                <i class="fas fa-graduation-cap me-2"></i>Data Akademis
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-layer-group me-1 text-success"></i>Tingkat Kelas 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white">
                                            <i class="fas fa-school"></i>
                                        </span>
                                        <select name="tingkat_kelas"
                                            class="form-select @error('tingkat_kelas') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Tingkat --</option>
                                            <option value="X" {{ old('tingkat_kelas') == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                                            <option value="XI" {{ old('tingkat_kelas') == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                                            <option value="XII" {{ old('tingkat_kelas') == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                                        </select>
                                    </div>
                                    @error('tingkat_kelas')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-book me-1 text-success"></i>Jurusan 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white">
                                            <i class="fas fa-book-open"></i>
                                        </span>
                                        <select name="id_kelas"
                                            class="form-select @error('id_kelas') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach($kelas as $k)
                                                <option value="{{ $k->id_kelas }}"
                                                    {{ old('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_kelas')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-money-bill-wave me-1 text-success"></i>Nominal SPP 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-success text-white">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                    <select name="id_spp"
                                        class="form-select @error('id_spp') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Tahun & Nominal --</option>
                                        @foreach($spp as $s)
                                            <option value="{{ $s->id_spp }}"
                                                {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
                                                Tahun {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}/bulan
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id_spp')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Kontak -->
                        <div class="mb-4">
                            <h6 class="text-warning fw-bold mb-3">
                                <i class="fas fa-address-card me-2"></i>Data Kontak
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-home me-1 text-warning"></i>Alamat Lengkap 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-dark">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <textarea name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        rows="3"
                                        minlength="10"
                                        placeholder="Masukkan alamat lengkap (RT/RW, Desa, Kecamatan, Kabupaten/Kota)"
                                        required>{{ old('alamat') }}</textarea>
                                </div>
                                <small class="text-muted">Minimal 10 karakter</small>
                                @error('alamat')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-phone me-1 text-warning"></i>No. Telepon/WhatsApp 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-warning text-dark">
                                        <i class="fas fa-mobile-alt"></i>
                                    </span>
                                    <input type="text" name="no_telp"
                                        class="form-control @error('no_telp') is-invalid @enderror"
                                        value="{{ old('no_telp') }}"
                                        placeholder="08xx-xxxx-xxxx"
                                        maxlength="13" pattern="[0-9]+" required>
                                </div>
                                <small class="text-muted">Format: 081234567890 (maksimal 13 digit)</small>
                                @error('no_telp')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Info Akun -->
                        <div class="alert alert-info border-0 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                                <div>
                                    <h6 class="alert-heading mb-2">Informasi Akun Login Siswa</h6>
                                    <div class="mb-1">
                                        <strong>Username:</strong> <span class="badge bg-primary">NISN</span>
                                    </div>
                                    <div>
                                        <strong>Password Default:</strong> <span class="badge bg-success">siswa123</span>
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Siswa dapat mengubah password setelah login pertama kali
                                    </small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>
                                <span>Kembali ke Daftar</span>
                            </a>
                            <div class="d-flex gap-2">
                                <button type="reset" class="btn btn-outline-danger btn-lg">
                                    <i class="fas fa-redo me-2"></i>
                                    <span>Reset Form</span>
                                </button>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save me-2"></i>
                                    <span>Simpan Data</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Panduan Pengisian
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Pastikan semua data terisi dengan benar
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            NISN dan NIS harus sesuai dengan dokumen resmi
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Nomor telepon aktif untuk komunikasi
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Alamat lengkap untuk keperluan administrasi
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Penting!
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Data yang telah disimpan tidak dapat diubah</strong> kecuali melalui admin.
                    </p>
                    <p class="mb-0">
                        Pastikan data sudah benar sebelum menyimpan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validasi input angka -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validasi input angka saja
    document.querySelectorAll('input[pattern]').forEach(input => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

    // Auto uppercase untuk nama
    document.querySelector('input[name="nama"]').addEventListener('input', function() {
        this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
    });

    // Preview data sebelum submit
    document.getElementById('formSiswa').addEventListener('submit', function(e) {
        const nama = document.querySelector('input[name="nama"]').value;
        const nisn = document.querySelector('input[name="nisn"]').value;
        
        if (nama && nisn) {
            const confirmMsg = `Apakah data siswa berikut sudah benar?\n\nNama: ${nama}\nNISN: ${nisn}\n\nData akan disimpan dan tidak dapat diubah.`;
            if (!confirm(confirmMsg)) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endsection
