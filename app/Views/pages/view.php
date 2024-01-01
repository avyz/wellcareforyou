<?= $this->extend($layout); ?>

<?= $this->section($section); ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-2"><?= $title; ?> Comics</h2>
            <form action="<?= $title == 'Add' ? '/comics/save' : '/comics/edit' ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <?php if ($title == 'Edit') : ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="coverLama" value="<?= $data['cover'] ?>">
                    <input type="hidden" name="slug" value="<?= $data['slug'] ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label for="comic_name" class="form-label">Comic Name</label>
                    <!-- 'comic_name' adalah data old nya, sedangkan $data['comic_name'] dari database -->
                    <!-- old('comic_name', $data['comic_name']) -->
                    <input type="text" class="form-control <?= validation_show_error('comic_name') ? 'is-invalid' : '' ?>" id="comic_name" name="comic_name" value="<?= ($title == 'Edit' ? old('comic_name', $data['comic_name']) : old('comic_name')) ?>" <?= $title == 'Edit' ? 'readonly' : 'autofocus' ?>>
                    <div class="<?= validation_show_error('comic_name') ? 'invalid-feedback' : '' ?>">
                        <?= validation_show_error('comic_name'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control <?= validation_show_error('author') ? 'is-invalid' : '' ?>" id="author" name="author" value="<?= ($title == 'Edit' ? old('author', $data['author']) : old('author')) ?>">
                    <div class="<?= validation_show_error('author') ? 'invalid-feedback' : '' ?>">
                        <?= validation_show_error('author'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control <?= validation_show_error('publisher') ? 'is-invalid' : '' ?>" id="publisher" name="publisher" value="<?= ($title == 'Edit' ? old('publisher', $data['publisher']) : old('publisher')) ?>">
                    <div class="<?= validation_show_error('publisher') ? 'invalid-feedback' : '' ?>">
                        <?= validation_show_error('publisher'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover</label>
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <?php $path = "" ?>
                            <?php if ($title == 'Add') : ?>
                                <?php $path = "/assets/img/default.png"; ?>
                            <?php else : ?>
                                <?php if ($data['cover'] == 'default.jpg') : ?>
                                    <?php $path = "/assets/img/default.png"; ?>
                                <?php else : ?>
                                    <?php $path = "/assets/img/{$data['cover']}"; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <img src="<?= $path; ?>" class="cover-img preview-img mb-2 mb-lg-0" alt="img">
                        </div>
                        <div class="col-lg-10">
                            <input onchange="previewImg()" class="form-control <?= validation_show_error('cover') ? 'is-invalid' : '' ?>" type="file" id="cover" name="cover">
                            <div class="<?= validation_show_error('cover') ? 'invalid-feedback' : '' ?>">
                                <?= validation_show_error('cover'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <?php $value = null ?>
                    <?php if ($title == 'Add') : ?>
                        <?php $value = old('status') ?>
                    <?php else : ?>
                        <?php $value = old('status', $data['status']) ?>
                    <?php endif; ?>
                    <input type="checkbox" class="form-check-input" id="status" name="status" value="1" <?= $value == 1 ? 'checked' : '' ?>>
                    <label class="form-check-label" for="status">Complete</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/comics" class="ms-2">Back To List</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>