<?php $__env->startPush('css'); ?><link rel="stylesheet" href="<?php echo e(asset('css/template-studio.css')); ?>"><?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper template-studio">
    <section class="content-header"><div class="container-fluid"><div class="studio-hero"><div><span class="studio-eyebrow">CETAK BERKAS</span><h1>Dokumen rapi, siap setiap saat.</h1><p>Kelola template Word dan biarkan data customer mengisi dokumen Anda.</p></div><div class="studio-hero-icon"><i class="far fa-file-word"></i></div></div></div></section>
    <section class="content"><div class="container-fluid">
        <?php if(session('success')): ?><div class="alert alert-success"><?php echo e(session('success')); ?></div><?php endif; ?>
        <div class="card studio-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Pengaturan Template</h3>
                <?php if($permissions['tambah']): ?><a href="<?php echo e(route('pengaturan-template.create')); ?>" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-plus mr-1"></i> Tambah Template</a><?php endif; ?>
            </div>
            <div class="card-body">
                <form method="GET" class="d-flex mb-4" role="search"><label for="template-search" class="sr-only">Cari template</label><input id="template-search" type="search" name="q" value="<?php echo e(request('q')); ?>" class="form-control mr-2" placeholder="Cari nama cetak atau kode template..."><button class="btn btn-outline-primary">Cari</button><?php if(request('q')): ?><a class="btn btn-link" href="<?php echo e(route('pengaturan-template.index')); ?>">Reset</a><?php endif; ?></form>
                <div class="table-responsive"><table class="table table-bordered table-striped">
                    <thead><tr><th>No</th><th>Nama Cetak</th><th>Kode</th><th>Deskripsi</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($templates->firstItem() + $loop->index); ?></td>
                            <td><span class="studio-list-title"><?php echo e($template->nama); ?></span><small class="d-block text-muted mt-1"><?php echo e($template->detected_variables === null ? 'Buka Edit untuk memeriksa variabel' : count($template->detected_variables).' variabel dalam Word'); ?></small></td><td><code><?php echo e($template->kode); ?></code></td>
                            <td><?php echo e($template->deskripsi ?: '-'); ?></td>
                            <td><span class="badge badge-<?php echo e($template->is_active ? 'success' : 'secondary'); ?>"><?php echo e($template->is_active ? 'Aktif' : 'Nonaktif'); ?></span></td>
                            <td class="text-nowrap">
                                <?php if($template->file_path): ?><a class="btn btn-info btn-sm" href="<?php echo e(route('pengaturan-template.download', $template)); ?>">Unduh Word</a><?php endif; ?>
                                <?php if($permissions['edit']): ?><a class="btn btn-primary btn-sm" href="<?php echo e(route('pengaturan-template.edit', $template)); ?>">Edit</a><?php endif; ?>
                                <?php if($permissions['hapus']): ?>
                                <form class="d-inline" method="POST" action="<?php echo e(route('pengaturan-template.destroy', $template)); ?>" onsubmit="return confirm('Hapus template ini beserta file Word-nya?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6"><div class="studio-empty"><i class="far fa-file-word"></i><strong><?php echo e(request('q') ? 'Template tidak ditemukan' : 'Mulai dengan template pertama Anda'); ?></strong><p class="mt-2 mb-0"><?php echo e(request('q') ? 'Coba kata pencarian lain.' : 'Tambahkan Word, periksa variabel, lalu simpan untuk digunakan kembali.'); ?></p></div></td></tr>
                    <?php endif; ?>
                    </tbody>
                </table></div>
                <?php echo e($templates->links('pagination::bootstrap-4')); ?>

            </div>
        </div>
    </div></section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\cetak_berkas\index.blade.php ENDPATH**/ ?>