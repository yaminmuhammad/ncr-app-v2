<?= $this->extend('layout/template') ?>
<!-- body {
background-image: url("assets/images/1.jpg");
background-size: cover;
background-position: center;
background-attachment: fixed;
background-repeat: no-repeat;
} -->
<?= $this->section('content') ?>
<div class="container-fluid" style="background-image: url('assets/images/1.jpg'); background-size: cover; background-position: center; background-attachment: fixed; background-repeat: no-repeat;">
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="<?= base_url() ?>assets/images/logo.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <!-- membuat flash data dari router setelah di save -->
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                        </div>
                    <?php endif; ?>
                    <!-- end flash data -->
                    <form action="<?= base_url() ?>login/auth" method="post">
                        <? csrf_field() ?>
                        <div class="input-field" style="padding-bottom: 30px;">
                            <i class='bx bx-user'></i>
                            <input type="text" id="nama" name="nama" oninput="this.value = this.value.toUpperCase()" class="input <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama') ?>" placeholder="Masukkan Nama Lengkap" />
                            <div class="invalid-feedback">
                                <?= validation_show_error('nama'); ?>
                            </div>
                        </div>

                        <div class="input-field" style="padding-bottom: 30px;">
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" id="npk" name="npk" class="input <?= (validation_show_error('npk')) ? 'is-invalid' : ''; ?>" value="<?= old('npk') ?>" placeholder="Masukkan NPK" />
                            <div class="invalid-feedback">
                                <?= validation_show_error('npk'); ?>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="input-field" style="margin-left: 30px;">
                            <button type="submit" class="submit">Login</button>
                        </div>

                        <!-- <div class="two-col">
                            <div class="one">
                                <input type="checkbox" name="" id="check">
                                <label for="check"> Remember Me</label>
                            </div>
                            <div class="two">
                                <label><a href="#">Forgot password?</a></label>
                            </div>
                        </div> -->

                    </form>
                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection() ?>