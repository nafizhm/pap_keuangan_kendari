<!-- resources/views/admin/bank/index.blade.php -->

<?php $__env->startSection('content'); ?>
    <style>
        .legend {
            position: fixed;
            top: 80px;
            right: 30px;
            padding: 10px;
            font-size: 14px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.4);
            transition: right 0.3s ease;
            width: 200px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            border-radius: 50%;
            border: 2px solid #000;
        }

        .toggle-btn {
            width: 100%;
            padding: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
        }

        .show-btn {
            position: fixed;
            top: 100px;
            right: 30px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.4);
            cursor: pointer;
            display: none;
        }

        .svg-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
            border: 2px solid #d1cfcf;
            position: relative;
        }

        .svg-container svg {
            width: 100%;
            height: 100%;
            cursor: grab;
            transition: transform 0.1s ease-out;
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-lg text-dark">Siteplan</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <!-- ================================================================================================== -->

                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <?php echo $__env->make('admin.siteplan.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <?php $__currentLoopData = $lokasiKavling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="tab-pane fade <?php echo e($index == 0 ? 'show active' : ''); ?>"
                                            id="custom-tabs-four-<?php echo e($kav->id); ?>" role="tabpanel">

                                            <?php if($kav->masterSvg): ?>
                                            <a href="<?php echo e(route('siteplan-penjualan.cetak.pdf', $kav->id)); ?>" target="_blank"
                                                class="btn btn-danger btn-sm mr-1">
                                                <i class="fas fa-file-pdf mr-1"></i> Cetak Denah PDF
                                            </a>
                                            <a href="<?php echo e(route('siteplan-penjualan.cetak.jpg', $kav->id)); ?>" target="_blank"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-file-image mr-1"></i> Download Denah JPG
                                            </a>

                                            
                                            <div class="svg-container mt-3">
                                                <button class="reset-button btn btn-success btn-sm"
                                                    style="position: absolute; top: 10px; left: 10px; z-index: 10;">
                                                    Reset Siteplan
                                                </button>

                                                
                                                <?php if($kav->masterSvg): ?>
                                                    <?php echo str_replace(['[[lebar]]', '[[tinggi]]'], ['100%', '100%'], $kav->masterSvg->header_svg); ?>

                                                <?php endif; ?>

                                                
                                                <?php $__currentLoopData = $kav->kavlingPeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $warna = '#ffffff';

                                                        if ($pt->customer) {
                                                            $warna = $pt->customer->progres->warna ?? '#ffffff';
                                                        } else {
                                                            if ($pt->is_booked) {
                                                                $warna = '#42f202';
                                                            }
                                                        }
                                                    ?>


                                                    <?php if($pt->jenis_map == 'polygon'): ?>
                                                        <a href="javascript:void(0);" class="detail-button"
                                                            data-id="<?php echo e($pt->id); ?>"
                                                            data-url="<?php echo e(route('siteplan-penjualan.show', $pt->id)); ?>">
                                                            <?php echo str_replace(
                                                                ['[[1]]', '[[2]]', '[[3]]', '[[4]]'],
                                                                [$pt->map, $warna, $pt->matrik, $pt->kode_kavling],
                                                                $kav->masterSvg->polygon_svg,
                                                            ); ?>

                                                        </a>
                                                    <?php elseif($pt->jenis_map == 'path'): ?>
                                                        <a href="javascript:void(0);" class="detail-button"
                                                            data-id="<?php echo e($pt->id); ?>"
                                                            data-url="<?php echo e(route('siteplan-penjualan.show', $pt->id)); ?>">
                                                            <?php echo str_replace(
                                                                ['[[1]]', '[[2]]', '[[3]]', '[[4]]'],
                                                                [$pt->map, $warna, $pt->matrik, $pt->kode_kavling],
                                                                $kav->masterSvg->path_svg,
                                                            ); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                
                                                <?php if($kav->masterSvg): ?>
                                                    <?php echo $kav->masterSvg->footer_svg; ?>

                                                <?php endif; ?>
                                            </div>
                                            <?php else: ?>
                                                <div class="alert alert-info mt-3" role="status">
                                                    Siteplan <?php echo e($kav->nama_kavling); ?> belum tersedia. Silakan lengkapi template denah lokasi ini.
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <!-- /.card -->
                        </div>
                    </div>

                    <!-- ========================================================================================== -->

                    <!-- Tombol show di luar legenda -->
                    <button class="show-btn btn-xs" id="show-btn" onclick="toggleLegend()">Show</button>

                    <!-- Tambahkan legenda -->
                    <div class="legend" id="legend">
                        <?php $__currentLoopData = $legend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: <?php echo e($item->warna); ?>"></div>
                                <?php echo e($item->status_progres); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Tombol hide -->
                        <button class="toggle-btn" onclick="toggleLegend()">Hide</button>
                    </div>
                    <!-- ========================================================================================== -->

                </div>
            </div>
        </section>
    </div><!-- /.container-fluid -->
    <!-- /.content-wrapper -->

    <?php echo $__env->make('admin.siteplan.siteplan_penjualan.detail', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/svg_1.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\siteplan\siteplan_penjualan\index.blade.php ENDPATH**/ ?>