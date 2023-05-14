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
<?php if (session()->getFlashdata('pesan-error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto" role="alert">
        <?= session()->getFlashdata('pesan-error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<!-- ======================= Cards ================== -->
<?php if (session()->get('is_admin')) : ?>
    <div class="cardBox">
        <div class="mycard shadow-lg bg-warning">
            <div>
                <div class="numbers"> <?= $total_rows ?></div>
                <div class="cardName">Problems</div>
            </div>
            <div class="iconBx">
                <ion-icon name="warning"></ion-icon>
            </div>
        </div>

        <div class="mycard shadow-lg bg-danger">
            <div>
                <div class="numbers"> <?php echo $status_count['ng_count']; ?></div>
                <div class="cardName">Status NG</div>
            </div>

            <div class="iconBx">
                <ion-icon name="alert-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="mycard shadow-lg bg-success">
            <div>
                <div class="numbers"><?php echo $status_count['ok_count']; ?></div>
                <div class="cardName">Status OK</div>
            </div>

            <div class="iconBx">
                <ion-icon name="checkmark-circle-outline"></ion-icon>
            </div>
        </div>

        <div class="mycard shadow-lg bg-primary">
            <div>
                <div class="numbers"><?php echo $status_count['pending_count']; ?></div>
                <div class="cardName">Status Pending</div>
            </div>

            <div class="iconBx">
                <ion-icon name="eye-outline"></ion-icon>
            </div>
        </div>
    </div>

    <!-- ================ Order Details List ================= -->
    <div class="details">
        <div class="recentOrders shadow">
            <div class="cardHeader" style="margin-bottom: 30px;">
                <h2>Recent Reports</h2>

                <!-- <a href="#" class="btn">View All</a> -->
            </div>
            <table id="process-table" class="table table-striped table-responsive-xl">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="col-4 text-center" scope="col">Problem</th>
                        <th class="text-center" scope="col">Area</th>
                        <th class="text-center" scope="col">Quantity</th>
                        <th class="text-center" scope="col">Satuan</th>
                        <th class="text-center" scope="col">Departemen Tujuan</th>
                        <th class="text-center" scope="col">Jenis Laporan</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($ncr as $n) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <!-- <td class="text-center"><img src="/img_uploaded/<?= $n['foto']; ?>" alt="" class="img-thumbnail fs-2" style="width: 200px;"></td> -->
                            <td class="text-justify"><?= $n['problem']; ?></td>
                            <td class="text-center"><?= $n['area']; ?></td>
                            <td class="text-center"><?= $n['qty']; ?></td>
                            <td class="text-center"><?= $n['satuan']; ?></td>
                            <td class="text-center"><?= $n['departemen_tujuan']; ?></td>
                            <td class="text-center"><?= $n['jenis']; ?></td>
                            <td class="text-center">
                                <?php if ($n['status'] == 'PENDING') { ?>
                                    <span class="badge bg-primary" style="color: white;">PENDING</span>
                                <?php } else if ($n['status'] == "OK") { ?>
                                    <span class="badge bg-success" style="color: white;">OK</span>
                                <?php } else if ($n['status'] == "NG") { ?>
                                    <span class="badge bg-danger" style="color: white;">NG</span>
                                <?php }
                                ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="/home/<?= $n['id']; ?>" class="btn btn-warning" style="color: white;">
                                        <ion-icon name="eye"></ion-icon>
                                    </a>
                                    <a href="/print/<?= $n['id']; ?>" class="btn btn-primary" style="color: white;">
                                        <ion-icon name="print"></ion-icon>
                                    </a>
                                    <a href="/send/<?= $n['id']; ?>" class="btn btn-danger" style="color: white;">
                                        <ion-icon name="mail"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>