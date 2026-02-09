@extends('layouts.main')

@section('title', 'Entri Pembayaran')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0" style="border-radius:15px">
        <div class="card-header text-white"
             style="background:linear-gradient(135deg,#003366, #003366);border-radius:15px 15px 0 0">
            <h5 class="mb-0">
                <i class="bi bi-cash-coin me-2"></i> Entri Pembayaran SPP
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('pembayaran.store') }}" method="POST" id="formPembayaran">
                @csrf

                <div class="row g-3">

                    <!-- SISWA -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Siswa</label>
                        <select name="nisn" id="nisn" class="form-select" required onchange="updateNominal()">
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
                        <label class="form-label fw-semibold">Petugas</label>
                        <select name="id_petugas" class="form-select" required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach($petugas as $p)
                                <option value="{{ $p->id_petugas }}">{{ $p->nama_petugas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- TANGGAL -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal Bayar</label>
                        <input type="date" name="tgl_bayar" class="form-control"
                               value="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- TAHUN -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tahun Dibayar</label>
                        <select name="tahun_dibayar" class="form-select" required>
                            @for($i = $tahunSekarang; $i >= $tahunSekarang - 3; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- JUMLAH -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Total Bayar</label>
                        <input type="number" id="jumlah_bayar" class="form-control fw-bold text-primary"
                               readonly required>
                    </div>

                </div>

                <!-- BULAN -->
                <hr class="my-4">
                <label class="form-label fw-semibold">Bulan Dibayar</label>
                <div class="row">
                    @foreach($bulan as $b)
                        <div class="col-md-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input bulan-checkbox"
                                       type="checkbox"
                                       name="bulan_dibayar[]"
                                       value="{{ $b }}"
                                       onchange="hitungTotal()">
                                <label class="form-check-label">{{ $b }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="metode_pembayaran" value="tunai">

                <div class="text-end mt-4">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Pembayaran
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

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
