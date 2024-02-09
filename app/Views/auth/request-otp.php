<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="auth-container d-flex">

    <div class="container mx-auto align-self-center">

        <div class="row justify-content-center">

            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto mx-lg-2">
                <div class="card">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('notif')) : ?>
                            <?= session()->getFlashdata('notif') ?>
                        <?php endif; ?>
                        <form action="/verify" method="POST" id="verifyData">
                            <?= csrf_field() ?>
                            <input type="hidden" name="email" class="form-control" value="<?= $email ?>">
                            <div class="row text-center">
                                <div class="col-md-12 mb-3">
                                    <h2>Verification Email</h2>
                                    <p>Enter the code for verification.</p>
                                </div>
                                <div class="col-sm-2 col-3 ms-auto">
                                    <div class="mb-3">
                                        <input type="text" name="code-1" class="form-control opt-input">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-3">
                                    <div class="mb-3">
                                        <input type="text" name="code-2" class="form-control opt-input">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-3">
                                    <div class="mb-3">
                                        <input type="text" name="code-3" class="form-control opt-input">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-3 me-auto">
                                    <div class="mb-3">
                                        <input type="text" name="code-4" class="form-control opt-input">
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-secondary btn-optin-confirm w-100">VERIFY</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Didn't receive the code ? <a href="/resend/<?= $email ?>" class="text-warning">Resend</a></p>
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