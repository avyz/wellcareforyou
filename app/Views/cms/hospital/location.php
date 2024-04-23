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
                <table id="hospital-location-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Country</th>
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
<div class="modal fade" id="locationCreateModal" tabindex="-1" role="dialog" aria-labelledby="locationCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="locationCreateModalLabel">Create Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="locationCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="lang_uuid">Country : </label>
                                <select id="lang_uuid" class="form-control" required>
                                    <option value="">-- Choose your country --</option>
                                    <?php foreach ($language_list as $d) : ?>
                                        <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hospital_location_name">State :</label>
                                <input type="text" class="form-control" id="hospital_location_name" required>

                            </div>
                        </div>
                        <div class="col-md-3 mt-2 mt-md-0">
                            <div class="form-group">
                                <label class="d-none d-md-block" style="visibility: hidden;">Status :</label>
                                <button type="button" class="btn btn-info" id="insert-data-location" style="padding: 11px 33px;width:100%">Insert</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table dt-table-hover table-border my-3" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="show-state"></tbody>
                        </table>
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
<div class="modal fade" id="locationEditModal" tabindex="-1" role="dialog" aria-labelledby="locationEditModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="locationEditModalLabel">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="locationEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group" style="display: none;">
                        <label for="edit_lang_uuid">Country : </label>
                        <select id="edit_lang_uuid" class="form-control" required>
                            <option value="">-- Choose your country --</option>
                            <?php foreach ($language_list as $d) : ?>
                                <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="edit_hospital_location_name">State :</label>
                                <input type="text" class="form-control" id="edit_hospital_location_name">
                            </div>
                        </div>
                        <div class="col-md-3 mt-2 mt-md-0">
                            <div class="form-group">
                                <label class="d-none d-md-block" style="visibility: hidden;">Status :</label>
                                <button type="button" class="btn btn-info" id="edit-insert-data-location" style="padding: 11px 33px;width:100%">Insert</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table dt-table-hover table-border my-3" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="edit-show-state"></tbody>
                        </table>
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