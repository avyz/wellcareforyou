<div class="p-3 bg-color-main">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';color:white">
            <ol class="breadcrumb mb-0">
                <?php if ($data) : ?>
                    <?php if ($data['type'] != 'edit') : ?>
                        <?php foreach ($breadcrumbs as $d) : ?>
                            <?php if ($d['is_active'] != 1) : ?>
                                <li class="breadcrumb-item">
                                    <a href="<?= $d['url'] ?>" class="text-white"><?= $d['segment'] ?></a>
                                </li>
                            <?php else : ?>
                                <li class="breadcrumb-item active">
                                    <?= $d['segment'] ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php foreach ($breadcrumbs as $d) : ?>
                            <?php if ($d['is_active'] != 1) : ?>
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)" class="text-white"><?= $d['segment'] ?></a>
                                </li>
                            <?php else : ?>
                                <li class="breadcrumb-item active">
                                    <?= $d['segment'] ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else : ?>
                    <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active">Item</li>
                <?php endif; ?>
            </ol>
        </nav>
        <h3 class="text-white"><?= $title ?></h3>
    </div>
</div>