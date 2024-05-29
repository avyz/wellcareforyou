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
                            <th>Phone</th>
                            <th>Address</th>
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

                        <div class="row align-items-center">
                            <div class="col-lg-2">
                                <img src="/assets/website/images/hospital/default.png" class="preview-img-hospital-image mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-10">
                                <input onchange="previewImg('hospital_image', 'preview-img-hospital-image')" class="form-control" type="file" id="hospital_image" name="hospital_image" accept="image/*" required>
                            </div>
                        </div>


                        <!-- <input type="file" class="form-control" name="hospital_image" id="hospital_image" required> -->
                        <div class="invalid-feedback" id="hospital_image_validation"></div>
                    </div>
                    <div class="form-group my-3">
                        <label for="hospital_name">Hospital Name</label>
                        <input type="text" class="form-control" name="hospital_name" id="hospital_name" required>
                        <div class="invalid-feedback" id="hospital_name_validation"></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">HQ Address</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
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
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="hq_hospital_location_uuid">Hospital State</label>
                                        <select name="hq_hospital_location_uuid" id="hq_hospital_location_uuid" class="form-control" required>
                                            <option value="">-- Choose your state --</option>
                                        </select>
                                        <div class="invalid-feedback" id="hq_hospital_location_uuid_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="branch_hospital_country">Hospital Country</label>
                                        <select id="branch_hospital_country" class="form-control">
                                            <option value="">-- Choose your country --</option>
                                            <?php foreach ($language_list as $d) : ?>
                                                <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback" id="branch_hospital_country_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="branch_hospital_location_uuid">Hospital State</label>
                                        <select name="branch_hospital_location_uuid" id="branch_hospital_location_uuid" class="form-control">
                                            <option value="">-- Choose your state --</option>
                                        </select>
                                        <div class="invalid-feedback" id="branch_hospital_location_uuid_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="branch_hospital_phone">Hospital Phone</label>
                                        <input type="text" class="form-control" id="branch_hospital_phone">
                                        <div class="invalid-feedback" id="branch_hospital_phone_validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-3">
                                <label for="branch_hospital_map_location">Hospital Map Location</label>
                                <input type="text" class="form-control" id="branch_hospital_map_location">
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
            <form action="javascript:void(0)" method="post" id="hospitalEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="hospital_id" id="edit_hospital_id">
                    <div class="form-group">
                        <label for="edit_hospital_image_new">Hospital Photo</label>

                        <div class="row align-items-center" id="edit-show-hospital-image">
                            <div class="col-lg-2">
                                <img class="edit-preview-img-hospital-image mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-10">
                                <input onchange="previewImg('edit_hospital_image_new', 'edit-preview-img-hospital-image')" class="form-control" type="file" id="edit_hospital_image_new" name="edit_hospital_image_new" accept="image/*">
                            </div>
                        </div>
                        <div class="invalid-feedback" id="edit_hospital_image_new_validation"></div>
                        <input type="hidden" class="form-control" name="edit_hospital_image" id="edit_hospital_image">
                    </div>
                    <div class="form-group my-3">
                        <label for="edit_hospital_name">Hospital Name</label>
                        <input type="text" class="form-control" name="edit_hospital_name" id="edit_hospital_name" required>
                        <div class="invalid-feedback" id="edit_hospital_name_validation"></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">HQ Address</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="edit_hq_hospital_country">Hospital Country</label>
                                        <select name="edit_hq_hospital_country" id="edit_hq_hospital_country" class="form-control" required>
                                            <option value="">-- Choose your country --</option>
                                            <?php foreach ($language_list as $d) : ?>
                                                <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback" id="edit_hq_hospital_country_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="edit_hq_hospital_location_uuid">Hospital State</label>
                                        <select name="edit_hq_hospital_location_uuid" id="edit_hq_hospital_location_uuid" class="form-control" required>
                                            <option value="">-- Choose your state --</option>
                                        </select>
                                        <div class="invalid-feedback" id="edit_hq_hospital_location_uuid_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="edit_hq_hospital_phone">Hospital Phone</label>
                                        <input type="text" class="form-control" name="edit_hq_hospital_phone" id="edit_hq_hospital_phone" required>
                                        <div class="invalid-feedback" id="edit_hq_hospital_phone_validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-3">
                                <label for="edit_hq_hospital_map_location">Hospital Map Location</label>
                                <input type="text" class="form-control" name="edit_hq_hospital_map_location" id="edit_hq_hospital_map_location" required>
                                <div class="invalid-feedback" id="edit_hq_hospital_map_location_validation"></div>
                            </div>
                            <div class="form-group">
                                <label for="edit_hq_hospital_address">Hospital Address</label>
                                <textarea class="form-control" name="edit_hq_hospital_address" id="edit_hq_hospital_address" cols="10" rows="5"></textarea>
                                <div class="invalid-feedback" id="edit_hq_hospital_address_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="card-title">Branch Address</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="edit_branch_hospital_country">Hospital Country</label>
                                        <select id="edit_branch_hospital_country" class="form-control">
                                            <option value="">-- Choose your country --</option>
                                            <?php foreach ($language_list as $d) : ?>
                                                <option value="<?= $d['uuid'] ?>"><?= $d['language'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback" id="edit_branch_hospital_country_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="edit_branch_hospital_location_uuid">Hospital State</label>
                                        <select name="edit_branch_hospital_location_uuid" id="edit_branch_hospital_location_uuid" class="form-control">
                                            <option value="">-- Choose your state --</option>
                                        </select>
                                        <div class="invalid-feedback" id="edit_branch_hospital_location_uuid_validation"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-3 mt-lg-0">
                                    <div class="form-group">
                                        <label for="edit_branch_hospital_phone">Hospital Phone</label>
                                        <input type="text" class="form-control" id="edit_branch_hospital_phone">
                                        <div class="invalid-feedback" id="edit_branch_hospital_phone_validation"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-3">
                                <label for="edit_branch_hospital_map_location">Hospital Map Location</label>
                                <input type="text" class="form-control" id="edit_branch_hospital_map_location">
                                <div class="invalid-feedback" id="edit_branch_hospital_map_location_validation"></div>
                            </div>
                            <div class="form-group">
                                <label for="edit_branch_hospital_address">Hospital Address</label>
                                <textarea class="form-control" id="edit_branch_hospital_address" cols="10" rows="5"></textarea>
                                <div class="invalid-feedback" id="edit_branch_hospital_address_validation"></div>
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                <button type="button" class="btn btn-info" id="edit-insert-data-hospital-branch">Insert</button>
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
                                    <tbody id="edit-show-branch-hospital"></tbody>
                                </table>
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