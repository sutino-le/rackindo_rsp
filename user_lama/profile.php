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


<div class="x_panel">
    <div class="x_title">
        <h2>Detail Profil
            <a href="home_admin.php?page=id_card_edit&ktp_nomor=<?php echo $ktp_nomor; ?>" class="btn btn-success"><i
                    class="fa fa-edit m-right-xs"></i>
                Edit Profile</a>
        </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="col-md-3 col-sm-3  profile_left text-center">
            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive avatar-view rounded-circle" src="../admin/foto/<?php echo $user_foto; ?>"
                        alt="Avatar" title="Change the avatar" width="150px">
                </div>
            </div>
            <h5><?php echo $ktp_nama; ?></h5>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-id-card  user-profile-icon"></i>
                    <?php echo date("d F Y", strtotime($karyawan_join)); ?>
                </li>

                <li>
                    <i class="fa fa-briefcase user-profile-icon"></i>
                    <?php echo $karyawan_jabatan . " / " . $karyawan_bagian; ?>
                </li>

                <li class="m-top-xs">
                    <i class="fa fa-external-link user-profile-icon"></i>
                    <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                </li>

            </ul>

            <br />

            <!-- start skills -->
            <h4>Skills</h4>
            <ul class="list-unstyled user_data">
                <li>
                    <p>Web Applications</p>
                    <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                </li>
                <li>
                    <p>Website Design</p>
                    <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                    </div>
                </li>
                <li>
                    <p>Automation & Testing</p>
                    <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                    </div>
                </li>
                <li>
                    <p>UI / UX</p>
                    <div class="progress progress_sm">
                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                </li>
            </ul>
            <!-- end of skills -->

        </div>
        <div class="col-md-9 col-sm-9 ">

            <div class="profile_title">
                <div class="col-md-12">
                    <h2>Data Karyawan</h2>
                </div>
            </div>
            <!-- start of user-activity-graph -->
            <div id="graph_bar" style="width:100%; height:280px;" class=" m-2">

                <div class="row">
                    <label class="col-sm-3 col-form-label">Nomor NPK</label>
                    <label class="col-sm-9 col-form-label">: <?php echo $karyawan_npk; ?></label>
                </div>


                <div class="row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <label class="col-sm-9 col-form-label">: <?php echo $ktp_nama; ?></label>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Jabatan / Departemen</label>
                    <label class="col-sm-9 col-form-label">:
                        <?php echo $karyawan_jabatan . " / " . $karyawan_bagian; ?></label>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Tanggal Masuk</label>
                    <label class="col-sm-9 col-form-label">:
                        <?php echo date("d F Y", strtotime($karyawan_join)); ?></label>
                </div>

                <div class="row">
                    <label class="col-sm-3 col-form-label">Status Karyawan</label>
                    <label class="col-sm-9 col-form-label">: <?php echo $karyawan_status; ?></label>
                </div>

            </div>
            <!-- end of user-activity-graph -->

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                            data-toggle="tab" aria-expanded="true">Identitas KTP</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab"
                            data-toggle="tab" aria-expanded="false">Domisili</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2"
                            data-toggle="tab" aria-expanded="false">Pendidikan</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                        <!-- start recent activity -->
                        <ul class="messages">
                            <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">Raw denim you probably
                                        haven't heard of them jean shorts Austin. Nesciunt
                                        tofu stumptown aliqua butcher retro keffiyeh
                                        dreamcatcher synth.</blockquote>
                                    <br />
                                    <p class="url">
                                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                        <a href="#"><i class="fa fa-paperclip"></i> User
                                            Acceptance Test.doc </a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-error">21</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Brian Michaels</h4>
                                    <blockquote class="message">Raw denim you probably
                                        haven't heard of them jean shorts Austin. Nesciunt
                                        tofu stumptown aliqua butcher retro keffiyeh
                                        dreamcatcher synth.</blockquote>
                                    <br />
                                    <p class="url">
                                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                                        <a href="#" data-original-title="">Download</a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">Raw denim you probably
                                        haven't heard of them jean shorts Austin. Nesciunt
                                        tofu stumptown aliqua butcher retro keffiyeh
                                        dreamcatcher synth.</blockquote>
                                    <br />
                                    <p class="url">
                                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                        <a href="#"><i class="fa fa-paperclip"></i> User
                                            Acceptance Test.doc </a>
                                    </p>
                                </div>
                            </li>
                            <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-error">21</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Brian Michaels</h4>
                                    <blockquote class="message">Raw denim you probably
                                        haven't heard of them jean shorts Austin. Nesciunt
                                        tofu stumptown aliqua butcher retro keffiyeh
                                        dreamcatcher synth.</blockquote>
                                    <br />
                                    <p class="url">
                                        <span class="fs1" aria-hidden="true" data-icon=""></span>
                                        <a href="#" data-original-title="">Download</a>
                                    </p>
                                </div>
                            </li>

                        </ul>
                        <!-- end recent activity -->

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                        <!-- start user projects -->
                        <table class="data table table-striped no-margin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Client Company</th>
                                    <th class="hidden-phone">Hours Spent</th>
                                    <th>Contribution</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>New Company Takeover Review</td>
                                    <td>Deveint Inc</td>
                                    <td class="hidden-phone">18</td>
                                    <td class="vertical-align-mid">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" data-transitiongoal="35">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>New Partner Contracts Consultanci</td>
                                    <td>Deveint Inc</td>
                                    <td class="hidden-phone">13</td>
                                    <td class="vertical-align-mid">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger" data-transitiongoal="15">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Partners and Inverstors report</td>
                                    <td>Deveint Inc</td>
                                    <td class="hidden-phone">30</td>
                                    <td class="vertical-align-mid">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" data-transitiongoal="45">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>New Company Takeover Review</td>
                                    <td>Deveint Inc</td>
                                    <td class="hidden-phone">28</td>
                                    <td class="vertical-align-mid">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" data-transitiongoal="75">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- end user projects -->

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla
                            single-origin coffee squid. Exercitation +1 labore velit, blog
                            sartorial PBR leggings next level wes anderson artisan four loko
                            farm-to-table craft beer twee. Qui
                            photo booth letterpress, commodo enim craft beer mlkshk </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>