<?php echo \view('bagianAwal.nav')->render(); ?>

<div class="container my-5">
    <h3 class="mb-4">Riwayat Transaksi</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if(empty($payments) || $payments->isEmpty()): ?>
                <p class="text-muted">Belum ada transaksi.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Booking ID</th>
                                <th>Package</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($payments as $p): ?>
                                <tr>
                                    <td><?php echo e($p->created_at->format('d M Y H:i')); ?></td>
                                    <td><?php echo e($p->booking->id); ?></td>
                                    <td><?php echo e(ucfirst($p->booking->package_name)); ?></td>
                                    <td>Rp <?php echo e(number_format($p->amount ?? 0, 0, ',', '.')); ?></td>
                                    <td><?php echo e(strtoupper($p->metode ?? '-')); ?></td>
                                    <td>
                                        <?php if($p->status === 'paid'): ?>
                                            <span class="badge bg-success">Paid</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('payment.menu', ['booking' => $p->booking->id])); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
