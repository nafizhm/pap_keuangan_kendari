<?php
    $types = app(\App\Services\BookingAttachments::class)->definitions($data);
    $folder = (int) $data->stt_reg === 2 ? 'assets/customer/' : 'assets/booking/';
?>
<?php $__currentLoopData = $types->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row mb-3">
        <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $filename = $type->filename($data);
                $inputId = 'upload_' . $type->kode;
                $isPdf = $filename && strtolower(pathinfo($filename, PATHINFO_EXTENSION)) === 'pdf';
            ?>
            <div class="col-sm-6">
                <label for="<?php echo e($inputId); ?>" class="form-label"><?php echo e($type->nama); ?> <?php if($type->aktif && !$type->trashed() && $type->wajib): ?><span class="text-danger">*</span><?php endif; ?></label>
                <div class="img-thumbnail d-flex align-items-center justify-content-center"
                    style="max-width: 350px; height: 180px; background-color: #f8f9fa; border: 1px solid #dee2e6; overflow: hidden;">
                    <?php if($filename): ?>
                        <button type="button" class="btn p-0 attachment-preview" data-url="<?php echo e(asset($folder . $filename)); ?>" data-pdf="<?php echo e($isPdf ? '1' : '0'); ?>" aria-label="Perbesar lampiran" style="width:100%;height:100%;">
                            <?php if($isPdf): ?>
                                <span class="text-primary">Lihat PDF</span>
                            <?php else: ?>
                                <img src="<?php echo e(asset($folder . $filename)); ?>" alt="<?php echo e($type->nama); ?>" style="max-width:100%;max-height:100%;">
                            <?php endif; ?>
                        </button>
                    <?php else: ?>
                        <span class="text-muted">Tidak ada file</span>
                    <?php endif; ?>
                </div>
                <input type="file" name="<?php echo e($type->inputName()); ?>" id="<?php echo e($inputId); ?>" class="form-control-file mt-2 attachment-input" accept=".jpg,.jpeg,.png,.webp,.pdf">
                <small class="text-muted">Pilih file untuk mengganti lampiran (maks. 10 MB).</small>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\shared\booking-upload-verification.blade.php ENDPATH**/ ?>