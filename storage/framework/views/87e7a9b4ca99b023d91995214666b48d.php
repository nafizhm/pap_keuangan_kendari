
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-3">
                                <div class="d-flex align-content-center justify-content-between">
                                    <h3 class="font-weight-bold text-lg">Data Customer berdasarkan <?php echo e($scope); ?>

                                        <?php echo e($nama); ?>

                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Periode: <strong><?php echo e($period->label); ?></strong> ? Berdasarkan tanggal verifikasi customer.</p>
                                <a class="btn btn-sm btn-outline-secondary mb-3" href="<?php echo e(route('dashboard.index', $period->parameters())); ?>">Kembali ke Dashboard</a>
                                <table class="table table-bordered table-striped w-100 data-table">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Nasabah</th>
                                            <th>Marketing</th>
                                            <th>Perumahan</th>
                                            <th>Status Progres</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal Create -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: false,
                ordering: false,
                responsive: true,
                ajax: { url: <?php echo json_encode(url()->current(), 15, 512) ?>, data: <?php echo json_encode($period->parameters(), 15, 512) ?> },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal_verif',
                        name: 'tanggal_verif',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'id_marketing',
                        name: 'id_marketing',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id_lokasi',
                        name: 'id_lokasi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id_status_progres',
                        name: 'id_status_progres',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }]
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\dashboard\statistik\customer.blade.php ENDPATH**/ ?>