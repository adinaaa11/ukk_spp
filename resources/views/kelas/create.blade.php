@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">
            <i class="fas fa-school me-2"></i>Tambah Data Kelas
        </h2>
        <p class="section-subtitle">Masukkan informasi kelas baru</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg">
                <div class="card-header-custom bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-school me-2"></i>Form Tambah Kelas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('kelas.store') }}" method="POST" id="formKelas">
                        @csrf

                        <!-- Data Kelas -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-info-circle me-2"></i>Data Kelas
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-tag me-1 text-primary"></i>Nama Kelas 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-school"></i>
                                    </span>
                                    <input type="text" name="nama_kelas" 
                                        class="form-control @error('nama_kelas') is-invalid @enderror" 
                                        value="{{ old('nama_kelas') }}" 
                                        placeholder="Contoh: XII RPL 1" 
                                        maxlength="10" 
                                        required>
                                </div>
                                <small class="text-muted">Format: [Tingkat] [Jurusan] [Nomor] (contoh: X RPL 1)</small>
                                @error('nama_kelas')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-graduation-cap me-1 text-primary"></i>Kompetensi Keahlian 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-book"></i>
                                    </span>
                                    <input type="text" name="kompetensi_keahlian" 
                                        class="form-control @error('kompetensi_keahlian') is-invalid @enderror" 
                                        value="{{ old('kompetensi_keahlian') }}" 
                                        placeholder="Contoh: Rekayasa Perangkat Lunak" 
                                        maxlength="50" 
                                        required>
                                </div>
                                <small class="text-muted">Nama jurusan sesuai kurikulum</small>
                                @error('kompetensi_keahlian')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('kelas.index') }}" class="btn btn-outline-secondary btn-lg">
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
                            Gunakan format standar nama kelas
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Pastikan kompetensi keahlian sesuai
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Hindari duplikasi nama kelas
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Info 10 Jurusan -->
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>10 Jurusan Tersedia
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-primary me-1">RPL</span>
                                Rekayasa Perangkat Lunak
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-primary me-1">DKV</span>
                                Desain Komunikasi Visual
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-primary me-1">MKT</span>
                                Mekatronika
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-primary me-1">TKJ</span>
                                Teknik Komputer Jaringan
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-warning text-dark me-1">TPM</span>
                                Teknik Permesinan
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-warning text-dark me-1">TL</span>
                                Teknik Pengelasan
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-warning text-dark me-1">TBKR</span>
                                Teknik Body Kendaraan
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-warning text-dark me-1">TKR</span>
                                Teknik Kendaraan Ringan
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-success me-1">APHP</span>
                                Agribisnis Pengolahan Hasil
                            </small>
                        </div>
                        <div class="col-6">
                            <small class="d-block mb-1">
                                <span class="badge bg-success me-1">ATPH</span>
                                Agribisnis Tanaman Pangan
                            </small>
                        </div>
                    </div>
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
                        <strong>Kapasitas maksimal:</strong> 35 siswa per kelas
                    </p>
                    <p class="mb-0">
                        <strong>Total kelas:</strong> 42 kelas (14 jurusan × 3 tingkat)
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validasi form -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto uppercase untuk nama kelas
    document.querySelector('input[name="nama_kelas"]').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    // Auto capitalize untuk kompetensi keahlian
    document.querySelector('input[name="kompetensi_keahlian"]').addEventListener('input', function() {
        this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
    });

    // Preview data sebelum submit
    document.getElementById('formKelas').addEventListener('submit', function(e) {
        const namaKelas = document.querySelector('input[name="nama_kelas"]').value;
        const kompetensi = document.querySelector('input[name="kompetensi_keahlian"]').value;
        
        if (namaKelas && kompetensi) {
            const confirmMsg = `Apakah data kelas berikut sudah benar?\n\nNama Kelas: ${namaKelas}\nKompetensi: ${kompetensi}\n\nData akan disimpan.`;
            if (!confirm(confirmMsg)) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endsection