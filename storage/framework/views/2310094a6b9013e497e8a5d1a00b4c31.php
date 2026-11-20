<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Booking'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        $favicon = \App\Models\PengaturanMedia::where('jenis_data', 'fav icon')->where('stt_aktif', 1)->first();
        $faviconPath = $favicon && $favicon->nama_file ? asset('config_media/' . $favicon->nama_file) : asset('default/favicon.ico');
    ?>

    <link rel="icon" href="<?php echo e($faviconPath); ?>">
    <link rel="shortcut icon" href="<?php echo e($faviconPath); ?>">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('templates/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')); ?>">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('templates/plugins/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('templates/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo e(asset('templates/plugins/toastr/toastr.min.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/brand-theme.css')); ?>">
</head>

<body class="hold-transition sidebar-mini" style="background-color: #ebebeb;">
    <div class="wrapper">

        <?php echo $__env->yieldContent('content'); ?>


    </div>
    <!-- AdminLTE JS -->
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/adminlte.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo e(asset('templates/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo e(asset('templates/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>

    <!-- Toastr -->
    <script src="<?php echo e(asset('templates/plugins/toastr/toastr.min.js')); ?>"></script>

    <script>
        $(document).on('input', '.format-number', function() {
            let input = $(this).val().replace(/[^\d]/g, '');
            let formatted = input.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            $(this).val(formatted);
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\layouts\app.blade.php ENDPATH**/ ?>