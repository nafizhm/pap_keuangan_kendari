
<?php $__env->startPush('css'); ?>
    <style>
        .booking-verification .content-header { padding: 24px 20px; }
        .booking-verification .card { border: 1px solid #dce8ef; border-radius: 12px; box-shadow: 0 4px 18px rgba(8,62,89,.06); }
        .booking-verification .card-header { border-radius: 12px 12px 0 0; }
        .booking-verification .card-body { padding: 24px; }
        .booking-verification .verification-heading { font-size: 16px; font-weight: 700; color: var(--brand-primary); border-bottom: 1px solid #dce8ef; padding-bottom: 12px; margin-bottom: 22px; }
        .booking-verification .form-group { margin-bottom: 18px; }
        .booking-verification .col-form-label { font-size: 14px; font-weight: 600; }
        .booking-verification .form-control { border-radius: 6px; }
        .booking-verification .agreement-upload { background: #f3f9fc; border: 1px dashed #9dc8dd; border-radius: 10px; padding: 20px; }
        .dark-mode .booking-verification .agreement-upload { background: #1f2937; border-color: #45647a; }
        .dark-mode .booking-verification .card { border-color: #374151; }
        @media (min-width: 768px) { .booking-verification #formData > .row > .col-md-6 { padding-left: 20px; padding-right: 20px; } }
        @media (max-width: 767px) { .booking-verification .card-body { padding: 16px; } .booking-verification .verification-heading { margin-top: 16px; } }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper booking-verification">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex flex-wrap justify-content-between align-items-center" style="gap: 12px;">
                    <div><h1 class="h4 font-weight-bold mb-1">Verifikasi Booking</h1><p class="text-muted mb-0">Periksa data pelanggan, kelengkapan dokumen, dan pembayaran sebelum memberikan persetujuan.</p></div>
                    <a href="<?php echo e(route('pengajuan-hold.index')); ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-3 bg-indigo text-white">
                                <div class="d-flex align-content-center justify-content-between">
                                    <h3 class="font-weight-bold text-lg">Verifikasi Data Booking</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="formData" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="verification-heading"><i class="fas fa-user mr-2"></i>Data Pelanggan & Booking</h4>
                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Tanggal</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="tgl_booking" id="tgl_booking" value="<?php echo e($data->tgl_booking); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo e($data->nama_lengkap); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nik" id="nik" value="<?php echo e($data->nik); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Jenis
                                                Kelamin</label>
                                            <div class="col-sm-8">
                                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control"><option value=""></option><option value="Laki-laki" <?php echo e($data->jenis_kelamin == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option><option value="Perempuan" <?php echo e($data->jenis_kelamin == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option></select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Tempat Lahir</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo e($data->tempat_lahir); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Tanggal
                                                Lahir</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="tgl_lahir" id="tgl_lahir" value="<?php echo e($data->tgl_lahir); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Alamat KTP</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat_ktp" id="alamat_ktp" value="<?php echo e($data->alamat_ktp); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">NPWP</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="npwp" id="npwp" value="<?php echo e($data->npwp); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="no_bpjs_kes" class="col-sm-4 col-form-label">No. BPJS Kes</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="no_bpjs_kes" id="no_bpjs_kes" value="<?php echo e($data->no_bpjs_kes); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email" id="email" value="<?php echo e($data->email); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Nomor
                                                Telepon</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="no_telp" id="no_telp" value="<?php echo e($data->no_telp); ?>" class="form-control">
                                            </div>
                                        </div>

                                        <?php echo $__env->make('shared.emergency-contacts', ['data' => $data ?? null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Nama Marketing</label>
                                            <div class="col-sm-8">
                                                <select name="id_marketing" id="id_marketing" class="form-control"><option value=""></option><option value="0" <?php echo e((string) $data->id_marketing === "0" ? "selected" : ""); ?>>Non Marketing</option>
<?php $__currentLoopData = $marketingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($option->id); ?>" <?php echo e($data->id_marketing == $option->id ? 'selected' : ''); ?>><?php echo e($option->nama_marketing); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Lokasi Perumahan</label>
                                            <div class="col-sm-8">
                                                <select name="id_lokasi" id="id_lokasi" class="form-control"><option value=""></option>
<?php $__currentLoopData = $lokasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($option->id); ?>" <?php echo e($data->id_lokasi == $option->id ? 'selected' : ''); ?>><?php echo e($option->nama_kavling); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Blok Kavling</label>
                                            <div class="col-sm-8">
                                                <select name="id_kavling" id="id_kavling" class="form-control"><option value=""></option>
<?php $__currentLoopData = $kavlingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($option->id); ?>" <?php echo e($data->id_kavling == $option->id ? 'selected' : ''); ?>><?php echo e($option->kode_kavling); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
                                            </div>
                                        </div>

                                        <div id="rincian-biaya">
                                        <?php $__currentLoopData = $data->rincian_biaya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(($item['nilai'] ?? 0) > 0): ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><?php echo e($item['nama'] ?? '-'); ?></label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Rp.</span>
                                                            </div>
                                                            <input type="text"
                                                                value="<?php echo e(number_format($item['nilai'], 0, ',', '.')); ?>"
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><strong>Total Harga</strong></label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text"
                                                        id="total_harga" value="<?php echo e(number_format($data->total_harga, 0, ',', '.')); ?>"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alamat_domisili" class="col-sm-4 col-form-label">Alamat Domisili</label>
                                            <div class="col-sm-8"><input type="text" name="alamat_domisili" id="alamat_domisili" value="<?php echo e($data->alamat_domisili); ?>" class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-8"><input type="text" name="pekerjaan" id="pekerjaan" value="<?php echo e($data->pekerjaan); ?>" class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="status_pernikahan" class="col-sm-4 col-form-label">Status Pernikahan</label>
                                            <div class="col-sm-8"><input type="text" name="status_pernikahan" id="status_pernikahan" value="<?php echo e($data->status_pernikahan); ?>" class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_p" class="col-sm-4 col-form-label">Nama Pasangan</label>
                                            <div class="col-sm-8"><input type="text" name="nama_p" id="nama_p" value="<?php echo e($data->nama_p); ?>" class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nik_p" class="col-sm-4 col-form-label">NIK Pasangan</label>
                                            <div class="col-sm-8"><input type="text" name="nik_p" id="nik_p" value="<?php echo e($data->nik_p); ?>" class="form-control"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Jenis
                                                Perumahan</label>
                                            <div class="col-sm-8">
                                                <select name="jenis_perumahan" id="jenis_perumahan" class="form-control"><option value=""></option><option value="Subsidi" <?php echo e($data->jenis_perumahan == 'Subsidi' ? 'selected' : ''); ?>>Subsidi</option><option value="Komersil" <?php echo e($data->jenis_perumahan == 'Komersil' ? 'selected' : ''); ?>>Komersil</option></select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_registrasi" class="col-sm-4 col-form-label">Booking
                                                Fee</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Rp.</span>
                                                    </div>
                                                    <input type="text" name="booking_fee" id="booking_fee"
                                                        value="<?php echo e(number_format((float) $data->booking_fee, 0, ',', '.')); ?>"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h4 class="verification-heading"><i class="fas fa-folder-open mr-2"></i>Lampiran Pendukung</h4>
<?php echo $__env->make('shared.booking-upload-verification', ['data' => $data], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
                                </div>

                                <hr>


                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" id="primary_id" name="primary_id"
                                        value="<?php echo e($data->id); ?>">

                                    <h4 class="verification-heading"><i class="fas fa-file-signature mr-2"></i>Perjanjian Booking</h4>
                                    <div class="agreement-upload mb-4">
                                        <label for="perjanjian_booking">Unggah Dokumen Perjanjian Booking</label>
                                        <p class="text-muted small">Wajib dilengkapi sebelum status diubah menjadi Disetujui. Format PDF, JPG, JPEG, atau PNG; maksimal 10 MB.</p>
                                        <?php if($agreementFile = $data->berkas_booking['perjanjian_booking']['file'] ?? null): ?>
                                            <a href="<?php echo e(asset('assets/booking/' . $agreementFile)); ?>" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm mb-3"><i class="fas fa-file-alt mr-1"></i>Lihat Perjanjian Booking</a>
                                        <?php endif; ?>
                                        <input type="file" name="perjanjian_booking" id="perjanjian_booking" class="form-control-file" accept="application/pdf,image/jpeg,image/png" aria-describedby="agreement-help">
                                        <small id="agreement-help" class="text-muted d-block mt-2"><?php echo e($agreementFile ? 'Unggah file baru hanya jika ingin mengganti dokumen.' : 'Dokumen belum diunggah.'); ?></small>
                                    </div>
                                    <h4 class="verification-heading"><i class="fas fa-check-circle mr-2"></i>Keputusan Verifikasi</h4>

                                    <div class="form-group row">
                                        <label for="stt_reg" class="col-sm-2 col-form-label">Status Verifikasi</label>
                                        <div class="col-sm-3">
                                            <select name="stt_reg" id="stt_reg" class="form-control select-status">
                                                <option value=""></option>
                                                <option value="1" <?php echo e($data->stt_reg == 1 ? 'selected' : ''); ?>>Pending
                                                </option>
                                                <option value="2" <?php echo e($data->stt_reg == 2 ? 'selected' : ''); ?>>
                                                    Disetujui
                                                </option>
                                                <option value="3" <?php echo e($data->stt_reg == 3 ? 'selected' : ''); ?>>Ditolak
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Metode Bayar</label>
                                        <div class="col-sm-3">
                                            <select class="form-select select-metode-bayar" name="id_metode_bayar"
                                                id="id_metode_bayar">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $metodeBayarList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>" <?php if(old('id_metode_bayar', $data->id_metode_bayar) == $item->id): echo 'selected'; endif; ?>><?php echo e($item->jenis_bayar); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <label for="id_bank" class="col-sm-2 col-form-label">Rekening Pembayaran</label>
                                        <div class="col-sm-3">
                                            <select class="form-select select-bank" name="id_bank" id="id_bank">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $bankList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>" <?php if(old('id_bank', $data->id_bank) == $item->id): echo 'selected'; endif; ?>><?php echo e($item->nama); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jenis_pembelian" class="col-sm-2 col-form-label">Jenis
                                            Pembelian</label>
                                        <div class="col-sm-3">
                                            <select name="jenis_pembelian" id="jenis_pembelian"
                                                class="form-control select-pembelian">
                                                <option value=""></option>
                                                <option value="Pembelian Cash"
                                                    <?php echo e($data->jenis_pembelian == 'Pembelian Cash' ? 'selected' : ''); ?>>
                                                    Pembelian Cash</option>
                                                <option value="Cash Bertahap"
                                                    <?php echo e($data->jenis_pembelian == 'Cash Bertahap' ? 'selected' : ''); ?>>Cash
                                                    Bertahap</option>
                                                <option value="KPR"
                                                    <?php echo e($data->jenis_pembelian == 'KPR' ? 'selected' : ''); ?>>KPR</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- CASH ==================================> -->
                                    <hr class="hr-transaksi" style="display: none;">
                                    <div id="trx_cash" style="display: none;">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Atas Nama Surat</label>
                                            <div class="col-sm-3">
                                                <input name="an_surat_cash" id="an_surat_cash" class="form-control"
                                                    type="text"
                                                    value="<?php echo e($data->an_surat_cash ?? $data->nama_lengkap); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CASH BERTAHAP ==================================> -->
                                    <hr class="hr-transaksi" style="display: none;">
                                    <div id="trx_cash_bertahap" style="display: none;">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Termin (x)</label>
                                            <div class="col-sm-2">
                                                <div class="input-group">
                                                    <input name="termin_x_cash_b" id="termin_x_cash_b"
                                                        class="form-control format-number"
                                                        value="<?php echo e(isset($data->termin_x_cash_b) && $data->termin_x_cash_b != 0 ? number_format($data->termin_x_cash_b, 0, ',', '.') : 60); ?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Bulan</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer text-center">
                                        <a href="<?php echo e(route('pengajuan-hold.index')); ?>" class="btn btn-danger">Kembali</a>

                                        <button type="submit" class="btn btn-primary ms-1" id="submitBtn"
                                            <?php if(isset($data) && $data->stt_reg == 2): ?> readonly <?php endif; ?>>
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
    <div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="attachmentModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="attachmentModalTitle">Lampiran Booking</h5><button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body text-center" style="overflow:auto;max-height:80vh;">
                <div id="attachmentZoomControls" class="mb-2"><button type="button" class="btn btn-sm btn-secondary" id="zoomOut">−</button> <button type="button" class="btn btn-sm btn-secondary" id="zoomReset">100%</button> <button type="button" class="btn btn-sm btn-secondary" id="zoomIn">+</button></div>
                <img id="attachmentImage" alt="Lampiran booking" style="max-width:100%;height:auto;">
                <iframe id="attachmentPdf" title="Lampiran PDF" style="width:100%;height:65vh;border:0;" class="d-none"></iframe>
            </div>
        </div></div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            function updateAgreementRequirement() {
                $('#perjanjian_booking').prop('required', $('#stt_reg').val() === '2' && ! <?php echo json_encode((bool) ($data->berkas_booking['perjanjian_booking']['file'] ?? false), 15, 512) ?>);
            }
            $('#stt_reg').on('change', updateAgreementRequirement);
            updateAgreementRequirement();
            const kavlings = <?php echo json_encode($kavlingList, 15, 512) ?>;
            const originalKavling = <?php echo json_encode((string) $data->id_kavling, 15, 512) ?>;
            function fillKavlings(selected) {
                const select = $('#id_kavling').empty().append(new Option('', ''));
                kavlings.filter(item => String(item.id_lokasi) === $('#id_lokasi').val()).forEach(item => {
                    select.append(new Option(item.kode_kavling, item.id, false, String(item.id) === selected));
                });
            }
            fillKavlings(originalKavling);
            $('#id_lokasi').on('change', function() {
                fillKavlings('');
                $('#id_kavling').trigger('change');
            });
            $('#id_kavling').on('change', function() {
                const item = kavlings.find(item => String(item.id) === $(this).val());
                const rincian = item ? (item.rincian_biaya || []) : [];
                const container = $('#rincian-biaya').empty();
                let total = 0;
                rincian.forEach(cost => {
                    total += Number(cost.nilai || 0);
                    if (Number(cost.nilai) <= 0) return;
                    const row = $('<div class="form-group row">');
                    $('<label class="col-sm-4 col-form-label">').text(cost.nama || '-').appendTo(row);
                    const input = $('<div class="col-sm-8"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Rp.</span></div></div></div>');
                    $('<input type="text" class="form-control" readonly>').val(Number(cost.nilai).toLocaleString('id-ID')).appendTo(input.find('.input-group'));
                    row.append(input).appendTo(container);
                });
                $('#total_harga').val(total.toLocaleString('id-ID'));
            });
            $('#booking_fee').on('input', function() {
                const value = this.value.replace(/\D/g, '');
                this.value = value ? Number(value).toLocaleString('id-ID') : '';
            });

            let zoom = 1;
            function setZoom(value) {
                zoom = Math.max(0.25, Math.min(4, value));
                $('#attachmentImage').css({width: (zoom * 100) + '%', maxWidth: 'none'});
                $('#zoomReset').text(Math.round(zoom * 100) + '%');
            }
            $(document).on('click', '.attachment-preview', function() {
                const isPdf = $(this).attr('data-pdf') === '1';
                const url = $(this).attr('data-url');
                $('#attachmentImage').toggleClass('d-none', isPdf).attr('src', isPdf ? '' : url);
                $('#attachmentPdf').toggleClass('d-none', !isPdf).attr('src', isPdf ? url : '');
                $('#attachmentZoomControls').toggle(!isPdf);
                setZoom(1);
                $('#attachmentModal').modal('show');
            });
            $('#zoomIn').on('click', () => setZoom(zoom + 0.25));
            $('#zoomOut').on('click', () => setZoom(zoom - 0.25));
            $('#zoomReset').on('click', () => setZoom(1));
            $('#attachmentModal').on('hidden.bs.modal', function() {
                $('#attachmentImage, #attachmentPdf').removeAttr('src');
            });
            $('.attachment-input').each(function() {
                $(this).data('original-preview', $(this).siblings('.img-thumbnail').html());
            }).on('change', function() {
                const input = $(this);
                const thumbnail = input.siblings('.img-thumbnail');
                const previousUrl = input.data('preview-url');
                if (previousUrl) URL.revokeObjectURL(previousUrl);
                const file = this.files[0];
                if (!file) {
                    thumbnail.html(input.data('original-preview'));
                    return;
                }
                const isPdf = file.type === 'application/pdf';
                if (file.size > 10 * 1024 * 1024 || !(['image/jpeg', 'image/png', 'image/webp'].includes(file.type) || isPdf)) {
                    toastr.error('Pilih JPG, PNG, WEBP atau PDF, maksimal 10 MB.');
                    this.value = '';
                    thumbnail.html(input.data('original-preview'));
                    return;
                }
                const url = URL.createObjectURL(file);
                input.data('preview-url', url);
                const button = $('<button type="button" class="btn p-0 attachment-preview" aria-label="Perbesar lampiran" style="width:100%;height:100%;">').attr({'data-url': url, 'data-pdf': isPdf ? '1' : '0'});
                if (isPdf) button.text('Lihat PDF');
                else button.append($('<img alt="Lampiran baru" style="max-width:100%;max-height:100%;">').attr('src', url));
                thumbnail.empty().append(button);
            });
        });
        $(document).ready(function() {
            $('.select-status').select2({
                theme: "bootstrap4",
                minimumResultsForSearch: Infinity,
            });

            $('.select-jenis').select2({
                theme: "bootstrap4",
                placeholder: 'Pilih Jenis Pembelian',
                minimumResultsForSearch: Infinity,
            });

            $('.select-bank').select2({
                theme: "bootstrap4",
                placeholder: 'Pilih Bank',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            $('.select-metode-bayar').select2({
                theme: "bootstrap4",
                placeholder: 'Pilih Metode Bayar',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            $('.select-pembelian').select2({
                theme: "bootstrap4",
                placeholder: 'Pilih Jenis Pembelian',
                minimumResultsForSearch: Infinity,
            });
        });

        $(document).ready(function() {
            function hideAllTransactionForms() {
                $('#trx_cash').hide();
                $('#trx_cash_bertahap').hide();
                $('.hr-transaksi').hide();
            }

            $('#jenis_pembelian').on('change', function() {
                let selected = $(this).val();
                hideAllTransactionForms();

                switch (selected) {
                    case 'Pembelian Cash':
                        $('#trx_cash').prev('.hr-transaksi').show();
                        $('#trx_cash').show();
                        break;
                    case 'Cash Bertahap':
                        $('#trx_cash_bertahap').prev('.hr-transaksi').show();
                        $('#trx_cash_bertahap').show();
                        break;
                }
            });

            $('#jenis_pembelian').trigger('change');
        });


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
            let url = '<?php echo e(route('pengajuan-hold.verifikasi.simpan', ['id' => ':id'])); ?>'.replace(':id', id);
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
                success: function(response) {
                    sessionStorage.setItem('success', response.message || 'Data booking berhasil disimpan.');
                    window.location.href = "<?php echo e(route('pengajuan-hold.index')); ?>";
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        audio.play();
                        let errors = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors : {};
                        let firstError = Object.values(errors).flat()[0] || 'Data yang dikirim tidak valid.';

                        toastr.error(firstError, "GAGAL!", {
                            progressBar: true,
                            timeOut: 6000,
                            positionClass: "toast-bottom-right",
                        });

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
                    } else {
                        audio.play();
                        let response = xhr.responseJSON || {};
                        let message = response.message || response.error;

                        if (!message && xhr.status === 419) {
                            message = 'Sesi Anda telah berakhir. Muat ulang halaman lalu coba simpan kembali.';
                        }

                        toastr.error(message || 'Terjadi kesalahan pada server. Silakan coba lagi.', "GAGAL!", {
                            progressBar: true,
                            timeOut: 8000,
                            positionClass: "toast-bottom-right",
                        });
                    }
                    spinner.addClass('d-none');
                    btnText.text('Simpan');
                    submitBtn.prop('disabled', false);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\admin\pengajuan_hold\verif.blade.php ENDPATH**/ ?>