<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <style>
            .col-pencairan {
                background-color: #fff3cd;
            }

            .col-total-retensi {
                background-color: #f8d7da;
                color: #b02a37;
            }
        </style>
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="font-weight-bold text-lg mb-0">Rekap Retensi Pencairan</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th width="50px">No</th>
                                            <th>Lokasi + Unit</th>
                                            <th class="text-center">Plafon</th>
                                            <th class="text-center col-pencairan">Pencairan</th>
                                            <?php $__currentLoopData = $retensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th class="text-center"><?php echo e($retensi->nama_retensi); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <th class="text-center col-total-retensi">Total Retensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($index + 1); ?></td>
                                                <td><?php echo e($row['lokasi_unit']); ?></td>
                                                <td class="text-right"><?php echo e(number_format($row['plafon'], 0, ',', '.')); ?></td>
                                                <td class="text-right col-pencairan"><?php echo e(number_format($row['pencairan'], 0, ',', '.')); ?></td>
                                                <?php $__currentLoopData = $retensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td class="text-right"><?php echo e(number_format($row['retensi'][$retensi->id] ?? 0, 0, ',', '.')); ?></td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <td class="text-right font-weight-bold col-total-retensi"><?php echo e(number_format($row['total_retensi'], 0, ',', '.')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="<?php echo e(5 + $retensis->count()); ?>" class="text-center text-muted">
                                                    Belum ada data unit yang sudah cair.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="font-weight-bold bg-light">
                                            <td colspan="2" class="text-center">TOTAL</td>
                                            <td class="text-right"><?php echo e(number_format($totals['plafon'], 0, ',', '.')); ?></td>
                                            <td class="text-right col-pencairan"><?php echo e(number_format($totals['pencairan'], 0, ',', '.')); ?></td>
                                            <?php $__currentLoopData = $retensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td class="text-right"><?php echo e(number_format($totals['retensi'][$retensi->id] ?? 0, 0, ',', '.')); ?></td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <td class="text-right col-total-retensi"><?php echo e(number_format($totals['total_retensi'], 0, ',', '.')); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\keuangan\retensi\index.blade.php ENDPATH**/ ?>