<script>
    var audio = new Audio('<?php echo e(asset('audio/notification.ogg')); ?>');

    $(function() {
        <?php if(Session::has('success')): ?>
            audio.play();
            toastr.success("<?php echo e(Session::get('success')); ?>", "Berhasil!", {
                closeButton: true,
                progressBar: true,
                timeOut: 3000,
                positionClass: 'toast-bottom-right',
            });
        <?php endif; ?>

        <?php if($errors->any()): ?>
            audio.play();
            toastr.error("<?php echo e($errors->first()); ?>", "Kesalahan!", {
                closeButton: true,
                progressBar: true,
                timeOut: 3000,
                positionClass: 'toast-bottom-right'
            });
        <?php endif; ?>
    });
</script>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\components\toast.blade.php ENDPATH**/ ?>