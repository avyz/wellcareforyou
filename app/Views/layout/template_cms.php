<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta name="language" content="<?= $language_row['lang_code']; ?>">


    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="/assets/cms/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/main.css" rel="stylesheet" type="text/css" />
    <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>
        <link href="/assets/cms/css/user-navbar.css" rel="stylesheet" type="text/css" />
        <link href="/assets/cms/css/user-footer.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/assets/website/css/responsive.css">
        <link rel="stylesheet" href="/assets/website/css/meanmenu.min.css">
        <link rel="stylesheet" href="/assets/website/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="/assets/website/css/owl.carousel.min.css">
        <link rel="stylesheet" href="/assets/website/css/swiper-bundle.min.css">
        <link rel="stylesheet" href="/assets/website/css/select2.min.css">
    <?php endif; ?>
    <link href="/assets/cms/css/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/tabs.css" rel="stylesheet" type="text/css" />
    <link href="/assets/cms/css/structure.css" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/assets/cms/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/assets/cms/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/website/css/remixicon.css">
    <link rel="stylesheet" href="/assets/cms/table/datatable/datatables.css" type="text/css">
    <link rel="stylesheet" href="/assets/cms/table/datatable/dt-global_style.css" type="text/css">
    <link rel="stylesheet" href="/assets/cms/table/datatable/custom_dt_miscellaneous.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Links Of CSS File -->
    <link href="/assets/cms/css/preloader.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/cms/filepond/filepond.min.css">
    <link rel="stylesheet" href="/assets/cms/filepond/FilePondPluginImagePreview.min.css">
    <!-- <link href="/assets/cms/css/scrollspyNav.css" rel="stylesheet" type="text/css" /> -->
    <link href="/assets/cms/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/website/images/favicon.ico" type="image/x-icon">

    <!-- Title -->
    <title><?= $title; ?></title>
    <script src="/assets/website/js/jquery.min.js"></script>
</head>

<body class="layout-boxed">
    <div class="sweet-alert"></div>
    <!-- Load Preloader -->
    <?= $this->include('layout/website/preloader'); ?>
    <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>
        <!-- Load Header -->
        <div style="border-top: 4px solid #0de0fe;position:fixed;z-index:1200;width:100%"></div>
        <?= $this->include('layout/website/header'); ?>

        <?= $this->include('layout/website/navbar'); ?>
    <?php else : ?>
        <?= $this->include('layout/admin/header'); ?>
    <?php endif; ?>

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container container-xxl" id="container">
        <div class="overlay"></div>

        <div class="px-md-1">
            <div class="px-md-4">
                <?= $this->include('layout/admin/sidebar'); ?>
            </div>
        </div>

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="middle-content container-xxl p-0">
                    <?= $this->include('layout/admin/breadcrumbs') ?>
                    <!-- BODY -->
                    <div class="row layout-top-spacing <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>user-layout-top-spacing<?php endif; ?>">
                        <?php if (session()->getFlashdata('notif')) : ?>
                            <?= session()->getFlashdata('notif') ?>
                        <?php endif; ?>
                        <?= $this->renderSection('bodyCms'); ?>
                    </div>
                    <!-- END BODY -->
                </div>
            </div>
            <!--  BEGIN FOOTER ADMIN  -->
            <?php if (session()->get('is_master') != 0 || session()->get('is_admin') != 0) : ?>
                <div class="footer-wrapper">
                    <div class="footer-section">
                        <p class="">Copyright © <span class="dynamic-year"></span> <a target="_blank" href="/">Renavi Projekt-D</a>, All rights reserved.</p>
                    </div>
                </div>
            <?php endif; ?>
            <!--  END CONTENT AREA  -->
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!--  END MAIN CONTAINER  -->

    <!-- Footer User -->
    <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>
        <?= $this->include('layout/website/footer'); ?>
    <?php endif; ?>
    <!-- End Footer User -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/assets/cms/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        var runTimeOut;
        const url = window.location.origin;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var metaLanguage = $('meta[name="language"]').attr('content');
        var isClick = false;
        var countClicked = 0;

        function datas() {
            var datas = $.ajax({
                url: url + '/check-activity',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (parseInt((Date.now() / 1000)) - parseInt(response.session) >= <?= $idleTime; ?>) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating activity:', error);
                }
            });

            isClick = true;

            return datas;
        }

        $(this).on("click keyup", function() {
            if (countClicked == 0) {
                if (!isClick) {
                    clearInterval(runTimeOut);
                    datas();
                }
            }
            if (isClick) {
                runTimeOut = setInterval(checkActivity, <?= ($idleTime * 1000); ?>);
                isClick = false;
            }
            countClicked++;
        })

        function countsClicked() {
            return countClicked = 0;
        }

        setInterval(countsClicked, <?= ($idleTime * 1000) / 2; ?>);

        function checkActivity() {
            if (!isClick) {
                datas();
            }
        }

        runTimeOut = setInterval(checkActivity, <?= $idleTime * 1000; ?>);
    </script>

    <script src="/assets/cms/js/perfect-scrollbar.min.js"></script>
    <script src="/assets/cms/js/mousetrap.min.js"></script>
    <script src="/assets/cms/js/waves/waves.min.js"></script>
    <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>
        <script src="/assets/website/js/meanmenu.min.js"></script>
        <script src="/assets/website/js/owl.carousel.min.js"></script>
        <script src="/assets/website/js/swiper-bundle.min.js"></script>
        <script src="/assets/website/js/form-validator.min.js"></script>
        <script src="/assets/website/js/ajaxchimp.min.js"></script>
        <script src="/assets/website/js/appear.min.js"></script>
        <script src="/assets/website/js/jspdf.debug.js"></script>
        <script src="/assets/website/js/select2.min.js"></script>
        <script src="/assets/website/js/custom.js"></script>
    <?php else : ?>
        <script>
            // Preloader
            $(window).on('load', function() {
                $('.preloader').addClass('preloader-deactivate');
            })
        </script>
    <?php endif; ?>
    <script src="/assets/cms/js/app.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/assets/cms/apex/apexcharts.min.js"></script>
    <script src="/assets/cms/js/custom.js"></script>
    <script src="/assets/cms/table/datatable/datatables.js"></script>
    <script src="/assets/cms/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/assets/cms/table/datatable/button-ext/jszip.min.js"></script>
    <script src="/assets/cms/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/assets/cms/table/datatable/button-ext/buttons.print.min.js"></script>
    <script src="/assets/cms/js/datatable_custom.js"></script>
    <script src="/assets/cms/js/api.js"></script>
    <script src="/assets/cms/js/menu-management/custom.js"></script>
    <script src="/assets/cms/js/user-management/custom.js"></script>

    <!-- <script src="/assets/cms/js/scrollspyNav.js"></script> -->
    <script src="/assets/cms/filepond/filepond.min.js"></script>
    <script src="/assets/cms/filepond/FilePondPluginFileValidateType.min.js"></script>
    <script src="/assets/cms/filepond/FilePondPluginImageExifOrientation.min.js"></script>
    <script src="/assets/cms/filepond/FilePondPluginImagePreview.min.js"></script>
    <script src="/assets/cms/filepond/FilePondPluginImageCrop.min.js"></script>
    <script src="/assets/cms/filepond/FilePondPluginImageResize.min.js"></script>
    <script src="/assets/cms/filepond/FilePondPluginImageTransform.min.js"></script>
    <script src="/assets/cms/filepond/filepondPluginFileValidateSize.min.js"></script>
    <script src="/assets/cms/filepond/custom-filepond.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


</body>

</html>