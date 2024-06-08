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
                <table id="country-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Country</th>
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
<div class="modal fade" id="countryCreateModal" tabindex="-1" role="dialog" aria-labelledby="countryCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="countryCreateModalLabel">Create Country</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="countryCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country_code">Code :</label>
                                <input type="text" class="form-control" name="country_code" id="country_code" required>
                                <div class="invalid-feedback" id="country_code_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country :</label>
                                <input type="text" class="form-control" name="country" id="country" required>
                                <div class="invalid-feedback" id="country_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2 mt-md-0">
                                <label for="data_country_icon" class="form-label">Icon :</label>
                                <input class="form-control" type="file" name="data_country_icon" id="data_country_icon" accept="image/jpg, image/jpeg, image/png" required>
                                <div class="invalid-feedback" id="data_country_icon_validation"></div>
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
<div class="modal fade" id="countryEditModal" tabindex="-1" role="dialog" aria-labelledby="countryEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="countryEditModalLabel">Edit Country</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="countryEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="country_id" id="edit_country_id">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit_country_code">Code :</label>
                                <input type="text" class="form-control" name="edit_country_code" id="edit_country_code" readonly>
                                <div class="invalid-feedback" id="edit_country_code_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_country">Country :</label>
                                <input type="text" class="form-control" name="edit_country" id="edit_country" required>
                                <div class="invalid-feedback" id="edit_country_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2 mt-md-0">
                                <input type="hidden" class="form-control" name="edit_old_country_icon" id="edit_old_country_icon">
                                <label for="edit_data_country_icon" class="form-label">Icon :</label>
                                <input class="form-control" type="file" name="edit_data_country_icon" id="edit_data_country_icon" accept="image/jpg, image/jpeg, image/png">
                                <div class="invalid-feedback" id="edit_data_country_icon_validation"></div>
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