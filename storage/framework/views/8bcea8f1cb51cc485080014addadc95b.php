<div class="modal-header bg-indigo">
    <h5 class="modal-title">QR Code</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body text-center">
    <div class="my-3">
        <?php echo $qrCode; ?>

    </div>
    <p class="small">Scan QR untuk membuka: <a href="<?php echo e($url); ?>" target="_blank"><?php echo e($url); ?></a></p>
</div>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\customer\serah_kunci\qr.blade.php ENDPATH**/ ?>