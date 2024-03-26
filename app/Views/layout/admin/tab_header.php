<div id="tabsSimple" class="col-xl-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <?= $this->include('layout/admin/buttons'); ?>
        <div class="simple-tab">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php foreach ($dataMenu['sidebar'] as $d) : ?>
                    <?php foreach ($d['tab'] as $t => $key) : ?>
                        <li class="nav-item menutab" role="presentation">
                            <button data-view="<?= $key['view'] ?>" data-create="<?= $key['create'] ?>" data-edit="<?= $key['edit'] ?>" data-delete="<?= $key['delete'] ?>" data-buttons_csv="<?= $key['buttons_csv'] ?>" data-buttons_excel="<?= $key['buttons_excel'] ?>" data-buttons_print="<?= $key['buttons_print'] ?>" onclick="validationButtons(this);handleTabClick('<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>')" class="selector-tab nav-link <?php if ($t == 0) : ?>active<?php endif; ?>" id="<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>-tab-pane" type="button" role="tab" aria-controls="<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>-tab-pane" aria-selected="true"><?= $key['menu_tab_name'] ?></button>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>