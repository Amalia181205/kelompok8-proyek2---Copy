@extends('bagianAwal.main')

@section('title', 'Menu Pembayaran')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Pembayaran - {{ $booking->package_name }}</h4>
                </div>
                
                <div class="card-body">
                    <!-- Informasi Booking -->
                    <div class="mb-4">
                        <h5>Detail Booking</h5>
                        <table class="table table-sm">
                            <tr>
                                <td>ID Booking</td>
                                <td><strong>#{{ $booking->id }}</strong></td>
                            </tr>
                            <tr>
                                <td>Paket</td>
                                <td>{{ $booking->package_name }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td class="fw-bold text-success">Rp {{ number_format($amount, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- JIKA SUDAH LUNAS --}}
                    @if(isset($payment) && $payment->status === 'paid')
                        <div class="alert alert-success text-center">
                            <h5>✅ Pembayaran Berhasil</h5>
                            <p>Order ID: <strong>{{ $payment->order_id }}</strong></p>
                            <p>Status: <span class="badge bg-success">LUNAS</span></p>
                            <a href="{{ route('payment.history') }}" class="btn btn-success mt-2">
                                Lihat Riwayat
                            </a>
                        </div>

                    {{-- JIKA BELUM BAYAR --}}
                    @else
                        <div class="text-center">
                            <form method="GET" action="{{ route('payment.create', $booking->id) }}">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
                                </button>
                            </form>
                            
                            <div class="mt-4">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection