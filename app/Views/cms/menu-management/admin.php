<?= $this->extend($layout); ?>
<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <?= $this->include('layout/admin/tab_header'); ?>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="menu-tab-pane" role="tabpane0" aria-labelledby="menu-tab" tabindex="0">
            <div class="mt-3">
                <table id="menu-ui-table" class="table dt-table-hover" style="width:100%">
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
        <div class="tab-pane fade" id="submenu-tab-pane" role="tabpanel" aria-labelledby="submenu-tab" tabindex="1">
            <div class="mt-3">
                <table id="submenu-ui-table" class="table dt-table-hover" style="width:100%">
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
        <div class="tab-pane fade" id="tab-tab-pane" role="tabpane2" aria-labelledby="tab-tab" tabindex="2">
            <div class="mt-3">
                <table id="tab-ui-table" class="table dt-table-hover" style="width:100%">
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
<?= $this->endSection(); ?>


<!-- Modal -->
<div class="modal fade" id="menuCreateModal" tabindex="-1" role="dialog" aria-labelledby="menuCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="menuCreateModalLabel">Create Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="adminCreate">
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

<div class="modal fade" id="menuEditModal" tabindex="-1" role="dialog" aria-labelledby="menuEditModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="menuEditModalLabel">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="adminEdit">
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

<div class="modal fade" id="submenuCreateModal" tabindex="-1" role="dialog" aria-labelledby="submenuCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="submenuCreateModalLabel">Create Submenu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="adminSubmenuCreate">
                <div class="modal-body">
                    <?= $this->include('layout/admin/language_form'); ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="submenu_menu_id">Menu Name :</label>
                                <select class="form-control" name="menu_id" id="submenu_menu_id" required>
                                </select>
                                <div class="invalid-feedback" id="menu_id_validation"></div>
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
                    <button class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tabCreateModal" tabindex="-1" role="dialog" aria-labelledby="tabCreateModalLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="tabCreateModalLabel">Create Tab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros. Phasellus egestas sit amet velit sed luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit amet ullamcorper mi. </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>