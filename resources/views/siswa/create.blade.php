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
                    <h5 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Form Tambah Siswa
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf

                        {{-- NISN & NIS --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror"
                                    value="{{ old('nisn') }}"
                                    placeholder="Contoh: 0012345678"
                                    maxlength="10" pattern="[0-9]{10}" required>
                                <small class="text-muted">10 digit angka</small>
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NIS <span class="text-danger">*</span></label>
                                <input type="text" name="nis"
                                    class="form-control @error('nis') is-invalid @enderror"
                                    value="{{ old('nis') }}"
                                    placeholder="Contoh: 12345678"
                                    maxlength="8" pattern="[0-9]{8}" required>
                                <small class="text-muted">8 digit angka</small>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap"
                                minlength="3" maxlength="35" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kelas & Jurusan --}}
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                <select name="tingkat_kelas"
                                    class="form-select @error('tingkat_kelas') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" {{ old('tingkat_kelas') == 'X' ? 'selected' : '' }}>X</option>
                                    <option value="XI" {{ old('tingkat_kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                                    <option value="XII" {{ old('tingkat_kelas') == 'XII' ? 'selected' : '' }}>XII</option>
                                </select>
                                @error('tingkat_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-bold">Jurusan <span class="text-danger">*</span></label>
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
                                @error('id_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- SPP --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nominal SPP <span class="text-danger">*</span></label>
                            <select name="id_spp"
                                class="form-select @error('id_spp') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Nominal SPP --</option>
                                @foreach($spp as $s)
                                    <option value="{{ $s->id_spp }}"
                                        {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
                                        Rp {{ number_format($s->nominal, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_spp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                rows="3"
                                minlength="10"
                                placeholder="Masukkan alamat lengkap"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- No Telp --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp"
                                class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp') }}"
                                placeholder="Contoh: 081234567890"
                                maxlength="13" pattern="[0-9]+" required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Info --}}
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Username siswa = <strong>NISN</strong><br>
                            Password default = <strong>siswa123</strong>
                        </div>

                        <hr>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Validasi input angka --}}
<script>
document.querySelectorAll('input[pattern]').forEach(input => {
    input.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
@endsection
