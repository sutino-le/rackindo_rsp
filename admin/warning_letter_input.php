<?php
$karyawan_ktp = $_GET['karyawan_ktp'];
$tahun_sekarang = date("Y");

//Cek  data karyawan
$cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_ktp='$karyawan_ktp' ");
$v_cek_karyawan = mysql_fetch_array($cek_karyawan);


//cek nomor warning letter
$cek_wl = mysql_query("SELECT * FROM warning_letter ORDER BY wl_id DESC ");
$v_cek_wl = mysql_fetch_array($cek_wl);
if ($tahun_sekarang != date("Y", strtotime($v_cek_wl['wl_tanggal']))) {
    $nomor_wl = 1;
} else if ($tahun_sekarang == date("Y", strtotime($v_cek_wl['wl_tanggal']))) {
    $nomor_wl = $v_cek_wl['wl_nomor'] + 1;
}
?>
<html>

<head>
    <title>Combo Dinamis</title>
    <script language="javascript" src="jquery-1.3.2.js"></script>
</head>

<body>

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Input Warning Letter</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="home_admin.php?page=warning_letter_input_prosess" method="post">

            <input type="hidden" class="form-control" value="<?php echo $v_cek_karyawan['karyawan_ktp']; ?>"
                name="wl_ktp">

            <div class="card-body">

                <div class="form-group row">
                    <label for="karyawan_ktp" class="col-sm-2 col-form-label">ID Card Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?php echo $v_cek_karyawan['karyawan_ktp']; ?>"
                            name="wl_ktp" id="wl_ktp" placeholder="Enter NPK Number" disabled>
                    </div>
                    <label for="ktp_nama" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_nama"
                            value="<?php echo $v_cek_karyawan['ktp_nama']; ?>" id="ktp_nama" placeholder="Full name"
                            disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="wl_nomor" class="col-sm-2 col-form-label">Letter Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="wl_nomor" value="<?php echo $nomor_wl; ?>"
                            id="wl_nomor" placeholder="Enter Letter Number" required>
                    </div>
                    <label for="wl_tanggal" class="col-sm-2 col-form-label">Letter Date</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="wl_tanggal" value="<?php echo date("Y-m-d"); ?>"
                            id="wl_tanggal" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="wl_ke">Warning Letter To</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="wl_ke" id="wl_ke" required>
                            <option value="" selected>Select Letter</option>
                            <option></option>
                            <option value="Lisan">Lisan</option>
                            <option value="ke-1">ke-1</option>
                            <option value="ke-2">ke-2</option>
                            <option value="ke-3">ke-3</option>
                        </select>
                    </div>
                    <label class="control-label col-sm-2" for="wl_durasi">Duration </label>
                    <div class="col-sm-4">
                        <select class="form-control" name="wl_durasi" id="wl_durasi" required>
                            <option value="" selected>Select Duration</option>
                            <option></option>
                            <option value="21 (dua puluh satu) hari">21 (dua puluh satu) hari</option>
                            <option value="01 (satu) bulan">1 (satu) bulan</option>
                            <option value="02 (dua) bulan">2 (dua) bulan</option>
                            <option value="03 (tiga) bulan">3 (tiga) bulan</option>
                            <option value="04 (empat) bulan">4 (empat) bulan</option>
                            <option value="05 (lima) bulan">5 (lima) bulan</option>
                            <option value="06 (enam) bulan">6 (enam) bulan</option>
                            <option value="07 (tujuh) bulan">7 (tujuh) bulan</option>
                            <option value="08 (delapan) bulan">8 (delapan) bulan</option>
                            <option value="09 (sembilan) bulan">9 (sembilan) bulan</option>
                            <option value="10 (sepuluh) bulan">10 (sepuluh) bulan</option>
                            <option value="11 (sebelas) bulan">11 (sebelas) bulan</option>
                            <option value="12 (dua belas) bulan">12 (dua belas) bulan</option>
                            <option value="18 (delapan belas) bulan">18 (delapan belas) bulan</option>
                            <option value="24 (dua puluh empat) bulan">24 (dua puluh empat) bulan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="wl_awal" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="wl_awal" id="wl_awal" required>
                    </div>
                    <label for="wl_akhir" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="wl_akhir" id="wl_akhir" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="wl_keterangan" class="col-sm-2 col-form-label">Letter Information</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="wl_keterangan" id="wl_keterangan" cols="130"
                            rows="5"><?php echo $v_cek_wl['wl_keterangan']; ?></textarea>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=warning_letter_view"><button type="button"
                        class="btn btn-secondary btn-sm">Back</button></a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->