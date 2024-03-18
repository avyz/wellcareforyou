<?= $this->extend($layout); ?>
<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <?= $this->include('layout/admin/tab_header'); ?>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="menuuser-tab-pane" role="tabpane0" aria-labelledby="menuuser-tab" tabindex="0">
            <div class="mt-3">
                <table id="menuuser-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Icon</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="submenuuser-tab-pane" role="tabpanel" aria-labelledby="submenuuser-tab" tabindex="1">
            <div class="mt-3">
                <table id="submenuuser-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Submenu</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="tabuser-tab-pane" role="tabpane2" aria-labelledby="tabuser-tab" tabindex="2">
            <div class="mt-3">
                <table id="tabuser-ui-table" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Submenu</th>
                            <th>Tab</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <?= $this->include('layout/admin/tab_footer'); ?>
</div>
<!-- Modal -->

<!-- Menu -->
<div class="modal fade" id="menuuserCreateModal" tabindex="-1" role="dialog" aria-labelledby="menuuserCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="menuuserCreateModalLabel">Create Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="userCreate">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_name">Menu Name :</label>
                                <input type="text" class="form-control" name="menu_name" id="menu_name" required>
                                <div class="invalid-feedback" id="menu_name_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_icon">Menu Icon :</label>
                                <input type="text" class="form-control" name="menu_icon" id="menu_icon" placeholder="Search icon: https://fontawesome.com/icons" required>
                                <div class="invalid-feedback" id="menu_icon_validation"></div>
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

<div class="modal fade" id="menuuserEditModal" tabindex="-1" role="dialog" aria-labelledby="menuuserEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="menuuserEditModalLabel">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="userEdit">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="menu_id" id="edit_menu_id">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_menu_name">Menu Name :</label>
                                <input type="text" class="form-control" name="edit_menu_name" id="edit_menu_name">
                                <div class="invalid-feedback" id="edit_menu_name_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_menu_icon">Menu Icon :</label>
                                <input type="text" class="form-control" name="edit_menu_icon" id="edit_menu_icon" placeholder="Search icon: https://fontawesome.com/icons" required>
                                <div class="invalid-feedback" id="edit_menu_icon_validation"></div>
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

<!-- Submenu -->
<div class="modal fade" id="submenuuserCreateModal" tabindex="-1" role="dialog" aria-labelledby="submenuuserCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="submenuuserCreateModalLabel">Create Submenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="userSubmenuCreate">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="submenu_menu_id">Menu Name :</label>
                                <select class="form-control" name="menu_id" id="submenu_menu_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="menu_id_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_children_name">Submenu Name :</label>
                                <input type="text" class="form-control" name="menu_children_name" id="menu_children_name" required>
                                <!-- <select class="form-control" name="menu_children_id" id="menu_children_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select> -->
                                <div class="invalid-feedback" id="menu_children_name_validation"></div>
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

<div class="modal fade" id="submenuuserEditModal" tabindex="-1" role="dialog" aria-labelledby="submenuuserEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="submenuuserEditModalLabel">Edit Submenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="userSubmenuEdit">
                <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="menu_children_id" id="edit_menu_children_id">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_submenu_menu_id">Menu Name :</label>
                                <select class="form-control" name="edit_submenu_menu_id" id="edit_submenu_menu_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="edit_submenu_menu_id_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_menu_children_name">Submenu Name :</label>
                                <input type="text" class="form-control" name="edit_menu_children_name" id="edit_menu_children_name" required>
                                <!-- <select class="form-control" name="menu_children_id" id="menu_children_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select> -->
                                <div class="invalid-feedback" id="edit_menu_children_name_validation"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tab Menu -->
<div class="modal fade" id="tabuserCreateModal" tabindex="-1" role="dialog" aria-labelledby="tabuserCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="tabuserCreateModalLabel">Create Tab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="userTabmenuCreate">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tabmenu_menu_id">Menu Name :</label>
                                <select class="form-control" name="tabmenu_menu_id" id="tabmenu_menu_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="tabmenu_menu_id_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tabmenu_children_id">Submenu Name :</label>
                                <select class="form-control" name="tabmenu_children_id" id="tabmenu_children_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="tabmenu_children_id_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="menu_tab_name">Tab Name :</label>
                                <input type="text" class="form-control" name="menu_tab_name" id="menu_tab_name" required>
                                <div class="invalid-feedback" id="menu_tab_name_validation"></div>
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

<div class="modal fade" id="tabuserEditModal" tabindex="-1" role="dialog" aria-labelledby="tabuserEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="tabuserEditModalLabel">Edit Tab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="userTabmenuEdit">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="tab_menu_id" id="edit_tab_menu_id">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_tabmenu_menu_id">Menu Name :</label>
                                <select class="form-control" name="edit_tabmenu_menu_id" id="edit_tabmenu_menu_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="edit_tabmenu_menu_id_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_tabmenu_children_id">Submenu Name :</label>
                                <select class="form-control" name="edit_tabmenu_children_id" id="edit_tabmenu_children_id" required>
                                    <option value="">-- Choose your selection --</option>
                                </select>
                                <div class="invalid-feedback" id="edit_tabmenu_children_id_validation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_menu_tab_name">Tab Name :</label>
                                <input type="text" class="form-control" name="edit_menu_tab_name" id="edit_menu_tab_name" required>
                                <div class="invalid-feedback" id="edit_menu_tab_name_validation"></div>
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
<?= $this->endSection(); ?>