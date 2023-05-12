<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="">
                <div class="card rounded-3 border shadow">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="text-center mb-4">Form Report NCR </h2>
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <!-- end flash data -->
                        <form action="/ncr/save" method="post" enctype="multipart/form-data" class="px-md-2">
                            <?= csrf_field() ?>
                            <div class="form-group mb-4">
                                <label for="problem" class="form-label fs-5">Problem</label>
                                <textarea class="form-control border p-2 mb-2 <?= (validation_show_error('problem')) ? 'is-invalid' : ''; ?>" id="problem" placeholder="Masukkan Detail Problem" autofocus value="<?= old('problem') ?>" name="problem" style="height: 100px; resize: none;"></textarea>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('problem'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="area" class="form-label fs-5">Area</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('area')) ? 'is-invalid' : ''; ?>" id="area" placeholder="cth : GEDUNG A" name="area" value="<?= old('area') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('area'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4 row justify-content-center">
                                <div class="col-5">
                                    <label for="qty" class="form-label fs-5">Quantity</label>
                                    <input type="number" class="form-control border p-2 mb-2 <?= (validation_show_error('qty')) ? 'is-invalid' : ''; ?>" id="qty" placeholder="cth : 10" name="qty" value="<?= old('qty') ?>" />
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('qty'); ?>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <label for="satuan" class="form-label fs-5">Satuan</label>
                                    <select class="form-control  border p-2 mb-2 select2 satuan <?= (validation_show_error('satuan')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Satuan --" data-allow-clear="true" name="satuan" id="satuan">
                                        <option disabled selected>-- Pilih Satuan --</option>
                                        <option value="Pallet">Pallet</option>
                                        <option value="Rak">Rak</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Unit">Unit</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('satuan'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group mb-4">

                            </div> -->
                            <div class="form-group mb-4">
                                <label for="departemen_tujuan" class="form-label fs-5">Departemen Tujuan</label>
                                <select class="form-control select2  border p-2 mb-2 departemen_tujuan <?= (validation_show_error('departemen_tujuan')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Departemen Tujuan --" data-allow-clear="true" name="departemen_tujuan" id="departemen_tujuan">
                                    <option disabled selected>-- Pilih Departemen Tujuan --</option>
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
                                    <?= validation_show_error('departemen_tujuan'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="jenis" class="form-label fs-5">Jenis Laporan NCR</label>
                                <select class="form-control select2  border p-2 mb-2 jenis <?= (validation_show_error('jenis')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Jenis --" data-allow-clear="true" name="jenis" id="jenis">
                                    <option disabled selected>-- Pilih Jenis --</option>
                                    <option value="NCR PROCESS">NCR PROCESS</option>
                                    <option value="NCR PRODUCT">NCR PRODUCT</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('jenis'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="foto" class="form-label fs-5 custom-file-label-poto <?= (validation_show_error('foto')) ? 'is-invalid' : ''; ?>">Upload Foto</label>
                                <div class="col-sm-3 mb-4">
                                    <img src="/assets/images/default.jpg" class="img-thumbnail img-preview">
                                </div>
                                <input type="file" class="form-control border mb-5 " id="foto" onchange="previewImg()" name="foto" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('foto'); ?>
                                </div>
                            </div>
                            <!-- <div class="d-flex justify-content-between"> -->
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            <!-- </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>