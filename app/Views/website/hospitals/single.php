<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>

<!-- Start Hospital Details Area -->
<div class="hospital-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="hospital-details-content mr-15">
                    <h2>Facilities</h2>
                    <p>Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Donec rutrum congue leo eget malesuada. Sed porttitor lectus nibh.</p>
                    <p>Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>

                    <div class="gap-mb-30"></div>

                    <h2>Labour room</h2>
                    <p>Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>

                    <div class="gap-mb-30"></div>

                    <h2>Operation theatre</h2>
                    <p>Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta.</p>

                    <div class="gap-mb-30"></div>

                    <h2>Telemedicine</h2>
                    <p>Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>

                    <div class="gap-mb-30"></div>

                    <h2>Pharmacy</h2>
                    <p>Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.</p>

                    <div class="gap-mb-30"></div>

                    <h2>Clinic</h2>
                    <p>Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta.</p>

                    <ul>
                        <li>General Medicine</li>
                        <li>Orthopedics</li>
                        <li>Pediatrics</li>
                        <li>Dentistry</li>
                        <li>Gynecology</li>
                    </ul>
                </div>

                <div class="package-list">
                    <h2 class="ps-2">Package</h2>
                    <div class="hospital-area pt-4">
                        <div class="row justify-content-start">
                            <div class="col-lg-6 col-md-6">
                                <div class="single-hospital">
                                    <a href="/hospitals/package/<?= $title ?>/Lorem ipsum dolor sit amet">
                                        <img src="/assets/website/images/hospital/hospital-1.jpg" alt="Image">
                                    </a>
                                    <div class="hospital-content">
                                        <h3>
                                            <a href="/hospitals/package/<?= $title ?>/Lorem ipsum dolor sit amet">
                                                Lorem ipsum dolor sit amet
                                            </a>
                                        </h3>
                                        <a href="/hospitals/package/<?= $title ?>/Lorem ipsum dolor sit amet" class="default-btn active">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-wrap ml-15">
                    <div class="single-hospital">
                        <a href="hospital-details.html">
                            <img src="/assets/website/images/hospital/hospital-1.jpg" alt="Image">
                        </a>
                        <div class="hospital-content">
                            <h3>
                                <a href="hospital-details.html">
                                    Hospitals in Atlanta
                                </a>
                            </h3>
                            <ul>
                                <li>
                                    <span>Address:</span>
                                    DKI Jakarta 11825, Indonesia
                                </li>
                                <li>
                                    <span>Phone:</span>
                                    <a href="tel:-(616)-999-95544">(616) 999-95544</a>
                                </li>
                            </ul>

                            <a href="appointment.html" class="default-btn active">
                                Book an appointment
                            </a>
                        </div>
                    </div>

                    <div class="hospital-location">
                        <h3>Our Locations</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63470.65525471034!2d106.62243902167967!3d-6.141991599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9caeabc1325%3A0x34e86cdff0064073!2sSambal%20Bakar%20Indonesia%2C%20Peta%20Barat!5e0!3m2!1sid!2sid!4v1705073205571!5m2!1sid!2sid"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hospital Details Area -->

<?= $this->endSection(); ?>