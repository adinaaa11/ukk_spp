@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2 class="section-title">Edit Data Siswa</h2>
        <p class="section-subtitle">Perbarui informasi siswa</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Form Edit Data Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.update', $siswa->nisn) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" 
                                       value="{{ old('nisn', $siswa->nisn) }}" placeholder="Contoh: 0012345678" maxlength="10" required>
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIS <span class="text-danger">*</span></label>
                                <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" 
                                       value="{{ old('nis', $siswa->nis) }}" placeholder="Contoh: 12345678" maxlength="8" required>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', $siswa->nama) }}" placeholder="Masukkan nama lengkap" required>
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
                                    <option value="{{ $k->id_kelas }}" {{ old('id_kelas', $siswa->id_kelas) == $k->id_kelas ? 'selected' : '' }}>
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
                                    <option value="{{ $s->id_spp }}" {{ old('id_spp', $siswa->id_spp) == $s->id_spp ? 'selected' : '' }}>
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
                                      rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" 
                                   value="{{ old('no_telp', $siswa->no_telp) }}" placeholder="Contoh: 081234567890" maxlength="13" required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
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

        <div class="col-md-4">
            <div class="card card-custom text-center">
                <div class="card-body">
                    <img src="https://ui-avatars.com/api/?name={{ $siswa->nama }}&background=3498db&color=fff&size=150" 
                         class="rounded-circle mb-3" alt="Avatar">
                    <h5 class="fw-bold">{{ $siswa->nama }}</h5>
                    <p class="text-muted mb-1">{{ $siswa->nisn }}</p>
                    <span class="badge bg-info">{{ $siswa->kelas->nama_kelas }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection