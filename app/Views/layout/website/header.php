<!-- Start Header Area -->
<div class="top-header-area bg-lg-white bg-header-mobile">
    <div class="container px-5">
        <div class="d-none d-lg-block">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <ul class="header-left-content">
                        <li>
                            <div class="d-flex align-items-center">
                                <?php if ($misc) : ?>
                                    <?php if ($data['type'] != 'edit') : ?>
                                        <a class="navbar-brand me-auto" href="/">
                                            <img src="/assets/website/images/<?= $misc['misc_logo'] ?>" class="main-logo" style="width: 220px;" alt="logo">
                                        </a>
                                    <?php else : ?>
                                        <a class="navbar-brand me-auto" href="javascript:void(0)">
                                            <img src="/assets/website/images/<?= $misc['misc_logo'] ?>" class="main-logo" style="width: 220px;" alt="logo">
                                        </a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a class="navbar-brand me-auto" href="/">
                                        <img src="/assets/website/images/logo.png" class="main-logo" style="width: 220px;" alt="logo">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <ul class="header-right-content d-lg-flex justify-content-end">
                        <li class="me-0 pe-0 me-xl-2 pe-xl-2">
                            <img class="img-fluid" style="width: 27px;" src="/assets/website/images/icon/heli.png" alt="heli">
                            <?php if ($misc) : ?>
                                <?php if ($data['type'] != 'edit') : ?>
                                    <a href="tel:<?= $misc['misc_emergency_number'] ?>">
                                        <b>
                                            <?= $misc['misc_emergency_number'] ?>
                                        </b>
                                    </a>
                                <?php else : ?>
                                    <a href="javascript:void(0)">
                                        <b>
                                            <?= $misc['misc_emergency_number'] ?>
                                        </b>
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="tel:1-23-456-789">
                                    <b>
                                        1-23-456-789
                                    </b>
                                </a>
                            <?php endif; ?>
                        </li>
                        <li class="me-0 pe-0 me-xl-2 pe-xl-2">
                            <img class="img-fluid" style="width: 27px;" src="/assets/website/images/icon/24-hours.png" alt="24-hours">

                            <?php if ($misc) : ?>
                                <?php if ($data['type'] != 'edit') : ?>
                                    <a href="tel:<?= $misc['misc_fulltime_number'] ?>">
                                        <b>
                                            <?= $misc['misc_fulltime_number'] ?>
                                        </b>
                                    </a>
                                <?php else : ?>
                                    <a href="javascript:void(0)">
                                        <b>
                                            <?= $misc['misc_fulltime_number'] ?>
                                        </b>
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="tel:1-23-456-789">
                                    <b>
                                        1-23-456-789
                                    </b>
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center d-block d-lg-none">
            <ul class="header-right-content">
                <li class="me-0 pe-0 me-xl-2 pe-xl-2">
                    <img class="img-fluid" style="width: 32px;" src="/assets/website/images/icon/heli_white.png" alt="heli">

                    <?php if ($misc) : ?>
                        <?php if ($data['type'] != 'edit') : ?>
                            <a href="tel:<?= $misc['misc_emergency_number'] ?>" class="text-white">
                                <b>
                                    <?= $misc['misc_emergency_number'] ?>
                                </b>
                            </a>
                        <?php else : ?>
                            <a href="javascript:void(0)" class="text-white">
                                <b>
                                    <?= $misc['misc_emergency_number'] ?>
                                </b>
                            </a>
                        <?php endif; ?>
                    <?php else : ?>
                        <a href="tel:1-23-456-789" class="text-white">
                            <b>
                                1-23-456-789
                            </b>
                        </a>
                    <?php endif; ?>
                </li>
                <li class="me-0 pe-0 me-xl-2 pe-xl-2">
                    <img class="img-fluid" style="width: 32px;" src="/assets/website/images/icon/24-hours_white.png" alt="24-hours">

                    <?php if ($misc) : ?>
                        <?php if ($data['type'] != 'edit') : ?>
                            <a href="tel:<?= $misc['misc_fulltime_number'] ?>" class="text-white">
                                <b>
                                    <?= $misc['misc_fulltime_number'] ?>
                                </b>
                            </a>
                        <?php else : ?>
                            <a href="javascript:void(0)" class="text-white">
                                <b>
                                    <?= $misc['misc_fulltime_number'] ?>
                                </b>
                            </a>
                        <?php endif; ?>
                    <?php else : ?>
                        <a href="tel:1-23-456-789" class="text-white">
                            <b>
                                1-23-456-789
                            </b>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Header Area -->