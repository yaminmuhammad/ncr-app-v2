<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<!-- ======================= Cards ================== -->
<?php if (session()->get('is_admin')) : ?>
    <div class="cardBox">
        <div class="mycard bg-primary">
            <div>
                <div class="numbers"> <?= $total_rows ?></div>
                <div class="cardName">Problems</div>
            </div>
            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>

        <div class="mycard bg-danger">
            <div>
                <div class="numbers">80</div>
                <div class="cardName">Status NG</div>
            </div>

            <div class="iconBx">
                <ion-icon name="alert-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="mycard bg-success">
            <div>
                <div class="numbers">284</div>
                <div class="cardName">Status OK</div>
            </div>

            <div class="iconBx">
                <ion-icon name="checkmark-circle-outline"></ion-icon>
            </div>
        </div>
    </div>

    <!-- ================ Order Details List ================= -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader" style="margin-bottom: 30px;">
                <h2>Recent Reports</h2>

                <!-- <a href="#" class="btn">View All</a> -->
            </div>
            <table id="process-table">
                <thead>
                    <tr>
                        <th scope=" col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Problem</th>
                        <th scope="col">Area</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Departemen Tujuan</th>
                        <th scope="col">Jenis Laporan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($ncr as $n) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img_uploaded/<?= $n['foto']; ?>" alt="" class="img-thumbnail fs-2" style="width: 200px;"></td>
                            <td><?= $n['problem']; ?></td>
                            <td><?= $n['area']; ?></td>
                            <td><?= $n['qty']; ?></td>
                            <td><?= $n['satuan']; ?></td>
                            <td><?= $n['departemen_tujuan']; ?></td>
                            <td><?= $n['jenis']; ?></td>
                            <td>

                            </td>
                            <td>
                                <!-- <a href="/detail_process/<?= $n['id']; ?>" class="btn btn-warning">
                                Detail
                            </a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>