<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link href="/assets/cms/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="/assets/cms/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="/assets/cms/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/structure.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/auth-cover.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/website/css/remixicon.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/website/images/favicon.ico" type="image/x-icon">

    <!-- Title -->
    <title><?= $title; ?></title>

    <meta name="description" content="<?= $metaDescription; ?>">
</head>

<body>

    <!-- Load Preloader -->
    <?= $this->include('layout/website/preloader'); ?>

    <!-- Load Body -->
    <?= $this->renderSection('bodyAuth'); ?>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/assets/website/js/jquery.min.js"></script>
    <script src="/assets/cms/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/cms/js/2-Step-Verification.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
        // Preloader
        $(window).on('load', function() {
            $('.preloader').addClass('preloader-deactivate');
        })

        function showPassword(e, nameInput) {
            var i = $(e).children("i");
            i.toggleClass("ri-eye-close-line");
            $("input[name=" + nameInput + "]").attr("type", i.hasClass("ri-eye-close-line") ? "text" : "password");
        }
    </script>
</body>

</html>