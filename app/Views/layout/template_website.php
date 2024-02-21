<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="/assets/website/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/website/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/website/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/website/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/website/css/flaticon.css">
    <link rel="stylesheet" href="/assets/website/css/remixicon.css">
    <link rel="stylesheet" href="/assets/website/css/meanmenu.min.css">
    <link rel="stylesheet" href="/assets/website/css/odometer.min.css">
    <link rel="stylesheet" href="/assets/website/css/animate.min.css">
    <link rel="stylesheet" href="/assets/website/css/style.css">
    <link rel="stylesheet" href="/assets/website/css/dark-mode.css">
    <link rel="stylesheet" href="/assets/website/css/responsive.css">
    <link rel="stylesheet" href="/assets/website/css/select2.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/website/images/favicon.ico">
    <!-- Title -->
    <title><?= $title; ?></title>

    <meta name="description" content="<?= $metaDescription; ?>">
</head>

<body>

    <!-- Load Preloader -->
    <?= $this->include('layout/website/preloader'); ?>

    <!-- Load Header -->
    <div style="border-top: 4px solid #0de0fe;position:fixed;z-index:1200;width:100%"></div>
    <?= $this->include('layout/website/header'); ?>

    <!-- Load Navbar -->
    <?= $this->include('layout/website/navbar'); ?>

    <!-- Load Body -->
    <?= $this->renderSection('bodyWebsite'); ?>

    <!-- Load Footer -->
    <?= $this->include('layout/website/footer'); ?>
    <!-- End Load Footer -->


    <!-- Start Go Top Area -->
    <div class="wa-button">
        <a href="https://wa.me/123456789" target="_blank">
            <i class="ri-whatsapp-line"></i>
        </a>
    </div>
    <div class="go-top">
        <i class="ri-arrow-up-s-fill"></i>
        <i class="ri-arrow-up-s-fill"></i>
    </div>
    <!-- End Go Top Area -->

    <!-- Links of JS File -->
    <script src="/assets/website/js/jquery.min.js"></script>
    <script src="/assets/website/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/website/js/meanmenu.min.js"></script>
    <script src="/assets/website/js/owl.carousel.min.js"></script>
    <script src="/assets/website/js/swiper-bundle.min.js"></script>
    <script src="/assets/website/js/appear.min.js"></script>
    <script src="/assets/website/js/odometer.min.js"></script>
    <script src="/assets/website/js/wow.min.js"></script>
    <script src="/assets/website/js/jspdf.debug.js"></script>
    <script src="/assets/website/js/form-validator.min.js"></script>
    <script src="/assets/website/js/contact-form-script.js"></script>
    <script src="/assets/website/js/ajaxchimp.min.js"></script>
    <script src="/assets/website/js/select2.min.js"></script>
    <script src="/assets/website/js/custom.js"></script>

    <script>
        // Sticky, Go To Top JS
        $(window).on('scroll', function() {
            // Header Sticky JS
            if ($(this).scrollTop() > 150) {
                $('.navbar-area').addClass("is-sticky");
            } else {
                $('.navbar-area').removeClass("is-sticky");
            };

            // Go To Top JS
            var scrolled = $(window).scrollTop();
            if (scrolled > 300) $('.go-top').addClass('active');
            if (scrolled < 300) $('.go-top').removeClass('active');
        });
    </script>
</body>

</html>