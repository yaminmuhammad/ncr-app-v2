<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
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
                                <input type="password" id="npk" name="npk" class="input <?= (validation_show_error('npk')) ? 'is-invalid' : ''; ?>" value="<?= old('npk') ?>" placeholder="Masukkan Password (NPK)" />
                                <div class="invalid-feedback">
                                    <?= validation_show_error('npk'); ?>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="input-field" style="margin-left: 30px;">
                                <button type="submit" class="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>