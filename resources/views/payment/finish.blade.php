@extends('bagianAwal.main')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow border-0 text-center p-4">
                <div class="card-body">

                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
                    </div>

                    <h3 class="fw-bold text-success">Pembayaran Berhasil 🎉</h3>

                    <p class="text-muted mt-3">
                        Terima kasih! Pembayaran Anda telah berhasil diproses.
                    </p>

                    <hr>

                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('payment.history') }}" class="btn btn-success">
                            Lihat Riwayat Pembayaran
                        </a>

                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                            Kembali ke Dashboard
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
