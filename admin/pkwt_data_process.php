<?php
include "koneksi.php";
$id = $_GET['id'];


$query_pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_id='$id' ");
$hasil_pkwt = mysql_fetch_array($query_pkwt);

$pkwt_ktp = $hasil_pkwt['pkwt_ktp'];
$pkwt_nomor = $hasil_pkwt['pkwt_nomor'];
$pkwt_tanggal = $hasil_pkwt['pkwt_tanggal'];
$pkwt_jenis = $hasil_pkwt['pkwt_jenis'];
$pkwt_awal = $hasil_pkwt['pkwt_awal'];
$pkwt_akhir = $hasil_pkwt['pkwt_akhir'];
$pkwt_bagian = $hasil_pkwt['pkwt_bagian'];
$pkwt_jabatan = $hasil_pkwt['pkwt_jabatan'];

if ($pkwt_jenis == "Permanent") {
    $jenis_pk = "PKWTT";
} else if ($pkwt_jenis == "Contract") {
    $jenis_pk = "PKWT";
} else if ($pkwt_jenis == "Daily") {
    $jenis_pk = "HL";
}

$query_karyawan = mysql_query("SELECT * FROM karyawan WHERE karyawan_ktp='$pkwt_ktp' ");
$hasil_karyawan = mysql_fetch_array($query_karyawan);

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
$bln = $array_bln[date('n', strtotime($pkwt_tanggal))];


$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$pkwt_ktp' ");
$hasil_ktp = mysql_fetch_array($query_ktp);


$query_bagian = mysql_query("SELECT * FROM bagian WHERE bagian_id=$pkwt_bagian ");
$hasil_bagian = mysql_fetch_array($query_bagian);

$query_jabatan = mysql_query("SELECT * FROM jabatan WHERE jabatan_id=$pkwt_jabatan ");
$hasil_jabatan = mysql_fetch_array($query_jabatan);
?>



<html>

<head>
    <title>Combo Dinamis</title>
    <script language="javascript" src="jquery-1.3.2.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
</head>

<body>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Employment Agreement</h3>
        </div>
        <form class="form-horizontal" action="home_admin.php?page=pkwt_data_process_input" method="post">

            <input type="hidden" name="pkwt_id" id="pkwt_id" value="<?php echo $id; ?>">

            <div class=" card-body">

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp">Card ID :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp" placeholder="Enter KTP" name="ktp"
                            value="<?php echo $pkwt_ktp; ?>" disabled>
                    </div>
                    <label class="control-label col-sm-2" for="nama">Full Name :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama"
                            value="<?php echo $hasil_ktp['ktp_nama']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="karyawan_bagian">Job Title :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="karyawan_bagian" placeholder="Enter Job Title"
                            name="karyawan_bagian" value="<?php echo $hasil_bagian['bagian_nama']; ?>" disabled>
                    </div>
                    <label class="control-label col-sm-2" for="karyawan_jabatan">Position :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="karyawan_jabatan" placeholder="Enter Nama"
                            name="karyawan_jabatan" value="<?php echo $hasil_jabatan['jabatan_nama']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="karyawan_kategori" class="col-sm-2 col-form-label">Employee Type</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="karyawan_kategori" id="karyawan_kategori" required>
                            <option value="" selected>Selelct Employee Type</option>
                            <option></option>
                            <option value="Staff">Staff</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                    <label class="control-label col-sm-2" for="karyawan_finger">Finger ID :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="karyawan_finger" placeholder="Enter Finger ID"
                            name="karyawan_finger" required>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=pkwt_data"><button type="button"
                        class="btn btn-secondary btn-sm">Back</button></a>
            </div>

        </form>

    </div>

</body>

</html>