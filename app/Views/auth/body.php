<?= $this->extend($layout); ?>

<?= $this->section($section); ?>

<div class="auth-container d-flex">

    <div class="container mx-auto align-self-center">

        <div class="row justify-content-center">

            <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                <!-- <div class="auth-cover-bg-image"></div>
                <div class="auth-overlay"></div> -->

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
                                <h2>Sign In</h2>
                                <p>Please enter your email and password to login</p>
                            </div>
                            <form action="/auth-login" method="post">
                                <?= csrf_field() ?>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" value="<?= old('email'); ?>">
                                        <div class="<?= validation_show_error('email') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12">

                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <div class="input-group border-group <?= validation_show_error('password') ? 'is-invalid' : '' ?>">
                                            <input type="password" name="password" id="password" class="form-control">
                                            <div class="d-flex align-items-center text-center" type="button" onclick="showPassword(this, 'password')">
                                                <i class="ri-eye-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="<?= validation_show_error('password') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('password'); ?>
                                        </div>
                                    </div>

                                    <!-- <div class="mb-4">
                                    </div> -->
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <a href="javascript:void(0);" class="text-dark">Forgot Password?</a>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn default-btn w-100">SIGN IN</button>
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
                                    <p class="mb-0">Dont't have an account ? <a href="/register" class="text-warning">Sign Up</a></p>
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