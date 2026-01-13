<!-- resources/views/spp/edit.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Edit Data SPP</h2>
        <p class="section-subtitle">Perbarui informasi SPP</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Form Edit SPP</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('spp.update', $spp->id_spp) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" 
                                   class="form-control @error('tahun') is-invalid @enderror" 
                                   value="{{ old('tahun', $spp->tahun) }}" 
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
                                <option value="75000" {{ old('nominal', $spp->nominal) == 75000 ? 'selected' : '' }}>Rp 75.000</option>
                                <option value="100000" {{ old('nominal', $spp->nominal) == 100000 ? 'selected' : '' }}>Rp 100.000</option>
                                <option value="175000" {{ old('nominal', $spp->nominal) == 175000 ? 'selected' : '' }}>Rp 175.000</option>
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
                        <i class="fas fa-money-check-alt fa-4x" style="color: var(--navy-primary);"></i>
                    </div>
                    <h5 class="fw-bold">Data SPP Saat Ini</h5>
                    <hr>
                    <div class="row text-center">
                        <div class="col-6">
                            <h6 class="text-muted">Tahun</h6>
                            <h3 style="color: var(--navy-primary);">{{ $spp->tahun }}</h3>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted">Nominal</h6>
                            <h3 class="text-success">Rp {{ number_format($spp->nominal, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="text-start">
                        <p class="mb-1"><strong>Jumlah Siswa Menggunakan SPP Ini:</strong></p>
                        <h4 style="color: var(--navy-primary);">{{ $spp->siswa->count() }} Siswa</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection