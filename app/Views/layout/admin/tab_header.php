<div id="tabsSimple" class="col-xl-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <?= $this->include('layout/admin/buttons'); ?>

        <div class="simple-tab">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php foreach ($dataMenu['sidebar'] as $d) : ?>
                    <?php foreach ($d['tab'] as $t => $key) : ?>
                        <li class="nav-item menutab" role="presentation">
                            <button onclick="handleTabClick('<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>')" class="nav-link <?php if ($t == 0) : ?>active<?php endif; ?>" id="<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>-tab-pane" type="button" role="tab" aria-controls="<?= strtolower(str_replace(' ', '', $key['menu_tab_name'])) ?>-tab-pane" aria-selected="true"><?= $key['menu_tab_name'] ?></button>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>