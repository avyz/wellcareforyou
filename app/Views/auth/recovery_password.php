<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="auth-container d-flex">

    <div class="container mx-auto align-self-center">

        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto mx-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="/recovery-password" method="POST">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-3 text-center">

                                    <h2>Recovery Password</h2>
                                    <p>Enter your email to recover your password</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <input placeholder="Email" type="text" name="email" class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>" value="<?= old('email'); ?>">
                                        <div class="<?= validation_show_error('email') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('email'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <div class="mb-2">
                                        <button type="submit" class="btn default-btn w-100">RECOVER</button>
                                    </div>
                                    <a href="/login">Back to login</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>