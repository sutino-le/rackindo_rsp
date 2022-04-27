<?php
$karyawan_npk = $_GET['karyawan_npk'];
$tahun_sekarang = date("Y");

//Cek  data karyawan
$cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_npk='$karyawan_npk' ");
$v_cek_karyawan = mysql_fetch_array($cek_karyawan);


//cek nomor warning letter
$cek_skt = mysql_query("SELECT * FROM skt ORDER BY skt_id DESC ");
$v_cek_skt = mysql_fetch_array($cek_skt);

if ($tahun_sekarang != date("Y", strtotime($v_cek_skt['skt_tanggal']))) {
    $nomor_skt = 1;
} else if ($tahun_sekarang == date("Y", strtotime($v_cek_skt['skt_tanggal']))) {
    $nomor_skt = $v_cek_skt['skt_nomor'] + 1;
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
            <h3 class="card-title">Input Letter of Statement</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="home_admin.php?page=skt_input_prosess" method="post">

            <input type="hidden" class="form-control" value="<?php echo $v_cek_karyawan['karyawan_ktp']; ?>"
                name="skt_ktp">

            <div class="card-body">

                <div class="form-group row">
                    <label for="karyawan_npk" class="col-sm-2 col-form-label">NPK Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?php echo $v_cek_karyawan['karyawan_npk']; ?>"
                            name="skt_npk" id="skt_npk" placeholder="Enter NPK Number" disabled>
                    </div>
                    <label for="ktp_nama" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_nama"
                            value="<?php echo $v_cek_karyawan['ktp_nama']; ?>" id="ktp_nama" placeholder="Full name"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="skt_nomor" class="col-sm-2 col-form-label">Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="skt_nomor" value="<?php echo $nomor_skt; ?>"
                            id="skt_nomor" placeholder="Enter Number" required>
                    </div>
                    <label for="skt_tanggal" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="skt_tanggal" value="<?php echo date("Y-m-d"); ?>"
                            id="skt_tanggal" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="skt_aprove">Aprovel Name </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="skt_aprove" placeholder="Enter Name" value="Nasirin"
                            name="skt_aprove" required>
                    </div>
                    <label class="control-label col-sm-2" for="skt_aprove_jabatan">Position </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="skt_aprove_jabatan" placeholder="Enter Position"
                            value="Personalia" name="skt_aprove_jabatan" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="skt_status_karyawan">Employee Status </label>
                    <div class="col-sm-4">
                        <select class="form-control" name="skt_status_karyawan" id="skt_status_karyawan" required>
                            <option value="" selected>Select Employee Status</option>
                            <option></option>
                            <option value="dengan Perjanjian Kerja Waktu Tertentu">dengan Perjanjian Kerja Waktu
                                Tertentu</option>
                            <option value="Tetap">Tetap</option>
                        </select>
                    </div>
                    <label class="control-label col-sm-2" for="skt_jenis">Necessary </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="skt_jenis" placeholder="Enter Necessary"
                            name="skt_jenis" required>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=employee_information"><button type="button"
                        class="btn btn-secondary btn-sm">Back</button></a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->