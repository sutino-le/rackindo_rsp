<?php

// User
$user = mysql_query("SELECT * FROM user WHERE user_ktp='$user_ktp' ");
$v_user = mysql_fetch_array($user);
$user_npk = $v_user['user_npk'];
$user_hp = $v_user['user_hp'];
$user_email = $v_user['user_email'];
$user_foto = $v_user['user_foto'];

//biodata KTP
$biodata_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$user_ktp' ");
$v_biodata_ktp = mysql_fetch_array($biodata_ktp);

$ktp_nomor = $v_biodata_ktp['ktp_nomor'];
$ktp_nama = $v_biodata_ktp['ktp_nama'];
$ktp_tempat_lahir = $v_biodata_ktp['ktp_tempat_lahir'];
$ktp_tanggal_lahir = $v_biodata_ktp['ktp_tanggal_lahir'];
$ktp_kelamin = $v_biodata_ktp['ktp_kelamin'];
$ktp_gol_darah = $v_biodata_ktp['ktp_gol_darah'];
$ktp_alamat = $v_biodata_ktp['ktp_alamat'];
$ktp_rt = $v_biodata_ktp['ktp_rt'];
$ktp_rw = $v_biodata_ktp['ktp_rw'];
$ktp_kelurahan = $v_biodata_ktp['ktp_kelurahan'];
$ktp_kecamatan = $v_biodata_ktp['ktp_kecamatan'];
$ktp_kabupaten = $v_biodata_ktp['ktp_kabupaten'];
$ktp_propinsi = $v_biodata_ktp['ktp_propinsi'];
$ktp_kodepos = $v_biodata_ktp['ktp_kodepos'];
$ktp_agama = $v_biodata_ktp['ktp_agama'];
$ktp_status = $v_biodata_ktp['ktp_status'];
$ktp_kewarganegaraan = $v_biodata_ktp['ktp_kewarganegaraan'];

//biodata Domisili
$biodata_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$user_ktp' ");
$v_biodata_domisili = mysql_fetch_array($biodata_domisili);
$domisili_alamat = $v_biodata_domisili['domisili_alamat'];
$domisili_rt = $v_biodata_domisili['domisili_rt'];
$domisili_rw = $v_biodata_domisili['domisili_rw'];
$domisili_kelurahan = $v_biodata_domisili['domisili_kelurahan'];
$domisili_kecamatan = $v_biodata_domisili['domisili_kecamatan'];
$domisili_kabupaten = $v_biodata_domisili['domisili_kabupaten'];
$domisili_propinsi = $v_biodata_domisili['domisili_propinsi'];
$domisili_kodepos = $v_biodata_domisili['domisili_kodepos'];

//karyawan
$karyawan = mysql_query("SELECT * FROM karyawan JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan_ktp='$user_ktp' ");
$v_karyawan = mysql_fetch_array($karyawan);

if (empty($v_karyawan)) {
    $karyawan_status = "Belum Aktif";
    $karyawan_join = "";
    $karyawan_bagian = "";
    $karyawan_jabatan = "";
} else {
    $karyawan_npk = $v_karyawan['karyawan_npk'];
    $karyawan_status = $v_karyawan['karyawan_status'];
    $karyawan_join = $v_karyawan['karyawan_join'];
    $karyawan_bagian = $v_karyawan['bagian_nama'];
    $karyawan_jabatan = $v_karyawan['jabatan_nama'];
}



//Data Vaksin
$vaksin = mysql_query("SELECT * FROM vaksin WHERE vaksin_ktp='$user_ktp' ");

//pendidikan
$pendidikan = mysql_query("SELECT * FROM pendidikan JOIN biodata_ktp ON pendidikan.pendidikan_ktp=biodata_ktp.ktp_nomor WHERE pendidikan_ktp='$user_ktp' ORDER BY pendidikan.pendidikan_awal DESC ");

//keluarga
$keluarga = mysql_query("SELECT * FROM biodata_keluarga JOIN keluarga_silsilah ON biodata_keluarga.keluarga_jenis=keluarga_silsilah.silsilah_id JOIN biodata_ktp ON biodata_keluarga.keluarga_ktp=biodata_ktp.ktp_nomor WHERE biodata_keluarga.keluarga_ktp='$user_ktp' ORDER BY biodata_keluarga.keluarga_jenis, biodata_keluarga.keluarga_lahir ASC ");

