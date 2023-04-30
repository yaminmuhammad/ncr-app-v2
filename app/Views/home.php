<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container" style="margin-top: 80px;">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
            </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card" style="width: 18rem; ">
                    <img src="<?= base_url() ?>assets/images/gambar1.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">NCR Form</h5>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="<?= base_url('/ncr_form') ?>" class="btn btn-primary">Pilih</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card" style="width: 18rem; ">
                    <img src="<?= base_url() ?>assets/images/Petroleum.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Detail Laporan</h5>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <a href="<?= base_url('/detail_ncr') ?>" class="btn btn-primary">Pilih</a>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card" style="width: 18rem;">
                <img src="<?= base_url() ?>assets/images/gambar2.jpeg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">NCR Products</h5>
                    <a href="<?= base_url('/form_product') ?>" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div> -->
        </div>
        <div class="d-flex justify-content-center w-100">
            <a href="<?= base_url('/logout') ?>" class="btn btn-lg btn-danger">Logout</a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>