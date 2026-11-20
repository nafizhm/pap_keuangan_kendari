    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-danger p-0 m-0">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>" class="text-primary">Dashboard</a>
            </li>
            <?php if(isset($breadcrumb)): ?>
                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->last): ?>
                        <li class="breadcrumb-item active text-muted" aria-current="page"><?php echo e($item); ?></li>
                    <?php else: ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e($item['url']); ?>" class="text-primary"><?php echo e($item['label']); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ol>
    </nav>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\components\breadcrumb.blade.php ENDPATH**/ ?>