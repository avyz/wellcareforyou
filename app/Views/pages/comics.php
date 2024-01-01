<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Comic List</h1>
            <?php if (session()->getFlashdata('notif')) : ?>
                <?= session()->getFlashdata('notif') ?>
            <?php endif; ?>
            <a href="/comics/view/add">
                <button type="button" class="btn btn-primary">
                    Add Comic
                </button>
            </a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Comic Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td scope="row"><?= ++$i ?></td>
                            <td>
                                <img class="cover-img" src="/assets/img/<?= $d['cover'] ?>" alt="<?= $d['comic_name'] ?>">
                            </td>
                            <td>
                                <?= $d['comic_name'] ?>
                            </td>
                            <td><?= $d['author']; ?></td>
                            <td>
                                <a href="/comics/<?= $d['slug'] ?>">
                                    <div class="btn btn-success">Detail</div>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>