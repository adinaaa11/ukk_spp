@extends('layouts.main')

@section('title', 'Input Pembayaran SPP')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-navy text-white py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i>Input Pembayaran SPP
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('pembayaran.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Pilih Siswa -->
                            <div class="col-md-6">
                                <label for="nisn" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-user-graduate text-navy me-2"></i>Pilih Siswa (NISN)
                                </label>
                                <select name="nisn" 
                                        id="nisn" 
                                        class="form-select @error('nisn') is-invalid @enderror" 
                                        required
                                        style="font-size: 14px; padding: 10px 12px;">
                                    <option value="">-- Pilih Siswa --</option>
                                    @foreach($siswa as $s)
                                        <option value="{{ $s->nisn }}" {{ old('nisn') == $s->nisn ? 'selected' : '' }}>
                                            {{ $s->nisn }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('nisn')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal Bayar -->
                            <div class="col-md-6">
                                <label for="tgl_bayar" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-calendar-alt text-navy me-2"></i>Tanggal Bayar
                                </label>
                                <input type="date" 
                                       name="tgl_bayar" 
                                       id="tgl_bayar" 
                                       class="form-control @error('tgl_bayar') is-invalid @enderror"
                                       value="{{ old('tgl_bayar', date('Y-m-d')) }}"
                                       required
                                       style="font-size: 14px; padding: 10px 12px;">
                                @error('tgl_bayar')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bulan Dibayar -->
                            <div class="col-md-6">
                                <label for="bulan_dibayar" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-calendar-day text-navy me-2"></i>Bulan Dibayar
                                </label>
                                <select name="bulan_dibayar" 
                                        id="bulan_dibayar" 
                                        class="form-select @error('bulan_dibayar') is-invalid @enderror" 
                                        required
                                        style="font-size: 14px; padding: 10px 12px;">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="Januari" {{ old('bulan_dibayar') == 'Januari' ? 'selected' : '' }}>Januari</option>
                                    <option value="Februari" {{ old('bulan_dibayar') == 'Februari' ? 'selected' : '' }}>Februari</option>
                                    <option value="Maret" {{ old('bulan_dibayar') == 'Maret' ? 'selected' : '' }}>Maret</option>
                                    <option value="April" {{ old('bulan_dibayar') == 'April' ? 'selected' : '' }}>April</option>
                                    <option value="Mei" {{ old('bulan_dibayar') == 'Mei' ? 'selected' : '' }}>Mei</option>
                                    <option value="Juni" {{ old('bulan_dibayar') == 'Juni' ? 'selected' : '' }}>Juni</option>
                                    <option value="Juli" {{ old('bulan_dibayar') == 'Juli' ? 'selected' : '' }}>Juli</option>
                                    <option value="Agustus" {{ old('bulan_dibayar') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                    <option value="September" {{ old('bulan_dibayar') == 'September' ? 'selected' : '' }}>September</option>
                                    <option value="Oktober" {{ old('bulan_dibayar') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                    <option value="November" {{ old('bulan_dibayar') == 'November' ? 'selected' : '' }}>November</option>
                                    <option value="Desember" {{ old('bulan_dibayar') == 'Desember' ? 'selected' : '' }}>Desember</option>
                                </select>
                                @error('bulan_dibayar')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tahun Dibayar -->
                            <div class="col-md-6">
                                <label for="tahun_dibayar" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-calendar text-navy me-2"></i>Tahun Dibayar
                                </label>
                                <select name="tahun_dibayar" 
                                        id="tahun_dibayar" 
                                        class="form-select @error('tahun_dibayar') is-invalid @enderror" 
                                        required
                                        style="font-size: 14px; padding: 10px 12px;">
                                    <option value="">-- Pilih Tahun --</option>
                                    @for($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}" {{ old('tahun_dibayar', date('Y')) == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun_dibayar')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ID SPP -->
                            <div class="col-md-6">
                                <label for="id_spp" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-file-invoice-dollar text-navy me-2"></i>Pilih Tarif SPP
                                </label>
                                <select name="id_spp" 
                                        id="id_spp" 
                                        class="form-select @error('id_spp') is-invalid @enderror" 
                                        required
                                        style="font-size: 14px; padding: 10px 12px;">
                                    <option value="">-- Pilih Tarif SPP --</option>
                                    @foreach($spp as $s)
                                        <option value="{{ $s->id_spp }}" {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
                                            {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_spp')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jumlah Bayar -->
                            <div class="col-md-6">
                                <label for="jumlah_bayar" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-money-bill-wave text-navy me-2"></i>Jumlah Bayar
                                </label>
                                <input type="number" 
                                       name="jumlah_bayar" 
                                       id="jumlah_bayar" 
                                       class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                       placeholder="Masukkan jumlah pembayaran"
                                       value="{{ old('jumlah_bayar') }}"
                                       required
                                       style="font-size: 14px; padding: 10px 12px;">
                                @error('jumlah_bayar')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Metode Pembayaran (Hanya Tunai) -->
                            <div class="col-md-12">
                                <label for="metode_pembayaran" class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-cash-register text-navy me-2"></i>Metode Pembayaran
                                </label>
                                <div class="form-check p-3" style="border: 2px solid #e0e0e0; border-radius: 10px; background: #f8f9fa;">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="metode_pembayaran" 
                                           id="metode_tunai" 
                                           value="tunai" 
                                           checked
                                           style="width: 18px; height: 18px; margin-top: 4px;">
                                    <label class="form-check-label ms-2" for="metode_tunai" style="font-size: 14px;">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <strong>Tunai</strong>
                                        <small class="text-muted d-block mt-1" style="font-size: 12px;">Pembayaran langsung dengan uang tunai</small>
                                    </label>
                                </div>
                                @error('metode_pembayaran')
                                    <div class="text-danger mt-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('pembayaran.index') }}" 
                                       class="btn btn-secondary px-4 py-2"
                                       style="font-size: 14px;">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" 
                                            class="btn btn-primary px-4 py-2"
                                            style="font-size: 14px; background: linear-gradient(135deg, #001f3f 0%, #001529 100%); border: none;">
                                        <i class="fas fa-save me-2"></i>Simpan Pembayaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-navy {
        background: linear-gradient(135deg, #001f3f 0%, #001529 100%);
    }
    
    .text-navy {
        color: #001f3f;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #FFD700;
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #001f3f;
        border-color: #001f3f;
    }
    
    .btn-primary:hover,
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 31, 63, 0.3) !important;
    }
</style>
@endsection