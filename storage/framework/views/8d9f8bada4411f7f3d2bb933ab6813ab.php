
<?php $__env->startSection('content'); ?>
    <?php
        $logo = \App\Models\PengaturanMedia::where('jenis_data', 'logo website')->first();
    ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold ">Dashboard</h1>
                        <p class="text-muted mt-2 mb-0">Ringkasan penjualan dan aktivitas: <strong class="text-primary"><?php echo e($period->label); ?></strong></p>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?php echo $__env->make('admin.dashboard.period-filter', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3><?php echo e($totalKavling); ?> / <?php echo e($totalKavling); ?></h3>
                                <p>Total Unit</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo e($merah); ?></h3>
                                <p>Booking</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo e($hijau); ?></h3>

                                <p>Wawancara</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-indigo">
                            <div class="inner">
                                <h3><?php echo e($ungu); ?></h3>

                                <p>Akad</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <!-- Start statistik Marketing -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-lightblue">
                                <div class="widget-user-image">
                                    <img class="mt-3" style="max-width: 70px; height: auto;"
                                        src="<?php echo e(asset('config_media/' . ($logo->nama_file ?? 'default.png'))); ?>"
                                        alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">Statistik Penjualan per Lokasi</h3>
                                <h5 class="widget-user-desc"><?php echo e($period->label); ?> ? Per <?php echo e($tglSekarang); ?></h5>
                            </div>
                            <div class="card-footer p-0">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th width="7%" class="text-center">KODE</th>
                                            <th width="30%">Perumahan</th>
                                            <th width="6%" class="text-center">Jumlah</th>
                                            <?php $__currentLoopData = $kolomStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <th class="text-center"><?php echo e(strtoupper($status->short_name)); ?></th>
                                                <?php if($status->id == 1): ?>
                                                    <th class="text-center">HOLD</th>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <th class="text-center">ACTION</th>
                                            <th class="text-center">KPR</th>
                                            <th class="text-center">CASH</th>
                                            <th class="text-center">KREDIT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $dataLokasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lokasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                <td align="center"><?php echo e($lokasi['nama_singk_1']); ?></td>
                                                <td><?php echo e($lokasi['nama']); ?></td>
                                                <td align="center" class="table-warning"><?php echo e($lokasi['jumlah']); ?></td>
                                                <?php $__currentLoopData = $kolomStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $key = strtolower(str_replace(' ', '_', $status->short_name)); ?>
                                                    <td align="center"><?php echo e($lokasi[$key] ?? 0); ?></td>
                                                    <?php if($status->id == 1): ?>
                                                        <td align="center"><?php echo e($lokasi['hold'] ?? 0); ?></td>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <td align="center" class="table-primary">
                                                    <a href="<?php echo e(route('dashboard.lokasi-penjualan-show', array_merge(['id' => $lokasi['id']], $periodQuery))); ?>"
                                                        class="btn btn-primary btn-xs btn-detail">
                                                        Detail
                                                    </a>
                                                </td>
                                                <td align="center"><?php echo e($lokasi['kpr']); ?></td>
                                                <td align="center"><?php echo e($lokasi['cash']); ?></td>
                                                <td align="center"><?php echo e($lokasi['kredit']); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">TOTAL</th>
                                            <th class="text-center"><?php echo e($totalSemua['jumlah']); ?></th>
                                            <?php $__currentLoopData = $kolomStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $key = strtolower(str_replace(' ', '_', $status->short_name)); ?>
                                                <th class="text-center"><?php echo e($totalSemua[$key] ?? 0); ?></th>
                                                <?php if($status->id == 1): ?>
                                                    <th class="text-center"><?php echo e($totalSemua['hold']); ?></th>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <th class="text-center table-primary"><?php echo e($totalSemua['total_customer']); ?></th>
                                            <th class="text-center"><?php echo e($totalSemua['kpr']); ?></th>
                                            <th class="text-center"><?php echo e($totalSemua['cash']); ?></th>
                                            <th class="text-center"><?php echo e($totalSemua['kredit']); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-maroon">
                                <div class="widget-user-image">
                                    <img class="mt-3" style="max-width: 70px; height: auto;"
                                        src="<?php echo e(asset('config_media/' . ($logo->nama_file ?? 'default.png'))); ?>"
                                        alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">Statistik Status Progres</h3>
                                <h5 class="widget-user-desc"><?php echo e($period->label); ?> ? Per <?php echo e($tglSekarang); ?></h5>
                            </div>

                            <div class="card-footer p-0">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col" width="5%">No</th>
                                            <th scope="col" width="45%">Jenis Progres</th>
                                            <th scope="col" width="10%">Jumlah Progres</th>
                                            <th scope="col" width="10%">Persentase</th>
                                            <th scope="col" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $dataProgres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($item['no']); ?></td>
                                                <td><?php echo e($item['status_progres']); ?></td>
                                                <td align="right"><?php echo e($item['jumlah']); ?></td>
                                                <td align="right"><?php echo e($item['persentase']); ?> %</td>
                                                <td align="center">
                                                    <a href="<?php echo e(route('dashboard.customer-status-progres-show', array_merge(['id' => $item['id_status_progres']], $periodQuery))); ?>"
                                                        class="btn bg-maroon btn-xs">Detail Data</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Widget: user widget style 2 -->
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-indigo">
                                <div class="widget-user-image">
                                    <img class="mt-3" style="max-width: 70px; height: auto;"
                                        src="<?php echo e(asset('config_media/' . ($logo->nama_file ?? 'default.png'))); ?>"
                                        alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">Statistik Penggunaan Bank</h3>
                                <h5 class="widget-user-desc"><?php echo e($period->label); ?> ? Per <?php echo e($tglSekarang); ?></h5>
                            </div>

                            <div class="card-footer p-0">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col" width="5%">No</th>
                                            <th scope="col" width="45%">Nama Bank</th>
                                            <th scope="col" width="10%">Jumlah Nasabah</th>
                                            <th scope="col" width="10%">Persentase</th>
                                            <th scope="col" width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $dataBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($bank['no']); ?></td>
                                                <td><?php echo e($bank['bank']); ?></td>
                                                <td align="right"><?php echo e($bank['jumlah']); ?></td>
                                                <td align="right"><?php echo e($bank['persentase']); ?> %</td>
                                                <td align="center">
                                                    <a href="<?php echo e(route('dashboard.customer-bank-show', array_merge(['id' => $bank['id_bank']], $periodQuery))); ?>"
                                                        class="btn bg-indigo btn-xs">Detail Data</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-widget widget-user-2 shadow-sm">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-teal">
                                <div class="widget-user-image">
                                    <img class="mt-3" style="max-width: 70px; height: auto;"
                                        src="<?php echo e(asset('config_media/' . ($logo->nama_file ?? 'default.png'))); ?>"
                                        alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class="widget-user-username">Statistik Penjualan Marketing</h3>
                                <h5 class="widget-user-desc"><?php echo e($period->label); ?> ? Per <?php echo e($tglSekarang); ?></h5>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col" width="5%">No</th>
                                        <th scope="col" width="45%">Nama Marketing</th>
                                        <th scope="col" width="10%">Penjualan</th>
                                        <th scope="col" width="10%">Persentase</th>
                                        <th scope="col" width="15%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $dataMarketing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marketing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($marketing['no']); ?></td>
                                            <td><?php echo e($marketing['marketing']); ?></td>
                                            <td align="right"><?php echo e($marketing['jumlah']); ?></td>
                                            <td align="right"><?php echo e($marketing['persentase']); ?> %</td>
                                            <td align="center">
                                                <a href="<?php echo e(route('dashboard.customer-marketing-show', array_merge(['id' => $marketing['id_marketing']], $periodQuery))); ?>"
                                                    class="btn bg-teal btn-xs">Detail Data</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\dashboard\dashboard.blade.php ENDPATH**/ ?>