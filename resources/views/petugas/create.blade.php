<!-- resources/views/petugas/create.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Tambah Data Petugas</h2>
        <p class="section-subtitle">Masukkan informasi petugas/admin baru</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Form Tambah Petugas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       value="{{ old('username') }}" 
                                       placeholder="Contoh: admin123" 
                                       maxlength="255" 
                                       required>
                                <small class="text-muted">Hanya huruf, angka, dan underscore</small>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Petugas <span class="text-danger">*</span></label>
                                <input type="text" name="nama_petugas" 
                                       class="form-control @error('nama_petugas') is-invalid @enderror" 
                                       value="{{ old('nama_petugas') }}" 
                                       placeholder="Contoh: Budi Santoso" 
                                       maxlength="255" 
                                       minlength="3" 
                                       required>
                                <small class="text-muted">Minimal 3 karakter</small>
                                @error('nama_petugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Level <span class="text-danger">*</span></label>
                            <select name="level" class="form-select @error('level') is-invalid @enderror" required>
                                <option value="">-- Pilih Level --</option>
                                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ old('level') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            </select>
                            <small class="text-muted">
                                <strong>Admin:</strong> Akses penuh semua fitur | 
                                <strong>Petugas:</strong> Hanya transaksi pembayaran
                            </small>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Minimal 6 karakter" 
                                       minlength="6" 
                                       required>
                                <small class="text-muted">Minimal 6 karakter</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" 
                                       class="form-control" 
                                       placeholder="Ketik ulang password" 
                                       minlength="6" 
                                       required>
                                <small class="text-muted">Harus sama dengan password</small>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Catatan:</strong> Username dan password akan digunakan untuk login ke sistem.
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('petugas.index') }}" class="btn btn-secondary">
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
    </div>
</div>
@endsection