<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="container">
    <?php if (session()->getFlashdata('notif')) : ?>
        <?= session()->getFlashdata('notif') ?>
    <?php endif; ?>
    <h1 class="my-2">People List</h1>
    <div class="row mt-4">
        <div class="col-lg-7">
            <a href="/people/view/add">
                <button type="button" class="btn btn-primary">
                    Add People
                </button>
            </a>
        </div>
        <div class="col-5">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="q" name="q" placeholder="Search..." aria-label="Search..." aria-describedby="search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0 + $offset; ?>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td scope="row"><?= ++$i ?></td>
                            <td>
                                <?= $d['nama']; ?>
                            </td>
                            <td>
                                <?= $d['alamat'] ?>
                            </td>
                            <td>
                                <a href="/people/<?= $d['id'] ?>">
                                    <div class="btn btn-success">Detail</div>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>