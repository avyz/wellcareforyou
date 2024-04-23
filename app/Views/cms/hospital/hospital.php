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
                <table id="hospital-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Hospital</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Create -->
<div class="modal fade" id="hospitalCreateModal" tabindex="-1" role="dialog" aria-labelledby="hospitalCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="hospitalCreateModalLabel">Create Hospital</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="hospitalCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="hospital_image">Hospital Photo</label>
                        <input type="file" class="form-control" name="hospital_image" id="hospital_image" required>
                        <div class="invalid-feedback" id="hospital_image_validation"></div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hospital_name">Hospital Name</label>
                                <input type="text" class="form-control" name="hospital_name" id="hospital_name" required>
                                <div class="invalid-feedback" id="hospital_name_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">HQ Address</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hq_hospital_country">Hospital Country</label>
                                        <select name="hq_hospital_country" id="hq_hospital_country" class="form-control" required>
                                            <option value="">-- Choose your country --</option>
                                            <?php foreach ($language_list as $d) : ?>
                                                <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback" id="hq_hospital_country_validation"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2 mt-md-0">
                                    <div class="form-group">
                                        <label for="hq_hospital_location_uuid">Hospital Location</label>
                                        <select name="hq_hospital_location_uuid" id="hq_hospital_location_uuid" class="form-control" required>
                                            <option value="">-- Choose your location --</option>
                                        </select>
                                        <div class="invalid-feedback" id="hq_hospital_location_uuid_validation"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2 mt-md-0">
                                    <div class="form-group">
                                        <label for="hq_hospital_phone">Hospital Phone</label>
                                        <input type="text" class="form-control" name="hq_hospital_phone" id="hq_hospital_phone" required>
                                        <div class="invalid-feedback" id="hq_hospital_phone_validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-3">
                                <label for="hq_hospital_map_location">Hospital Map Location</label>
                                <input type="text" class="form-control" name="hq_hospital_map_location" id="hq_hospital_map_location" required>
                                <div class="invalid-feedback" id="hq_hospital_map_location_validation"></div>
                            </div>
                            <div class="form-group">
                                <label for="hq_hospital_address">Hospital Address</label>
                                <textarea class="form-control" name="hq_hospital_address" id="hq_hospital_address" cols="10" rows="5"></textarea>
                                <div class="invalid-feedback" id="hq_hospital_address_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="card-title">Branch Address</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="branch_hospital_country">Hospital Country</label>
                                        <select id="branch_hospital_country" class="form-control" required>
                                            <option value="">-- Choose your country --</option>
                                            <?php foreach ($language_list as $d) : ?>
                                                <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback" id="branch_hospital_country_validation"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2 mt-md-0">
                                    <div class="form-group">
                                        <label for="branch_hospital_location_uuid">Hospital Location</label>
                                        <select name="branch_hospital_location_uuid" id="branch_hospital_location_uuid" class="form-control" required>
                                            <option value="">-- Choose your location --</option>
                                        </select>
                                        <div class="invalid-feedback" id="branch_hospital_location_uuid_validation"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2 mt-md-0">
                                    <div class="form-group">
                                        <label for="branch_hospital_phone">Hospital Phone</label>
                                        <input type="text" class="form-control" id="branch_hospital_phone" required>
                                        <div class="invalid-feedback" id="branch_hospital_phone_validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-3">
                                <label for="branch_hospital_map_location">Hospital Map Location</label>
                                <input type="text" class="form-control" id="branch_hospital_map_location" required>
                                <div class="invalid-feedback" id="branch_hospital_map_location_validation"></div>
                            </div>
                            <div class="form-group">
                                <label for="branch_hospital_address">Hospital Address</label>
                                <textarea class="form-control" id="branch_hospital_address" cols="10" rows="5"></textarea>
                                <div class="invalid-feedback" id="branch_hospital_address_validation"></div>
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                <button type="button" class="btn btn-info" id="insert-data-hospital-branch">Insert</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table dt-table-hover table-border my-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Map Location</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-branch-hospital"></tbody>
                                </table>
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
<div class="modal fade" id="hospitalEditModal" tabindex="-1" role="dialog" aria-labelledby="hospitalEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="hospitalEditModalLabel">Edit Hospital</h5>
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