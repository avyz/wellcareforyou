<?= $this->extend($layout); ?>
<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <h4>
        Submenu Role <?= ucwords($data['role']); ?>
    </h4>
    <b>
        <small>Submenu <?= $data['menu_name'] ?></small>
    </b>
    <form action="/user-management/create-menu-management-role-child" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <!-- <div class="row mt-3 justify-content-end">
            <div class="col-6 col-md-4">
                <div class="d-flex align-items-center">
                    <label class="mb-0 me-2 d-none d-md-inline">Language: </label>
                    <select class="form-control" name="menu_lang_code" onchange="changeLang(this, window.location.href, 'submenu-management-table', null, true)" required>
                        <option value="" selected disabled>-- Choose your menu language --</option>
                        <?php foreach ($language_list as $d) : ?>
                            <option value="<?= $d['lang_code'] ?>" <?php if ($d['lang_code'] == $language_row['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div> -->
        <div id="submenu-management-table">
            <div class="table-responsive">
                <table class="table dt-table-hover table-bordered my-3" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Submenu Name</th>
                            <th>View</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>CSV</th>
                            <th>Excel</th>
                            <th>Print</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data['menus'] as $menu) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $menu['menu_children_name']; ?></td>
                                <td>
                                    <?php if ($menu['view'] == 1) : ?>
                                        <input type="checkbox" name="view[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="view[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($menu['create'] == 1) : ?>
                                        <input type="checkbox" name="create[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="create[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($menu['edit'] == 1) : ?>
                                        <input type="checkbox" name="edit[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="edit[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($menu['delete'] == 1) : ?>
                                        <input type="checkbox" name="delete[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="delete[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($menu['buttons-csv'] == 1) : ?>
                                        <input type="checkbox" name="buttons_csv[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="buttons_csv[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($menu['buttons-excel'] == 1) : ?>
                                        <input type="checkbox" name="buttons_excel[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="buttons_excel[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($menu['buttons-print'] == 1) : ?>
                                        <input type="checkbox" name="buttons_print[]" value="<?= $menu['menu_children_uuid'] ?>" checked>
                                    <?php else : ?>
                                        <input type="checkbox" name="buttons_print[]" value="<?= $menu['menu_children_uuid'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (isset($menu['menu_management_children_uuid']) && $menu['view'] == 1 && $menu['have_children']) : ?>
                                        <a href="/user-management/management/roles/tabmenu?menu_children_uuid=<?= $menu['menu_children_uuid'] ?>&menu_management_uuid=<?= $menu['menu_management_uuid'] ?>&menu_management_children_uuid=<?= $menu['menu_management_children_uuid'] ?>&role=<?= $data['role'] ?>&submenu_name=<?= $menu['menu_children_name'] ?>" target="_blank"><button type="button" class="btn px-2 py-1 btn-info"><i class="ri-menu-add-fill"></i></button></a>
                                    <?php else : ?>
                                        <button class="btn px-2 py-1 btn-info" disabled><i class="ri-menu-add-fill"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-lg-end text-center mt-3">
                <input type="hidden" name="menu_uuid" value="<?= $data['menu_uuid'] ?>">
                <input type="hidden" name="role_uuid" value="<?= $data['role_uuid'] ?>">
                <input type="hidden" name="lang_code" value="<?= $data['lang_code'] ?>">
                <input type="hidden" name="menu_name" value="<?= $data['menu_name'] ?>">
                <input type="hidden" name="role" value="<?= $data['role'] ?>">
                <input type="hidden" name="type" value="<?= $data['type'] ?>">
                <input type="hidden" name="menu_management_uuid" value="<?= $data['menu_management_uuid'] ?>">
                <button type="button" class="btn btn-light-dark w-auto d-block d-lg-inline" onclick="window.close()">Cancel</button>
                <button type="submit" class="btn btn-primary mt-2 mt-lg-0 w-auto">Save</button>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>