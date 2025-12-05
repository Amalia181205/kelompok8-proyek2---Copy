<?php echo \view('bagianAwal.nav')->render(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="mb-3">Menu Pembayaran</h3>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Detail Booking</h5>
                    <p><strong>Booking ID:</strong> <?php echo e($booking->id); ?></p>
                    <p><strong>Package:</strong> <?php echo e(ucfirst($booking->package_name)); ?></p>
                    <p><strong>Tanggal:</strong> <?php echo e(\Carbon\Carbon::parse($booking->booking_date)->format('d M Y')); ?></p>
                    <p><strong>Jumlah dibayar (estimasi):</strong> Rp <?php echo e(number_format($amount ?? 0, 0, ',', '.')); ?></p>
                </div>
            </div>

            <?php if(empty($payment)): ?>
                <form method="POST" action="<?php echo e(route('payment.create', ['booking' => $booking->id])); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-primary w-100">Lanjut ke Pembayaran (QRIS)</button>
                </form>
            <?php else: ?>
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Pembayaran via QRIS</h5>

                        <img src="https://via.placeholder.com/300x300.png?text=QRIS+Placeholder" alt="QRIS" class="img-fluid mb-3" style="max-width:300px;">

                        <p class="mb-1"><strong>Payment ID:</strong> <?php echo e($payment->id); ?></p>
                        <p class="mb-1"><strong>Status:</strong>
                            <?php if($payment->status === 'paid'): ?>
                                <span class="badge bg-success">Paid</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php endif; ?>
                        </p>

                        <p class="small text-muted">Scan QR di atas menggunakan aplikasi pembayaran yang mendukung QRIS untuk menyelesaikan pembayaran.</p>

                        <?php if($payment->status !== 'paid'): ?>
                        <form method="POST" action="<?php echo e(route('payment.confirm', ['payment' => $payment->id])); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-success mt-3">Simulasikan Konfirmasi Pembayaran</button>
                        </form>
                        <?php endif; ?>

                        <a href="<?php echo e(route('payment.history')); ?>" class="btn btn-link mt-2">Lihat Riwayat Transaksi</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
