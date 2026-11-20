<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?php
        $konfigurasi = \App\Models\PengaturanProfil::first();
        ?>

        <title><?php echo e($konfigurasi->nama_perusahaan ?? 'Template Aplikasi'); ?></title>
        <?php
        $logoIcon = \App\Models\PengaturanMedia::where('jenis_data', 'fav icon')->first();
        ?>

        <?php if($logoIcon && $logoIcon->nama_file): ?>
        <link rel="icon" href="<?php echo e(asset('config_media/' . $logoIcon->nama_file)); ?>">
        <?php endif; ?>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/animate.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/magnific-popup.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/dripicons.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/slick.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/default.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('templateHomepage/css/responsive.css')); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css" />
        <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    </head>
    <body>

    <header
        class="header-section position-relative d-flex align-items-center"
        style="
            height: 50vh;
            background-image:
            linear-gradient(rgba(0, 45, 90, 0.50), rgb(103, 17, 242)),
            url('/assets/img/thumnail-marketing.webp');
            padding-left: 3rem;
            color: white;
        ">


        <div class="content position-relative" style="z-index: 2; max-width: 600px;">
            <h1 class="fw-bold" style="font-weight: 800; font-size: 3rem; margin-bottom: 0.3rem; color: white;">
                Our Agents
            </h1>
            <div style="width: 80px; height: 4px; background-color: white; margin-bottom: 1rem;"></div>
            <p class="lead" style="font-size: 15px; line-height: 1.4; color: white;">
                Temui tim agen marketing profesional kami yang berdedikasi membantu Anda menemukan hunian impian di perumahan berkualitas. Dengan pengalaman dan pengetahuan mendalam tentang properti lokal, mereka siap memberikan layanan terbaik serta informasi akurat demi kenyamanan dan kepuasan Anda dalam memilih rumah yang tepat.
            </p>
        </div>
    </header>


<main class="container my-5">
    <div class="row">
        <?php $__currentLoopData = $marketing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-md-4 col-lg-3 my-4"
                 data-aos="zoom-in"
                 data-aos-delay="<?php echo e($loop->index * 150); ?>">
                <div class="card shadow-sm h-100 card-hover-popup" style="transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;">
                    <img src="<?php echo e(asset('assets/marketing/marketing_offline/' . $agent->foto)); ?>"
                         class="card-img-top"
                         alt="<?php echo e($agent->nama_marketing); ?>"
                         style="object-fit: cover; height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #272727;"><?php echo e($agent->nama_marketing); ?></h5>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center">
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:<?php echo e($agent->no_telp); ?>"><?php echo e($agent->no_telp); ?></a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:<?php echo e($agent->email); ?>"><?php echo e($agent->email); ?></a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fa-solid fa-venus-mars"></i>
                                <span>
                                    <?php if($agent->jenis_kelamin == 1): ?>
                                        Laki-laki
                                    <?php elseif($agent->jenis_kelamin == 2): ?>
                                        Perempuan
                                    <?php else: ?>
                                        Tidak diketahui
                                    <?php endif; ?>
                                </span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fa-solid fa-house"></i>
                                <span><?php echo e($agent->alamat); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</main>


   <footer id="<?php echo e($tertiaryContent->url_item ?? 'contact'); ?>" class="footer-bg footer-p pt-100 pb-80 custom-footer" >
    <div class="footer-top pb-30">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-lg-6 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="footer-map mb-30">
                            <iframe
                                src="https://www.google.com/maps?q=1.067222,103.954389&hl=es;z=14&amp;output=embed"
                                width="100%"
                                height="250"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footerItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($footerItem->judul && $footerItem->artikel): ?>
                        <div class="col-xl-6 col-lg-3 col-sm-6">
                            <div class="footer-widget mb-30">
                                <div class="f-widget-title">
                                    <h5><?php echo e($footerItem->judul); ?></h5>
                                </div>
                                <div class="footer-link">
                                    <?php echo nl2br(e($footerItem->artikel)); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

             <?php if($tertiaryContent && $tertiaryContent->judul && $tertiaryContent->artikel): ?>
                <div class="col-12">
                    <div class="footer-widget mb-30 text-end">
                        <div class="f-widget-title">
                            <h5 class=" text-white d-inline-block px-3 py-2 rounded">
                                <i class="fas fa-phone-alt me-2"></i> <?php echo e($tertiaryContent->judul); ?>

                            </h5>
                            <p class="text-white mt-2"><?php echo e($tertiaryContent->artikel); ?></p>

                            <a href="#" class="btn btn-info mt-2">
                                <i class="fas fa-envelope me-1"></i> Kontak Kami
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    $konfigurasi = \App\Models\PengaturanProfil::first();
                    ?>
                    <div class="copyright-text text-center">
                        <p>&copy; 2025 <?php echo e($konfigurasi->nama_perusahaan ?? 'Template Aplikasi'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<script src="<?php echo e(asset('templateHomepage/js/vendor/modernizr-3.5.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/vendor/jquery-1.12.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/one-page-nav-min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/ajax-form.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/paroller.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/js_isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/imagesloaded.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/parallax.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/jquery.waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/jquery.scrollUp.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/jquery.magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/element-in-view.js')); ?>"></script>
<script src="<?php echo e(asset('templateHomepage/js/main.js')); ?>"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

</body>
<script>
     AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });


document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});


</script>



</html>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\frontend\homepage\marketing.blade.php ENDPATH**/ ?>