<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container ">
    <div class="row" style="margin-bottom: 200px;">
        <div class="col text-center">
            <h1 class="text-white" style="margin-bottom: 50px; margin-top: 50px;">Daftar Laporan NCR Product</h1>
            <div class="d-flex justify-content-between" style="margin-bottom: 50px;">
                <a href="<?= base_url('/home'); ?>" class="btn btn-secondary btn-lg">Home</a>
                <a href="<?= base_url('/detail_product/export'); ?>" class="btn btn-success btn-lg">Export All </a>
                <a href="<?= base_url('/detail_process'); ?>" class="btn btn-warning btn-lg">NCR Process</a>
            </div>
            <div class="table-responsive">
                <table class="table text-white align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Problem</th>
                            <th scope="col">Area</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Departemen</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($product as $d) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><img src="/img_uploaded/<?= $d['foto']; ?>" alt="" class="img-thumbnail fs-2" style="width: 200px;"></td>
                                <td><?= $d['problem']; ?></td>
                                <td><?= $d['area']; ?></td>
                                <td><?= $d['qty']; ?></td>
                                <td><?= $d['departemen']; ?></td>
                                <td>
                                    <a href="/detail_product/<?= $d['id']; ?>" class="btn btn-light">
                                        Export this
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>