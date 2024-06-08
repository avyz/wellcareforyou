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
                <table id="specialist-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Specialist</th>
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
<div class="modal fade" id="specialistCreateModal" tabindex="-1" role="dialog" aria-labelledby="specialistCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="specialistCreateModalLabel">Create Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="specialistCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group my-3">
                        <label for="specialist_name">Specialist :</label>
                        <input type="text" class="form-control" name="specialist_name" id="specialist_name" required>
                        <div class="invalid-feedback" id="specialist_name_validation"></div>
                    </div>
                    <?php foreach ($language_list as $key => $d) : ?>
                        <div class="form-group mb-3">
                            <label>Description <?= $d['language'] ?> :</label>
                            <textarea name="specialist_desc_<?= $d['lang_code'] ?>" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback" id="specialist_desc_<?= $d['lang_code'] ?>_validation"></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label for="specialist_image">Image<small class="text-danger">*</small> : </label>
                        <div class="row align-items-center">
                            <div class="col-lg-2">
                                <img src="/assets/website/images/specialist/default.png" class="preview-img-specialist-image mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-10">
                                <input onchange="previewImg('specialist_image', 'preview-img-specialist-image')" class="form-control" type="file" id="specialist_image" name="specialist_image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="invalid-feedback" id="specialist_image_validation"></div>
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
<div class="modal fade" id="specialistEditModal" tabindex="-1" role="dialog" aria-labelledby="specialistEditModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="specialistEditModalLabel">Edit Specialist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="specialistEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="doctor_specialist_id" id="edit_doctor_specialist_id">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <div class="form-group my-3">
                        <label for="edit_specialist_name">Specialist :</label>
                        <input type="text" class="form-control" name="edit_specialist_name" id="edit_specialist_name" required>
                        <div class="invalid-feedback" id="edit_specialist_name_validation"></div>
                    </div>
                    <?php foreach ($language_list as $key => $d) : ?>
                        <div class="form-group mb-3 edit_specialist_desc">
                            <label for="edit_specialist_desc_<?= $d['lang_code'] ?>">Description <?= $d['language'] ?> :</label>
                            <textarea data-lang_code="<?= $d['lang_code'] ?>" name="edit_specialist_desc_<?= $d['lang_code'] ?>" id="edit_specialist_desc_<?= $d['lang_code'] ?>" class="form-control" rows="3"></textarea>
                            <div class="invalid-feedback" id="edit_specialist_desc_<?= $d['lang_code'] ?>_validation"></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label>Image<small class="text-danger">*</small> : </label>
                        <div class="row align-items-center" id="edit-show-specialist-image">
                            <div class="col-lg-2">
                                <img class="edit-preview-img-specialist-image mb-2 mb-lg-0" style="width:120px" alt="img">
                            </div>
                            <div class="col-lg-10">
                                <input onchange="previewImg('edit_specialist_image_new', 'edit-preview-img-specialist-image')" class="form-control" type="file" id="edit_specialist_image_new" name="edit_specialist_image_new" accept="image/*">
                            </div>
                        </div>
                        <div class="invalid-feedback" id="edit_specialist_image_new_validation"></div>
                        <input type="hidden" class="form-control" name="edit_specialist_image" id="edit_specialist_image">
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