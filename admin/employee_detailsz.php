<?php
$karyawan_npk = $_GET['id'];
$karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN user ON karyawan.karyawan_ktp=user.user_ktp JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_npk='$karyawan_npk' ");
$v_karyawan = mysql_fetch_array($karyawan);

$vaksin_ktp = $v_karyawan['ktp_nomor'];
//Data Vaksin
$vaksin = mysql_query("SELECT * FROM vaksin WHERE vaksin_ktp='$vaksin_ktp' ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>User profile porlet with tabs - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="portlet light profile-sidebar-portlet bordered">
                    <div class="profile-userpic">
                        <img src="foto/<?php echo $v_karyawan['user_foto']; ?>" class="img-responsive" alt="">
                    </div>
                    <div class="profile-usertitle">



                        <div class="profile-usertitle-name"> <?php echo $v_karyawan['ktp_nama']; ?> </div>
                        <div class="profile-usertitle-job"> <?php echo $v_karyawan['bagian_nama']; ?> </div>
                        <div class="profile-usertitle-email"> <?php echo $v_karyawan['user_email']; ?> </div>
                        <div class="profile-usertitle-email"> <?php echo $v_karyawan['user_hp']; ?> </div>
                        <button onclick="document.getElementById('id01').style.display='block'" type="button"
                            title="Edit Nomor & Email" class="btn btn-primary btn-sm"><i
                                class='fas fa-edit'></i></button>


                        <div id="id01" class="w3-modal small">
                            <div class="w3-modal-content w3-animate-top w3-card-4">
                                <header class="w3-container w3-teal">
                                    <span onclick="document.getElementById('id01').style.display='none'"
                                        class="w3-button w3-display-topright">&times;</span>
                                    <h2>Update Contact <?php echo $v_karyawan['ktp_nama']; ?></h2>
                                </header>
                                <form action="home_admin.php?page=user_edit_kontak" method="POST">
                                    <div class="w3-container">
                                        <br>
                                        <div class="form-group">
                                            <input type="hidden" name="user_npk" value="<?php echo $karyawan_npk; ?>">
                                            Email
                                            <input type="email" name="user_email"
                                                value="<?php echo $v_karyawan['user_email']; ?>" class="form-control"
                                                id="exampleInputEmail1" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            Nomor HP
                                            <input type="text" name="user_hp"
                                                value="<?php echo $v_karyawan['user_hp']; ?>" class="form-control"
                                                id="exampleInputEmail1" placeholder="Nomor HP">
                                        </div>
                                    </div>
                                    <footer class="w3-container w3-teal">
                                        <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                        <span onclick="document.getElementById('id01').style.display='none'"
                                            class="w3-button"><button type="button"
                                                class="btn btn-secondary btn-sm">Kembali</button></span>
                                    </footer>
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-info  btn-sm">Follow</button>
                        <button type="button" class="btn btn-info  btn-sm"><a
                                href="https://api.whatsapp.com/send?phone=<?php echo $v_karyawan['user_hp']; ?>&text=Saya%20tertarik%20untuk%20berlangganan%20KIRIM.EMAIL"
                                target="_blank"><i class="fab fa-whatsapp"></i> Chat</a></button>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#">
                                    <i class="icon-home"></i> Ticket List </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-settings"></i> Support Staff </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-info"></i> Configurations </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Employees info</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#profile" aria-controls="profile"
                                        role="tab" data-toggle="tab">Profile</a></li>
                                <li role="presentation"><a href="#vaksin" aria-controls="vaksin" role="tab"
                                        data-toggle="tab">Vaksin</a></li>
                                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
                                        data-toggle="tab">Settings</a></li>
                                <li role="presentation"><a href="#home" aria-controls="home" role="tab"
                                        data-toggle="tab">Update</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="profile">

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-info">Place and date of birth</label>
                                        <label
                                            class="col-sm-6 col-form-label"><?php echo $v_karyawan['ktp_tempat_lahir']; ?>/<?php echo date("d F Y", strtotime($v_karyawan['ktp_tanggal_lahir'])); ?></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-info">Gender</label>
                                        <label
                                            class="col-sm-3 col-form-label"><?php echo $v_karyawan['ktp_kelamin']; ?></label>
                                        <label class="col-sm-3 col-form-label text-info">Blood group</label>
                                        <label
                                            class="col-sm-2 col-form-label"><?php echo $v_karyawan['ktp_gol_darah']; ?>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-info">Address</label>
                                        <label
                                            class="col-sm-8 col-form-label"><?php echo $v_karyawan['ktp_alamat'] . ", RT/RW " . $v_karyawan['ktp_rt'] . "/" . $v_karyawan['ktp_rw'] . ", Kel. " . $v_karyawan['ktp_kelurahan'] . ", Kec. " . $v_karyawan['ktp_kecamatan'] . ", " . $v_karyawan['ktp_kabupaten'] . "-" . $v_karyawan['ktp_propinsi'] . "-" . $v_karyawan['ktp_kodepos']; ?></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-info">Religion</label>
                                        <label
                                            class="col-sm-3 col-form-label"><?php echo $v_karyawan['ktp_agama']; ?></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-info">Marital Status</label>
                                        <label
                                            class="col-sm-3 col-form-label"><?php echo $v_karyawan['ktp_status']; ?></label>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-info">Citizenship</label>
                                        <label
                                            class="col-sm-3 col-form-label"><?php echo $v_karyawan['ktp_kewarganegaraan']; ?></label>
                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="vaksin">


                                    <div class="form-group row">
                                        <?php
                                        while ($v_vaksin = mysql_fetch_array($vaksin)) {
                                        ?>
                                        <label class="col-sm-4 col-form-label text-info">Vaccine
                                            to-<?php echo $v_vaksin['vaksin_ke']; ?></label>
                                        <label
                                            class="col-sm-3 col-form-label"><?php echo $v_vaksin['vaksin_jenis']; ?></label>
                                        <label
                                            class="col-sm-3 col-form-label"><?php echo date("d F Y", strtotime($v_vaksin['vaksin_tanggal'])); ?></label>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                </div>

                                <div role="tabpanel" class="tab-pane" id="settings">Settings</div>


                                <div role="tabpanel" class="tab-pane" id="home">
                                    <form>
                                        <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputLastName">Last Name</label>
                                            <input type="text" class="form-control" id="inputLastName"
                                                placeholder="Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="exampleInputFile">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Check me out
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="employee_details.css">

    <script type="text/javascript">

    </script>
</body>

</html>