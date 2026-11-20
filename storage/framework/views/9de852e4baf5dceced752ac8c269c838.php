
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-3 bg-indigo text-white">
                                <div class="d-flex align-content-center justify-content-between">
                                    <h3 class="font-weight-bold text-lg">Form Lampiran Booking</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="formData" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('shared.booking-attachments', ['data' => $data, 'allowDelete' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="modal-footer">
                                        <a href="<?php echo e(route('pengajuan-hold.index')); ?>" class="btn btn-danger">Kembali</a>
                                        <button type="submit" class="btn btn-primary ms-1" id="submitBtn">
                                            <span class="spinner-border spinner-border-sm me-2 d-none" role="status"
                                                aria-hidden="true"></span>
                                            <span class="button-text">Simpan</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        var audio = new Audio('<?php echo e(asset('audio/notification.ogg')); ?>');

        $('#formData').on('submit', function(e) {
            e.preventDefault();

            let submitBtn = $('#submitBtn');
            let spinner = submitBtn.find('.spinner-border');
            let btnText = submitBtn.find('.button-text');

            spinner.removeClass('d-none');
            btnText.text('Menyimpan...');
            submitBtn.prop('disabled', true);

            let id = '<?php echo e($data->id); ?>';
            let url = '<?php echo e(route('pengajuan-hold.upload', ['id' => ':id'])); ?>'.replace(':id', id);
            let method = 'POST';

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            let formData = new FormData(this);
            formData.append('_method', method);

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function() {
                    sessionStorage.setItem('success', 'Lampiran berhasil diupdate!');
                    window.location.href = "<?php echo e(route('pengajuan-hold.index')); ?>";
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        audio.play();
                        toastr.error("Ada inputan yang salah!", "GAGAL!", {
                            progressBar: true,
                            timeOut: 3500,
                            positionClass: "toast-bottom-right",
                        });

                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            const name = key.replace(/^berkas_booking_files\.(.+)$/, 'berkas_booking_files[$1]');
                            let input = $('#formData :input').filter(function () { return this.name === name; });
                            input.addClass('is-invalid');
                            input.parent().find('.invalid-feedback').remove();
                            input.parent().append(
                                '<span class="invalid-feedback" role="alert"><strong>' +
                                val[0] + '</strong></span>'
                            );
                        });

                        spinner.addClass('d-none');
                        btnText.text('Simpan');
                        submitBtn.prop('disabled', false);
                    }
                }
            });
        });

        $(document).on('click', '.btnHapusFoto', function(e) {
            e.preventDefault();

            let button = $(this);
            let field = button.data('field');
            let id = button.data('id');
            let previewContainer = button.parent();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'File ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<span class="swal-btn-text">Ya, Hapus</span>',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: false,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary'
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const confirmBtn = Swal.getConfirmButton();
                        const btnText = confirmBtn.querySelector('.swal-btn-text');

                        btnText.innerHTML =
                            '<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span> Menghapus...';
                        confirmBtn.disabled = true;

                        $.ajax({
                            url: `<?php echo e(route('pengajuan-hold.delete-file', ':id')); ?>`
                                .replace(':id', id),
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                field: field
                            },
                            success: function(response) {
                                if (response.success) {
                                    audio.play();
                                    toastr.success("File telah dihapus!",
                                        "BERHASIL", {
                                            progressBar: true,
                                            timeOut: 3500,
                                            positionClass: "toast-bottom-right"
                                        });
                                    previewContainer.html(
                                        '<span style="color: #6c757d;">Tidak ada file</span>'
                                    );
                                    button.remove();
                                    Swal.close();
                                } else {
                                    audio.play();
                                    toastr.error("Gagal menghapus file.",
                                        "GAGAL!", {
                                            progressBar: true,
                                            timeOut: 3500,
                                            positionClass: "toast-bottom-right"
                                        });
                                    btnText.innerHTML = 'Ya, Hapus';
                                    confirmBtn.disabled = false;
                                }
                            },
                            error: function() {
                                audio.play();
                                toastr.error("Gagal menghapus file.", "GAGAL!", {
                                    progressBar: true,
                                    timeOut: 3500,
                                    positionClass: "toast-bottom-right"
                                });
                                btnText.innerHTML = 'Ya, Hapus';
                                confirmBtn.disabled = false;
                            }
                        });
                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\pengajuan_hold\lampiran.blade.php ENDPATH**/ ?>