<?php
    $siteplanRoutes = ['siteplan-penjualan.index', 'siteplan-listrik.index', 'siteplan-air.index', 'st-balik-nama.index', 'st-bphtb-ssp.index', 'siteplan-unit-ready.index'];
    $siteplanMenuIds = \App\Models\HakAkses::where('id_user', auth()->id())->where('lihat', 1)->pluck('id_menu');
    $siteplanOptions = \App\Models\Menu::whereIn('id', $siteplanMenuIds)->whereIn('route_name', $siteplanRoutes)->orderBy('urutan')->get()->filter(fn ($item) => \Illuminate\Support\Facades\Route::has($item->route_name))->unique('route_name');
?>
<div class="d-flex flex-wrap align-items-end p-3" style="gap: 12px;">
    <div>
        <label for="siteplan-location">Lokasi Kavling</label>
        <select id="siteplan-location" class="custom-select" <?php if($lokasiKavling->isEmpty()): echo 'disabled'; endif; ?>>
            <?php $__empty_1 = true; $__currentLoopData = $lokasiKavling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <option value="<?php echo e($kav->id); ?>"><?php echo e($kav->nama_kavling); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <option value="">Belum ada lokasi</option>
            <?php endif; ?>
        </select>
    </div>
    <div>
        <label for="siteplan-type">Jenis Siteplan</label>
        <select id="siteplan-type" class="custom-select">
            <?php $__currentLoopData = $siteplanOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(route($option->route_name)); ?>" <?php if(request()->routeIs($option->route_name)): echo 'selected'; endif; ?>><?php echo e($option->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div id="siteplan-print-actions" class="d-flex flex-wrap" style="gap: 8px;"></div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    $(function () {
        const locationSelect = $('#siteplan-location');
        const panels = $('#custom-tabs-four-tabContent').children('.tab-pane');
        const printActions = $('#siteplan-print-actions');
        panels.each(function () {
            const actions = $(this).children('a.btn[target="_blank"]');
            actions.attr('data-siteplan-location', this.id.replace('custom-tabs-four-', ''));
            printActions.append(actions);
        });
        function selectLocation() {
            const locationId = locationSelect.val();
            panels.removeClass('show active');
            $('#custom-tabs-four-' + locationId).addClass('show active');
            printActions.children().each(function () {
                $(this).toggleClass('d-none', $(this).attr('data-siteplan-location') !== locationId);
            });
            window.dispatchEvent(new Event('resize'));
        }
        const requestedLocation = new URL(window.location.href).searchParams.get('lokasi');
        if (requestedLocation && locationSelect.find('option').filter(function () { return this.value === requestedLocation; }).length) {
            locationSelect.val(requestedLocation);
        }
        locationSelect.on('change', selectLocation);
        $('#siteplan-type').on('change', function () {
            const target = new URL(this.value, window.location.origin);
            if (locationSelect.val()) target.searchParams.set('lokasi', locationSelect.val());
            window.location.assign(target.href);
        });
        selectLocation();
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\siteplan\navigation.blade.php ENDPATH**/ ?>