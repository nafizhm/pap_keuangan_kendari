<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Dashboard Keuangan</h1>
                <p class="text-muted mt-2 mb-0">Saldo berdasarkan seluruh pemasukan dikurangi pengeluaran, termasuk saldo awal yang diimpor.</p>
                <?php if($period->start): ?>
                    <small class="text-muted">Periode data <?php echo e(\Carbon\Carbon::parse($period->start)->format('d/m/Y')); ?> – <?php echo e(\Carbon\Carbon::parse($period->end)->format('d/m/Y')); ?></small>
                <?php endif; ?>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <?php if($withoutBank > 0): ?>
                    <div class="alert alert-info">
                        <?php echo e($withoutBank); ?> transaksi memiliki rekening kosong. Nominalnya termasuk dalam total, tetapi tidak masuk saldo rekening mana pun.
                    </div>
                <?php endif; ?>
                <div class="row">
                    <?php $__currentLoopData = ['saldo' => ['Total Saldo', 'bg-primary'], 'pemasukan' => ['Total Pemasukan', 'bg-success'], 'pengeluaran' => ['Total Pengeluaran', 'bg-danger']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => [$label, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box <?php echo e($color); ?>">
                                <div class="inner">
                                    <p><?php echo e($label); ?></p>
                                    <h3 style="font-size: clamp(1.2rem, 2vw, 1.8rem);">Rp <?php echo e(number_format($summary[$key], 2, ',', '.')); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <h2 class="h5 mb-3">Saldo per Bank / Kas</h2>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 50px;">No</th>
                                        <th scope="col">Bank / Kas</th>
                                        <th scope="col" class="text-right">Pemasukan</th>
                                        <th scope="col" class="text-right">Pengeluaran</th>
                                        <th scope="col" class="text-right">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <th scope="row" class="font-weight-normal">
                                                <?php echo e($bank->nama); ?>

                                                <?php if($bank->no_rek): ?><small class="d-block text-muted"><?php echo e($bank->no_rek); ?></small><?php endif; ?>
                                            </th>
                                            <td class="text-right text-nowrap">Rp <?php echo e(number_format($bank->pemasukan, 2, ',', '.')); ?></td>
                                            <td class="text-right text-nowrap">Rp <?php echo e(number_format($bank->pengeluaran, 2, ',', '.')); ?></td>
                                            <td class="text-right text-nowrap font-weight-bold <?php echo e($bank->saldo < 0 ? 'text-danger' : 'text-success'); ?>">Rp <?php echo e(number_format($bank->saldo, 2, ',', '.')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr><td colspan="5" class="text-center text-muted">Belum ada rekening bank atau kas.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\keuangan\dashboard.blade.php ENDPATH**/ ?>