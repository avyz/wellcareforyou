<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <div class="main-content">
        <div class="container">
            <?php if (session()->getFlashdata('notif')) : ?>
                <?= session()->getFlashdata('notif') ?>
            <?php endif; ?>
            <?= $this->include('/layout/admin/buttons'); ?>
            <div class="table-responsive">
                <table id="language-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Language</th>
                            <th>Code</th>
                            <th>Icon</th>
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
<div class="modal fade" id="languageCreateModal" tabindex="-1" role="dialog" aria-labelledby="languageCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="languageCreateModalLabel">Create Language</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="languageCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lang_code">Code :</label>
                                <input type="text" class="form-control" name="lang_code" id="lang_code" required>
                                <div class="invalid-feedback" id="lang_code_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="language">Language :</label>
                                <input type="text" class="form-control" name="language" id="language" required>
                                <div class="invalid-feedback" id="language_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2 mt-md-0">
                                <label for="data_lang_icon" class="form-label">Icon :</label>
                                <input class="form-control" type="file" name="data_lang_icon" id="data_lang_icon" accept="image/jpg, image/jpeg, image/png" required>
                                <div class="invalid-feedback" id="data_lang_icon_validation"></div>
                            </div>
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
<div class="modal fade" id="languageEditModal" tabindex="-1" role="dialog" aria-labelledby="languageEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="languageEditModalLabel">Edit Language</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="languageEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="lang_id" id="edit_lang_id">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit_lang_code">Code :</label>
                                <input type="text" class="form-control" name="edit_lang_code" id="edit_lang_code" readonly>
                                <div class="invalid-feedback" id="edit_lang_code_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_language">edit_Language :</label>
                                <input type="text" class="form-control" name="edit_language" id="edit_language" required>
                                <div class="invalid-feedback" id="edit_language_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2 mt-md-0">
                                <input type="hidden" class="form-control" name="edit_old_lang_icon" id="edit_old_lang_icon">
                                <label for="edit_data_lang_icon" class="form-label">Icon :</label>
                                <input class="form-control" type="file" name="edit_data_lang_icon" id="edit_data_lang_icon" accept="image/jpg, image/jpeg, image/png" required>
                                <div class="invalid-feedback" id="edit_data_lang_icon_validation"></div>
                            </div>
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