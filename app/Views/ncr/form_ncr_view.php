<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<section>
    <div class="container-xl py-5 h-100">
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
                                <label for="nama" class="form-label fs-5">Name Part/Tipe</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="Masukkan Nama Part/Tipe" autofocus value="<?= old('nama') ?>" name="nama"></input>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="hal" class="form-label fs-5">Hal</label>
                                <select class="form-control select2  border p-2 mb-2 hal <?= (validation_show_error('hal')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Hal --" data-allow-clear="true" name="hal" id="hal">
                                    <option disabled selected>-- Pilih Hal --</option>
                                    <option value="MASALAH">MASALAH</option>
                                    <option value="POTENSI MASALAH">POTENSI MASALAH</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('hal'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="attn" class="form-label fs-5">Attn</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('attn')) ? 'is-invalid' : ''; ?>" id="attn" placeholder="Masukkan Attn" autofocus value="<?= old('attn') ?>" name="attn"></input>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('attn'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="frekuensi_masalah" class="form-label fs-5">Frekuensi Masalah</label>
                                <select class="form-control select2  border p-2 mb-2 frekuensi_masalah <?= (validation_show_error('frekuensi_masalah')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Frekuensi Masalah --" data-allow-clear="true" name="frekuensi_masalah" id="frekuensi_masalah">
                                    <option disabled selected>-- Pilih Frekuensi Masalah --</option>
                                    <option value="Pertama kali">Pertama kali</option>
                                    <option value="Berulang">Berulang</option>
                                    <option value="Sering">Sering</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('frekuensi_masalah'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="problem" class="form-label fs-5">Problem</label>
                                <textarea class="form-control border p-2 mb-2 <?= (validation_show_error('problem')) ? 'is-invalid' : ''; ?>" id="problem" placeholder="Masukkan Detail Problem" autofocus value="<?= old('problem') ?>" name="problem" style="height: 100px; resize: none;"></textarea>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('problem'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="area" class="form-label fs-5">Problem Terjadi</label>
                                <select class="form-control select2  border p-2 mb-2 area <?= (validation_show_error('area')) ? 'is-invalid' : ''; ?>" data-placeholder="-- Pilih Area --" data-allow-clear="true" name="area" id="area">
                                    <option disabled selected>-- Pilih Area --</option>
                                    <option value="Incoming">Incoming</option>
                                    <option value="Produksi 1">Produksi 1</option>
                                    <option value="Produksi 2">Produksi 2</option>
                                    <option value="WH-C/WH-FG">WH-C/WH-FG</option>
                                    <option value="Customer">Customer</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('area'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="temporary_action" class="form-label fs-5">Temporary Action</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('temporary_action')) ? 'is-invalid' : ''; ?>" id="temporary_action" placeholder="cth : Sortir" name="temporary_action" value="<?= old('temporary_action') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('temporary_action'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="area" class="form-label fs-5">OTY</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('oty')) ? 'is-invalid' : ''; ?>" id="oty" placeholder="cth : Reject 3" name="oty" value="<?= old('oty') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('oty'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="area" class="form-label fs-5">Aktual</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('aktual')) ? 'is-invalid' : ''; ?>" id="aktual" placeholder="cth : White mark pada bagian sisi pendek" name="aktual" value="<?= old('aktual') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('aktual'); ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="area" class="form-label fs-5">Standar</label>
                                <input type="text" class="form-control border p-2 mb-2 <?= (validation_show_error('standar')) ? 'is-invalid' : ''; ?>" id="standar" placeholder="cth : Tidak ada white mark" name="standar" value="<?= old('standar') ?>" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('standar'); ?>
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