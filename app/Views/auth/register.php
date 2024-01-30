<?= $this->extend($layout); ?>

<?= $this->section($section); ?>

<div class="auth-container d-flex">

    <div class="container mx-auto align-self-center">

        <div class="row justify-content-center">

            <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                <div class="auth-cover">

                    <div class="position-relative">
                        <img class="img-fluid" src="/assets/cms/img/login-banner.png" alt="auth-img">
                    </div>

                </div>

            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto mx-lg-2">
                <div class="card">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('notif')) : ?>
                            <?= session()->getFlashdata('notif') ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h2>Sign Up</h2>
                                <p>Please fill in the form below to register</p>

                            </div>
                            <form action="/auth-register" method="post">
                                <?= csrf_field() ?>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" name="first_name" class="form-control <?= validation_show_error('first_name') ? 'is-invalid' : '' ?>" value="<?= old('first_name'); ?>">
                                                <div class="<?= validation_show_error('first_name') ? 'invalid-feedback' : '' ?>">
                                                    <?= validation_show_error('first_name'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" name="last_name" class="form-control <?= validation_show_error('last_name') ? 'is-invalid' : '' ?>" value="<?= old('last_name'); ?>">
                                                <div class="<?= validation_show_error('last_name') ? 'invalid-feedback' : '' ?>">
                                                    <?= validation_show_error('last_name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" value="<?= old('email') ?>">
                                        <div class="<?= validation_show_error('email') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Password</label>
                                                <div class="input-group border-group <?= validation_show_error('password') ? 'is-invalid' : '' ?>">
                                                    <input type="password" name="password" class="form-control">
                                                    <div class="d-flex align-items-center text-center" type="button" onclick="showPassword(this, 'password')">
                                                        <i class="ri-eye-2-line"></i>
                                                    </div>
                                                </div>
                                                <div class="<?= validation_show_error('password') ? 'invalid-feedback' : '' ?>">
                                                    <?= validation_show_error('password'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="input-group border-group <?= validation_show_error('password') ? 'is-invalid' : '' ?>">
                                                    <input type="password" name="confirm_password" class="form-control">
                                                    <div class="d-flex align-items-center text-center" type="button" onclick="showPassword(this, 'confirm_password')">
                                                        <i class="ri-eye-2-line"></i>
                                                    </div>
                                                </div>
                                                <div class="<?= validation_show_error('confirm_password') ? 'invalid-feedback' : '' ?>">
                                                    <?= validation_show_error('confirm_password'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3 <?= validation_show_error('agree') ? 'is-invalid' : '' ?>" name="agree" type="checkbox" id="form-check-default" value="1" <?= old('agree') == 1 ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="form-check-default">
                                                I agree the <a href="/terms-conditions" target="_blank" class="text-primary">Terms and Conditions</a>
                                            </label>
                                            <div class="<?= validation_show_error('agree') ? 'invalid-feedback' : '' ?>">
                                                <?= validation_show_error('agree'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn default-btn w-100">SIGN UP</button>
                                    </div>
                                </div>
                            </form>

                            <div class="col-12 mb-4">
                                <div class="">
                                    <div class="seperator">
                                        <hr>
                                        <div class="seperator-text"> <span>Or continue with</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <div class="mb-4">
                                    <a href="/auth-google">
                                        <button class="btn btn-social-login w-100">
                                            <img src="/assets/cms/img/google-gmail.svg" alt="google" class="img-fluid">
                                            <span class="btn-text-inner">Google</span>
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="col-sm-6 col-12">
                                <a href="/auth-facebook">
                                    <div class="mb-4">
                                        <button class="btn btn-social-login w-100">
                                            <img src="/assets/cms/img/facebook.svg" alt="fb" class="img-fluid rounded" style="background-color: #3b5998;">
                                            <span class="btn-text-inner">Facebook</span>
                                        </button>
                                    </div>
                                </a>
                            </div>

                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">Already have an account ? <a href="/login" class="text-warning">Sign in</a></p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>