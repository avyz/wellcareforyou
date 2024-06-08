<?php

use App\Models\Cms\Pages\PagesModel;

$this->pagesModel = new PagesModel();

?>

<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>
<!-- Start Who We Are Area -->
<div class="who-we-are-area pt-100 pb-70">
    <?php $data_page = $this->pagesModel::dataPageByNavbarIdAndSection($lang_code, 1) ?>
    <?php if ($data_page) : ?>
        <?php $section_1 = $page[0]; ?>
    <?php else : ?>
        <?php $section_1 = null; ?>
    <?php endif; ?>
    <?php if ($data['type'] == 'edit' && session()->get('is_master') == 1) : ?>
        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <?php if ($data_page) : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionOne' data-page_uuid="<?= $data_page['uuid'] ?>" data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionOneModal"><i class="ri-pencil-line"></i> Edit Section 1</button>
                <?php else : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionOne' data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionOneModal"><i class="ri-pencil-line"></i> Edit Section 1</button>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="mr-44">
                    <div class="row align-items-end">
                        <div class="col-lg-7 col-md-6">
                            <div class="who-we-are-img img-1">
                                <?php if (!empty($section_1)) : ?>
                                    <img src="/assets/website/images/about/<?= $section_1['image'][0]['page_image'] ?>" alt="image">
                                <?php else : ?>
                                    <img src="/assets/website/images/about/about-1.jpg" alt="image">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="who-we-are-img-2">
                                <?php if (!empty($section_1)) : ?>
                                    <h3><?= $section_1['optional_title'] ?></h3>
                                    <img src="/assets/website/images/about/<?= $section_1['image'][1]['page_image'] ?>" alt="image">
                                <?php else : ?>
                                    <img src="/assets/website/images/about/about-2.jpg" alt="image">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="who-we-are-img-3">
                                <?php if (!empty($section_1)) : ?>
                                    <img src="/assets/website/images/about/<?= $section_1['image'][2]['page_image'] ?>" alt="image">
                                <?php else : ?>
                                    <img src="/assets/website/images/about/about-3.jpg" alt="image">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ml-44">
                    <div class="who-we-are-content">
                        <span class="top-title">
                            <?php if (!empty($section_1)) : ?>
                                <?= $section_1['title'] ?>
                            <?php else : ?>
                                WHO WE ARE
                            <?php endif; ?>
                        </span>
                        <h2>
                            <?php if (!empty($section_1)) : ?>
                                <?= $section_1['subtitle'] ?>
                            <?php else : ?>
                                We have been providing services to patients for over 20 years
                            <?php endif; ?>
                        </h2>
                        <p>
                            <?php if (!empty($section_1)) : ?>
                                <?= $section_1['paragraph'] ?>
                            <?php else : ?>
                                Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.
                            <?php endif; ?>
                        </p>
                    </div>

                    <div class="row">
                        <?php if (!empty($section_1)) : ?>
                            <?php foreach ($section_1['grid'] as $grid) : ?>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="single-who-we-are">
                                        <?= $grid['image'] ?>
                                        <h3><?= $grid['title'] ?></h3>
                                        <p><?= $grid['paragraph'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-who-we-are">
                                    <i class="flaticon-hands"></i>
                                    <h3>1K+ Healing Hands</h3>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-who-we-are">
                                    <i class="flaticon-doctor"></i>
                                    <h3>Experience Doctors</h3>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-who-we-are">
                                    <i class="flaticon-handshake"></i>
                                    <h3>Advanced Healthcare</h3>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-who-we-are">
                                    <i class="flaticon-pharmacy"></i>
                                    <h3>50+ Pharmacies</h3>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Who We Are Area -->

<!-- Start Our Mison Area -->
<div class="our-mison-area">
    <?php $data_page = $this->pagesModel::dataPageByNavbarIdAndSection($lang_code, 2) ?>
    <?php if ($data_page) : ?>
        <?php $section_2 = $page[1]; ?>
    <?php else : ?>
        <?php $section_2 = null; ?>
    <?php endif; ?>
    <?php if ($data['type'] == 'edit' && session()->get('is_master') == 1 && $section_1) : ?>
        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <?php if ($data_page) : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionTwo' data-page_uuid="<?= $data_page['uuid'] ?>" data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionTwoModal"><i class="ri-pencil-line"></i> Edit Section 2</button>
                <?php else : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionTwo' data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionTwoModal"><i class="ri-pencil-line"></i> Edit Section 2</button>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <?php if (session()->get('is_master') == 1) : ?>
            <div class="container">
                <div class="d-flex justify-content-end align-items-center my-3">
                    <button class="btn btn-primary rounded me-2" type="button" disabled><i class="ri-pencil-line"></i> Please edit section 1 first</button>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container">
        <div class="row px-3">
            <div class="col-lg-6 single-mison bg-color">
                <?php if (!empty($section_2)) : ?>
                    <h3>
                        <?= $section_2['grid'][0]['title'] ?>
                    </h3>
                    <p>
                        <?= $section_2['grid'][0]['paragraph'] ?>
                    </p>
                <?php else : ?>
                    <h3>Our Vision</h3>
                    <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 single-mison">
                <?php if (!empty($section_2)) : ?>
                    <h3>
                        <?= $section_2['grid'][1]['title'] ?>
                    </h3>
                    <p>
                        <?= $section_2['grid'][1]['paragraph'] ?>
                    </p>
                <?php else : ?>
                    <h3>Our Mission</h3>
                    <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- End Our Mison Area -->

<!-- Start Solution Area -->
<div class="solution-area bg-color-f8f9fa pt-100 pb-70">
    <?php $data_page = $this->pagesModel::dataPageByNavbarIdAndSection($lang_code, 3) ?>
    <?php if ($data_page) : ?>
        <?php $section_3 = $page[2]; ?>
    <?php else : ?>
        <?php $section_3 = null; ?>
    <?php endif; ?>
    <?php if ($data['type'] == 'edit' && session()->get('is_master') == 1 && $section_2) : ?>
        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <?php if ($data_page) : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionThree' data-page_uuid="<?= $data_page['uuid'] ?>" data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionThreeModal"><i class="ri-pencil-line"></i> Edit Section 3</button>
                <?php else : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionThree' data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionThreeModal"><i class="ri-pencil-line"></i> Edit Section 3</button>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <?php if (session()->get('is_master') == 1) : ?>
            <div class="container">
                <div class="d-flex justify-content-end align-items-center my-3">
                    <button class="btn btn-primary rounded me-2" type="button" disabled><i class="ri-pencil-line"></i> Please edit section 2 first</button>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container">
        <div class="section-title solution-title">
            <span class="top-title">
                <?php if (!empty($section_3)) : ?>
                    <?= $section_3['title'] ?>
                <?php else : ?>
                    SOLUTION
                <?php endif; ?>
            </span>
            <h2>
                <?php if (!empty($section_3)) : ?>
                    <?= $section_3['subtitle'] ?>
                <?php else : ?>
                    Some easy steps to get your proper solution
                <?php endif; ?>
            </h2>
        </div>

        <div class="row justify-content-center">
            <?php if (!empty($section_3)) : ?>
                <?php foreach ($section_3['grid'] as $grid) : ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-solution">
                            <div class="icon">
                                <span><?= $grid['urutan'] ?></span>
                                <?= $grid['image'] ?>
                            </div>
                            <h3><?= $grid['title'] ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-solution">
                        <div class="icon">
                            <span>1</span>
                            <i class="flaticon-search"></i>
                        </div>
                        <h3>Search doctor</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-solution">
                        <div class="icon">
                            <span>2</span>
                            <i class="flaticon-search-1"></i>
                        </div>
                        <h3>Check doctor profile</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-solution">
                        <div class="icon">
                            <span>3</span>
                            <i class="flaticon-calendar"></i>
                        </div>
                        <h3>Doctor appointment</h3>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="single-solution">
                        <div class="icon">
                            <span>4</span>
                            <i class="flaticon-think"></i>
                        </div>
                        <h3>Get first solution</h3>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- End Solution Area -->

<!-- Start Choose Us Area -->
<div class="choose-us-area ptb-100">
    <?php $data_page = $this->pagesModel::dataPageByNavbarIdAndSection($lang_code, 4) ?>
    <?php if ($data_page) : ?>
        <?php $section_4 = $page[3]; ?>
    <?php else : ?>
        <?php $section_4 = null; ?>
    <?php endif; ?>
    <?php if ($data['type'] == 'edit' && session()->get('is_master') == 1 && $section_3) : ?>
        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <?php if ($data_page) : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionFour' data-page_uuid="<?= $data_page['uuid'] ?>" data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionFourModal"><i class="ri-pencil-line"></i> Edit Section 4</button>
                <?php else : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionFour' data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionFourModal"><i class="ri-pencil-line"></i> Edit Section 4</button>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <?php if (session()->get('is_master') == 1) : ?>
            <div class="container">
                <div class="d-flex justify-content-end align-items-center my-3">
                    <button class="btn btn-primary rounded me-2" type="button" disabled><i class="ri-pencil-line"></i> Please edit section 3 first</button>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="choose-us-content">
                    <span class="top-title">
                        <?php if ($section_4) : ?>
                            <?= $section_4['title'] ?>
                        <?php else : ?>
                            WHY CHOOSE US
                        <?php endif; ?>
                    </span>
                    <h2>
                        <?php if ($section_4) : ?>
                            <?= $section_4['subtitle'] ?>
                        <?php else : ?>
                            Our hospital has professional doctors who provide low cost 24 hour service
                        <?php endif; ?>
                    </h2>
                    <p>
                        <?php if ($section_4) : ?>
                            <?= $section_4['paragraph'] ?>
                        <?php else : ?>
                            Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.
                        <?php endif; ?>
                    </p>
                    <ul>
                        <?php if ($section_4) : ?>
                            <?php foreach ($section_4['grid'] as $key => $grid) : ?>
                                <li <?php if ($key % 2 != 0) : ?>class="active" <?php endif; ?>>
                                    <span><?= $grid['urutan'] ?></span>
                                    <h3><?= $grid['title'] ?></h3>
                                    <?= $grid['paragraph'] ?>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li>
                                <span>1</span>
                                <h3>Modern Technology</h3>
                                Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                            </li>
                            <li class="active">
                                <span>2</span>
                                <h3>Professional Doctors</h3>
                                Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                            </li>
                            <li>
                                <span>3</span>
                                <h3>Affordable Price</h3>
                                Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="choose-us-img ml-86">
                    <?php if ($section_4) : ?>
                        <img src="/assets/website/images/about/<?= $section_4['page_image'] ?>" alt="Image">
                    <?php else : ?>
                        <img src="/assets/website/images/choose-us-img.jpg" alt="Image">
                    <?php endif; ?>
                    <div class="ambulance-services d-flex">
                        <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                        <div class="ambulance-info">
                            <span>
                                <?php if ($section_4) : ?>
                                    <?= $section_4['optional_title'] ?>
                                <?php else : ?>
                                    24/7 Hours Service
                                <?php endif; ?>
                            </span>
                            <?php if ($misc) : ?>
                                <?php if ($data['type'] != 'edit') : ?>
                                    <a href="tel:<?= $misc['misc_fulltime_number'] ?>">
                                        <?= $misc['misc_fulltime_number'] ?>
                                    </a>
                                <?php else : ?>
                                    <a href="javascript:void(0)">
                                        <?= $misc['misc_fulltime_number'] ?>
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="tel:1-23-456-789">
                                    1-23-456-789
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Choose Us Area -->

<!-- Start Urgent Area -->
<div class="urgent-area ptb-100">
    <?php $data_page = $this->pagesModel::dataPageByNavbarIdAndSection($lang_code, 5) ?>
    <?php if ($data_page) : ?>
        <?php $section_5 = $page[4]; ?>
    <?php else : ?>
        <?php $section_5 = null; ?>
    <?php endif; ?>
    <?php if ($data['type'] == 'edit' && session()->get('is_master') == 1 && $section_4) : ?>
        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <?php if ($data_page) : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionFive' data-page_uuid="<?= $data_page['uuid'] ?>" data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionFiveModal"><i class="ri-pencil-line"></i> Edit Section 5</button>
                <?php else : ?>
                    <button class="btn btn-primary rounded me-2" id='aboutSectionFive' data-navbar_uuid="<?= $data['nid'] ?>" data-lang_code="<?= $lang_code ?>" type="button" data-bs-toggle="offcanvas" data-bs-target="#aboutSectionFiveModal"><i class="ri-pencil-line"></i> Edit Section 5</button>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <?php if (session()->get('is_master') == 1) : ?>
            <div class="container">
                <div class="d-flex justify-content-end align-items-center my-3">
                    <button class="btn btn-primary rounded me-2" type="button" disabled><i class="ri-pencil-line"></i> Please edit section 4 first</button>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="container">
        <div class="section-title services-title">
            <span class="top-title">
                <?php if ($section_5) : ?>
                    <?= $section_5['title'] ?>
                <?php else : ?>
                    OUR SERVICE
                <?php endif; ?>
            </span>
            <h2>
                <?php if ($section_5) : ?>
                    <?= $section_5['subtitle'] ?>
                <?php else : ?>
                    See our hospital's care services
                <?php endif; ?>
            </h2>
        </div>

        <div class="urgent-slide owl-carousel owl-theme">
            <?php if ($section_5) : ?>
                <?php foreach ($section_5['grid'] as $grid) : ?>
                    <div class="single-urgent">
                        <div class="icon">
                            <img src="/assets/website/images/about/icon/<?= $grid['image'] ?>" alt="Image">
                        </div>
                        <h3><?= $grid['title'] ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                    </div>
                    <h3>Chest Pain</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                    </div>
                    <h3>Minor Injury</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                    </div>
                    <h3>Vaccinations</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-4.svg" alt="Image">
                    </div>
                    <h3>Minor Burns</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                    </div>
                    <h3>Chest Pain</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                    </div>
                    <h3>Minor Injury</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                    </div>
                    <h3>Vaccinations</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-4.svg" alt="Image">
                    </div>
                    <h3>Minor Burns</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                    </div>
                    <h3>Chest Pain</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                    </div>
                    <h3>Minor Injury</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                    </div>
                    <h3>Vaccinations</h3>
                </div>
                <div class="single-urgent">
                    <div class="icon">
                        <img src="/assets/website/images/icon/icon-4.svg" alt="Image">
                    </div>
                    <h3>Minor Burns</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Urgent Area -->

<script src="/assets/website/js/about/custom.js"></script>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="aboutSectionOneModal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="aboutSectionOneModalLabel">Edit - Section 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/page/about/edit-content" id="createSectionOne" method="post">
            <input type="hidden" name="lang_code">
            <input type="hidden" name="navbar_uuid">
            <input type="hidden" name="section" value="1">
            <input type="hidden" name="page_uuid">
            <div class="mb-3">
                <label for="section_one_about_title" class="form-label">Title 1<small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_one_about_title" name="section_one_about_title" value="WHO WE ARE" required>
                <div class="invalid-feedback" id="section_one_about_title_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_one_about_optional_title" class="form-label">Title 2<small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_one_about_optional_title" name="section_one_about_optional_title" value="Connect With Wellcareforyou Health Care" required>
                <div class="invalid-feedback" id="section_one_about_optional_title_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_one_about_subtitle" class="form-label">Subtitle <small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_one_about_subtitle" name="section_one_about_subtitle" value="We have been providing services to patients for over 20 years" required>
                <div class="invalid-feedback" id="section_one_about_subtitle_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_one_about_paragraph" class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                <textarea class="form-control" name="section_one_about_paragraph" id="section_one_about_paragraph" cols="5" rows="3" required>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</textarea>
                <div class="invalid-feedback" id="section_one_about_paragraph_validation"></div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Content Grid</h5>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Grid 1</h6>
                    <input type="hidden" class="form-control" name="section_one_about_grid_urutan[]" value="1">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_title[]" id="section_one_about_grid_title_0" value="1K+ Healing Hands" required>
                        <div class="invalid-feedback" id="section_one_about_grid_title_validation_0"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_one_about_grid_paragraph[]" id="section_one_about_grid_paragraph_0" cols="5" rows="3" required>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</textarea>
                        <div class="invalid-feedback" id="section_one_about_grid_paragraph_validation_0"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_image[]" id="section_one_about_grid_image_0" value='<i class="flaticon-hands"></i>' required>
                        <div class="invalid-feedback" id="section_one_about_grid_image_validation_0"></div>
                    </div>
                    <h6 class="mb-3">Grid 2</h6>
                    <input type="hidden" class="form-control" name="section_one_about_grid_urutan[]" value="2">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_title[]" id="section_one_about_grid_title_1" value="Experience Doctors" required>
                        <div class="invalid-feedback" id="section_one_about_grid_title_validation_1"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_one_about_grid_paragraph[]" id="section_one_about_grid_paragraph_1" cols="5" rows="3" required>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</textarea>
                        <div class="invalid-feedback" id="section_one_about_grid_paragraph_validation_1"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_image[]" id="section_one_about_grid_image_1" value='<i class="flaticon-doctor"></i>' required>
                        <div class="invalid-feedback" id="section_one_about_grid_image_validation_1"></div>
                    </div>
                    <h6 class="mb-3">Grid 3</h6>
                    <input type="hidden" class="form-control" name="section_one_about_grid_urutan[]" value="3">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_title[]" id="section_one_about_grid_title_2" value="Advanced Healthcare" required>
                        <div class="invalid-feedback" id="section_one_about_grid_title_validation_2"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_one_about_grid_paragraph[]" id="section_one_about_grid_paragraph_2" cols="5" rows="3" required>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</textarea>
                        <div class="invalid-feedback" id="section_one_about_grid_paragraph_validation_2"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_image[]" id="section_one_about_grid_image_2" value='<i class="flaticon-handshake"></i>' required>
                        <div class="invalid-feedback" id="section_one_about_grid_image_validation_2"></div>
                    </div>
                    <h6 class="mb-3">Grid 4</h6>
                    <input type="hidden" class="form-control" name="section_one_about_grid_urutan[]" value="4">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_title[]" id="section_one_about_grid_title_3" value="50+ Pharmacies" required>
                        <div class="invalid-feedback" id="section_one_about_grid_title_validation_3"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_one_about_grid_paragraph[]" id="section_one_about_grid_paragraph_3" cols="5" rows="3" required>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</textarea>
                        <div class="invalid-feedback" id="section_one_about_grid_paragraph_validation_3"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_one_about_grid_image[]" id="section_one_about_grid_image_3" value='<i class="flaticon-pharmacy"></i>' required>
                        <div class="invalid-feedback" id="section_one_about_grid_image_validation_3"></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Content Image</h5>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Image 1</h6>
                    <input type="hidden" class="form-control" name="section_one_about_image_urutan[]" value="1">
                    <div class="mb-3">
                        <label class="form-label">Image <small class="text-danger">*</small> :</label>
                        <div class="row align-items-center" id="edit-show-section-one-about-image-0">
                            <div class="col-lg-12 mb-3">
                                <img src="/assets/website/images/about/about-1.jpg" class="edit-preview-img-section-one-about-image-0 mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-12">
                                <input onchange="previewImg('section_one_about_image_new_0', 'edit-preview-img-section-one-about-image-0')" class="form-control" type="file" id="section_one_about_image_new_0" name="section_one_about_image_new[]" accept="image/*">
                            </div>
                        </div>
                        <div class="invalid-feedback" id="section_one_about_image_new_validation_0"></div>
                        <input type="hidden" class="form-control" name="section_one_about_image[]" id="section_one_about_image_0">
                    </div>
                    <h6 class="mb-3">Image 2</h6>
                    <input type="hidden" class="form-control" name="section_one_about_image_urutan[]" value="2">
                    <div class="mb-3">
                        <label class="form-label">Image <small class="text-danger">*</small> :</label>
                        <div class="row align-items-center" id="edit-show-section-one-about-image-1">
                            <div class="col-lg-12 mb-3">
                                <img src="/assets/website/images/about/about-2.jpg" class="edit-preview-img-section-one-about-image-1 mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-12">
                                <input onchange="previewImg('section_one_about_image_new_1', 'edit-preview-img-section-one-about-image-1')" class="form-control" type="file" id="section_one_about_image_new_1" name="section_one_about_image_new[]" accept="image/*">
                            </div>
                        </div>
                        <div class="invalid-feedback" id="section_one_about_image_new_validation_1"></div>
                        <input type="hidden" class="form-control" name="section_one_about_image[]" id="section_one_about_image_1">
                    </div>
                    <h6 class="mb-3">Image 3</h6>
                    <input type="hidden" class="form-control" name="section_one_about_image_urutan[]" value="3">
                    <div class="mb-3">
                        <label class="form-label">Image <small class="text-danger">*</small> :</label>

                        <div class="row align-items-center" id="edit-show-section-one-about-image-2">
                            <div class="col-lg-12 mb-3">
                                <img src="/assets/website/images/about/about-3.jpg" class="edit-preview-img-section-one-about-image-2 mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-12">
                                <input onchange="previewImg('section_one_about_image_new_2', 'edit-preview-img-section-one-about-image-2')" class="form-control" type="file" id="section_one_about_image_new_2" name="section_one_about_image_new[]" accept="image/*">
                            </div>
                        </div>
                        <div class="invalid-feedback" id="section_one_about_image_new_validation_2"></div>
                        <input type="hidden" class="form-control" name="section_one_about_image[]" id="section_one_about_image_2">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-3">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="aboutSectionTwoModal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="aboutSectionTwoModalLabel">Edit - Section 2</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/page/about/edit-content" id="createSectionTwo" method="post">
            <input type="hidden" name="lang_code">
            <input type="hidden" name="navbar_uuid">
            <input type="hidden" name="section" value="2">
            <input type="hidden" name="page_uuid">
            <div class="mb-3">
                <input type="hidden" class="form-control" name="section_two_about_grid_urutan[]" value="1">
                <label class="form-label">Title Vision <small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" name="section_two_about_grid_title[]" id="section_two_about_grid_title_0" value="Our Vision" required>
                <div class="invalid-feedback" id="section_two_about_grid_title_validation_0"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Paragraph Vision <small class="text-danger">*</small> :</label>
                <textarea class="form-control" name="section_two_about_grid_paragraph[]" id="section_two_about_grid_paragraph_0" cols="5" rows="3" required>
                    Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.
                </textarea>
                <div class="invalid-feedback" id="section_two_about_grid_paragraph_validation_0"></div>
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="section_two_about_grid_urutan[]" value="2">
                <label class="form-label">Title Mission <small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" name="section_two_about_grid_title[]" id="section_two_about_grid_title_1" value="Our Mission" required>
                <div class="invalid-feedback" id="section_two_about_grid_title_validation_1"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Paragraph Mission <small class="text-danger">*</small> :</label>
                <textarea class="form-control" name="section_two_about_grid_paragraph[]" id="section_two_about_grid_paragraph_1" cols="5" rows="3" required>
                    Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.
                </textarea>
                <div class="invalid-feedback" id="section_two_about_grid_paragraph_validation_1"></div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-3">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="aboutSectionThreeModal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="aboutSectionThreeModalLabel">Edit - Section 3</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/page/about/edit-content" id="createSectionThree" method="post">
            <input type="hidden" name="lang_code">
            <input type="hidden" name="navbar_uuid">
            <input type="hidden" name="section" value="3">
            <input type="hidden" name="page_uuid">
            <div class="mb-3">
                <label for="section_three_about_title" class="form-label">Title<small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_three_about_title" name="section_three_about_title" value="SOLUTION" required>
                <div class="invalid-feedback" id="section_three_about_title_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_three_about_subtitle" class="form-label">Subtitle <small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_three_about_subtitle" name="section_three_about_subtitle" value="Some easy steps to get your proper solution" required>
                <div class="invalid-feedback" id="section_three_about_subtitle_validation"></div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Content Grid</h5>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Grid 1</h6>
                    <input type="hidden" class="form-control" name="section_three_about_grid_urutan[]" value="1">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_title[]" id="section_three_about_grid_title_0" value="Search doctor" required>
                        <div class="invalid-feedback" id="section_three_about_grid_title_validation_0"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_image[]" id="section_three_about_grid_image_0" value='<i class="flaticon-search"></i>' required>
                        <div class="invalid-feedback" id="section_three_about_grid_image_validation_0"></div>
                    </div>
                    <h6 class="mb-3">Grid 2</h6>
                    <input type="hidden" class="form-control" name="section_three_about_grid_urutan[]" value="2">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_title[]" id="section_three_about_grid_title_1" value="Check doctor profile" required>
                        <div class="invalid-feedback" id="section_three_about_grid_title_validation_1"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_image[]" id="section_three_about_grid_image_1" value='<i class="flaticon-search-1"></i>' required>
                        <div class="invalid-feedback" id="section_three_about_grid_image_validation_1"></div>
                    </div>
                    <h6 class="mb-3">Grid 3</h6>
                    <input type="hidden" class="form-control" name="section_three_about_grid_urutan[]" value="3">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_title[]" id="section_three_about_grid_title_2" value="Doctor appointment" required>
                        <div class="invalid-feedback" id="section_three_about_grid_title_validation_2"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_image[]" id="section_three_about_grid_image_2" value='<i class="flaticon-calendar"></i>' required>
                        <div class="invalid-feedback" id="section_three_about_grid_image_validation_2"></div>
                    </div>
                    <h6 class="mb-3">Grid 4</h6>
                    <input type="hidden" class="form-control" name="section_three_about_grid_urutan[]" value="4">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_title[]" id="section_three_about_grid_title_3" value="Get first solution" required>
                        <div class="invalid-feedback" id="section_three_about_grid_title_validation_3"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_three_about_grid_image[]" id="section_three_about_grid_image_3" value='<i class="flaticon-think"></i>' required>
                        <div class="invalid-feedback" id="section_three_about_grid_image_validation_3"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-3">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="aboutSectionFourModal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="aboutSectionFourModalLabel">Edit - Section 4</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/page/about/edit-content" id="createSectionFour" method="post">
            <input type="hidden" name="lang_code">
            <input type="hidden" name="navbar_uuid">
            <input type="hidden" name="section" value="4">
            <input type="hidden" name="page_uuid">
            <div class="mb-3">
                <label for="section_four_about_title" class="form-label">Title 1<small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_four_about_title" name="section_four_about_title" value="SOLUTION" required>
                <div class="invalid-feedback" id="section_four_about_title_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_four_about_optional_title" class="form-label">Title 2<small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_four_about_optional_title" name="section_four_about_optional_title" value="24/7 Hours Service" required>
                <div class="invalid-feedback" id="section_four_about_optional_title_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_four_about_subtitle" class="form-label">Subtitle <small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_four_about_subtitle" name="section_four_about_subtitle" value="Some easy steps to get your proper solution" required>
                <div class="invalid-feedback" id="section_four_about_subtitle_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_four_about_paragraph" class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                <textarea class="form-control" name="section_four_about_paragraph" id="section_four_about_paragraph" cols="5" rows="3" required>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</textarea>
                <div class="invalid-feedback" id="section_four_about_paragraph_validation"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Image <small class="text-danger">*</small> :</label>
                <div class="row align-items-center" id="edit-show-section-four-about-image">
                    <div class="col-lg-12 mb-3">
                        <img src="/assets/website/images/choose-us-img.jpg" class="edit-preview-img-section-four-about-image mb-2 mb-lg-0" style="width:120px" alt="img">
                    </div>
                    <div class="col-lg-12">
                        <input onchange="previewImg('section_four_about_image_new', 'edit-preview-img-section-four-about-image')" class="form-control" type="file" id="section_four_about_image_new" name="section_four_about_image_new" accept="image/*">
                    </div>
                </div>
                <div class="invalid-feedback" id="section_four_about_image_new_validation"></div>
                <input type="hidden" class="form-control" name="section_four_about_image" id="section_four_about_image">
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Content Grid</h5>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Grid 1</h6>
                    <input type="hidden" class="form-control" name="section_four_about_grid_urutan[]" value="1">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_four_about_grid_title[]" id="section_four_about_grid_title_0" value="Modern Technology" required>
                        <div class="invalid-feedback" id="section_four_about_grid_title_validation_0"></div>
                    </div>
                    <div class="mb-3">
                        <label for="section_four_about_grid_paragraph_0" class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_four_about_grid_paragraph[]" id="section_four_about_grid_paragraph_0" cols="5" rows="3" required>Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</textarea>
                        <div class="invalid-feedback" id="section_four_about_grid_paragraph_validation_0"></div>
                    </div>
                    <h6 class="mb-3">Grid 2</h6>
                    <input type="hidden" class="form-control" name="section_four_about_grid_urutan[]" value="2">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_four_about_grid_title[]" id="section_four_about_grid_title_1" value="Professional Doctors" required>
                        <div class="invalid-feedback" id="section_four_about_grid_title_validation_1"></div>
                    </div>
                    <div class="mb-3">
                        <label for="section_four_about_grid_paragraph_1" class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_four_about_grid_paragraph[]" id="section_four_about_grid_paragraph_1" cols="5" rows="3" required>Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</textarea>
                        <div class="invalid-feedback" id="section_four_about_grid_paragraph_validation_1"></div>
                    </div>
                    <h6 class="mb-3">Grid 3</h6>
                    <input type="hidden" class="form-control" name="section_four_about_grid_urutan[]" value="3">
                    <div class="mb-3">
                        <label class="form-label">Title <small class="text-danger">*</small> :</label>
                        <input type="text" class="form-control" name="section_four_about_grid_title[]" id="section_four_about_grid_title_2" value="Affordable Price" required>
                        <div class="invalid-feedback" id="section_four_about_grid_title_validation_2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="section_four_about_grid_paragraph_2" class="form-label">Paragraph <small class="text-danger">*</small> :</label>
                        <textarea class="form-control" name="section_four_about_grid_paragraph[]" id="section_four_about_grid_paragraph_2" cols="5" rows="3" required>Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</textarea>
                        <div class="invalid-feedback" id="section_four_about_grid_paragraph_validation_2"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-3">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="aboutSectionFiveModal">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="aboutSectionFiveModalLabel">Edit - Section 5</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="/page/about/edit-content" id="createSectionFive" method="post">
            <input type="hidden" name="lang_code">
            <input type="hidden" name="navbar_uuid">
            <input type="hidden" name="section" value="5">
            <input type="hidden" name="page_uuid">
            <div class="mb-3">
                <label for="section_five_about_title" class="form-label">Title<small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_five_about_title" name="section_five_about_title" value="OUR SERVICE" required>
                <div class="invalid-feedback" id="section_five_about_title_validation"></div>
            </div>
            <div class="mb-3">
                <label for="section_five_about_subtitle" class="form-label">Subtitle <small class="text-danger">*</small> :</label>
                <input type="text" class="form-control" id="section_five_about_subtitle" name="section_five_about_subtitle" value="See our hospital`s care services" required>
                <div class="invalid-feedback" id="section_five_about_subtitle_validation"></div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Content Grid</h5>
                </div>
                <div class="card-body">
                    <div class="data-about-grid">
                        <div class="rows">
                            <h6 class="mb-3">Grid <span id="section_five_about_grid_no_urutan_0">1</span></h6>
                            <input type="hidden" class="form-control" name="section_five_about_grid_urutan[]" value="1">
                            <div class="mb-3">
                                <label class="form-label">Title <small class="text-danger">*</small> :</label>
                                <input type="text" class="form-control" name="section_five_about_grid_title[]" id="section_five_about_grid_title_0" value="Modern Technology" required>
                                <div class="invalid-feedback" id="section_five_about_grid_title_validation_0"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image <small class="text-danger">*</small> :</label>
                                <div class="row align-items-center" id="edit-show-section-five-about-grid-image-0">
                                    <div class="col-lg-12 mb-3">
                                        <img src="/assets/website/images/icon/icon-3.svg" class="edit-preview-img-section-five-about-grid-image-0 mb-2 mb-lg-0" style="width:120px" alt="img">
                                    </div>
                                    <div class="col-lg-12">
                                        <input onchange="previewImg('section_five_about_grid_image_new_0', 'edit-preview-img-section-five-about-grid-image-0')" class="form-control" type="file" id="section_five_about_grid_image_new_0" name="section_five_about_grid_image_new[]" accept="image/*">
                                    </div>
                                </div>
                                <div class="invalid-feedback" id="section_five_about_grid_image_new_validation_0"></div>
                                <input type="hidden" class="form-control" name="section_five_about_grid_image[]" id="section_five_about_grid_image_0">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info text-white my-3" id="add-about-grid"><small>Add Grid</small></button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-3">Save</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>