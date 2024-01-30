<?= $this->extend($layout); ?>

<?= $this->section($section); ?>

<?php if (session()->getFlashdata('notif')) : ?>
    <?= session()->getFlashdata('notif') ?>
<?php endif; ?>

Masuk

<?= $this->endSection(); ?>