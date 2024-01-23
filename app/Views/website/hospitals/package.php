<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>

<!-- Start Hospital Details Area -->
<div class="hospital-details-area ptb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="hospital-details-content mr-15">
                    <h2 class="text-center"><?= $title ?></h2>

                    <div class="single-hospital my-3">
                        <a href="hospital-details.html">
                            <img src="/assets/website/images/hospital/hospital-1.jpg" alt="Image">
                        </a>
                    </div>

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
            </div>
        </div>
    </div>
</div>
<!-- End Hospital Details Area -->

<?= $this->endSection(); ?>