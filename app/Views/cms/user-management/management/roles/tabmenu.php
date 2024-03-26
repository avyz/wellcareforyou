<?= $this->extend($layout); ?>
<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <h4>
        Tabmenu Role <?= ucwords($data['role']); ?>
    </h4>
    <b>
        <small>Tabmenu <?= $data['submenu_name'] ?></small>
    </b>
    <form action="/user-management/create-menu-management-role-child-tab" method="POST" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="table-responsive">
            <table class="table dt-table-hover my-3" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tab Name</th>
                        <th>View</th>
                        <th>Create</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>CSV</th>
                        <th>Excel</th>
                        <th>Print</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data['menus'] as $menu) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $menu['menu_tab_name']; ?></td>
                            <td>
                                <?php if ($menu['view'] == 1) : ?>
                                    <input type="checkbox" name="view[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="view[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($menu['create'] == 1) : ?>
                                    <input type="checkbox" name="create[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="create[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($menu['edit'] == 1) : ?>
                                    <input type="checkbox" name="edit[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="edit[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($menu['delete'] == 1) : ?>
                                    <input type="checkbox" name="delete[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="delete[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($menu['buttons-csv'] == 1) : ?>
                                    <input type="checkbox" name="buttons_csv[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="buttons_csv[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($menu['buttons-excel'] == 1) : ?>
                                    <input type="checkbox" name="buttons_excel[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="buttons_excel[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($menu['buttons-print'] == 1) : ?>
                                    <input type="checkbox" name="buttons_print[]" value="<?= $menu['menu_tab_uuid'] ?>" checked>
                                <?php else : ?>
                                    <input type="checkbox" name="buttons_print[]" value="<?= $menu['menu_tab_uuid'] ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="text-lg-end text-center mt-3">
            <input type="hidden" name="role" value="<?= $data['role'] ?>">
            <input type="hidden" name="menu_management_children_uuid" value="<?= $data['menu_management_children_uuid'] ?>">
            <input type="hidden" name="menu_children_uuid" value="<?= $data['menu_children_uuid'] ?>">
            <input type="hidden" name="menu_management_uuid" value="<?= $data['menu_management_uuid'] ?>">
            <input type="hidden" name="submenu_name" value="<?= $data['submenu_name'] ?>">
            <button type="button" class="btn btn-light-dark w-auto d-block d-lg-inline" onclick="window.close()">Cancel</button>
            <button type="submit" class="btn btn-primary mt-2 mt-lg-0 w-auto">Save</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>