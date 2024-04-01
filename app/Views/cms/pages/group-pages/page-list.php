<?= $this->extend($layout); ?>
<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <h4>
        Group List <?= ucwords($data['page']); ?>
    </h4>
    <form action="/pages/create-group-pages-list" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="table-responsive">
            <table class="table dt-table-hover table-bordered my-3" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Pages</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data['group'] as $page) : ?>
                        <tr>
                            <td>
                                <?php if ($page['is_active_group_child'] == 1) : ?>
                                    <input type="checkbox" name="is_active[]" value="<?= $page['uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="is_active[]" value="<?= $page['uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td><?= $no++; ?></td>
                            <td><?= $page['navbar_management_name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-lg-end text-center mt-3">
            <input type="hidden" name="navbar_management_group_uuid" value="<?= $data['navbar_management_group_uuid'] ?>">
            <input type="hidden" name="lang_code" value="<?= $data['lang_code'] ?>">
            <button type="button" class="btn btn-light-dark w-auto d-block d-lg-inline" onclick="window.close()">Cancel</button>
            <button id="submit-data" type="submit" class="btn btn-primary mt-2 mt-lg-0 w-auto">Save</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>