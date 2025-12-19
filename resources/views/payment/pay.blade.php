<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ $booking->package_name }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .payment-container {
            max-width: 600px;
            margin: 50px auto;
        }
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            font-weight: bold;
        }
        .btn-pay {
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px;
        }
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container payment-container">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0"><i class="bi bi-credit-card me-2"></i> Pembayaran {{ $booking->package_name }}</h4>
            </div>
            
            <div class="card-body p-4">
                <!-- Informasi Booking -->
                <div class="info-box">
                    <h5 class="text-primary">📋 Detail Booking</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>ID Booking:</strong></td>
                            <td><strong class="text-primary">#{{ $booking->id }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Paket:</strong></td>
                            <td>{{ $booking->package_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal:</strong></td>
                            <td>{{ $booking->booking_date ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah:</strong></td>
                            <td class="fw-bold text-success fs-5">
                                Rp {{ number_format($payment->gross_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Order ID:</strong></td>
                            <td><code class="bg-light p-1 rounded">{{ $payment->order_id }}</code></td>
                        </tr>
                    </table>
                </div>

                <!-- Tombol Bayar -->
                <div class="text-center mt-4">
                    <button id="pay-button" class="btn btn-success btn-pay w-100">
                        <i class="bi bi-lock-fill me-2"></i> BAYAR SEKARANG
                    </button>
                    
                    <p class="text-muted mt-2 small">
                        <i class="bi bi-shield-check me-1"></i> Pembayaran aman dengan Midtrans
                    </p>
                    
                    <div class="mt-4">
                        <a href="{{ route('payment.menu', $booking) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Loading Spinner (hidden) -->
        <div id="loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="ms-3 text-white">Membuka halaman pembayaran...</div>
            </div>
        </div>
    </div>

    <!-- ✅ LOAD MIDTRANS SNAP JS DENGAN BENAR -->
    <script type="text/javascript" 
            src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');
            const loading = document.getElementById('loading');
            
            console.log('Page loaded, snapToken:', '{{ $snapToken }}');
            
            payButton.addEventListener('click', function() {
                const snapToken = '{{ $snapToken }}';
                
                if (!snapToken || snapToken === '') {
                    alert('❌ Token pembayaran tidak tersedia. Silakan refresh halaman atau hubungi admin.');
                    console.error('Snap Token is empty!');
                    return;
                }
                
                console.log('Attempting payment with token:', snapToken.substring(0, 50) + '...');
                
                // Tampilkan loading
                loading.style.display = 'block';
                payButton.disabled = true;
                payButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
                
                // Pastikan Snap.js sudah terload
                if (typeof snap === 'undefined') {
                    alert('❌ Midtrans Snap.js belum terload. Silakan refresh halaman.');
                    loading.style.display = 'none';
                    payButton.disabled = false;
                    payButton.innerHTML = '<i class="bi bi-lock-fill me-2"></i> BAYAR SEKARANG';
                    return;
                }
                
                // Eksekusi pembayaran
                snap.pay(snapToken, {
                    // ✅ Success: User menyelesaikan pembayaran
                    onSuccess: function(result) {
                        console.log('✅ Payment Success:', result);
                        loading.style.display = 'none';
                        window.location.href = '{{ route("payment.finish") }}?order_id=' + result.order_id + '&status=success';
                    },
                    
                    // ✅ Pending: User belum menyelesaikan pembayaran
                    onPending: function(result) {
                        console.log('⏳ Payment Pending:', result);
                        loading.style.display = 'none';
                        window.location.href = '{{ route("payment.pending") }}?order_id=' + result.order_id;
                    },
                    
                    // ✅ Error: Terjadi kesalahan
                    onError: function(result) {
                        console.log('❌ Payment Error:', result);
                        loading.style.display = 'none';
                        window.location.href = '{{ route("payment.error") }}?order_id=' + result.order_id + '&error=' + (result.status_message || 'Payment failed');
                    },
                    
                    // ✅ User menutup popup
                    onClose: function() {
                        console.log('⚠️ User closed payment popup');
                        loading.style.display = 'none';
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="bi bi-lock-fill me-2"></i> BAYAR SEKARANG';
                        alert('Anda menutup halaman pembayaran. Silakan klik "Bayar Sekarang" lagi jika ingin melanjutkan.');
                    }
                });
            });
        });
    </script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>