<!-- resources/views/spp/create.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Tambah Data SPP</h2>
        <p class="section-subtitle">Masukkan informasi SPP baru</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-money-check-alt me-2"></i>Form Tambah SPP</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('spp.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" 
                                   class="form-control @error('tahun') is-invalid @enderror" 
                                   value="{{ old('tahun', date('Y')) }}" 
                                   placeholder="Contoh: 2025" 
                                   min="2020" 
                                   max="2030" 
                                   required>
                            <small class="text-muted">Tahun ajaran SPP (4 digit)</small>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nominal <span class="text-danger">*</span></label>
                            <select name="nominal" class="form-select @error('nominal') is-invalid @enderror" required>
                                <option value="">-- Pilih Nominal --</option>
                                <option value="75000" {{ old('nominal') == '75000' ? 'selected' : '' }}>Rp 75.000</option>
                                <option value="100000" {{ old('nominal') == '100000' ? 'selected' : '' }}>Rp 100.000</option>
                                <option value="175000" {{ old('nominal') == '175000' ? 'selected' : '' }}>Rp 175.000</option>
                            </select>
                            <small class="text-muted">Pilih salah satu nominal SPP yang tersedia</small>
                            @error('nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('spp.index') }}" class="btn btn-secondary">
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
                <div class="card-body p-4">
                    <h5 class="mb-3 fw-bold"><i class="fas fa-info-circle me-2"></i>Informasi SPP</h5>
                    <ul class="ps-3 mb-0">
                        <li class="mb-2">SPP adalah biaya yang dibayarkan siswa setiap bulan</li>
                        <li class="mb-2">Pilih tahun ajaran yang sesuai</li>
                        <li class="mb-2">Nominal SPP tersedia dalam 3 pilihan:
                            <ul class="mt-2">
                                <li>Rp 75.000 / bulan</li>
                                <li>Rp 100.000 / bulan</li>
                                <li>Rp 175.000 / bulan</li>
                            </ul>
                        </li>
                        <li class="mb-2">Data SPP dapat diedit kapan saja</li>
                        <li>Pastikan data yang diinput sudah benar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection