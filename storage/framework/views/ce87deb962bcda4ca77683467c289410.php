<?php for($i = 1; $i <= 5; $i++): ?>
    <div class="form-group row">
        <div class="col-sm-12"><strong>Kontak Darurat <?php echo e($i); ?></strong></div>
        <?php $__currentLoopData = ['kontak_darurat' => 'Kontak Darurat (No. Telepon)', 'nama_pemilik_kontak_darurat' => 'Nama Pemilik Kontak Darurat', 'keterangan_kontak_darurat' => 'Keterangan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $field = $key . '_' . $i;
                $value = isset($data) ? $data->{$field} : null;
                if ($i === 1 && $value === null && isset($data)) {
                    $value = $key === 'kontak_darurat' ? $data->no_telp_saudara : ($key === 'nama_pemilik_kontak_darurat' ? $data->nama_saudara : null);
                }
            ?>
            <div class="col-sm-4">
                <label for="<?php echo e($field); ?>"><?php echo e($label); ?></label>
                <input type="<?php echo e($key === 'kontak_darurat' ? 'tel' : 'text'); ?>" name="<?php echo e($field); ?>" id="<?php echo e($field); ?>"
                    value="<?php echo e(old($field, $value)); ?>" maxlength="255" class="form-control" <?php echo e(!empty($readonly) ? 'readonly' : ''); ?>>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endfor; ?>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\shared\emergency-contacts.blade.php ENDPATH**/ ?>