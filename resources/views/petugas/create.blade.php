<!-- resources/views/petugas/create.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">
            <i class="fas fa-user-shield me-2"></i>Tambah Data Petugas
        </h2>
        <p class="section-subtitle">Masukkan informasi petugas/admin baru</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom shadow-lg">
                <div class="card-header-custom bg-gradient" style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark));">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-user-plus me-2"></i>Form Tambah Petugas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.store') }}" method="POST" id="formPetugas">
                        @csrf

                        <!-- Data Akun -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-user-circle me-2"></i>Data Akun
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-user me-1 text-primary"></i>Username 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" name="username" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               value="{{ old('username') }}" 
                                               placeholder="Contoh: admin123" 
                                               maxlength="255" 
                                               required>
                                    </div>
                                    <small class="text-muted">Hanya huruf, angka, dan underscore</small>
                                    @error('username')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-id-card me-1 text-primary"></i>Nama Lengkap 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fas fa-id-badge"></i>
                                        </span>
                                        <input type="text" name="nama_petugas" 
                                               class="form-control @error('nama_petugas') is-invalid @enderror" 
                                               value="{{ old('nama_petugas') }}" 
                                               placeholder="Contoh: Budi Santoso" 
                                               maxlength="255" 
                                               minlength="3" 
                                               required>
                                    </div>
                                    <small class="text-muted">Minimal 3 karakter</small>
                                    @error('nama_petugas')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-shield-alt me-1 text-primary"></i>Level Akses 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    <select name="level" class="form-select @error('level') is-invalid @enderror" required>
                                        <option value="">-- Pilih Level --</option>
                                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>
                                            <i class="fas fa-crown me-1"></i>Administrator
                                        </option>
                                        <option value="petugas" {{ old('level') == 'petugas' ? 'selected' : '' }}>
                                            <i class="fas fa-user-check me-1"></i>Petugas
                                        </option>
                                    </select>
                                </div>
                                <small class="text-muted">
                                    <strong>Admin:</strong> Akses penuh semua fitur | 
                                    <strong>Petugas:</strong> Hanya transaksi pembayaran
                                </small>
                                @error('level')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Keamanan -->
                        <div class="mb-4">
                            <h6 class="text-warning fw-bold mb-3">
                                <i class="fas fa-lock me-2"></i>Data Keamanan
                            </h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-key me-1 text-warning"></i>Password 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-dark">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Minimal 6 karakter" 
                                               minlength="6" 
                                               required>
                                    </div>
                                    <small class="text-muted">Minimal 6 karakter</small>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-lock me-1 text-warning"></i>Konfirmasi Password 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-dark">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" 
                                               class="form-control" 
                                               placeholder="Ketik ulang password" 
                                               minlength="6" 
                                               required>
                                    </div>
                                    <small class="text-muted">Harus sama dengan password</small>
                                </div>
                            </div>
                        </div>

                        <!-- Info Akun -->
                        <div class="alert alert-info border-0 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                                <div>
                                    <h6 class="alert-heading mb-2">Informasi Akun Login</h6>
                                    <div class="mb-1">
                                        <strong>Username & Password:</strong> Digunakan untuk login ke sistem
                                    </div>
                                    <div class="mb-1">
                                        <strong>Level Admin:</strong> <span class="badge bg-danger">Akses penuh</span>
                                    </div>
                                    <div class="mb-0">
                                        <strong>Level Petugas:</strong> <span class="badge bg-info">Hanya pembayaran</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('petugas.index') }}" class="btn btn-outline-secondary btn-lg">
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
                            Username unik dan mudah diingat
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Password minimal 6 karakter
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Pilih level akses yang sesuai
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Gunakan password yang kuat
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>Hak Akses
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-crown fa-2x text-danger me-3"></i>
                            <div>
                                <h6 class="mb-1 text-danger">Administrator</h6>
                                <p class="mb-0 text-muted small">Akses penuh ke semua fitur sistem</p>
                            </div>
                        </div>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>Manajemen siswa</li>
                            <li><i class="fas fa-check text-success me-2"></i>Manajemen kelas</li>
                            <li><i class="fas fa-check text-success me-2"></i>Manajemen SPP</li>
                            <li><i class="fas fa-check text-success me-2"></i>Manajemen petugas</li>
                            <li><i class="fas fa-check text-success me-2"></i>Laporan lengkap</li>
                        </ul>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-check fa-2x text-info me-3"></i>
                            <div>
                                <h6 class="mb-1 text-info">Petugas</h6>
                                <p class="mb-0 text-muted small">Hanya akses fitur pembayaran</p>
                            </div>
                        </div>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-check text-success me-2"></i>Entri pembayaran</li>
                            <li><i class="fas fa-check text-success me-2"></i>Cetak struk</li>
                            <li><i class="fas fa-check text-success me-2"></i>History pembayaran</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>Penting!
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Data akun yang sudah dibuat tidak dapat diubah username-nya.</strong>
                    </p>
                    <p class="mb-0">
                        Pastikan data yang diinput sudah benar sebelum menyimpan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validasi form -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto lowercase untuk username
    document.querySelector('input[name="username"]').addEventListener('input', function() {
        this.value = this.value.toLowerCase();
    });

    // Auto capitalize untuk nama
    document.querySelector('input[name="nama_petugas"]').addEventListener('input', function() {
        this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
    });

    // Preview data sebelum submit
    document.getElementById('formPetugas').addEventListener('submit', function(e) {
        const username = document.querySelector('input[name="username"]').value;
        const nama = document.querySelector('input[name="nama_petugas"]').value;
        const level = document.querySelector('select[name="level"]').value;
        
        if (username && nama && level) {
            const levelText = level === 'admin' ? 'Administrator' : 'Petugas';
            const confirmMsg = `Apakah data petugas berikut sudah benar?\n\nUsername: ${username}\nNama: ${nama}\nLevel: ${levelText}\n\nData akan disimpan.`;
            if (!confirm(confirmMsg)) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endsection