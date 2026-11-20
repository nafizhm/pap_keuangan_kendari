<?php
    $types = app(\App\Services\BookingAttachments::class)->definitions();
?>
<?php $__currentLoopData = $types->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="form-group row">
        <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php ($inputId = 'upload_' . $type->kode); ?>
            <label for="<?php echo e($inputId); ?>" class="control-label col-sm-2"><?php echo e($type->nama); ?> <?php if($type->wajib): ?><span class="text-danger">*</span><?php endif; ?></label>
            <div class="col-sm-4">
                <input name="<?php echo e($type->inputName()); ?>" id="<?php echo e($inputId); ?>" type="file" accept=".jpg,.jpeg,.png,.webp,.pdf"
                    onchange="handleFileChange(this, 'preview_<?php echo e($type->kode); ?>')">
                <div id="preview_<?php echo e($type->kode); ?>" class="mt-2 d-none">
                    <button type="button" class="btn btn-sm btn-primary" onclick="showPreview(this)">View</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="clearFile('<?php echo e($inputId); ?>', 'preview_<?php echo e($type->kode); ?>')">Hapus</button>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\shared\booking-upload-frontend.blade.php ENDPATH**/ ?>