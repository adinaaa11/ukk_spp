{{-- Form Input Siswa dengan styling sesuai tema website --}}
<div class="card card-custom">
    <div class="card-header-custom">
        <h5 class="mb-0">
            <i class="fas fa-user-edit me-2"></i>
            {{ isset($siswa) ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($siswa) ? route('siswa.update', $siswa->nisn) : route('siswa.store') }}" 
              method="POST">
            @csrf
            @if(isset($siswa))
                @method('PUT')
            @endif

            <div class="row">
                <!-- NISN -->
                <div class="col-md-6 mb-3">
                    <label for="nisn" class="form-label-custom">
                        <i class="fas fa-id-card me-1"></i>NISN <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control form-control-custom @error('nisn') is-invalid @enderror" 
                           id="nisn" 
                           name="nisn" 
                           value="{{ old('nisn', $siswa->nisn ?? '') }}"
                           {{ isset($siswa) ? 'readonly' : '' }}
                           placeholder="Masukkan NISN"
                           required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIS -->
                <div class="col-md-6 mb-3">
                    <label for="nis" class="form-label-custom">
                        <i class="fas fa-id-badge me-1"></i>NIS <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control form-control-custom @error('nis') is-invalid @enderror" 
                           id="nis" 
                           name="nis" 
                           value="{{ old('nis', $siswa->nis ?? '') }}"
                           placeholder="Masukkan NIS"
                           required>
                    @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="col-md-12 mb-3">
                    <label for="nama" class="form-label-custom">
                        <i class="fas fa-user me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control form-control-custom @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $siswa->nama ?? '') }}"
                           placeholder="Masukkan nama lengkap siswa"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Kelas -->
                <div class="col-md-6 mb-3">
                    <label for="id_kelas" class="form-label-custom">
                        <i class="fas fa-school me-1"></i>Kelas <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-control-custom @error('id_kelas') is-invalid @enderror" 
                            id="id_kelas" 
                            name="id_kelas" 
                            required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" 
                                    {{ old('id_kelas', $siswa->id_kelas ?? '') == $k->id_kelas ? 'selected' : '' }}>
                                {{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SPP -->
                <div class="col-md-6 mb-3">
                    <label for="id_spp" class="form-label-custom">
                        <i class="fas fa-money-bill-wave me-1"></i>Tahun SPP <span class="text-danger">*</span>
                    </label>
                    <select class="form-select form-control-custom @error('id_spp') is-invalid @enderror" 
                            id="id_spp" 
                            name="id_spp" 
                            required>
                        <option value="">-- Pilih Tahun SPP --</option>
                        @foreach($spp as $s)
                            <option value="{{ $s->id_spp }}" 
                                    {{ old('id_spp', $siswa->id_spp ?? '') == $s->id_spp ? 'selected' : '' }}>
                                {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_spp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No. Telepon -->
                <div class="col-md-6 mb-3">
                    <label for="no_telp" class="form-label-custom">
                        <i class="fas fa-phone me-1"></i>No. Telepon <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control form-control-custom @error('no_telp') is-invalid @enderror" 
                           id="no_telp" 
                           name="no_telp" 
                           value="{{ old('no_telp', $siswa->no_telp ?? '') }}"
                           placeholder="Contoh: 08123456789"
                           required>
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="col-md-12 mb-3">
                    <label for="alamat" class="form-label-custom">
                        <i class="fas fa-map-marker-alt me-1"></i>Alamat <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control form-control-custom @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3" 
                              placeholder="Masukkan alamat lengkap siswa"
                              required>{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2 justify-content-end mt-4">
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-2"></i>{{ isset($siswa) ? 'Update Data' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Form Label Custom */
.form-label-custom {
    font-weight: 600;
    color: var(--navy-primary);
    margin-bottom: 0.5rem;
    display: block;
}

/* Form Control Custom dengan tema navy-yellow */
.form-control-custom,
.form-select.form-control-custom {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.form-control-custom:focus,
.form-select.form-control-custom:focus {
    border-color: var(--yellow-accent);
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    outline: none;
}

.form-control-custom:hover:not(:focus),
.form-select.form-control-custom:hover:not(:focus) {
    border-color: var(--navy-primary);
}

/* Invalid Feedback */
.form-control-custom.is-invalid {
    border-color: #dc3545;
}

.form-control-custom.is-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Button Primary Custom */
.btn-primary-custom {
    background: linear-gradient(135deg, var(--navy-primary) 0%, #003366 100%);
    border: none;
    color: var(--yellow-accent);
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 31, 63, 0.2);
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #003366 0%, var(--navy-primary) 100%);
    color: var(--yellow-hover);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 31, 63, 0.3);
}

.btn-primary-custom:active {
    transform: translateY(0);
}

/* Button Secondary */
.btn-secondary {
    background: #6c757d;
    border: none;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

/* Card Custom Headers */
.card-custom {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.card-header-custom {
    background: linear-gradient(135deg, var(--navy-primary) 0%, #003366 100%);
    color: var(--yellow-accent);
    padding: 1.25rem 1.5rem;
    border: none;
}

.card-header-custom h5 {
    margin: 0;
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
    .form-control-custom,
    .form-select.form-control-custom {
        font-size: 0.9rem;
        padding: 0.65rem 0.9rem;
    }
    
    .btn-primary-custom,
    .btn-secondary {
        padding: 0.65rem 1.5rem;
        font-size: 0.9rem;
    }
}
</style>