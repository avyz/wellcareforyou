<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="auth-container d-flex">

    <div class="container mx-auto align-self-center">

        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-12 d-flex flex-column align-self-center mx-auto mx-lg-2">
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('notif')) : ?>
                            <?= session()->getFlashdata('notif') ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 mb-3">

                                <div class="media mb-4">

                                    <div class="avatar avatar-lg me-3">
                                        <img alt="avatar" src="/assets/cms/img/<?= $photo ? $photo : 'profile_white.png' ?>" class="rounded-circle">
                                    </div>

                                    <div class="media-body align-self-center">

                                        <h3 class="mb-0"><?= $nama; ?></h3>
                                        <p class="mb-0">Enter your password to unlock your Account</p>

                                    </div>

                                </div>

                            </div>
                            <form action="/unlock" method="post">
                                <?= csrf_field() ?>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <div class="input-group border-group <?= validation_show_error('password') ? 'is-invalid' : '' ?>">
                                            <input type="password" name="password" class="form-control" autofocus>
                                            <div class="d-flex align-items-center text-center" type="button" onclick="showPassword(this, 'password')">
                                                <i class="ri-eye-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="<?= validation_show_error('password') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn default-btn w-100">UNLOCK</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>