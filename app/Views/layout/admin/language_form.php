<div class="row">
    <div class="col-5 col-md-4">
        <div class="form-group pb-2">
            <label>Choose Language :</label>
            <select class="form-control" name="lang_code" required>
                <option value="" selected disabled>-- Choose your menu language --</option>
                <?php foreach ($language_list as $d) : ?>
                    <option value="<?= $d['lang_code'] ?>" <?php if ($d['lang_code'] == $language_row['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>