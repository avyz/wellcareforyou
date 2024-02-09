<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="auth-container d-flex">

    <div class="container mx-auto align-self-center">

        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-12 d-flex flex-column align-self-center mx-auto mx-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="/new-password/<?= $email; ?>" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 mb-3 text-center">

                                    <h2>Create Your New Password</h2>
                                    <p>Please enter your new password below</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <div class="input-group border-group <?= validation_show_error('password') ? 'is-invalid' : '' ?>">
                                                <input placeholder="New Password" type="password" name="password" class="form-control">
                                                <div class="d-flex align-items-center text-center" type="button" onclick="showPassword(this, 'password')">
                                                    <i class="ri-eye-2-line"></i>
                                                </div>
                                            </div>
                                            <div class="<?= validation_show_error('password') ? 'invalid-feedback' : '' ?>">
                                                <?= validation_show_error('password'); ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group border-group <?= validation_show_error('confirm_password') ? 'is-invalid' : '' ?>">
                                                <input placeholder="Confirm New Password" type="password" name="confirm_password" class="form-control">
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

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn default-btn w-100">RESET PASSWORD</button>
                                    </div>
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