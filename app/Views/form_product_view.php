<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">
                    <!-- <img src="assets/images/gambar2.jpeg" class="w-90" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo"> -->
                    <div class="card-body p-4 p-md-5">
                        <h2 class="text-center mb-4">Form Report NCR Product</h2>
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                        <?php endif; ?>
                        <form action="/product/save" method="post" enctype="multipart/form-data" class="px-md-2">
                            <?= csrf_field() ?>
                            <div class="form-outline mb-4">
                                <label for="problem" class="form-label fs-5">Problem</label>
                                <textarea class="form-control border border-2 p-2 mb-2 <?= (validation_show_error('problem')) ? 'is-invalid' : ''; ?>" id="problem" autofocus value="<?= old('problem') ?>" name="problem" style="height: 100px; resize: none;"></textarea>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('problem'); ?>
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="area" class="form-label fs-5">Area</label>
                                <input type="text" class="form-control border border-2 p-2 mb-2 <?= (validation_show_error('area')) ? 'is-invalid' : ''; ?>" id="area" value="<?= old('area') ?>" name="area" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('area'); ?>
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="qty" class="form-label fs-5">Quantity</label>
                                <input type="number" class="form-control border border-2 p-2 mb-2 <?= (validation_show_error('qty')) ? 'is-invalid' : ''; ?>" id="qty" name="qty" value="<?= old('qty') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('qty'); ?>
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="departemen" class="form-label fs-5">Departemen</label>
                                <!-- <input type="text" class="form-control border border-2 p-2 mb-2 <?= (validation_show_error('departemen')) ? 'is-invalid' : ''; ?>" id="departemen" name="departemen" value="<?= old('departemen') ?>" /> -->
                                <select class="form-control select2 departemen <?= (validation_show_error('departemen')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Departemen --" data-allow-clear="true" name="departemen" id="departemen">
                                    <option disabled selected>-- Pilih Departemen --</option>
                                    <option value="GA, IR & CSR">GA, IR & CSR</option>
                                    <option value="PRODUCTION 1">PRODUCTION 1</option>
                                    <option value="PRODUCTION 2">PRODUCTION 2</option>
                                    <option value="PPIC">PPIC</option>
                                    <option value="PROCUREMENT">PROCUREMENT</option>
                                    <option value="MAINTENANCE">MAINTENANCE</option>
                                    <option value="QUALITY ASSURANCE">QUALITY ASSURANCE</option>
                                    <option value="PPIC">PPIC</option>
                                    <option value="MARKETING">MARKETING</option>
                                    <option value="EHS">EHS</option>
                                    <option value="SUPERVISOR SHIFT 2 & SHIFT 3">SUPERVISOR SHIFT 2 & SHIFT 3</option>
                                    <option value="FIN, ACC  & RISK MGT CONT">FIN, ACC & RISK MGT CONT</option>
                                    <option value="HRD">HRD</option>
                                    <option value="PRODUCT ENGINEERING">PRODUCT ENGINEERING</option>
                                    <option value="INDUSTRIAL SYSTEM DEVELOPMENT">INDUSTRIAL SYSTEM DEVELOPMENT</option>
                                    <option value="PROCESS ENGINEERING">PROCESS ENGINEERING</option>
                                    <option value="MIS">MIS</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('departemen'); ?>
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label for="foto" class="form-label fs-5 custom-file-label">Upload Foto</label>
                                <div class="col-sm-8 w-200 h-150">
                                    <img src="/assets/images/default.jpg" class="img-thumbnail img-preview">
                                </div>
                                <input type="file" class="form-control border border-2 p-2 mb-2 <?= (validation_show_error('foto')) ? 'is-invalid' : ''; ?> foto" id="foto" name="foto" onchange="previewImg()" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('foto'); ?>
                                </div>
                                <!-- <div class="invalid-feedback">
                                </div> -->
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('/home'); ?>" class="btn btn-secondary btn-lg">Back</a>
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>