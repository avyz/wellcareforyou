<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <div class="main-content">
        <div class="container">
            <?php if (session()->getFlashdata('notif')) : ?>
                <?= session()->getFlashdata('notif') ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="d-md-flex justify-content-between">
                        <h4><?= $title; ?></h4>
                        <a href="/hospital/hospital/package/post?hospital_uuid=<?= $data['hospital_uuid'] ?>&hospital_name=<?= $data['hospital_name'] ?>&hospital_code=<?= $data['hospital_code'] ?>&lang_code=<?= $data['lang_code'] ?>">
                            <button class="btn btn-primary mb-3 mb-md-0">POST</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="packages-ui-table" data-hospital_uuid="<?= $data['hospital_uuid'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>