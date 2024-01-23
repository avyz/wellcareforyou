<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link rel="icon" type="image/png" href="/assets/website/images/favicon.png">
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

    <!-- Start Footer Area -->
    <div class="footer-area bg-color-0057b8 pt-100 pb-70">
        <div class="container text-white">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <a href="index.html" class="logo">
                            <img src="/assets/website/images/logo_white.png" class="main-logo" alt="logo">
                        </a>
                        <p class="text-white">Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec sollicitudin molestie.</p>
                        <h4 class="text-white">Registration</h4>
                        <p class="mt-1 text-white">
                            Monday - Saturday
                            <br>
                            08.00 - 16.00 (GMT +8)
                        </p>
                        <ul class="socila-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <img src="/assets/website/images/svg-icon/facebook.svg" alt="Image">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.twitter.com/" target="_blank">
                                    <img src="/assets/website/images/svg-icon/twitter.svg" alt="Image">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <img src="/assets/website/images/svg-icon/linkedin.svg" alt="Image">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <img src="/assets/website/images/svg-icon/instagram.svg" alt="Image">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget ps-lg-4">
                        <h3 class="text-white">COMPANY</h3>

                        <ul class="import-link">
                            <li>
                                <a class="text-white" href="/about">
                                    <i class="ri-arrow-right-s-line"></i>
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/privacy-policy">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/terms-conditions">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Terms & Conditions
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/news-blog">
                                    <i class="ri-arrow-right-s-line"></i>
                                    News & Blog
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3 class="text-white">DIRECTORY</h3>

                        <ul class="import-link">
                            <li>
                                <a class="text-white" href="/hospitals">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Hospitals
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/doctors">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Doctors
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/pharmacies">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Pharmacies
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/specialists">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Specialists
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3 class="text-white">GET IN TOUCH</h3>

                        <ul class="import-link">
                            <li>
                                <a class="text-white" href="/contact-us">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Contact Us
                                </a>
                            </li>
                            <li>
                                <a class="text-white" href="/carreer">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Carreer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Area -->

    <!-- Start Copyright Area -->
    <div class="copy-right-area">
        <div class="container">
            <p>© <span id="c-year"></span> Renavi Projekt-D copyright</p>
        </div>
    </div>
    <!-- End Copyright Area -->

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
</body>

</html>