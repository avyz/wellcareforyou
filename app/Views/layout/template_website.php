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
    <div class="footer-area bg-color-f1f5f8 pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <a href="index.html" class="logo">
                            <img src="/assets/website/images/logo.png" class="main-logo" alt="logo">
                        </a>
                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec sollicitudin molestie.</p>
                        <h4>177 Devon Lane Miami, MK 3355</h4>
                        <ul class="info">
                            <li>
                                <span>EMAIL US:</span>
                                <a href="mailto:info@bexi.com">info@bexi.com</a>
                            </li>
                            <li>
                                <span>CALL US:</span>
                                <a href="tel:1-885-665-2022">1-885-665-2022</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>Departments</h3>

                        <ul class="import-link">
                            <li>
                                <a href="department.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Emergency Departments
                                </a>
                            </li>
                            <li>
                                <a href="department-orthopedics.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Orthopedics
                                </a>
                            </li>
                            <li>
                                <a href="department.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Neurosciences
                                </a>
                            </li>
                            <li>
                                <a href="department.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Gastroenterology
                                </a>
                            </li>
                            <li>
                                <a href="department.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Bariatric Surgery
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>Helpful Links</h3>

                        <ul class="import-link">
                            <li>
                                <a href="find-a-doctor.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Find a Doctor
                                </a>
                            </li>
                            <li>
                                <a href="hospital.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Find a Hospital
                                </a>
                            </li>
                            <li>
                                <a href="products.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Buy Medicine
                                </a>
                            </li>
                            <li>
                                <a href="terms-conditions.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Terms of Use
                                </a>
                            </li>
                            <li>
                                <a href="privacy-policy.html">
                                    <i class="ri-arrow-right-s-line"></i>
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>Subscribe Our Newsletter</h3>

                        <form class="newsletter-form" data-toggle="validator">
                            <input type="email" class="form-control" placeholder="Email address" name="EMAIL" required autocomplete="off">

                            <button class="default-btn" type="submit">
                                Submit now
                            </button>

                            <div id="validator-newsletter" class="form-result"></div>
                        </form>

                        <ul class="socila-link">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <img src="/assets/website/images/svg-icon/facebook.svg" alt="Image">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <img src="/assets/website/images/svg-icon/twitter.svg" alt="Image">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
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
            </div>
        </div>
    </div>
    <!-- End Footer Area -->

    <!-- Start Copyright Area -->
    <div class="copy-right-area">
        <div class="container">
            <p>© Bexi is Proudly Owned by <a href="https://envytheme.com/" target="_blank">EnvyTheme</a></p>
        </div>
    </div>
    <!-- End Copyright Area -->

    <!-- Start Go Top Area -->
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