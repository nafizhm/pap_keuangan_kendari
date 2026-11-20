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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>

<body>

    <header class="custom-navbar" id="customNavbar" data-aos="fade-down" data-aos-duration="1000">
        <nav class="custom-navbar-container">
            <ul class="custom-navbar-left">
                <?php $__currentLoopData = $navItems->slice(0, ceil($navItems->count() / 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($item->url_item ? '#' . $item->url_item : '#'); ?>"
                            class="<?php echo e(request()->url() == url($item->artikel) ? 'custom-navbar-active' : ''); ?>">
                            <?php echo e($item->judul); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="custom-navbar-logo">
                <?php if($logo && $logo->nama_file): ?>
                    <img src="<?php echo e(asset('assets/konten/' . $logo->nama_file)); ?>" alt="Logo">
                <?php else: ?>
                    <img src="<?php echo e(asset('default/logo.png')); ?>" alt="Default Logo">
                <?php endif; ?>
            </div>

            <ul class="custom-navbar-right">
                <?php $__currentLoopData = $navItems->slice(ceil($navItems->count() / 2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e($item->url_item ? '#' . $item->url_item : '#'); ?>"
                            class="<?php echo e(request()->url() == url($item->artikel) ? 'custom-navbar-active' : ''); ?>">
                            <?php echo e($item->judul); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php if(Auth::guard('web')->check()): ?>
                        <a href="<?php echo e(route('beranda.index')); ?>" class="custom-navbar-active">Masuk</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="<?php echo e(request()->routeIs('login') ? 'custom-navbar-active' : ''); ?>">
                            Login
                        </a>
                    <?php endif; ?>

                </li>
            </ul>

            <button class="navbar-toggle" id="navbarToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>

        <ul class="custom-navbar-menu" id="mobileMenu">
            <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e($item->url_item ? '#' . $item->url_item : '#'); ?>"
                        class="<?php echo e(request()->url() == url($item->artikel) ? 'custom-navbar-active' : ''); ?>">
                        <?php echo e($item->judul); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('login')); ?>"
                    class="<?php echo e(request()->routeIs('login') ? 'custom-navbar-active' : ''); ?>">
                    Login
                </a>
            </li>
        </ul>
    </header>


    <main>
        <section id="<?php echo e($beranda->url_item ?? 'home'); ?>" class="slider-area fix p-relative">
            <div class="slider-active">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $path = public_path('assets/konten/' . $slider->nama_file);
                        $imageUrl =
                            file_exists($path) && !is_dir($path)
                                ? asset('assets/konten/' . $slider->nama_file)
                                : asset('default/content1.png');
                    ?>

                    <div class="single-slider slider-bg d-flex align-items-center"
                        style="background-image:url('<?php echo e($imageUrl); ?>')">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="slider-content s-slider-content text-left">
                                        <p style="font-size: 10px; color: white; letter-spacing: 10px; line-height: 1;"
                                            data-animation="fadeInUp" data-delay=".4s">
                                            <?php echo nl2br(e($slider->judul)); ?>

                                        </p>
                                        <h1 style="color: white; font-size: 50px;" data-animation="fadeInUp"
                                            data-delay=".4s">
                                            <?php echo nl2br(e($slider->artikel)); ?>

                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <section class="about-hero patterned-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-duration="1000">
                        <span class="about-subtitle">WHO WE ARE</span>
                        <h1 class="about-title">Rhabayu Property<br>Living In A Modern<br>International City</h1>
                        <p class="about-description">
                            Sebuah kota modern di masa depan dengan hunian berkualitas, fasilitas lengkap dan lokasi
                            paling strategis di Batam.
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="about-stats" data-aos="fade-left" data-aos-duration="1000">
                            <div class="stat" data-aos="zoom-in" data-aos-delay="200">
                                <h2><?php echo e(\Illuminate\Support\Facades\DB::table('kavling_peta')->count()); ?></h2>
                                <p>Total Kavling</p>
                            </div>
                            <div class="stat" data-aos="zoom-in" data-aos-delay="600">
                                <h2><?php echo e(\Illuminate\Support\Facades\DB::table('lokasi_kavling')->count()); ?></h2>
                                <p>Cluster</p>
                            </div>
                            <div class="stat" data-aos="zoom-in" data-aos-delay="800">
                                <h2><?php echo e(\App\Models\Customer::count()); ?></h2>
                                <p>Kepala Keluarga</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section id="<?php echo e($aboutUs->url_item ?? 'about'); ?>" class="about-area about-p pt-120 pb-120 p-relative">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <div class="s-about-img p-relative custom-about-img">
                            <?php if($aboutUs && $aboutUs->nama_file): ?>
                                <img src="<?php echo e(asset('assets/konten/' . $aboutUs->nama_file)); ?>" alt="About Image"
                                    class="img-fluid">
                            <?php else: ?>
                                <img src="<?php echo e(asset('default/content.png')); ?>" alt="Default Image" class="img-fluid">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="about-content s-about-content pl-30">
                            <div class="about-title second-atitle" data-aos="fade-up" data-aos-delay="300">
                                <span>About Us</span>
                                <div class="about-title-flex">
                                    <h2><?php echo e($aboutUs->judul ?? 'Judul tidak tersedia'); ?></h2>
                                    <?php if($aboutUs && $aboutUs->icon): ?>
                                        <i class="<?php echo e($aboutUs->icon); ?>"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p data-aos="fade-up" data-aos-delay="400"><?php echo $aboutUs->artikel ?? 'Konten belum tersedia.'; ?></p>
                            <a href="<?php echo e(route('aboutus')); ?>" class="btn" data-aos="zoom-in"
                                data-aos-delay="500">Lebih Lanjut</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="<?php echo e($product->url_item ?? 'produk'); ?>" class="py-4 py-md-5 px-md-5"
            style="background-color: #6f00ff;">

            <div class="row g-4">
                <?php $__currentLoopData = $primaryContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $path = public_path('assets/konten/' . $item->nama_file);
                        $imageUrl =
                            file_exists($path) && !is_dir($path)
                                ? asset('assets/konten/' . $item->nama_file)
                                : asset('default/content.png');
                    ?>


                    <div class="col-md-4 col-sm-6 mb-4" data-aos="zoom-in" data-aos-duration="800"
                        data-aos-delay="<?php echo e($index * 150); ?>">

                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo e($imageUrl); ?>" class="card-img-top" alt="<?php echo e($item->judul); ?>"
                                style="object-fit: cover; width: 100%; height: 250px;">


                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo e($item->judul); ?></h5>
                                <p class="card-text"><?php echo e($item->artikel); ?></p>
                                <a href="#" class="btn btn-primary mt-auto">Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>

        <section id="<?php echo e($fasilitas->url_item ?? 'fasilitas'); ?>"
            class="services-area services-bg services-two pt-120 pb-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="section-title text-center pl-40 pr-40 mb-80" data-aos="fade-down"
                            data-aos-duration="1000">
                            <span>Our Facilities</span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $animations = ['flip-left'];
                            $animationType = $animations[$index % count($animations)];
                        ?>

                        <div class="col-lg-4 col-md-6 mb-30" data-aos="<?php echo e($animationType); ?>"
                            data-aos-delay="<?php echo e($index * 150); ?>" data-aos-duration="800">
                            <div class="s-single-services">
                                <div class="services-ico2">
                                    <i class="<?php echo e($facility->icon ?? 'fas fa-building'); ?>"></i>
                                </div>
                                <div class="second-services-content2">
                                    <h5><?php echo e($facility->judul ?? 'No Title'); ?></h5>
                                    <p><?php echo e(\Illuminate\Support\Str::limit($facility->artikel ?? 'Deskripsi belum tersedia.', 120)); ?>

                                    </p>
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>

        <section id="<?php echo e($progres->url_item ?? 'siteplan'); ?>" class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
                        <h2 class="fw-bold mb-3"><?php echo e($progres->judul ?? 'Judul tidak tersedia'); ?></h2>
                        <p class="text-muted mb-4"><?php echo e($progres->artikel ?? 'Deskripsi tidak tersedia'); ?></p>
                        <a href="<?php echo e(route('progres')); ?>" class="btn btn-primary btn-lg">
                            Lihat Selengkapnya
                        </a>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="s-about-img p-relative custom-about-img">
                            <?php if($progres && $progres->nama_file): ?>
                                <img src="<?php echo e(asset('assets/konten/' . $progres->nama_file)); ?>" alt="About Image"
                                    class="img-fluid rounded shadow">
                            <?php else: ?>
                                <img src="<?php echo e(asset('default/content.png')); ?>" alt="Default Image"
                                    class="img-fluid rounded shadow">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer-bg footer-p pt-100 pb-80 custom-footer">
        <div class="footer-top pb-30">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <div class="footer-widget mb-30">

                            <div class="footer-map mb-30">
                                <iframe
                                    src="https://www.google.com/maps?q=1.067222,103.954389&hl=es;z=14&amp;output=embed"
                                    width="100%" height="250" style="border:0;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
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
                                    <h5 class="text-white d-inline-block px-3 py-2 rounded">
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

    const toggle = document.getElementById('navbarToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('active');
        mobileMenu.classList.toggle('mobile-menu-active');
    });

    const navbar = document.getElementById('customNavbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });



    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>



</html>
<?php /**PATH D:\2_laravel_project\pap_kendari_keuangan\resources\views\frontend\homepage\homepage.blade.php ENDPATH**/ ?>