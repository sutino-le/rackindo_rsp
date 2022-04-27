<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PT Rackindo Setara Perkasa</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body background="assets/img/1.jpg">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-light my-4">Buat Akun</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form-control" action="register_proses.php" method="POST">

                                        <div class=" row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="ktp_nomor" id="ktp_nomor"
                                                        type="text" placeholder="Masukan Nomor KTP" minlength="16"
                                                        maxlength="16" required />
                                                    <label for="ktp_nomor">Nomor KTP</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="ktp_nama" id="ktp_nama"
                                                        type="text" placeholder="Masukan Nama Lengkap" required />
                                                    <label for="ktp_nama">Nama Lengkap</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="nomor_hp" id="nomor_hp"
                                                        type="text" placeholder="Masukan Nomor HP +628xxxxx" required />
                                                    <label for="nomor_hp">Nomor HP</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" name="email" id="email" type="email"
                                                        placeholder="name@example.com" required />
                                                    <label for="email">Alamat Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" type="password" name="pwd" id="pwd"
                                                        placeholder="Create a password" required />
                                                    <label for="pwd">Kata Sandi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" type="password" name="pwd2" id="pwd2"
                                                        placeholder="Create a password" required />
                                                    <label for="pwd2">Konfirmasi Kata Sandi</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-block">Buat
                                                    Akun</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="index.php">Punya akun? Pergi untuk masuk</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; HRIS | PT Rackindo Setara Perkasa 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.ui.custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.uniform.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/maruti.js"></script>
    <script src="js/maruti.form_validation.js"></script>



</body>

</html>