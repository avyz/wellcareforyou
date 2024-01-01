<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Detail Comics</h1>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/assets/img/<?= $data['cover'] ?>" class="img-fluid rounded-start" alt="<?= $data['cover'] ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="me-auto">
                                    <?= $data['comic_name'] ?>
                                </span>
                                <small class="ms-auto">
                                    <?php if ($data['status'] == 1) : ?>
                                        <small class="badge text-bg-success">
                                            Completed
                                        </small>
                                    <?php else : ?>
                                        <small class="badge text-bg-warning">
                                            Ongoing
                                        </small>
                                    <?php endif; ?>
                                </small>
                            </h5>
                            <p class="card-text">
                                <b>Sinopsis:</b><br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, praesentium?
                            </p>
                            <p class="card-text">
                                <b>
                                    Author:
                                </b>
                                <?= $data['author']; ?>
                            </p>
                            <p class="card-text"><small class="text-body-secondary"><b>Publisher:</b> <?= $data['publisher'] ?></small></p>

                            <a href="/comics/view/edit/<?= $data['slug'] ?>" class="btn btn-primary">Edit</a>

                            <!-- DELETE -->
                            <form action="/comics/<?= $data['id'] ?>/<?= $data['comic_name'] ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <br>
                            <a href="/comics" class="mt-2">Back To List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>