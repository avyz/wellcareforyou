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
                <table id="doctors-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Doctor</th>
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
<div class="modal fade" id="doctorCreateModal" tabindex="-1" role="dialog" aria-labelledby="doctorCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="doctorCreateModalLabel">Create Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="doctorCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="doctor_image">Doctor Photo<small class="text-danger">*</small> : </label>
                        <div class="row align-items-center">
                            <div class="col-lg-2">
                                <img src="/assets/website/images/doctor/profile.png" class="preview-img-doctor-image mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-10">
                                <input onchange="previewImg('doctor_image', 'preview-img-doctor-image')" class="form-control" type="file" id="doctor_image" name="doctor_image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="doctor_image_validation"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group my-3">
                                <label for="doctor_name">Name<small class="text-danger">*</small> : </label>
                                <input type="text" class="form-control" name="doctor_name" id="doctor_name" required>
                                <div class="invalid-feedback" id="doctor_name_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-3">
                                <label for="doctor_gender">Gender<small class="text-danger">*</small> : </label>
                                <select class="form-control" name="doctor_gender" id="doctor_gender" required>
                                    <option value="">-- Select gender --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <div class="invalid-feedback" id="doctor_gender_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="doctor_phone">Phone<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" name="doctor_phone" id="doctor_phone" required>
                        <div class="invalid-feedback" id="doctor_phone_validation"></div>
                    </div>
                    <div class="form-group my-3" id="tags_doctor_language">
                        <label for="doctor_language">Language<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" id="doctor_language" required>
                        <input type="hidden" class="form-control" name="check_doctor_language" id="check_doctor_language">
                        <div class="invalid-feedback" id="check_doctor_language_validation"></div>
                    </div>
                    <div class="form-group my-3" id="tags_doctor_hospital">
                        <label for="doctor_hospital">Hospital<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" id="doctor_hospital" required>
                        <input type="hidden" class="form-control" name="check_doctor_hospital" id="check_doctor_hospital">
                        <div class="invalid-feedback" id="check_doctor_hospital_validation"></div>
                    </div>
                    <div class="form-group my-3" id="tags_doctor_specialist">
                        <label for="doctor_specialist">Specialist<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" id="doctor_specialist" required>
                        <input type="hidden" class="form-control" name="check_doctor_specialist" id="check_doctor_specialist">
                        <div class="invalid-feedback" id="check_doctor_specialist_validation"></div>
                    </div>
                    <?php foreach ($language_list as $key => $d) : ?>
                        <div class="form-group mb-3">
                            <label>Biography <?= $d['language'] ?> :</label>
                            <textarea name="doctor_biography_<?= $d['lang_code'] ?>" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback" id="doctor_biography_<?= $d['lang_code'] ?>_validation"></div>
                        </div>
                    <?php endforeach; ?>
                    <?php $doctor_worktime = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']; ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Worktime</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php foreach ($doctor_worktime as $day) : ?>
                                <h5><?= $day ?></h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="doctor_worktime_start_<?= $day ?>">Start : </label>
                                            <input onchange="timeVal(this, 'doctor_worktime_end_<?= $day ?>')" type="time" class="form-control" name="doctor_worktime_start_<?= $day ?>" id="doctor_worktime_start_<?= $day ?>">
                                            <div class="invalid-feedback" id="doctor_worktime_start_<?= $day ?>_validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="doctor_worktime_end_<?= $day ?>">End : </label>
                                            <input type="time" class="form-control" name="doctor_worktime_end_<?= $day ?>" id="doctor_worktime_end_<?= $day ?>" readonly>
                                            <div class="invalid-feedback" id="doctor_worktime_end_<?= $day ?>_validation"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Education</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="doctor_education">Education : </label>
                                <input type="text" class="form-control" id="doctor_education">
                                <!-- <div class="invalid-feedback" id="doctor_education_validation"></div> -->
                            </div>
                            <div class="form-group my-3">
                                <label for="doctor_education_location">Location : </label>
                                <input class="form-control" id="doctor_education_location" />
                                <!-- <div class="invalid-feedback" id="doctor_education_location_validation"></div> -->
                            </div>
                            <div class="form-group">
                                <label for="doctor_education_year">Year : </label>
                                <input class="form-control" id="doctor_education_year" maxlength="4" />
                                <!-- <div class="invalid-feedback" id="doctor_education_year_validation"></div> -->
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                <button type="button" class="btn btn-info" id="insert-data-doctor-education">Insert</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table dt-table-hover table-border my-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Education</th>
                                            <th>Location</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-doctor-education"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Employment</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="doctor_employment">Employment : </label>
                                <input type="text" class="form-control" id="doctor_employment">
                                <!-- <div class="invalid-feedback" id="doctor_employment_validation"></div> -->
                            </div>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="doctor_employment_start_year">Start Year : </label>
                                        <input class="form-control" id="doctor_employment_start_year" maxlength="4" />
                                        <!-- <div class="invalid-feedback" id="doctor_employment_start_year_validation"></div> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="doctor_employment_end_year">End Year : </label>
                                        <input class="form-control" id="doctor_employment_end_year" maxlength="4" />
                                        <!-- <div class="invalid-feedback" id="doctor_employment_end_year_validation"></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                <button type="button" class="btn btn-info" id="insert-data-doctor-employment">Insert</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table dt-table-hover table-border my-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employment</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-doctor-employment"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="doctor_address">Address :</label>
                        <textarea name="doctor_address" id="doctor_address" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback" id="doctor_address_validation"></div>
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
<div class="modal fade" id="doctorEditModal" tabindex="-1" role="dialog" aria-labelledby="doctorEditModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="doctorEditModalLabel">Edit Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="doctorEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="doctor_id" id="edit_doctor_id">
                    <div class="form-group">
                        <label>Doctor Photo<small class="text-danger">*</small> : </label>
                        <div class="row align-items-center" id="edit-show-doctor-image">
                            <div class="col-lg-2">
                                <img class="edit-preview-img-doctor-image mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-10">
                                <input onchange="previewImg('edit_doctor_image_new', 'edit-preview-img-doctor-image')" class="form-control" type="file" id="edit_doctor_image_new" name="edit_doctor_image_new" accept="image/*">
                            </div>
                        </div>
                        <div class="invalid-feedback" id="edit_doctor_image_new_validation"></div>
                        <input type="hidden" class="form-control" name="edit_doctor_image" id="edit_doctor_image">
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group my-3">
                                <label for="edit_doctor_name">Name<small class="text-danger">*</small> : </label>
                                <input type="text" class="form-control" name="edit_doctor_name" id="edit_doctor_name" required>
                                <div class="invalid-feedback" id="edit_doctor_name_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-3">
                                <label for="edit_doctor_gender">Gender<small class="text-danger">*</small> : </label>
                                <select class="form-control" name="edit_doctor_gender" id="edit_doctor_gender" required>
                                    <option value="">-- Select gender --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <div class="invalid-feedback" id="edit_doctor_gender_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="edit_doctor_phone">Phone<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" name="edit_doctor_phone" id="edit_doctor_phone" required>
                        <div class="invalid-feedback" id="edit_doctor_phone_validation"></div>
                    </div>
                    <div class="form-group my-3" id="tags_edit_doctor_language">
                        <label for="edit_doctor_language">Language<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" id="edit_doctor_language" required>
                        <input type="hidden" class="form-control" name="check_edit_doctor_language" id="check_edit_doctor_language">
                        <div class="invalid-feedback" id="check_edit_doctor_language_validation"></div>
                    </div>
                    <div class="form-group my-3" id="tags_edit_doctor_hospital">
                        <label for="edit_doctor_hospital">Hospital<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" id="edit_doctor_hospital" required>
                        <input type="hidden" class="form-control" name="check_edit_doctor_hospital" id="check_edit_doctor_hospital">
                        <div class="invalid-feedback" id="check_edit_doctor_hospital_validation"></div>
                    </div>
                    <div class="form-group my-3" id="tags_edit_doctor_specialist">
                        <label for="edit_doctor_specialist">Specialist<small class="text-danger">*</small> : </label>
                        <input type="text" class="form-control" id="edit_doctor_specialist" required>
                        <input type="hidden" class="form-control" name="check_edit_doctor_specialist" id="check_edit_doctor_specialist">
                        <div class="invalid-feedback" id="check_edit_doctor_specialist_validation"></div>
                    </div>
                    <?php foreach ($language_list as $key => $d) : ?>
                        <div class="form-group mb-3">
                            <label>Biography <?= $d['language'] ?> :</label>
                            <textarea name="edit_doctor_biography_<?= $d['lang_code'] ?>" id="edit_doctor_biography_<?= $d['lang_code'] ?>" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback" id="edit_doctor_biography_<?= $d['lang_code'] ?>_validation"></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Worktime</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php foreach ($doctor_worktime as $day) : ?>
                                <h5><?= $day ?></h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="edit_doctor_worktime_start_<?= $day ?>">Start : </label>
                                            <input onchange="timeVal(this, 'edit_doctor_worktime_end_<?= $day ?>')" type="time" class="form-control" name="edit_doctor_worktime_start_<?= $day ?>" id="edit_doctor_worktime_start_<?= $day ?>">
                                            <div class="invalid-feedback" id="edit_doctor_worktime_start_<?= $day ?>_validation"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="edit_doctor_worktime_end_<?= $day ?>">End : </label>
                                            <input type="time" class="form-control" name="edit_doctor_worktime_end_<?= $day ?>" id="edit_doctor_worktime_end_<?= $day ?>" readonly>
                                            <div class="invalid-feedback" id="edit_doctor_worktime_end_<?= $day ?>_validation"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Education</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="edit_doctor_education">Education : </label>
                                <input type="text" class="form-control" id="edit_doctor_education">
                                <!-- <div class="invalid-feedback" id="edit_doctor_education_validation"></div> -->
                            </div>
                            <div class="form-group my-3">
                                <label for="edit_doctor_education_location">Location : </label>
                                <input class="form-control" id="edit_doctor_education_location" />
                                <!-- <div class="invalid-feedback" id="edit_doctor_education_location_validation"></div> -->
                            </div>
                            <div class="form-group">
                                <label for="edit_doctor_education_year">Year : </label>
                                <input class="form-control" id="edit_doctor_education_year" maxlength="4" />
                                <!-- <div class="invalid-feedback" id="edit_doctor_education_year_validation"></div> -->
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                <button type="button" class="btn btn-info" id="edit-insert-data-doctor-education">Insert</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table dt-table-hover table-border my-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Education</th>
                                            <th>Location</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="edit-show-doctor-education"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Employment</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="edit_doctor_employment">Employment : </label>
                                <input type="text" class="form-control" id="edit_doctor_employment">
                                <!-- <div class="invalid-feedback" id="edit_doctor_employment_validation"></div> -->
                            </div>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_doctor_employment_start_year">Start Year : </label>
                                        <input class="form-control" id="edit_doctor_employment_start_year" maxlength="4" />
                                        <!-- <div class="invalid-feedback" id="edit_doctor_employment_start_year_validation"></div> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_doctor_employment_end_year">End Year : </label>
                                        <input class="form-control" id="edit_doctor_employment_end_year" maxlength="4" />
                                        <!-- <div class="invalid-feedback" id="edit_doctor_employment_end_year_validation"></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end my-3">
                                <button type="button" class="btn btn-info" id="edit-insert-data-doctor-employment">Insert</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table dt-table-hover table-border my-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employment</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="edit-show-doctor-employment"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_doctor_address">Address :</label>
                        <textarea name="edit_doctor_address" id="edit_doctor_address" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback" id="edit_doctor_address_validation"></div>
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