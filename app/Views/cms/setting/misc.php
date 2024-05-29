<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="row layout-top-spacing">
    <div class="main-content">
        <div class="container">
            <?php if (session()->getFlashdata('notif')) : ?>
                <?= session()->getFlashdata('notif') ?>
            <?php endif; ?>
            <?= $this->include('layout/admin/title'); ?>
            <form action="javascript:void(0)" id="save-misc" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white mb-0">General Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group my-3">
                            <label for="misc_logo">Logo : </label>
                            <input type="hidden" class="form-control" name="misc_logo_old" id="misc_logo_old" value="<?= $data['misc'][0] ? $data['misc'][0]['misc_logo'] : "" ?>">
                            <?php if (isset($data['misc'][0]['misc_logo'])) : ?>
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <img src="/assets/website/images/<?= $data['misc'][0]['misc_logo'] ?>" class="preview-img-misc mb-2 mb-lg-0" style="width:120px" alt="img">
                                    </div>
                                    <div class="col-lg-10">
                                        <input onchange="previewImg('misc_logo', 'preview-img-misc')" class="form-control <?= validation_show_error('misc_logo') ? 'is-invalid' : '' ?>" type="file" id="misc_logo" name="misc_logo">
                                        <!-- <div class="<?= validation_show_error('misc_logo') ? 'invalid-feedback' : '' ?>">
                                    <?= validation_show_error('misc_logo'); ?>
                                </div> -->
                                        <div class="invalid-feedback" id="misc_logo_validation"></div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type="file" class="form-control <?= validation_show_error('misc_logo') ? 'is-invalid' : '' ?>" name="misc_logo" id="misc_logo" value="<?= old('misc_logo', $data['misc'][0] ? $data['misc'][0]['misc_logo'] : "") ?>">
                                <!-- <div class="<?= validation_show_error('misc_logo') ? 'invalid-feedback' : '' ?>">
                            <?= validation_show_error('misc_logo'); ?>
                        </div> -->
                                <div class="invalid-feedback" id="misc_logo_validation"></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group my-3">
                            <label for="misc_logo_white">Logo White : </label>
                            <input type="hidden" class="form-control" name="misc_logo_white_old" id="misc_logo_white_old" value="<?= $data['misc'][0] ? $data['misc'][0]['misc_logo_white'] : "" ?>">

                            <?php if (isset($data['misc'][0]['misc_logo_white'])) : ?>
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <img src="/assets/website/images/<?= $data['misc'][0]['misc_logo_white'] ?>" class="preview-img-misc-logo-white mb-2 mb-lg-0" style="width:120px" alt="img">
                                    </div>
                                    <div class="col-lg-10">
                                        <input onchange="previewImg('misc_logo_white', 'preview-img-misc-logo-white')" class="form-control <?= validation_show_error('misc_logo_white') ? 'is-invalid' : '' ?>" type="file" id="misc_logo_white" name="misc_logo_white">
                                        <!-- <div class="<?= validation_show_error('misc_logo_white') ? 'invalid-feedback' : '' ?>">
                                    <?= validation_show_error('misc_logo_white'); ?>
                                </div> -->
                                        <div class="invalid-feedback" id="misc_logo_white_validation"></div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type="file" class="form-control <?= validation_show_error('misc_logo_white') ? 'is-invalid' : '' ?>" name="misc_logo_white" id="misc_logo_white" value="<?= old('misc_logo_white', $data['misc'][0] ? $data['misc'][0]['misc_logo_white'] : "") ?>">
                                <!-- <div class="<?= validation_show_error('misc_logo_white') ? 'invalid-feedback' : '' ?>">
                            <?= validation_show_error('misc_logo_white'); ?>
                        </div> -->
                                <div class="invalid-feedback" id="misc_logo_white_validation"></div>
                            <?php endif; ?>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-12">
                                <label for="misc_default_language">Default Language : </label>
                                <select name="misc_default_language" id="misc_default_language" class="form-control <?= validation_show_error('misc_default_language') ? 'is-invalid' : '' ?>">
                                    <option value="" disabled>-- Choose your default language --</option>
                                    <?php foreach ($dataMenu['language'] as $d) : ?>
                                        <?php if ($d['is_lang_default'] == 1) : ?>
                                            <option value="<?= $d['lang_code'] ?>" selected><?= $d['language'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $d['lang_code'] ?>"><?= $d['language'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <!-- <div class="<?= validation_show_error('misc_default_language') ? 'invalid-feedback' : '' ?>">
                            <?= validation_show_error('misc_default_language'); ?>
                        </div> -->
                                <div class="invalid-feedback" id="misc_default_language_validation"></div>
                            </div>
                        </div>
                        <div class="card">
                            <h4 class="card-header">Whatsapp</h4>
                            <div class="card-body">
                                <?php if ($data['data_navbar']) : ?>
                                    <?php foreach ($data['data_navbar'] as $d) : ?>
                                        <input type="hidden" class="form-control" name="misc_navbar_management_uuid[]" value="<?= $d['uuid'] ?>">
                                        <input type="hidden" class="form-control" name="misc_navbar_management_name[]" value="<?= url_title($d['navbar_management_name'], '_', true) ?>">
                                        <div class="row my-3">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="misc_whatsapp_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>">Whatsapp <?= $d['navbar_management_name'] ?> : </label>
                                                    <input type="text" class="form-control <?= validation_show_error('misc_whatsapp_' . strtolower(url_title($d['navbar_management_name'], '_', true))) ? 'is-invalid' : '' ?>" name="misc_whatsapp_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>" id="misc_whatsapp_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>" value="<?= old('misc_whatsapp_' . strtolower(url_title($d['navbar_management_name'], '_', true)), $d['navbar_management_whatsapp']) ?>">
                                                    <!-- <div class="<?= validation_show_error('misc_whatsapp_' . strtolower(url_title($d['navbar_management_name'], '_', true))) ? 'invalid-feedback' : '' ?>">
                                                <?= validation_show_error('misc_whatsapp_' . strtolower(url_title($d['navbar_management_name'], '_', true))); ?>
                                            </div> -->
                                                    <div class="invalid-feedback" id="misc_whatsapp_<?= strtolower(url_title($d['navbar_management_name'], '_', true)) ?>_validation"></div>
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
                            <div class="row pe-0">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6 pe-0">
                                            <label for="misc_emergency_number">Emergency Number : </label>
                                            <input type="text" class="form-control <?= validation_show_error('misc_emergency_number') ? 'is-invalid' : '' ?>" name="misc_emergency_number" id="misc_emergency_number" value="<?= old('misc_emergency_number', $data['misc'][0] ? $data['misc'][0]['misc_emergency_number'] : "") ?>">
                                            <!-- <div class="<?= validation_show_error('misc_emergency_number') ? 'invalid-feedback' : '' ?>">
                                        <?= validation_show_error('misc_emergency_number'); ?>
                                    </div> -->
                                            <div class="invalid-feedback" id="misc_emergency_number_validation"></div>
                                        </div>
                                        <div class="col-lg-6 pe-0">
                                            <label for="misc_fulltime_number">24 Hours Number : </label>
                                            <input type="text" class="form-control <?= validation_show_error('misc_fulltime_number') ? 'is-invalid' : '' ?>" name="misc_fulltime_number" id="misc_fulltime_number" value="<?= old('misc_fulltime_number', $data['misc'][0] ? $data['misc'][0]['misc_fulltime_number'] : "") ?>">
                                            <!-- <div class="<?= validation_show_error('misc_fulltime_number') ? 'invalid-feedback' : '' ?>">
                                        <?= validation_show_error('misc_fulltime_number'); ?>
                                    </div> -->
                                            <div class="invalid-feedback" id="misc_fulltime_number_validation"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ps-3 pe-0">
                                    <label for="misc_email">Email : </label>
                                    <input type="email" class="form-control <?= validation_show_error('misc_email') ? 'is-invalid' : '' ?>" name="misc_email" id="misc_email" value="<?= old('misc_email', $data['misc'][0] ? $data['misc'][0]['email'] : "") ?>">
                                    <!-- <div class="<?= validation_show_error('misc_email') ? 'invalid-feedback' : '' ?>">
                                <?= validation_show_error('misc_email'); ?>
                            </div> -->
                                    <div class="invalid-feedback" id="misc_email_validation"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="form-group">
                                <label for="misc_address">Address : </label>
                                <textarea class="form-control <?= validation_show_error('misc_address') ? 'is-invalid' : '' ?>" name="misc_address" id="misc_address" cols="10" rows="5"><?= $data['misc'] ? $data['misc'][0]['address'] : "" ?></textarea>
                                <!-- <div class="<?= validation_show_error('misc_address') ? 'invalid-feedback' : '' ?>">
                            <?= validation_show_error('misc_address'); ?>
                        </div> -->
                                <div class="invalid-feedback" id="misc_address_validation"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="misc_work_time">Work Time : </label>
                            <input type="text" class="form-control <?= validation_show_error('misc_work_time') ? 'is-invalid' : '' ?>" name="misc_work_time" id="misc_work_time" value="<?= old('misc_work_time', $data['misc'][0] ? $data['misc'][0]['work_time'] : "") ?>">
                            <!-- <div class="<?= validation_show_error('misc_work_time') ? 'invalid-feedback' : '' ?>">
                                            <?= validation_show_error('misc_work_time'); ?>
                                        </div> -->
                            <div class="invalid-feedback" id="misc_work_time_validation"></div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="misc_facebook">Facebook Link : </label>
                                    <input type="text" class="form-control" name="misc_facebook" id="misc_facebook" value="<?= old('misc_address', $data['misc'][0] ? $data['misc'][0]['facebook_link'] : "") ?>">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <label for="misc_twitter">Twitter Link : </label>
                                    <input type="text" class="form-control" name="misc_twitter" id="misc_twitter" value="<?= old('misc_address', $data['misc'][0] ? $data['misc'][0]['twitter_link'] : "") ?>">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <label for="misc_instagram">Instagram Link : </label>
                                    <input type="text" class="form-control" name="misc_instagram" id="misc_instagram" value="<?= old('misc_address', $data['misc'][0] ? $data['misc'][0]['instagram_link'] : "") ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-header bg-primary">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-6 col-md-6">
                                <h4 class="text-white mb-0">Misc Language Management</h4>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center">
                                    <label class="mb-0 me-2 d-none d-md-inline text-white">Language: </label>
                                    <select class="form-control" name="language_code" onchange="changeLang(this, url + '/setting/misc', 'misc-language-management', null, true)">
                                        <option value="" selected disabled>-- Choose your menu language --</option>
                                        <?php foreach ($language_list as $d) : ?>
                                            <option value="<?= $d['lang_code'] ?>" <?php if ($d['lang_code'] == $language_row['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="misc-language-management">
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>