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
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                <select name="tingkat_kelas" id="tingkat_kelas" class="form-select" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>

                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-bold">Jurusan <span class="text-danger">*</span></label>
                                <select name="id_kelas" id="jurusan" class="form-select @error('id_kelas') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kelas Dulu --</option>
                                </select>
                                @error('id_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nominal SPP <span class="text-danger">*</span></label>
                            <select name="id_spp" class="form-select @error('id_spp') is-invalid @enderror" required>
                                <option value="">-- Pilih Nominal SPP --</option>
                                @foreach($spp as $s)
                                <option value="{{ $s->id_spp }}">
                                    Rp {{ number_format($s->nominal, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Pilih nominal: Rp 75.000, Rp 100.000, atau Rp 175.000</small>
                            @error('id_spp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
            <div class="card card-custom" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white;">
                <div class="card-body p-4">
                    <h5 class="mb-3 fw-bold"><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                    <ul class="ps-3 mb-0">
                        <li class="mb-2"><strong>Kelas X:</strong> RPL 1, RPL 2</li>
                        <li class="mb-2"><strong>Kelas XI & XII:</strong> RPL, MKT, TKJ, DKV, TPM 1-2, TL 1-2, TBKR, TKR 1-2, APHP 1-3, ATPH 1-2</li>
                        <li class="mb-2"><strong>SPP:</strong> Rp 75.000, Rp 100.000, Rp 175.000</li>
                        <li>Semua field wajib diisi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Data kelas dari database
const kelasData = @json($kelas->mapWithKeys(function($item) {
    return [$item->nama_kelas => $item->id_kelas];
}));

// Jurusan per tingkat
const jurusanPerTingkat = {
    'X': ['X RPL 1', 'X RPL 2'],
    'XI': ['XI RPL', 'XI MKT', 'XI TKJ', 'XI DKV', 'XI TPM 1', 'XI TPM 2', 'XI TL 1', 'XI TL 2', 'XI TBKR', 'XI TKR 1', 'XI TKR 2', 'XI APHP 1', 'XI APHP 2', 'XI APHP 3', 'XI ATPH 1', 'XI ATPH 2'],
    'XII': ['XII RPL', 'XII MKT', 'XII TKJ', 'XII DKV', 'XII TPM 1', 'XII TPM 2', 'XII TL 1', 'XII TL 2', 'XII TBKR', 'XII TKR 1', 'XII TKR 2', 'XII APHP 1', 'XII APHP 2', 'XII APHP 3', 'XII ATPH 1', 'XII ATPH 2']
};

// Update dropdown jurusan
document.getElementById('tingkat_kelas').addEventListener('change', function() {
    const tingkat = this.value;
    const jurusanSelect = document.getElementById('jurusan');
    
    jurusanSelect.innerHTML = '<option value="">-- Pilih Jurusan --</option>';
    
    if (tingkat && jurusanPerTingkat[tingkat]) {
        jurusanPerTingkat[tingkat].forEach(namaKelas => {
            if (kelasData[namaKelas]) {
                const option = document.createElement('option');
                option.value = kelasData[namaKelas];
                option.textContent = namaKelas;
                jurusanSelect.appendChild(option);
            }
        });
    }
});

// Validasi hanya angka
document.querySelectorAll('input[pattern*="[0-9]"]').forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
@endsection