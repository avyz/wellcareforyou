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
                        <select class="form-control" name="language_code" onchange="changeLang(this, url + '/pages/data-navbar', pages_ui_table, 'pagesCreateModal', false)">
                            <option value="" selected disabled>-- Choose your menu language --</option>
                            <?php foreach ($language_list as $d) : ?>
                                <option value="<?= $d['lang_code'] ?>" <?php if ($d['lang_code'] == $language_row['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="pages-ui-table" data-view="<?= $dataMenu['sidebar'][0]['view'] ?>" data-create="<?= $dataMenu['sidebar'][0]['create'] ?>" data-edit="<?= $dataMenu['sidebar'][0]['edit'] ?>" data-delete="<?= $dataMenu['sidebar'][0]['delete'] ?>" data-buttons_csv="<?= $dataMenu['sidebar'][0]['buttons_csv'] ?>" data-buttons_excel="<?= $dataMenu['sidebar'][0]['buttons_excel'] ?>" data-buttons_print="<?= $dataMenu['sidebar'][0]['buttons_print'] ?>" class="table dt-table-hover my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pages</th>
                            <th>Pages Url</th>
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
<div class="modal fade" id="pagesCreateModal" tabindex="-1" role="dialog" aria-labelledby="pagesCreateModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="pagesCreateModalLabel">Create Pages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="pagesCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row my-3">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="navbar_management_name">Page Name :</label>
                                <input type="text" class="form-control" name="navbar_management_name" id="navbar_management_name" required>
                                <div class="invalid-feedback" id="navbar_management_name_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="navbar_management_number">Page Number :</label>
                                <input type="number" min="1" class="form-control" name="navbar_management_number" id="navbar_management_number" required>
                                <div class="invalid-feedback" id="navbar_management_number_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="to_page">To Page : </label>
                        <select name="to_page" id="to_page" class="form-control" required>
                            <option value="">-- Select Page --</option>
                            <option value="home">Home</option>
                            <option value="about">About</option>
                            <option value="hospitals">Hospital</option>
                            <option value="doctors">Doctor</option>
                            <option value="specialists">Specialist</option>
                            <option value="newsblog">News & Blog</option>
                            <option value="pharmacies">Pharmacies</option>
                            <option value="contact">Contact</option>
                            <option value="privacy-policy">Privacy Policy</option>
                            <option value="terms-condition">Terms Condition</option>
                        </select>
                        <div class="invalid-feedback" id="to_page_validation"></div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-switch ps-4">
                            <label class="form-check-label" for="is_main">Force page url to "/"</label>
                            <input class="form-check-input" type="checkbox" name="is_main" id="is_main" value="1">
                            <div class="invalid-feedback" id="is_main_validation"></div>
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
<div class="modal fade" id="pagesEditModal" tabindex="-1" role="dialog" aria-labelledby="pagesEditModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="pagesEditModalLabel">Edit Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="POST" id="pagesEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="navbar_management_id" id="edit_navbar_management_id">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row my-3">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="edit_navbar_management_name">Page Name :</label>
                                <input type="text" class="form-control" name="edit_navbar_management_name" id="edit_navbar_management_name" required>
                                <div class="invalid-feedback" id="edit_navbar_management_name_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="edit_navbar_management_number">Page Number :</label>
                                <input type="number" min="1" class="form-control" name="edit_navbar_management_number" id="edit_navbar_management_number" required>
                                <div class="invalid-feedback" id="edit_navbar_management_number_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_to_page">To Page : </label>
                        <select name="edit_to_page" id="edit_to_page" class="form-control" required>
                            <option value="">-- Select Page --</option>
                            <option value="home">Home</option>
                            <option value="about">About</option>
                            <option value="hospitals">Hospital</option>
                            <option value="doctors">Doctor</option>
                            <option value="specialists">Specialist</option>
                            <option value="newsblog">News & Blog</option>
                            <option value="pharmacies">Pharmacies</option>
                            <option value="contact">Contact</option>
                            <option value="privacy-policy">Privacy Policy</option>
                            <option value="terms-condition">Terms Condition</option>
                        </select>
                        <div class="invalid-feedback" id="edit_to_page_validation"></div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-switch ps-4">
                            <label class="form-check-label" for="edit_is_main">Force page url to "/"</label>
                            <input class="form-check-input" type="checkbox" name="edit_is_main" id="edit_is_main" value="1">
                            <div class="invalid-feedback" id="edit_is_main_validation"></div>
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