//darurat
$darurat = mysql_query("SELECT * FROM biodata_darurat JOIN biodata_ktp ON biodata_darurat.darurat_ktp=biodata_ktp.ktp_nomor WHERE biodata_darurat.darurat_ktp='$user_ktp' ORDER BY biodata_darurat.darurat_id ASC ");

//pengalaman
$pengalaman = mysql_query("SELECT * FROM biodata_pengalaman JOIN biodata_ktp ON biodata_pengalaman.pengalaman_ktp=biodata_ktp.ktp_nomor WHERE biodata_pengalaman.pengalaman_ktp='$user_ktp' ORDER BY biodata_pengalaman.pengalaman_awal DESC ");

//npwp
$npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$user_ktp' ");
$v_npwp = mysql_fetch_array($npwp);
$npwp = $v_npwp['npwp_nomor'];

//bpjstk
$bpjstk = mysql_query("SELECT * FROM bpjs_tk WHERE bpjstk_ktp='$user_ktp' ");
$v_bpjstk = mysql_fetch_array($bpjstk);
$bpjstk = $v_bpjstk['bpjstk_nomor'];
$bpjstk_status = $v_bpjstk['bpjstk_status'];
$bpjstk_masuk = date("d F Y", strtotime($v_bpjstk['bpjstk_masuk']));
if (empty($v_bpjstk)) {
    $kepesertaan_tk = "Tidak Terdaftar";
} else {
    $kepesertaan_tk = $bpjstk_status . " - " . $bpjstk_masuk;
}

//bpjskes
$bpjskes = mysql_query("SELECT * FROM bpjs_kes WHERE bpjskes_ktp='$user_ktp' ");
$v_bpjskes = mysql_fetch_array($bpjskes);
$bpjskes = $v_bpjskes['bpjskes_nomor'];
$bpjskes_status = $v_bpjskes['bpjskes_status'];
$bpjskes_masuk = date("d F Y", strtotime($v_bpjskes['bpjskes_masuk']));
if (empty($v_bpjskes)) {
    $kepesertaan_kes = "Tidak Terdaftar";
} else {
    $kepesertaan_kes = $bpjskes_status . " - " . $bpjskes_masuk;
}

//user
$user_detail = mysql_query("SELECT * FROM user JOIN biodata_ktp ON user.user_ktp=biodata_ktp.ktp_nomor WHERE user_ktp='$user_ktp' ");
?>


