@extends ('bagianAwal.main')

@section('title', 'Payment Menu')

@section('content')
<style>
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container my-5 fade-in">

    <div class="row">
        <div class="col-md-8 offset-md-2">

            <h3 class="mb-4 text-center fw-bold">Payment Menu</h3>

            @if(session('success'))
                <div class="alert alert-success fade-in">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm mb-4 fade-in">
                <div class="card-body">
                    <h5 class="card-title">Booking Details</h5>
                    <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
                    <p><strong>Package:</strong> {{ ucfirst($booking->package_name) }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                    <p><strong>Estimated Amount:</strong> Rp {{ number_format($amount ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>

            @if(empty($payment))
            <form method="POST" action="{{ route('payment.create', ['booking' => $booking->id]) }}">
                @csrf
                <button class="btn btn-primary w-100 fade-in">Proceed to Payment (QRIS)</button>
            </form>

            @else
            <div class="card shadow fade-in">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">QRIS Payment</h5>

                    <img src="https://via.placeholder.com/300x300.png?text=QRIS" 
                         class="img-fluid mb-3" style="max-width:300px;">

                    <p><strong>Payment ID:</strong> {{ $payment->id }}</p>

                    <p><strong>Status:</strong>
                        @if($payment->status === 'paid')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </p>

                    <p class="small text-muted">
                        Scan the QR code above using your QRIS-supported payment app.
                    </p>

                    @if($payment->status !== 'paid')
                    <form method="POST" action="{{ route('payment.confirm', ['payment' => $payment->id]) }}">
                        @csrf
                        <button class="btn btn-success mt-3 w-100">Simulate Payment Confirmation</button>
                    </form>
                    @endif

                    <a href="{{ route('payment.history') }}" class="btn btn-link mt-2">View Transaction History</a>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>
@endsection
