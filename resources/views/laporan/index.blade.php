@extends('layouts.main')

@section('title', 'Laporan Pembayaran SPP')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-navy text-white py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1">
                                <i class="fas fa-file-chart-line me-2"></i>Laporan Pembayaran SPP
                            </h3>
                            <p class="mb-0 opacity-75" style="font-size: 15px;">Export data pembayaran ke Excel atau PDF</p>
                        </div>
                        <div>
                            <i class="fas fa-download fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-5">
                    <!-- Form Filter -->
                    <form id="filterForm">
                        <div class="row g-4">
                            <!-- Filter Tanggal Mulai -->
                            <div class="col-md-6">
                                <label for="tanggal_mulai" class="form-label fw-bold" style="font-size: 16px;">
                                    <i class="fas fa-calendar-alt text-navy me-2"></i>Tanggal Mulai
                                </label>
                                <input type="date" 
                                       class="form-control form-control-lg shadow-sm" 
                                       id="tanggal_mulai" 
                                       name="tanggal_mulai"
                                       style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                            </div>

                            <!-- Filter Tanggal Akhir -->
                            <div class="col-md-6">
                                <label for="tanggal_akhir" class="form-label fw-bold" style="font-size: 16px;">
                                    <i class="fas fa-calendar-check text-navy me-2"></i>Tanggal Akhir
                                </label>
                                <input type="date" 
                                       class="form-control form-control-lg shadow-sm" 
                                       id="tanggal_akhir" 
                                       name="tanggal_akhir"
                                       style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                            </div>

                            <!-- Filter Bulan -->
                            <div class="col-md-6">
                                <label for="bulan" class="form-label fw-bold" style="font-size: 16px;">
                                    <i class="fas fa-calendar-day text-navy me-2"></i>Bulan Dibayar
                                </label>
                                <select class="form-select form-select-lg shadow-sm" 
                                        id="bulan" 
                                        name="bulan"
                                        style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                                    <option value="">-- Semua Bulan --</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                            </div>

                            <!-- Filter Tahun -->
                            <div class="col-md-6">
                                <label for="tahun" class="form-label fw-bold" style="font-size: 16px;">
                                    <i class="fas fa-calendar text-navy me-2"></i>Tahun Dibayar
                                </label>
                                <select class="form-select form-select-lg shadow-sm" 
                                        id="tahun" 
                                        name="tahun"
                                        style="font-size: 18px; padding: 15px 20px; border-radius: 10px; border: 2px solid #e0e0e0;">
                                    <option value="">-- Semua Tahun --</option>
                                    @for($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Tombol Download -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-center">
                                    <!-- Tombol Download Excel -->
                                    <button type="button" 
                                            id="btnDownloadExcel" 
                                            class="btn btn-lg btn-success shadow-lg px-5 py-3"
                                            style="font-size: 18px; border-radius: 12px; min-width: 250px;">
                                        <i class="fas fa-file-excel me-2"></i>
                                        <strong>Download Excel</strong>
                                    </button>

                                    <!-- Tombol Download PDF -->
                                    <button type="button" 
                                            id="btnDownloadPDF" 
                                            class="btn btn-lg btn-danger shadow-lg px-5 py-3"
                                            style="font-size: 18px; border-radius: 12px; min-width: 250px;">
                                        <i class="fas fa-file-pdf me-2"></i>
                                        <strong>Download PDF</strong>
                                    </button>

                                    <!-- Tombol Reset -->
                                    <button type="reset" 
                                            class="btn btn-lg btn-secondary shadow-lg px-4 py-3"
                                            style="font-size: 18px; border-radius: 12px;">
                                        <i class="fas fa-redo me-2"></i>
                                        Reset Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Info Box -->
                    <div class="alert alert-info mt-5 shadow-sm" style="font-size: 16px; border-radius: 10px; padding: 20px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fa-2x me-3"></i>
                            <div>
                                <strong>Informasi:</strong>
                                <ul class="mb-0 mt-2" style="line-height: 1.8;">
                                    <li>Pilih filter yang diinginkan atau biarkan kosong untuk mendownload semua data</li>
                                    <li>Format <strong>Excel</strong> untuk analisis data lebih lanjut</li>
                                    <li>Format <strong>PDF</strong> untuk laporan cetak atau dokumentasi</li>
                                    <li>Data akan diurutkan berdasarkan tanggal pembayaran (terbaru terlebih dahulu)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4) !important;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-danger:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4) !important;
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filterForm');
        const btnDownloadExcel = document.getElementById('btnDownloadExcel');
        const btnDownloadPDF = document.getElementById('btnDownloadPDF');

        // Download Excel
        btnDownloadExcel.addEventListener('click', function() {
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            window.location.href = '{{ route("laporan.download.excel") }}?' + params.toString();
        });

        // Download PDF
        btnDownloadPDF.addEventListener('click', function() {
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            window.location.href = '{{ route("laporan.download.pdf") }}?' + params.toString();
        });
    });
</script>
@endsection