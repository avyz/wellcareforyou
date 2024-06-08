<!-- Start Navbar Area -->
<div class="navbar-area shadow-sm">
    <div class="mobile-responsive-nav">
        <div class="container-xxl px-md-5">
            <div class="mobile-responsive-menu">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/website/images/logo.png" class="main-logo" style="width: 150px;" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="desktop-nav">
        <div class="container-xxl px-md-5">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <?php if ($navbar) : ?>
                            <?php if ($data['type'] != 'edit') : ?>
                                <?php foreach ($navbar as $d) : ?>
                                    <li class="nav-item pt-3 pb-2">
                                        <?php if ($lang_code) : ?>
                                            <a href="<?= $d['navbar_management_url'] ?>?language=<?= $lang_code ?>" class="nav-link border-style menu-link"><?= $d['navbar_management_name'] ?></a>
                                        <?php else : ?>
                                            <a href="<?= $d['navbar_management_url'] ?>" class="nav-link border-style menu-link"><?= $d['navbar_management_name'] ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php foreach ($navbar as $d) : ?>
                                    <li class="nav-item pt-3 pb-2">
                                        <a href="javascript:void(0)" class="nav-link border-style menu-link"><?= $d['navbar_management_name'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/" class="nav-link border-style menu-link">Home</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/about" class="nav-link border-style menu-link">About Us</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/news-blog" class="nav-link border-style menu-link">News & Blog</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/hospitals" class="nav-link border-style menu-link">Hospital</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/doctors" class="nav-link border-style menu-link">Doctors</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/pharmacies" class="nav-link border-style menu-link">Pharmacies</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/specialists" class="nav-link border-style menu-link">Specialists</a>
                            </li>
                            <li class="nav-item pt-3 pb-2">
                                <a href="/contact-us" class="nav-link border-style menu-link">Contact Us</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="others-options ms-auto">
                        <ul class="d-flex align-items-center">
                            <li class="nav-item">
                                <i class="ri-user-3-line"></i>
                                <?php if (session()->get('email')) : ?>
                                    <a href="javascript:void(0)" class="dropdown-toggle border-style" data-bs-toggle="dropdown">Hi, <?= session()->get('nama_depan') ?></a>
                                    <ul class="dropdown-menu" style="font-size: 0.9em;">
                                        <li class="dropdown-item">
                                            <a href="/my-account">My Account</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="/profile">Profile</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="/logout">Logout</a>
                                        </li>
                                    </ul>
                                <?php else : ?>
                                    <a href="/login">Login</a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <?php if ($language_list) : ?>
                                    <?php
                                    if ($lang_code) {
                                        usort($language_list, function ($a, $b) use ($lang_code) {
                                            if ($a['lang_code'] == $lang_code) {
                                                return -1;
                                            } elseif ($b['lang_code'] == $lang_code) {
                                                return 1;
                                            } else {
                                                return 0;
                                            }
                                        });
                                    } else {
                                        $lang_default = 1;
                                        usort($language_list, function ($a, $b) use ($lang_default) {
                                            if ($a['is_lang_default'] == $lang_default) {
                                                return -1;
                                            } elseif ($b['is_lang_default'] == $lang_default) {
                                                return 1;
                                            } else {
                                                return 0;
                                            }
                                        });
                                    }
                                    ?>
                                    <?php if ($data['type'] != 'edit') : ?>
                                        <form id="mySelectLangDesktop" action="/" method="get">
                                            <select onchange="changeLanguage(this, <?= session()->get('is_master') ?>)" class="select2 select-lang" name="language" data-type="desktop">
                                                <?php foreach ($language_list as $d) : ?>
                                                    <option value="<?= $d['lang_code'] ?>" data-img-src="/assets/website/images/lang/<?= $d['lang_icon'] ?>">
                                                        <?= strtoupper($d['lang_code']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    <?php else : ?>
                                        <form id="mySelectLangDesktop" action="javascript:void(0)" method="get">
                                            <select class="select2 select-lang" name="language" data-type="desktop">
                                                <?php foreach ($language_list as $d) : ?>
                                                    <option value="javascript:void(0)" data-img-src="/assets/website/images/lang/<?= $d['lang_icon'] ?>">
                                                        <?= strtoupper($d['lang_code']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <form id="mySelectLangDesktop" action="/" method="get">
                                        <select onchange="changeLanguage(this, <?= session()->get('is_master') ?>)" class="select2 select-lang" name="language" data-type="desktop">
                                            <option value="id" data-img-src="/assets/website/images/lang/flag-icon-indonesia.png">
                                                ID
                                            </option>
                                            <option value="en" data-img-src="/assets/website/images/lang/flag-icon-england.png">
                                                EN
                                            </option>
                                        </select>
                                    </form>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="others-option-for-responsive d-block d-lg-none" style="vertical-align: middle;">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="option-inner">
                    <div class="others-options justify-content-center">
                        <ul>
                            <li>
                                <i class="ri-user-3-line"></i>
                                <?php if (session()->get('email')) : ?>
                                    <a href="javascript:void(0)" class="dropdown-toggle border-style" data-bs-toggle="dropdown">Hi, <?= session()->get('nama_depan') ?></a>
                                    <ul class="dropdown-menu" style="font-size: 0.9em;">
                                        <li class="dropdown-item">
                                            <a href="/my-account">My Account</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="/profile">Profile</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="/logout">Logout</a>
                                        </li>
                                    </ul>
                                <?php else : ?>
                                    <a href="/login">Login</a>
                                <?php endif; ?>
                            </li>
                            <li style="border-left: 1px solid black;">
                                <?php if ($language_list) : ?>
                                    <?php
                                    if ($lang_code) {
                                        usort($language_list, function ($a, $b) use ($lang_code) {
                                            if ($a['lang_code'] == $lang_code) {
                                                return -1;
                                            } elseif ($b['lang_code'] == $lang_code) {
                                                return 1;
                                            } else {
                                                return 0;
                                            }
                                        });
                                    } else {
                                        $lang_default = 1;
                                        usort($language_list, function ($a, $b) use ($lang_default) {
                                            if ($a['is_lang_default'] == $lang_default) {
                                                return -1;
                                            } elseif ($b['is_lang_default'] == $lang_default) {
                                                return 1;
                                            } else {
                                                return 0;
                                            }
                                        });
                                    }
                                    ?>
                                    <?php if ($data['type'] != 'edit') : ?>
                                        <form id="mySelectLangMobile" action="/" method="get">
                                            <select onchange="changeLanguage(this, <?= session()->get('is_master') ?>)" class="select2 select-lang" name="language" data-type="mobile">
                                                <?php foreach ($language_list as $d) : ?>
                                                    <option value="<?= $d['lang_code'] ?>" data-img-src="/assets/website/images/lang/<?= $d['lang_icon'] ?>">
                                                        <?= strtoupper($d['lang_code']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    <?php else : ?>
                                        <form id="mySelectLangMobile" action="javascript:void(0)" method="get">
                                            <select class="select2 select-lang" name="language" data-type="mobile">
                                                <?php foreach ($language_list as $d) : ?>
                                                    <option value="javascript:void(0)" data-img-src="/assets/website/images/lang/<?= $d['lang_icon'] ?>">
                                                        <?= strtoupper($d['lang_code']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <form id="mySelectLangMobile" action="/" method="get">
                                        <select onchange="changeLanguage(this, <?= session()->get('is_master') ?>)" class="select2 select-lang" name="language" data-type="mobile">
                                            <option value="id" data-img-src="/assets/website/images/lang/flag-icon-indonesia.png">
                                                ID
                                            </option>
                                            <option value="en" data-img-src="/assets/website/images/lang/flag-icon-england.png">
                                                EN
                                            </option>
                                        </select>
                                    </form>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->

<script>
    function changeLanguage(e, is_master) {
        const type = $(e).data('type');
        if (type == 'desktop') {
            if (is_master == 0) {
                $("#mySelectLangDesktop").attr('action', window.location.href).submit();
            } else {
                $("#mySelectLangDesktop").submit()
            }
        } else {
            $("#mySelectLangMobile").submit();
        }
    }
</script>