<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-info card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="../admin/foto/<?php echo $user_foto; ?>"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $ktp_nama; ?></h3>

                <p class="text-muted text-center">
                    NIK : <?php echo $ktp_nomor; ?><br>
                    NPWP :
                    <?php echo substr($npwp, 0, 2) . "." . substr($npwp, 2, 3) . "." . substr($npwp, 5, 3) . "." . substr($npwp, 8, 1) . "-" . substr($npwp, 9, 3) . "." . substr($npwp, 12, 3); ?><br>
                    BPJS Kes : <?php echo $bpjskes; ?> <br>
                    BPJS TK : <?php echo $bpjstk; ?><br>
                    NPK : <?php echo $karyawan_npk; ?><br>
                    <?php echo $karyawan_jabatan; ?> - <?php echo $karyawan_bagian; ?><br>
                    Joint : <?php echo date("d-m-Y", strtotime($karyawan_join)); ?><br>
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $user_hp; ?>&text=Saya%20tertarik%20untuk%20berlangganan%20KIRIM.EMAIL"
                            target="_blank"><i class="fab fa-whatsapp"></i> Chat</a><a
                            class="float-right"><?php echo $user_hp; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?php echo $user_email; ?></a>
                    </li>
                </ul>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-syringe mr-1"></i>Vaccine</strong>

                <p class="text-muted">
                    <?php
                    while ($v_vaksin = mysql_fetch_array($vaksin)) {

                        echo $v_vaksin['vaksin_ke']; ?>.&nbsp;<?php echo $v_vaksin['vaksin_jenis']; ?>&nbsp;<?php echo date("d F Y", strtotime($v_vaksin['vaksin_tanggal'])) . "<br>"; ?>
                    <brs>
                        <?php
                    }
                    ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i>ID card Address</strong>

                <p class="text-muted">
                    <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . $ktp_kelurahan . ", Kec. " . $ktp_kecamatan . ", " . $ktp_kabupaten . "-" . $ktp_propinsi . "-" . $ktp_kodepos; ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i>Residence Address</strong>

                <p class="text-muted">
                    <?php echo $domisili_alamat . ", RT/RW " . $domisili_rt . "/" . $domisili_rw . ", Kel. " . $domisili_kelurahan . ", Kec. " . $domisili_kecamatan . ", " . $domisili_kabupaten . "-" . $domisili_propinsi . "-" . $domisili_kodepos; ?>
                </p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#cardID" data-toggle="tab">Card ID</a></li>
                    <li class="nav-item"><a class="nav-link" href="#education" data-toggle="tab">Education</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family Card</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#career" data-toggle="tab">Career History</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="home_admin.php?page=id_card_edit&ktp_nomor=<?php echo $user_ktp; ?>"><i
                                class="fas fa-edit"></i> Edit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="formulir_kerja_print.php?ktp_nomor=<?php echo $user_ktp; ?>"
                            target="_blank"><i class="fas fa-print"></i> Print</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content">

                    <div class="active tab-pane" id="cardID">
                        <!-- Post -->
                        <div class="post">

                            <center>
                                <table width="600" height="390" background="assets/img/ktps.png">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top" align="center">
                                        <td colspan="7">
                                            <b><?php echo strtoupper($ktp_propinsi); ?></b><br>
                                            <?php echo strtoupper($ktp_kabupaten); ?>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td><b>NIK</b></td>
                                        <td><b>:</b></td>
                                        <td><b><?php echo $ktp_nomor; ?></b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Nama</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_nama; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td rowspan="7">
                                            <img src="../admin/foto/<?php echo $user_foto; ?>" class="img-thumbnail"
                                                alt="profile-image" width="200" height="400">
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Tempat/Tgl Lahir</td>
                                        <td>:</td>
                                        <td colspan="4">
                                            <?php echo $ktp_tempat_lahir . " / " . date("d-m-Y", strtotime($ktp_tanggal_lahir)); ?>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Jenis Kelamin</td>
                                        <td>:</td>
                                        <td colspan="4"><?php echo $ktp_kelamin; ?>&nbsp;&nbsp; Gol.
                                            Darah : <?php echo $ktp_gol_darah; ?></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Alamat</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_alamat; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;RT/RW</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_rt . "/" . $ktp_rw; ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;Kel/Desa</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_kelurahan; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_kecamatan; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Agama</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_agama; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Status Perkawinan</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_status; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;Kewarganegaraan</td>
                                        <td>:</td>
                                        <td><?php echo $ktp_kewarganegaraan; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </center>

                        </div>
                        <!-- /.post -->
                    </div>

                    <div class="tab-pane" id="education">


                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-success">
                                    Education
                                </span>
                            </div>
                            <?php
                            while ($v_pendidikan = mysql_fetch_array($pendidikan)) {
                            ?>
                            <div>
                                <i class="fas fa-school"></i>

                                <div class="timeline-item">

                                    <h3 class="timeline-header">
                                        Graduate of <b><?php echo $v_pendidikan['pendidikan_tingkatan']; ?></b>
                                    </h3>

                                    <div class="timeline-body">
                                        from
                                        <b><?php echo $v_pendidikan['pendidikan_awal']; ?></b>
                                        to
                                        <b><?php echo $v_pendidikan['pendidikan_akhir']; ?></b>,
                                        school at
                                        <b><?php echo $v_pendidikan['pendidikan_nama']; ?></b>
                                        in the city
                                        <b><?php echo $v_pendidikan['pendidikan_kota']; ?></b>
                                    </div>
                                    <div class="timeline-footer">
                                        <b>
                                            <?php echo $v_pendidikan['pendidikan_jurusan'] . " - " . $v_pendidikan['pendidikan_nilai']; ?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <?php
                            }
                            ?>

                        </div>
                    </div>

                    <div class="tab-pane" id="family">

                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>Relationship</td>
                                <td>Full Name</td>
                                <td>Date of Birth</td>
                                <td>Assress</td>
                                <td>Phone Number</td>
                            </tr>
                            <?php
                            $nomor_keluarga = 1;
                            while ($v_keluarga = mysql_fetch_array($keluarga)) {
                                $keluarga_jenis = $v_keluarga['silsilah_nama'];
                                $keluarga_nama = $v_keluarga['keluarga_nama'];
                                $keluarga_kelamin = $v_keluarga['keluarga_kelamin'];
                                $keluarga_lahir = $v_keluarga['keluarga_lahir'];
                                $keluarga_alamat = $v_keluarga['keluarga_alamat'];
                                $keluarga_hp = $v_keluarga['keluarga_hp']; {
                            ?>
                            <tr>
                                <td><?php echo $nomor_keluarga; ?></td>
                                <td><?php echo $keluarga_jenis . "<br>" . $keluarga_kelamin; ?></td>
                                <td><?php echo $keluarga_nama; ?></td>
                                <td><?php echo $keluarga_lahir; ?></td>
                                <td><?php echo $keluarga_alamat; ?></td>
                                <td><?php echo $keluarga_hp; ?></td>
                            </tr>
                            <?php
                                    $nomor_keluarga++;
                                }
                            }
                            ?>
                        </table>

                    </div>

                    <div class="tab-pane" id="career">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-success">
                                    First Time Joint
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <?php
                            $pkwt = mysql_query("SELECT * FROM pkwt JOIN bagian ON pkwt.pkwt_bagian=bagian.bagian_id JOIN jabatan ON pkwt.pkwt_jabatan=jabatan.jabatan_id WHERE pkwt.pkwt_ktp='$user_ktp' ORDER BY pkwt.pkwt_awal ASC ");
                            while ($v_pkwt = mysql_fetch_array($pkwt)) {
                                $pkwt_npk = $v_pkwt['pkwt_npk'];
                                $pkwt_ktp = $v_pkwt['pkwt_ktp'];
                                $pkwt_jenis = $v_pkwt['pkwt_jenis'];
                                $pkwt_kategori = $v_pkwt['pkwt_kategori'];
                                $pkwt_awal = $v_pkwt['pkwt_awal'];
                                $pkwt_akhir = $v_pkwt['pkwt_akhir'];
                                $pkwt_bagian = $v_pkwt['bagian_nama'];
                                $pkwt_jabatan = $v_pkwt['jabatan_nama']; {
                                    if ($pkwt_kategori == "Terminate") {
                                        $color = "danger";
                                        $icon = "times-circle";
                                    } else if ($pkwt_kategori == "New Hire") {
                                        $color = "success";
                                        $icon = "file-signature";
                                    } else if ($pkwt_kategori == "Extended") {
                                        $color = "primary";
                                        $icon = "file-signature";
                                    }


                                    if ($pkwt_akhir == "0000-00-00") {
                                        $tampil_pkwt_akhir = " ";
                                        $tgl_pkwt_akhir = date("Y-m-d");
                                    } else {
                                        $tampil_pkwt_akhir = " to <b>" . date("d F Y", strtotime($pkwt_akhir));
                                        $tgl_pkwt_akhir = $pkwt_akhir;
                                    }
                            ?>
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-<?php echo $icon; ?> bg-<?php echo $color; ?>"></i>

                                <div class="timeline-item">

                                    <h3 class="timeline-header"><a href="#"><?php echo $pkwt_kategori; ?></a>
                                        <?php echo $pkwt_jenis; ?></h3>

                                    <div class="timeline-body">
                                        from
                                        <b><?php echo date("d F Y", strtotime($pkwt_awal)); ?></b><?php echo $tampil_pkwt_akhir; ?></b>,
                                        and acted
                                        as
                                        <b><?php echo $pkwt_jabatan; ?></b> in the
                                        <b><?php echo $pkwt_bagian; ?></b>
                                        section.
                                    </div>
                                    <div class="timeline-footer">
                                        <?php
                                                if ($pkwt_kategori == "Terminate") {
                                                    echo "";
                                                } else {
                                                    $warning_letter = mysql_query("SELECT * FROM warning_letter WHERE wl_ktp='$pkwt_ktp' AND wl_tanggal BETWEEN '$pkwt_awal' AND '$tgl_pkwt_akhir' ");
                                                    while ($v_warning_letter = mysql_fetch_array($warning_letter)) {
                                                        echo "<font color='red' ><b>* Have received a warning letter " . $v_warning_letter['wl_ke'] . " on " . date("d F Y", strtotime($v_warning_letter['wl_tanggal'])) . ".</b> </font><i class='fas fa-search bg-warning' title='" . $v_warning_letter['wl_keterangan'] . "'></i><br>";
                                                    }
                                                }
                                                ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <?php
                                }
                            }


                            if ($v_karyawan['karyawan_status'] == "Aktif") {
                                $color_status = "primary";
                            } else if ($v_karyawan['karyawan_status'] == "Keluar") {
                                $color_status = "danger";
                            }

                            ?>

                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-<?php echo $color_status; ?>">
                                    <?php echo $v_karyawan['karyawan_status'] . " "; ?>
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                        </div>
                    </div>

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience"
                                        placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and
                                                conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>