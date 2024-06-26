<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <div class="main-content">
        <div class="container">
            <?php if (session()->getFlashdata('notif')) : ?>
                <?= session()->getFlashdata('notif') ?>
            <?php endif; ?>
            <?= $this->include('/layout/admin/buttons'); ?>
            <div class="row justify-content-end mt-3">
                <div class="col-md-4 col-6">
                    <div class="d-flex align-items-center">
                        <label class="mb-0 me-2 d-none d-md-inline">Language: </label>
                        <select class="form-control" name="language_code" onchange="changeLang(this, url + '/group-pages/data-navbar', group_pages_ui_table, 'groupPagesCreateModal', false)">
                            <option value="" selected disabled>-- Choose your menu language --</option>
                            <?php foreach ($language_list as $d) : ?>
                                <option value="<?= $d['lang_code'] ?>" <?php if ($d['lang_code'] == $language_row['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="group-pages-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Group Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Create -->
<div class="modal fade" id="groupPagesCreateModal" tabindex="-1" role="dialog" aria-labelledby="groupPagesCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="groupPagesCreateModalLabel">Create Group Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="groupPagesCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="form-group">
                        <label for="navbar_management_group_name">Group Name :</label>
                        <input type="text" class="form-control" name="navbar_management_group_name" id="navbar_management_group_name" required>
                        <div class="invalid-feedback" id="navbar_management_group_name_validation"></div>
                    </div>
                    <div class="form-group my-3">
                        <div class="form-check form-switch ps-4">
                            <label class="form-check-label" for="is_navbar">Force to be navbar</label>
                            <input class="form-check-input" type="checkbox" name="is_navbar" id="is_navbar" value="1">
                            <div class="invalid-feedback" id="is_navbar_validation"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="groupPagesEditModal" tabindex="-1" role="dialog" aria-labelledby="groupPagesEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="groupPagesEditModalLabel">Edit Group Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="groupPagesEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="navbar_management_group_id" id="edit_navbar_management_group_id">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="form-group">
                        <label for="edit_navbar_management_group_name">Group Name :</label>
                        <input type="text" class="form-control" name="edit_navbar_management_group_name" id="edit_navbar_management_group_name" required>
                        <div class="invalid-feedback" id="edit_navbar_management_group_name_validation"></div>
                    </div>
                    <div class="form-group my-3">
                        <div class="form-check form-switch ps-4">
                            <label class="form-check-label" for="edit_is_navbar">Force to be navbar</label>
                            <input class="form-check-input" type="checkbox" name="edit_is_navbar" id="edit_is_navbar" value="1">
                            <div class="invalid-feedback" id="edit_is_navbar_validation"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>