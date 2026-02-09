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
                    <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
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
                                        <option value="{{ $s->nisn }}" 
                                                data-spp="{{ $s->spp->nominal ?? 0 }}"
                                                {{ old('nisn') == $s->nisn ? 'selected' : '' }}>
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
                                        <option value="{{ $s->id_spp }}" 
                                                data-nominal="{{ $s->nominal }}"
                                                {{ old('id_spp') == $s->id_spp ? 'selected' : '' }}>
                                            {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_spp')
                                    <div class="invalid-feedback" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bulan Dibayar (MULTIPLE SELECT) -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold" style="font-size: 14px;">
                                    <i class="fas fa-calendar-day text-navy me-2"></i>Pilih Bulan yang Dibayar
                                    <span class="badge bg-info ms-2" style="font-size: 12px;">Bisa pilih lebih dari 1 bulan</span>
                                </label>
                                <div class="row g-2">
                                    @php
                                        $bulanList = [
                                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                        ];
                                    @endphp
                                    @foreach($bulanList as $index => $bulan)
                                        <div class="col-md-3 col-sm-4 col-6">
                                            <div class="form-check form-check-custom">
                                                <input class="form-check-input bulan-checkbox" 
                                                       type="checkbox" 
                                                       name="bulan_dibayar[]" 
                                                       value="{{ $bulan }}" 
                                                       id="bulan_{{ $index }}"
                                                       style="width: 20px; height: 20px; margin-top: 2px;">
                                                <label class="form-check-label ms-2" for="bulan_{{ $index }}" style="font-size: 15px; cursor: pointer;">
                                                    {{ $bulan }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('bulan_dibayar')
                                    <div class="text-danger mt-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle me-1"></i>Centang bulan-bulan yang akan dibayar. Total pembayaran akan dihitung otomatis.
                                </small>
                            </div>

                            <!-- Ringkasan Pembayaran -->
                            <div class="col-md-12">
                                <div class="alert alert-warning" style="font-size: 14px; border-radius: 10px; padding: 20px; background: #fff3cd; border: 2px solid #ffc107;">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <strong><i class="fas fa-calculator me-2"></i>Jumlah Bulan:</strong>
                                            <div class="h4 mb-0 mt-1 text-primary" id="jumlahBulan">0 bulan</div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <strong><i class="fas fa-money-bill me-2"></i>SPP per Bulan:</strong>
                                            <div class="h4 mb-0 mt-1 text-success" id="nominalPerBulan">Rp 0</div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <strong><i class="fas fa-wallet me-2"></i>Total Pembayaran:</strong>
                                            <div class="h3 mb-0 mt-1 text-danger" id="totalPembayaran">Rp 0</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="jumlah_bayar" id="jumlah_bayar" value="0">
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
                                            id="btnSubmit"
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
    
    .form-check-custom {
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        transition: all 0.3s;
    }
    
    .form-check-custom:hover {
        border-color: #FFD700;
        background: #fffef7;
    }
    
    .form-check-custom .form-check-input:checked ~ .form-check-label {
        color: #001f3f;
        font-weight: 600;
    }
    
    .btn-primary:hover,
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 31, 63, 0.3) !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.bulan-checkbox');
    const jumlahBulanEl = document.getElementById('jumlahBulan');
    const nominalPerBulanEl = document.getElementById('nominalPerBulan');
    const totalPembayaranEl = document.getElementById('totalPembayaran');
    const jumlahBayarInput = document.getElementById('jumlah_bayar');
    const sppSelect = document.getElementById('id_spp');
    const siswaSelect = document.getElementById('nisn');
    const btnSubmit = document.getElementById('btnSubmit');
    const formPembayaran = document.getElementById('formPembayaran');
    
    let nominalSpp = 0;
    
    // Update nominal SPP ketika pilih siswa atau SPP
    function updateNominalSpp() {
        const selectedSpp = sppSelect.options[sppSelect.selectedIndex];
        if (selectedSpp && selectedSpp.dataset.nominal) {
            nominalSpp = parseInt(selectedSpp.dataset.nominal);
        } else {
            nominalSpp = 0;
        }
        hitungTotal();
    }
    
    sppSelect.addEventListener('change', updateNominalSpp);
    siswaSelect.addEventListener('change', updateNominalSpp);
    
    // Hitung total pembayaran
    function hitungTotal() {
        const checkedBulan = document.querySelectorAll('.bulan-checkbox:checked');
        const jumlahBulan = checkedBulan.length;
        const total = jumlahBulan * nominalSpp;
        
        // Update tampilan
        jumlahBulanEl.textContent = jumlahBulan + ' bulan';
        nominalPerBulanEl.textContent = 'Rp ' + nominalSpp.toLocaleString('id-ID');
        totalPembayaranEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
        
        // Update hidden input
        jumlahBayarInput.value = total;
        
        // Enable/disable tombol submit
        btnSubmit.disabled = jumlahBulan === 0;
        if (jumlahBulan === 0) {
            btnSubmit.classList.add('disabled');
        } else {
            btnSubmit.classList.remove('disabled');
        }
    }
    
    // Event listener untuk checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', hitungTotal);
    });
    
    // Validasi sebelum submit
    formPembayaran.addEventListener('submit', function(e) {
        const checkedBulan = document.querySelectorAll('.bulan-checkbox:checked');
        
        if (checkedBulan.length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 bulan yang akan dibayar!');
            return false;
        }
        
        if (nominalSpp === 0) {
            e.preventDefault();
            alert('Pilih tarif SPP terlebih dahulu!');
            return false;
        }
        
        const confirmation = confirm(
            'Anda akan membayar SPP untuk ' + checkedBulan.length + ' bulan\n' +
            'Total: Rp ' + (checkedBulan.length * nominalSpp).toLocaleString('id-ID') + '\n\n' +
            'Lanjutkan?'
        );
        
        if (!confirmation) {
            e.preventDefault();
            return false;
        }
    });
    
    // Initial calculation
    updateNominalSpp();
});
</script>
@endsection