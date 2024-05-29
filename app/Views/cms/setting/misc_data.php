<input type="hidden" id="misc_desc_id" name="misc_desc_id" value="<?= $data['misc_desc'] ? $data['misc_desc']['uuid'] : '' ?>">
<div class="card my-3">
    <h4 class="card-header">Meta Desc</h4>
    <div class="card-body">
        <?php if ($data['data_navbar']) : ?>
            <?php foreach ($data['data_navbar'] as $d) : ?>
                <div class="row my-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="misc_meta_desc_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>">Meta Desc <?= $d['navbar_management_name'] ?> : </label>
                            <input type="text" class="form-control <?= validation_show_error('misc_meta_desc_' . strtolower(url_title($d['navbar_management_name'], '_', true))) ? 'is-invalid' : '' ?>" name="misc_meta_desc_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>" id="misc_meta_desc_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>" value="<?= old('misc_meta_desc_' . strtolower(url_title($d['navbar_management_name'], '_', true)), $d['navbar_management_meta_desc']) ?>">
                            <!-- <div class="<?= validation_show_error('misc_meta_desc_' . strtolower(url_title($d['navbar_management_name'], '_', true))) ? 'invalid-feedback' : '' ?>">
                                                            <?= validation_show_error('misc_meta_desc_' . strtolower(url_title($d['navbar_management_name'], '_', true))); ?>
                                                        </div> -->
                            <div class="invalid-feedback" id="misc_meta_desc_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>_validation"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            Please create page first
        <?php endif; ?>
    </div>
</div>
<div class="row my-3">
    <div class="form-group">
        <label for="misc_footer_desc">Description : </label>
        <textarea class="form-control <?= validation_show_error('misc_footer_desc') ? 'is-invalid' : '' ?>" name="misc_footer_desc" id="misc_footer_desc" cols="10" rows="5"><?= $data['misc_desc'] ? $data['misc_desc']['footer_desc'] : "" ?></textarea>
        <!-- <div class="<?= validation_show_error('misc_footer_desc') ? 'invalid-feedback' : '' ?>">
                                        <?= validation_show_error('misc_footer_desc'); ?>
                                    </div> -->
        <div class="invalid-feedback" id="misc_footer_desc_validation"></div>
    </div>
</div>
<div class="form-group my-3">
    <label for="misc_work_days">Work Days : </label>
    <input type="text" class="form-control <?= validation_show_error('misc_work_days') ? 'is-invalid' : '' ?>" name="misc_work_days" id="misc_work_days" value="<?= old('misc_work_days', $data['misc_desc'] ? $data['misc_desc']['work_days'] : "") ?>">
    <!-- <div class="<?= validation_show_error('misc_work_days') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('misc_work_days'); ?>
                                        </div> -->
    <div class="invalid-feedback" id="misc_work_days_validation"></div>
</div>
<?php if ($data['data_navbar']) : ?>
    <div class="text-lg-end text-center mt-3">
        <button type="submit" class="btn btn-primary mt-2 mt-lg-0 w-auto">Save</button>
    </div>
<?php endif; ?>