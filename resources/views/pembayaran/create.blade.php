@extends('layouts.main')

@section('title', 'Entri Pembayaran')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
        <div class="card-header text-white py-4" 
             style="background: linear-gradient(135deg, var(--navy-primary), var(--navy-dark)); border-radius: 20px 20px 0 0;">
            <h4 class="mb-0 fw-bold" style="color: var(--yellow-accent);">
                <i class="fas fa-cash-register me-2"></i> Entri Pembayaran SPP
            </h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
                @csrf

                <div class="row g-4">

                    <!-- SISWA -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold mb-3" style="color: var(--navy-primary);">
                            <i class="fas fa-user-graduate me-2"></i>Siswa
                        </label>
                        <select name="nisn" id="nisn" class="form-select" style="
                            border: 2px solid #e0e0e0;
                            border-radius: 12px;
                            padding: 12px 15px;
                            font-size: 15px;
                            transition: all 0.3s ease;
                        " required onchange="updateNominal()">
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->nisn }}" data-nominal="{{ $s->spp->nominal ?? 0 }}">
                                    {{ $s->nisn }} - {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- PETUGAS -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold mb-3" style="color: var(--navy-primary);">
                            <i class="fas fa-user-tie me-2"></i>Petugas
                        </label>
                        <select name="id_petugas" class="form-select" style="
                            border: 2px solid #e0e0e0;
                            border-radius: 12px;
                            padding: 12px 15px;
                            font-size: 15px;
                            transition: all 0.3s ease;
                        " required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach($petugas as $p)
                                <option value="{{ $p->id_petugas }}">{{ $p->nama_petugas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- TANGGAL -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold mb-3" style="color: var(--navy-primary);">
                            <i class="fas fa-calendar-alt me-2"></i>Tanggal Bayar
                        </label>
                        <input type="date" name="tgl_bayar" class="form-control" style="
                            border: 2px solid #e0e0e0;
                            border-radius: 12px;
                            padding: 12px 15px;
                            font-size: 15px;
                            transition: all 0.3s ease;
                        " value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- TAHUN -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold mb-3" style="color: var(--navy-primary);">
                            <i class="fas fa-calendar me-2"></i>Tahun Dibayar
                        </label>
                        <select name="tahun_dibayar" class="form-select" style="
                            border: 2px solid #e0e0e0;
                            border-radius: 12px;
                            padding: 12px 15px;
                            font-size: 15px;
                            transition: all 0.3s ease;
                        " required>
                            @for($i = $tahunSekarang; $i >= $tahunSekarang - 3; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- JUMLAH -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold mb-3" style="color: var(--navy-primary);">
                            <i class="fas fa-money-bill-wave me-2"></i>Total Bayar
                        </label>
                        <input type="number" id="jumlah_bayar" class="form-control fw-bold" style="
                            border: 2px solid var(--yellow-accent);
                            border-radius: 12px;
                            padding: 12px 15px;
                            font-size: 16px;
                            background: linear-gradient(145deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05));
                            color: var(--navy-primary);
                            transition: all 0.3s ease;
                        " readonly required>
                    </div>

                </div>

                <!-- BULAN -->
                <hr class="my-4" style="border-color: var(--yellow-accent); opacity: 0.3;">
                <label class="form-label fw-semibold mb-3" style="color: var(--navy-primary);">
                    <i class="fas fa-calendar-check me-2"></i>Bulan Dibayar
                </label>
                <div class="row">
                    @foreach($bulan as $b)
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input bulan-checkbox"
                                       type="checkbox"
                                       name="bulan_dibayar[]"
                                       value="{{ $b }}"
                                       onchange="hitungTotal()"
                                       style="
                                           width: 20px;
                                           height: 20px;
                                           cursor: pointer;
                                           transition: all 0.3s ease;
                                       ">
                                <label class="form-check-label" style="
                                    padding: 8px 15px;
                                    border-radius: 10px;
                                    background: linear-gradient(145deg, #f8f9fa, #e9ecef);
                                    border: 2px solid #e0e0e0;
                                    cursor: pointer;
                                    transition: all 0.3s ease;
                                    font-weight: 600;
                                    display: inline-block;
                                    margin-bottom: 5px;
                                ">
                                    <i class="fas fa-calendar-day me-1"></i>{{ $b }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="metode_pembayaran" value="tunai">

                <div class="text-end mt-4">
                    <button type="submit" class="btn" style="
                        background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
                        color: var(--navy-primary);
                        border: none;
                        padding: 15px 40px;
                        border-radius: 25px;
                        font-weight: 700;
                        font-size: 16px;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        position: relative;
                        overflow: hidden;
                        box-shadow: 0 4px 15px rgba(255,215,0,0.3);
                    ">
                        <i class="fas fa-save me-2"></i> Simpan Pembayaran
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --navy-primary: #001f3f;
        --navy-dark: #001529;
        --yellow-accent: #FFD700;
        --yellow-hover: #FFC000;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: var(--yellow-accent);
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.15);
        outline: none;
    }

    .form-check-input:checked {
        background-color: var(--yellow-accent);
        border-color: var(--yellow-accent);
    }

    .form-check-input:checked + .form-check-label {
        background: linear-gradient(135deg, var(--yellow-accent), var(--yellow-hover));
        color: var(--navy-primary);
        border-color: var(--yellow-accent);
        font-weight: 700;
        transform: scale(1.05);
    }

    .form-check-input:hover + .form-check-label {
        border-color: var(--yellow-accent);
        background: linear-gradient(145deg, rgba(255,215,0,0.1), rgba(255,215,0,0.05));
    }

    .btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(255,215,0,0.4);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(0, 31, 63, 0.1);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }
</style>

<script>
let nominalSpp = 0;

function updateNominal() {
    const selected = document.querySelector('#nisn option:checked');
    nominalSpp = selected ? parseInt(selected.dataset.nominal) : 0;
    hitungTotal();
}

function hitungTotal() {
    const checked = document.querySelectorAll('.bulan-checkbox:checked').length;
    document.getElementById('jumlah_bayar').value = checked * nominalSpp;
}
</script>
@endsection
