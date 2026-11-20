<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"></div></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-3 d-flex justify-content-between align-items-center">
                    <h3 class="font-weight-bold text-lg mb-0">Master Jenis Berkas</h3>
                    <?php if($permissions['tambah']): ?>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalForm">
                            <i class="fas fa-plus"></i> Tambah Jenis Berkas
                        </button>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped data-table w-100">
                        <thead><tr><th width="50">No</th><th>Nama Jenis Berkas</th><th width="100">Urutan</th><th width="120">Status</th><th width="150">Action</th></tr></thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md"><div class="modal-content">
        <div class="modal-header bg-indigo">
            <h5 class="modal-title text-white font-weight-bold" id="modalFormLabel">Tambah Jenis Berkas</h5>
            <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <form id="formData"><?php echo csrf_field(); ?>
            <input type="hidden" id="primary_id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama Jenis Berkas</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: Sertifikat">
                </div>
                <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" min="0" name="urutan" id="urutan" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="aktif">Status</label>
                    <select name="aktif" id="aktif" class="form-control">
                        <option value="1">Aktif</option><option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitBtn"><span class="button-text">Simpan</span></button>
            </div>
        </form>
    </div></div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(function () {
    const permissions = <?php echo json_encode($permissions, 15, 512) ?>;
    $('.data-table').DataTable({
        processing: false, serverSide: false, ordering: false, responsive: true,
        ajax: '<?php echo e(route('jenis-berkas.index')); ?>',
        columns: [
            {data:'DT_RowIndex', searchable:false}, {data:'nama'}, {data:'urutan'}, {data:'aktif'},
            {data:'action', searchable:false, visible: permissions.edit == 1 || permissions.hapus == 1, className:'text-center'}
        ]
    });
});

$(document).on('click', '[data-target="#modalForm"]', function () {
    $('#modalFormLabel').text('Tambah Jenis Berkas');
});

$(document).on('click', '.edit-button', function () {
    $.get($(this).data('url'), function (response) {
        $('#modalFormLabel').text('Edit Jenis Berkas');
        $('#primary_id').val(response.data.id);
        $('#nama').val(response.data.nama);
        $('#urutan').val(response.data.urutan);
        $('#aktif').val(response.data.aktif ? '1' : '0');
        $('#modalForm').modal('show');
    });
});

$('#modalForm').on('hidden.bs.modal', function () {
    $('#formData')[0].reset(); $('#primary_id').val('');
    $('.is-invalid').removeClass('is-invalid'); $('.invalid-feedback').remove();
});

$('#formData').on('submit', function (e) {
    e.preventDefault();
    const id = $('#primary_id').val();
    const url = id ? '<?php echo e(route('jenis-berkas.update', ':id')); ?>'.replace(':id', id) : '<?php echo e(route('jenis-berkas.store')); ?>';
    const data = new FormData(this); data.append('_method', id ? 'PUT' : 'POST');
    $('#submitBtn').prop('disabled', true);
    $.ajax({url, method:'POST', data, contentType:false, processData:false,
        success: function () { $('#modalForm').modal('hide'); $('.data-table').DataTable().ajax.reload(); toastr.success('Jenis berkas berhasil disimpan.'); },
        error: function (xhr) {
            $('.is-invalid').removeClass('is-invalid'); $('.invalid-feedback').remove();
            $.each(xhr.responseJSON?.errors || {}, function (key, val) {
                $('#' + key).addClass('is-invalid').after('<span class="invalid-feedback"><strong>' + val[0] + '</strong></span>');
            });
        }, complete: function () { $('#submitBtn').prop('disabled', false); }
    });
});

$(document).on('click', '.delete-button', function (e) {
    e.preventDefault(); const form = $(this).closest('form');
    Swal.fire({title:'Hapus jenis berkas?', text:'Kolom ini tidak akan ditampilkan lagi.', icon:'warning', showCancelButton:true, confirmButtonText:'Ya, Hapus', cancelButtonText:'Batal'})
        .then(result => { if (result.isConfirmed) $.post(form.attr('action'), form.serialize()).done(() => { $('.data-table').DataTable().ajax.reload(); toastr.success('Jenis berkas dihapus.'); }); });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\master\jenis_berkas\index.blade.php ENDPATH**/ ?>