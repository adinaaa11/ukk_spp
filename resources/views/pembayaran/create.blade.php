@extends('layouts.main')

@section('title', 'Entri Pembayaran')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="section-title">Entri Pembayaran SPP</h2>
        <p class="section-subtitle">Input pembayaran SPP siswa</p>
    </div>

    <div class="row">
        <!-- Form Input -->
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i>Form Pembayaran
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
                        @csrf

                        <!-- Pilih Siswa -->
                        <div class="mb-3">
                            <label for="nisn" class="form-label-custom">
                                <i class="fas fa-user me-1"></i>Pilih Siswa <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-control-custom @error('nisn') is-invalid @enderror" 
                                    id="nisn" 
                                    name="nisn" 
                                    required
                                    onchange="getSiswaDetail(this.value)">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($siswa as $s)
                                    <option value="{{ $s->nisn }}" 
                                            data-nominal="{{ $s->spp->nominal ?? 0 }}"
                                            {{ old('nisn') == $s->nisn ? 'selected' : '' }}>
                                        {{ $s->nisn }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Tanggal Bayar -->
                            <div class="col-md-6 mb-3">
                                <label for="tgl_bayar" class="form-label-custom">
                                    <i class="fas fa-calendar me-1"></i>Tanggal Bayar <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control form-control-custom @error('tgl_bayar') is-invalid @enderror" 
                                       id="tgl_bayar" 
                                       name="tgl_bayar" 
                                       value="{{ old('tgl_bayar', date('Y-m-d')) }}"
                                       required>
                                @error('tgl_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Petugas -->
                            <div class="col-md-6 mb-3">
                                <label for="id_petugas" class="form-label-custom">
                                    <i class="fas fa-user-tie me-1"></i>Petugas <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-control-custom @error('id_petugas') is-invalid @enderror" 
                                        id="id_petugas" 
                                        name="id_petugas" 
                                        required>
                                    <option value="">-- Pilih Petugas --</option>
                                    @foreach($petugas as $p)
                                        <option value="{{ $p->id_petugas }}" {{ old('id_petugas') == $p->id_petugas ? 'selected' : '' }}>
                                            {{ $p->nama_petugas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_petugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Bulan Dibayar -->
                            <div class="col-md-6 mb-3">
                                <label for="bulan_dibayar" class="form-label-custom">
                                    <i class="fas fa-calendar-alt me-1"></i>Bulan Dibayar <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-control-custom @error('bulan_dibayar') is-invalid @enderror" 
                                        id="bulan_dibayar" 
                                        name="bulan_dibayar" 
                                        required>
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach($bulan as $b)
                                        <option value="{{ $b }}" {{ old('bulan_dibayar') == $b ? 'selected' : '' }}>
                                            {{ $b }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bulan_dibayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tahun Dibayar -->
                            <div class="col-md-6 mb-3">
                                <label for="tahun_dibayar" class="form-label-custom">
                                    <i class="fas fa-calendar-check me-1"></i>Tahun Dibayar <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-control-custom @error('tahun_dibayar') is-invalid @enderror" 
                                        id="tahun_dibayar" 
                                        name="tahun_dibayar" 
                                        required>
                                    <option value="">-- Pilih Tahun --</option>
                                    @for($i = $tahunSekarang; $i >= $tahunSekarang - 3; $i--)
                                        <option value="{{ $i }}" {{ old('tahun_dibayar', $tahunSekarang) == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun_dibayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Jumlah Bayar -->
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_bayar" class="form-label-custom">
                                    <i class="fas fa-money-bill me-1"></i>Jumlah Bayar <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control form-control-custom @error('jumlah_bayar') is-invalid @enderror" 
                                       id="jumlah_bayar" 
                                       name="jumlah_bayar" 
                                       value="{{ old('jumlah_bayar') }}"
                                       placeholder="Masukkan jumlah pembayaran"
                                       min="0"
                                       required>
                                @error('jumlah_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Nominal SPP: <span id="nominalSpp" class="fw-bold text-success">-</span></small>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="col-md-6 mb-3">
                                <label for="metode_pembayaran" class="form-label-custom">
                                    <i class="fas fa-credit-card me-1"></i>Metode Pembayaran <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-control-custom @error('metode_pembayaran') is-invalid @enderror" 
                                        id="metode_pembayaran" 
                                        name="metode_pembayaran" 
                                        required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                                @error('metode_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-save me-2"></i>Simpan Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Siswa (Sidebar) -->
        <div class="col-md-4">
            <div class="card card-custom" id="siswaInfoCard" style="display: none;">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Info Siswa
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="" 
                             id="siswaAvatar" 
                             class="rounded-circle" 
                             alt="Avatar"
                             style="width: 100px; height: 100px; border: 3px solid var(--yellow-accent);">
                    </div>
                    
                    <div class="mb-2">
                        <small class="text-muted">Nama Siswa</small>
                        <p class="mb-0 fw-bold" id="siswaNama">-</p>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">NIS</small>
                        <p class="mb-0" id="siswaNis">-</p>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Kelas</small>
                        <p class="mb-0" id="siswaKelas">-</p>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Kompetensi Keahlian</small>
                        <p class="mb-0" id="siswaJurusan">-</p>
                    </div>
                    
                    <hr>
                    
                    <div class="p-3 text-center" style="background: #f8f9fa; border-radius: 8px; border-left: 4px solid var(--navy-primary);">
                        <small class="text-muted d-block">Nominal SPP/Bulan</small>
                        <h4 class="mb-0 text-success" id="siswaSppdisplay">-</h4>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pembayaran Siswa -->
            <div class="card card-custom mt-3" id="riwayatCard" style="display: none;">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>Riwayat Pembayaran
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div id="riwayatList" class="list-group list-group-flush">
                        <!-- Akan diisi via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function getSiswaDetail(nisn) {
    if (!nisn) {
        document.getElementById('siswaInfoCard').style.display = 'none';
        document.getElementById('riwayatCard').style.display = 'none';
        document.getElementById('nominalSpp').textContent = '-';
        document.getElementById('jumlah_bayar').value = '';
        return;
    }

    // Ambil nominal dari option yang dipilih
    const selectedOption = document.querySelector('#nisn option:checked');
    const nominal = selectedOption.getAttribute('data-nominal');
    
    // Set jumlah bayar otomatis
    document.getElementById('jumlah_bayar').value = nominal;
    document.getElementById('nominalSpp').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(nominal);

    // Tampilkan info siswa card
    document.getElementById('siswaInfoCard').style.display = 'block';

    // Update info siswa di sidebar menggunakan data dari select option
    const siswaData = @json($siswa);
    const siswa = siswaData.find(s => s.nisn == nisn);
    
    if (siswa) {
        document.getElementById('siswaAvatar').src = `https://ui-avatars.com/api/?name=${siswa.nama}&background=001f3f&color=FFD700&size=200`;
        document.getElementById('siswaNama').textContent = siswa.nama;
        document.getElementById('siswaNis').textContent = siswa.nis;
        document.getElementById('siswaKelas').textContent = siswa.kelas ? siswa.kelas.nama_kelas : '-';
        document.getElementById('siswaJurusan').textContent = siswa.kelas ? siswa.kelas.kompetensi_keahlian : '-';
        document.getElementById('siswaSppdisplay').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(siswa.spp ? siswa.spp.nominal : 0);
        
        // Load riwayat pembayaran
        loadRiwayatPembayaran(nisn);
    }
}

function loadRiwayatPembayaran(nisn) {
    const riwayatCard = document.getElementById('riwayatCard');
    const riwayatList = document.getElementById('riwayatList');
    
    // Ambil data pembayaran siswa dari blade
    const siswaData = @json($siswa);
    const siswa = siswaData.find(s => s.nisn == nisn);
    
    if (siswa && siswa.pembayaran && siswa.pembayaran.length > 0) {
        riwayatCard.style.display = 'block';
        
        let html = '';
        siswa.pembayaran.slice(0, 5).forEach(p => {
            html += `
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary">${p.bulan_dibayar} ${p.tahun_dibayar}</span>
                        </div>
                        <div class="text-success fw-bold">
                            Rp ${new Intl.NumberFormat('id-ID').format(p.jumlah_bayar)}
                        </div>
                    </div>
                    <small class="text-muted">${new Date(p.tgl_bayar).toLocaleDateString('id-ID')}</small>
                </div>
            `;
        });
        
        if (siswa.pembayaran.length > 5) {
            html += `<div class="list-group-item text-center"><small class="text-muted">+${siswa.pembayaran.length - 5} pembayaran lainnya</small></div>`;
        }
        
        riwayatList.innerHTML = html;
    } else {
        riwayatCard.style.display = 'none';
    }
}
</script>

<style>
/* Form Label Custom */
.form-label-custom {
    font-weight: 600;
    color: var(--navy-primary);
    margin-bottom: 0.5rem;
    display: block;
}

/* Form Control Custom */
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

.form-control-custom.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
}

/* Card Custom */
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

/* Button Styles */
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

.section-title {
    color: var(--navy-primary);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}
</style>
@endsection