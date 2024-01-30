<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>

<!-- Start Map Area -->
<div class="map-area pt-100">
    <div class="container">
        <div class="map-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63470.65525471034!2d106.62243902167967!3d-6.141991599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f9caeabc1325%3A0x34e86cdff0064073!2sSambal%20Bakar%20Indonesia%2C%20Peta%20Barat!5e0!3m2!1sid!2sid!4v1705073205571!5m2!1sid!2sid"></iframe>
        </div>
    </div>
</div>
<!-- End Map Area -->

<!-- Start Contact Informetion Area -->
<div class="contact-informetion-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="left-informetion">
                    <h2>Contact Information</h2>
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
                            <span>PHONE:</span>
                            <a href="tell:1-23-456-789">1-23-456-789</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="right-informetion">
                    <h2>Opening Hours</h2>

                    <ul>
                        <li>
                            Monday - Saturday
                            <span>8.00 – 16.00 (GMT +8)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Informetion Area -->

<!-- Start Contact Area -->
<div class="contact-area pb-100">
    <div class="container">
        <div class="contact-form">
            <h3>Send message</h3>

            <form id="contactForm">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Edgar">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>EMAIL</label>
                            <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="info@wellcare.com">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>PHONE</label>
                            <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="***********">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>SUBJECT</label>
                            <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="write subject here...">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>YOUR MESSAGE</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="6" required data-error="Write your message" placeholder="write message here...."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <div class="form-group">
                                <div class="form-check">
                                    <input name="gridCheck" value="I agree to the terms and privacy policy." class="form-check-input" type="checkbox" id="gridCheck" required>

                                    <label class="form-check-label" for="gridCheck">
                                        Accept <a href="/terms-conditions">terms and conditions</a> and <a href="/privacy-policy">privacy policy.</a>
                                    </label>
                                    <div class="help-block with-errors gridCheck-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 text-center">
                        <button type="submit" class="default-btn active">
                            Send message
                        </button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Contact Area -->

<?= $this->endSection(); ?>