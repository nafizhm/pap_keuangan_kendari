<?php
    $booking = $data ?? null;
    $types = app(\App\Services\BookingAttachments::class)->definitions($booking);
    $folder = $booking && (int) $booking->stt_reg === 2 ? 'assets/customer/' : 'assets/booking/';
?>
<div class="row">
    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $filename = $type->filename($booking);
            $enabled = $type->aktif && !$type->trashed();
            $inputId = 'upload_' . $type->kode;
        ?>
        <div class="col-sm-6 mb-3">
            <label for="<?php echo e($inputId); ?>"><?php echo e($type->nama); ?> <?php if($enabled && $type->wajib): ?><span class="text-danger">*</span><?php endif; ?></label>
            <?php if($filename): ?>
                <div class="mb-2">
                    <a href="<?php echo e(asset($folder . $filename)); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Lihat berkas</a>
                    <?php if(empty($readonly) && !empty($allowDelete)): ?>
                        <button type="button" class="btn btn-sm btn-danger btnHapusFoto" data-field="<?php echo e($type->kode); ?>" data-id="<?php echo e($booking->id); ?>">Hapus berkas</button>
                    <?php endif; ?>
                </div>
            <?php elseif(!empty($readonly)): ?>
                <div class="text-muted">Belum diunggah</div>
            <?php endif; ?>
            <?php if(empty($readonly)): ?>
                <input type="file" name="<?php echo e($type->inputName()); ?>" id="<?php echo e($inputId); ?>" accept=".jpg,.jpeg,.png,.webp,.pdf" class="form-control-file booking-file-input" data-frontend="<?php echo e(!empty($frontend) ? '1' : '0'); ?>"
                    <?php if(!empty($frontend)): ?> onchange="handleFileChange(this, 'preview_<?php echo e($type->kode); ?>')" <?php endif; ?>>
                <small class="text-muted">JPG, PNG, WEBP atau PDF, maksimal 10 MB. <?php echo e($enabled && $type->wajib ? 'Wajib' : 'Opsional'); ?>.</small>
                <?php if(empty($frontend)): ?>
                    <div class="booking-new-preview mt-2"></div>
                <?php endif; ?>
                <?php if(!empty($frontend)): ?>
                    <div id="preview_<?php echo e($type->kode); ?>" class="mt-2 d-none">
                        <button type="button" class="btn btn-sm btn-primary" onclick="showPreview(this)">Lihat</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="clearFile('<?php echo e($inputId); ?>', 'preview_<?php echo e($type->kode); ?>')">Hapus</button>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if (! $__env->hasRenderedOnce('8b4bf256-91b3-4c93-ae03-fa32564d6128')): $__env->markAsRenderedOnce('8b4bf256-91b3-4c93-ae03-fa32564d6128'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('change', function (event) {
    const input = event.target;
    if (!input.classList.contains('booking-file-input') || input.dataset.frontend === '1') return;
    const preview = input.parentElement.querySelector('.booking-new-preview');
    if (input.dataset.previewUrl) URL.revokeObjectURL(input.dataset.previewUrl);
    preview.replaceChildren();
    const file = input.files[0];
    if (!file) return;
    if (file.size > 10 * 1024 * 1024 || !['image/jpeg', 'image/png', 'image/webp', 'application/pdf'].includes(file.type)) {
        input.value = '';
        toastr.error('Pilih JPG, PNG, WEBP atau PDF, maksimal 10 MB.');
        return;
    }
    const link = document.createElement('a');
    input.dataset.previewUrl = URL.createObjectURL(file);
    link.href = input.dataset.previewUrl;
    link.target = '_blank';
    link.rel = 'noopener';
    link.className = 'btn btn-sm btn-outline-primary';
    link.textContent = 'Lihat file baru: ' + file.name;
    preview.appendChild(link);
});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\shared\booking-attachments.blade.php ENDPATH**/ ?>