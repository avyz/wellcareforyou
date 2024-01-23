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
    <title><?= lang('Errors.pageNotFound') ?></title>
</head>

<body>
    <!-- <div class="wrap">
        <h1>404</h1>

        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>
    </div> -->
    <!-- Start 404 Error Page Area -->
    <div class="error-area ptb-100">
        <div class="container">
            <div class="error-content">
                <img src="/assets/website/images/404_other.png" alt="Image">
                <p>
                    <?php if (ENVIRONMENT !== 'production') : ?>
                        <?= nl2br(esc($message)) ?>
                    <?php else : ?>
                        <?= lang('Errors.sorryCannotFind') ?>
                    <?php endif; ?>
                </p>
                <div class="d-block">
                    <a href="/" class="default-btn">
                        Go To Home
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 Error Page Area -->

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