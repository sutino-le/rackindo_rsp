<?php
$birthdate = date("m-d");
$ultah = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$user_ktp' ");
$v_ultah = mysql_fetch_array($ultah);

if ($birthdate == date("m-d", strtotime($v_ultah['ktp_tanggal_lahir']))) {

?>
<div class="card mb-1">
    <div class="inner text-center">
        <img src="img/ultah3.gif" alt="Selamat Ulang Tahun" width="150" height="150">
        <h1 style="font-family:Brush Script MT;">Happy Birthday to You</h1>
    </div>
</div>

<?php
}
?>

<?php
// biodata_ktp
$field_biodata_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$user_ktp' ");
$jumlah_field_biodata_ktp = mysql_num_fields($field_biodata_ktp);

$biodata_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$user_ktp' ");
while (($row_biodata_ktp    = mysql_fetch_assoc($biodata_ktp)) != null) {
    $count_biodata_ktp = count($row_biodata_ktp);
}


// biodata_domisili
$field_biodata_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$user_ktp' ");
$jumlah_field_biodata_domisili = mysql_num_fields($field_biodata_domisili);

$biodata_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$user_ktp' ");
while (($row_biodata_domisili    = mysql_fetch_assoc($biodata_domisili)) != null) {
    $count_biodata_domisili = count($row_biodata_domisili);
}


// pendidikan
$field_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$user_ktp' ");
$jumlah_field_pendidikan = mysql_num_fields($field_pendidikan);

$pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$user_ktp' ");
while (($row_pendidikan    = mysql_fetch_assoc($pendidikan)) != null) {
    $count_pendidikan = count($row_pendidikan);
}


// biodata_keluarga
$field_biodata_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_ktp='$user_ktp' ");
$jumlah_field_biodata_keluarga = mysql_num_fields($field_biodata_keluarga);

$biodata_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_ktp='$user_ktp' ");
while (($row_biodata_keluarga    = mysql_fetch_assoc($biodata_keluarga)) != null) {
    $count_biodata_keluarga = count($row_biodata_keluarga);
}


// biodata_darurat
$field_biodata_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$user_ktp' ");
$jumlah_field_biodata_darurat = mysql_num_fields($field_biodata_darurat);

$biodata_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$user_ktp' ");
while (($row_biodata_darurat    = mysql_fetch_assoc($biodata_darurat)) != null) {
    $count_biodata_darurat = count($row_biodata_darurat);
}


// biodata_pengalaman
$field_biodata_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_ktp='$user_ktp' ");
$jumlah_field_biodata_pengalaman = mysql_num_fields($field_biodata_pengalaman);

$biodata_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_ktp='$user_ktp' ");
while (($row_biodata_pengalaman    = mysql_fetch_assoc($biodata_pengalaman)) != null) {
    $count_biodata_pengalaman = count($row_biodata_pengalaman);
}


// biodata_npwp
$field_biodata_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$user_ktp' ");
$jumlah_field_biodata_npwp = mysql_num_fields($field_biodata_npwp);

$biodata_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$user_ktp' ");
while (($row_biodata_npwp    = mysql_fetch_assoc($biodata_npwp)) != null) {
    $count_biodata_npwp = count($row_biodata_npwp);
}


// user
$field_user = mysql_query("SELECT * FROM user WHERE user_ktp='$user_ktp' ");
$jumlah_field_user = mysql_num_fields($field_user);

$user = mysql_query("SELECT * FROM user WHERE user_ktp='$user_ktp' ");
while (($row_user    = mysql_fetch_assoc($user)) != null) {
    $count_user = count($row_user);
}


?>
<div class="row">

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-address-card"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data KTP</span>
                <span class="info-box-number">
                    <?php echo (($count_biodata_ktp / $jumlah_field_biodata_ktp) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marked-alt"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Domisili</span>
                <span class="info-box-number">
                    <?php echo (($count_biodata_domisili / $jumlah_field_biodata_domisili) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-graduate"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Pendidikan</span>
                <span class="info-box-number">
                    <?php echo (($count_pendidikan / $jumlah_field_pendidikan) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Keluarga</span>
                <span class="info-box-number">
                    <?php echo (($count_biodata_keluarga / $jumlah_field_biodata_keluarga) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-phone"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Darurat</span>
                <span class="info-box-number">
                    <?php echo (($count_biodata_darurat / $jumlah_field_biodata_darurat) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Pengalaman</span>
                <span class="info-box-number">
                    <?php echo (($count_biodata_pengalaman / $jumlah_field_biodata_pengalaman) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="far fa-credit-card"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data NPWP</span>
                <span class="info-box-number">
                    <?php echo (($count_biodata_npwp / $jumlah_field_biodata_npwp) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-cog"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data User</span>
                <span class="info-box-number">
                    <?php echo (($count_user / $jumlah_field_user) * 100); ?>
                    <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

</div>