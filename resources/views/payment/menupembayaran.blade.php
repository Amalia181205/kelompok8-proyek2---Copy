{{-- JIKA SUDAH LUNAS --}}
@if(isset($payment) && $payment->status === 'paid')
    <div class="alert alert-success text-center">
        <h5>Pembayaran Berhasil</h5>
        <p>Order ID: <strong>{{ $payment->order_id }}</strong></p>
    </div>

{{-- JIKA BELUM ADA SNAP TOKEN --}}
@elseif(empty($snapToken))
    <form method="POST" action="{{ route('payment.create', $booking->id) }}">
        @csrf
        <button type="submit" class="btn btn-primary w-100">
            Bayar Sekarang
        </button>
    </form>

{{-- JIKA SNAP TOKEN SUDAH ADA --}}
@else
    <div class="card shadow">
        <div class="card-body text-center">
            <h5 class="mb-3">Complete Your Payment</h5>

            <p><strong>Order ID:</strong> {{ $payment->order_id }}</p>

            <p>
                <strong>Status:</strong>
                <span class="badge bg-warning text-dark">
                    {{ ucfirst($payment->status) }}
                </span>
            </p>

            <button id="pay-button" class="btn btn-success w-100 mt-3">
                Bayar dengan Midtrans
            </button>
        </div>
    </div>

    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            this.disabled = true;

            snap.pay('{{ $snapToken }}', {
                onSuccess: function () {
                    window.location.href = "{{ route('payment.finish') }}";
                },
                onPending: function () {
                    alert('Menunggu pembayaran');
                    location.reload();
                },
                onError: function () {
                    alert('Pembayaran gagal');
                    location.reload();
                },
                onClose: function () {
                    location.reload();
                }
            });
        });
    </script>
@endif
