<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container-sm h-100" style="width: 100vw;">
        <div class="card rounded-3 border shadow">
            <div class="card-body p-4 p-md-5">
                <div class="mb-3 ">
                    <img src="/img_uploaded/<?= $id_ncr['foto']; ?>" class="card-img-top w-50 rounded mx-auto d-block" style="max-width: 100vw;" alt="...">
                    <div class="card-body">
                        <form method="POST" action="/home/update/<?= $id_ncr['id']; ?>" enctype="multipart/form-data">
                            <? csrf_field() ?>
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
                                    <td scope="row" class="card-title font-weight-bold">TEMPORARY ACTION</td>
                                    <td class="card-text text-justify"><?= $id_ncr['temporary_action'] ?></td>
                                </tr>
                                <tr>
                                    <td scope="row" class="card-title font-weight-bold">OTY</td>
                                    <td class="card-text text-justify"><?= $id_ncr['oty'] ?></td>
                                </tr>
                                <tr>
                                    <td scope="row" class="card-title font-weight-bold">AKTUAL</td>
                                    <td class="card-text text-justify"><?= $id_ncr['aktual'] ?></td>
                                </tr>
                                <tr>
                                    <td scope="row" class="card-title font-weight-bold">STANDAR</td>
                                    <td class="card-text text-justify"><?= $id_ncr['standar'] ?></td>
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
                                    <td class="card-text text-justify">
                                        <select name="status" class="form-select">
                                            <option value="PENDING" <?php if ($id_ncr['status'] == 'PENDING') echo 'selected'; ?>>PENDING</option>
                                            <option value="OK" <?php if ($id_ncr['status'] == 'OK') echo 'selected'; ?>>OK</option>
                                            <option value="NG" <?php if ($id_ncr['status'] == 'NG') echo 'selected'; ?>>NG</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-info">Save</button>
                            <a href="/printX/<?= $id_ncr['id']; ?>" class="btn btn-success" style="color: white; float: right; margin-left: 10px;">
                                <ion-icon name="print"></ion-icon> Excel
                            </a>
                            <a href="/printW/<?= $id_ncr['id']; ?>" class="btn btn-primary" style="color: white; float: right; margin-left: 10px;">
                                <ion-icon name="print"></ion-icon> Word
                            </a>
                            <a href="" class="btn btn-danger" style="color: white; float: right; margin-left: 10px;">
                                <ion-icon name="print"></ion-icon> PDF
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>