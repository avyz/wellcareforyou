<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>

<!-- Start Patients & Visitors Area -->
<div class="patients-visitors-area pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="patients-visitors-content">
                    <h2>Pharmacies Flow</h2>
                    <p>Donec sollicitudin molestie malesuada. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat sollicitudin molestie malesuada. Cras ultricies.</p>
                    <p>Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Curabitur aliquet quam id dui posuere blandit. Curabitur aliquet quam id dui posuere.</p>

                    <div class="gap-mb-30"></div>

                    <div class="accordion frequently-asked" id="accordionExample">
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    1. Choose Your Hospital
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    2. Make an appointment
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. Rating and review your doctor
                                </button>
                            </h3>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    4. Price for treatment
                                </button>
                            </h3>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="visitors-sludebar">
                    <a href="index.html">
                        <img src="/assets/website/images/logo.png" alt="Image">
                    </a>
                    <h4>Contact</h4>

                    <ul>
                        <li>
                            <span>ADDRESS:</span>
                            DKI Jakarta 11825, Indonesia
                        </li>
                        <li>
                            <span>EMAIL US:</span>
                            <a href="mailto:info@wellcare.com">info@wellcare.com</a>
                        </li>
                        <li>
                            <span>CALL US:</span>
                            <a href="tel:1-23-456-789">1-23-456-789</a>
                        </li>
                    </ul>
                </div>

                <div class="visitors-location">
                    <h3>Our Locations</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63470.65525471034!2d106.62243902167967!3d-6.141991599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9caeabc1325%3A0x34e86cdff0064073!2sSambal%20Bakar%20Indonesia%2C%20Peta%20Barat!5e0!3m2!1sid!2sid!4v1705073205571!5m2!1sid!2sid"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Patients & Visitors Area -->

<?= $this->endSection(); ?>