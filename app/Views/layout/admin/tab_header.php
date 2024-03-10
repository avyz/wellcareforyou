<div id="tabsSimple" class="col-xl-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <div class="d-md-flex justify-content-between">
                    <h4><?= $dataMenu['menu']['menu_name']; ?></h4>
                    <button class="btn btn-primary mb-3 mb-md-0" id="create-btn" data-bs-toggle="modal">Create</button>
                </div>
            </div>
        </div>

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