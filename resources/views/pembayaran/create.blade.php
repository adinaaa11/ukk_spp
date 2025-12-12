@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom mt-5">
                <div class="card-body text-center p-5">
                    <div class="display-1 text-primary mb-3">
                        <i class="fas fa-user-graduate" style="color: var(--navy-primary);"></i>
                    </div>
                    <h3 class="mb-4 fw-bold" style="color: var(--navy-primary);">Mulai Transaksi Pembayaran</h3>
                    <p class="text-muted mb-4">Masukkan NISN Siswa untuk melakukan pengecekan data dan pembayaran SPP.</p>
                    
                    <form action="{{ route('pembayaran.cari') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="nisn" class="form-control form-control-lg" placeholder="Contoh: 1234567890" required>
                            <button class="btn btn-navy px-4" type="submit">
                                <i class="fas fa-search me-2"></i> Cari Siswa
                            </button>
                        </div>
                    </form>
                    
                    @if(session('error'))
                        <div class="alert alert-danger mt-3 rounded-pill">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection