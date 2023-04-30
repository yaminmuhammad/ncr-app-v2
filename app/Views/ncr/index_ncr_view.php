<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row" style="margin-bottom: 200px;">
        <div class="col text-center">
            <h1 class="" style="margin-bottom: 50px; margin-top: 50px;">Daftar Laporan NCR Process</h1>
            <div class="d-flex justify-content-between" style="margin-bottom: 50px;">
                <!-- <a href="<?= base_url('/home'); ?>" class="btn btn-secondary btn-lg">Home</a>
                <a href="<?= base_url(''); ?>" class="btn btn-success btn-lg">Export All </a>
                <a href="<?= base_url(''); ?>" class="btn btn-warning btn-lg">NCR Product</a> -->
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-striped cell-border" id="process-table"">
                    <thead>
                        <tr>
                            <th scope=" col">#</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">Problem</th>
                    <th scope="col">Area</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Departemen Tujuan</th>
                    <th scope="col">Jenis Laporan</th>
                    <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($ncr as $n) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <!-- <td><img src="/img_uploaded/<?= $n['foto']; ?>" alt="" class="img-thumbnail fs-2" style="width: 200px;"></td> -->
                                <td><?= $n['problem']; ?></td>
                                <td><?= $n['area']; ?></td>
                                <td><?= $n['qty']; ?></td>
                                <td><?= $n['satuan']; ?></td>
                                <td><?= $n['departemen_tujuan']; ?></td>
                                <td><?= $n['jenis']; ?></td>
                                <td>
                                    <a href="/detail_process/<?= $n['id']; ?>" class="btn btn-warning">
                                        Detail
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