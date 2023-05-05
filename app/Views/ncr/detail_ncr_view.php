<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container-sm h-100" style="width: 100vw;">
        <!-- <div class=" h-100"> -->
        <div class="card rounded-3 border shadow">
            <!-- <img src="assets/images/gambar1.jpeg" class="w-90" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo"> -->
            <div class="card-body p-4 p-md-5">
                <div class="mb-3">
                    <img src="/img_uploaded/<?= $id_ncr['foto']; ?>" class="card-img-top w-50 " style="max-width: 100vw;" alt="...">
                    <div class="card-body">
                        <!-- <h5 class="card-title font-weight-bold">Problem : </h5>
                            <p class="card-text text-justify"><?= $id_ncr['problem'] ?></p>
                            <h5 class="card-title font-weight-bold">Area : </h5>
                            <p class="card-text text-justify"><?= $id_ncr['area'] ?></p>
                            <h5 class="card-title font-weight-bold">Quantity : </h5>
                            <p class="card-text text-justify"><?= $id_ncr['qty'] ?><?= $id_ncr['satuan'] ?></p>
                            <h5 class="card-title font-weight-bold">Departemen Tujuan : </h5>
                            <p class="card-text text-justify"><?= $id_ncr['departemen_tujuan'] ?></p>
                            <h5 class="card-title font-weight-bold">Jenis NCR : </h5>
                            <p class="card-text text-justify"><?= $id_ncr['jenis'] ?></p> -->
                        <table class="table">
                            <tr>
                                <td scope="row" class="card-title font-weight-bold">PROBLEM</td>
                                <td class="card-text text-justify"><?= $id_ncr['problem'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row" class="card-title font-weight-bold">AREA</td>
                                <td class="card-text text-justify"><?= $id_ncr['area'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row" class="card-title font-weight-bold">QUANTITY</td>
                                <td class="card-text text-justify"><?= $id_ncr['qty'] ?> <?= $id_ncr['satuan'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row" class="card-title font-weight-bold">DEPARTEMEN TUJUAN</td>
                                <td class="card-text text-justify"><?= $id_ncr['departemen_tujuan'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row" class="card-title font-weight-bold">JENIS NCR</td>
                                <td class="card-text text-justify"><?= $id_ncr['jenis'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row" class="card-title font-weight-bold">STATUS</td>
                                <td class="card-text text-justify"><?= $id_ncr['status'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</section>
<?= $this->endSection() ?>