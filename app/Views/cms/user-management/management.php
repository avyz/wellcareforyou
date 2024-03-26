<?= $this->extend($layout); ?>
<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <?= $this->include('layout/admin/tab_header'); ?>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="users-tab-pane" role="tabpane0" aria-labelledby="users-tab" tabindex="0">
            <div class="mt-3">
                <table id="users-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="roles-tab-pane" role="tabpane0" aria-labelledby="roles-tab" tabindex="0">
            <div class="mt-3">
                <table id="roles-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="loguser-tab-pane" role="tabpane0" aria-labelledby="loguser-tab" tabindex="0">
            <div class="mt-3">
                <div class="row mb-2">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="date_start_log" class="col-form-label">Date Start</label>
                                    <input onchange="dateVal(this, 'date_end_log')" type="date" class="form-control" id="date_start_log" name="date_start">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="date_end_log" class="col-form-label">Date End</label>
                                    <input type="date" class="form-control" id="date_end_log" name="date_end" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 d-flex align-items-end mt-2 mt-lg-0">
                                <button type="button" class="btn btn-primary w-100" style="padding: 13px;" id="filter-log">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="loguser-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="logauth-tab-pane" role="tabpane0" aria-labelledby="logauth-tab" tabindex="0">
            <div class="mt-3">
                <div class="row mb-2">
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="date_start_auth" class="col-form-label">Date Start</label>
                                    <input onchange="dateVal(this, 'date_end_auth')" type="date" class="form-control" id="date_start_auth" name="date_start">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="date_end_auth" class="col-form-label">Date End</label>
                                    <input type="date" class="form-control" id="date_end_auth" name="date_end" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 d-flex align-items-end mt-2 mt-lg-0">
                                <button type="button" class="btn btn-primary w-100" style="padding: 13px;" id="filter-auth">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="logauth-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?= $this->include('layout/admin/tab_footer'); ?>
</div>

<!-- Users -->
<!-- Create -->
<div class="modal fade" id="usersCreateModal" tabindex="-1" role="dialog" aria-labelledby="usersCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="usersCreateModalLabel">Create User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="usersCreate">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_depan">First Name :</label>
                                <input type="text" class="form-control" name="nama_depan" id="nama_depan" required>
                                <div class="invalid-feedback" id="nama_depan_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="form-group">
                                <label for="nama_belakang">Last Name :</label>
                                <input type="text" class="form-control" name="nama_belakang" id="nama_belakang">
                                <div class="invalid-feedback" id="nama_belakang_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_user">Email :</label>
                                <input type="text" class="form-control" name="email" id="email_user" required>
                                <div class="invalid-feedback" id="email_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="form-group">
                                <label for="role_id_user">Role :</label>
                                <select class="form-control" name="role_id" id="role_id_user" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="role_id_validation"></div>
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
<div class="modal fade" id="usersEditModal" tabindex="-1" role="dialog" aria-labelledby="usersEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="usersEditModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="usersEdit">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama_depan">First Name :</label>
                                <input type="text" class="form-control" name="edit_nama_depan" id="edit_nama_depan" required>
                                <div class="invalid-feedback" id="edit_nama_depan_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="form-group">
                                <label for="edit_nama_belakang">Last Name :</label>
                                <input type="text" class="form-control" name="edit_nama_belakang" id="edit_nama_belakang">
                                <div class="invalid-feedback" id="edit_nama_belakang_validation"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_email_user">Email :</label>
                                <input type="text" class="form-control" name="edit_email_user" id="edit_email_user" readonly>
                                <div class="invalid-feedback" id="edit_email_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="form-group">
                                <label for="edit_role_id_user">Role :</label>
                                <select class="form-control" name="edit_role_id_user" id="edit_role_id_user" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="edit_role_id_user_validation"></div>
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

<!-- Roles -->
<!-- Create -->
<div class="modal fade" id="rolesCreateModal" tabindex="-1" role="dialog" aria-labelledby="rolesCreateModalLabel" aria-hidden="true">
    <div class="modal-sm modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesCreateModalLabel">Create Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="rolesCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role">Role :</label>
                        <input type="text" class="form-control" name="role" id="role" required>
                        <div class="invalid-feedback" id="role_validation"></div>
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
<div class="modal fade" id="rolesEditModal" tabindex="-1" role="dialog" aria-labelledby="rolesEditModalLabel" aria-hidden="true">
    <div class="modal-sm modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesEditModalLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="rolesEdit" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="role_id" id="edit_role_id">
                    <div class="form-group
                    ">
                        <label for="edit_role">Role :</label>
                        <input type="text" class="form-control" name="edit_role" id="edit_role" required>
                        <div class="invalid-feedback" id="edit_role_validation"></div>
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