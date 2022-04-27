<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$karyawan_kategori = addslashes($_POST['karyawan_kategori']);
$karyawan_jenis = addslashes($_POST['karyawan_jenis']);
$karyawan_jabatan = addslashes($_POST['karyawan_jabatan']);
$periode_awal = addslashes($_POST['periode_awal']);
$periode_akhir = addslashes($_POST['periode_akhir']);

if ($karyawan_jenis == "Permanent") {
    $jabatan_kategori = $karyawan_kategori . " - " . $karyawan_jenis;
} else if ($karyawan_jabatan == "3") {
    $jabatan_satu = "3";
    $jabatan_dua = "4";
    $jabatan_kategori = $karyawan_kategori . " - Koordinator - " . $karyawan_jenis;
} else if ($karyawan_jabatan == "4") {
    $jabatan_satu = "3";
    $jabatan_dua = "4";
    $jabatan_kategori = $karyawan_kategori . " - Koordinator - " . $karyawan_jenis;
} else if ($karyawan_jabatan == "5") {
    $jabatan_satu = "5";
    $jabatan_dua = "6";
    $jabatan_kategori = $karyawan_kategori . " - Operator - " . $karyawan_jenis;
} else if ($karyawan_jabatan == "6") {
    $jabatan_satu = "5";
    $jabatan_dua = "6";
    $jabatan_kategori = $karyawan_kategori . " - Operator - " . $karyawan_jenis;
}

$cek_upah_kalkulasi = mysql_query("SELECT * FROM upah_kalkulasi WHERE upah_kal_kategori='$jabatan_kategori' AND upah_kal_awal='$periode_awal' AND upah_kal_akhir='$periode_akhir' ");
$v_upah_kalkulasi = mysql_fetch_array($cek_upah_kalkulasi);
$upah_kal_id = $v_upah_kalkulasi['upah_kal_id'];

if (empty($upah_kal_id)) {
    // jika kosong
    if ($karyawan_jenis == "Permanent") {

        $cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN upah_karyawan ON karyawan.karyawan_ktp=upah_karyawan.upah_kar_ktp JOIN upah ON upah_karyawan.upah_kar_upah=upah.upah_tahun WHERE 
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_status='Aktif'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'
     ");
    } else {

        $cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN upah_karyawan ON karyawan.karyawan_ktp=upah_karyawan.upah_kar_ktp JOIN upah ON upah_karyawan.upah_kar_upah=upah.upah_tahun WHERE 
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_satu' AND karyawan.karyawan_status='Aktif'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_dua' AND karyawan.karyawan_status='Aktif'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_satu' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_dua' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'
     ");
    }
    while ($v_karyawan = mysql_fetch_array($cek_karyawan)) {
        $karyawan_ktp = $v_karyawan['karyawan_ktp'];
        $upah_jumlah = $v_karyawan['upah_jumlah'];
        $upah_kar_kompensasi = $v_karyawan['upah_kar_kompensasi'];
        $upah_kar_insentif = $v_karyawan['upah_kar_insentif'];

        $kompensasi = $upah_jumlah * ($upah_kar_kompensasi / 100);

        // input kalkulasi
        $input_upah_kalkulasi = mysql_query("INSERT INTO upah_kalkulasi VALUES (
            '',
            '$karyawan_ktp',
            '$jabatan_kategori',
            '$periode_awal',
            '$periode_akhir',
            '$upah_jumlah',
            '$kompensasi',
            '$upah_kar_insentif'
        )");
    }
} else {
    // jika ada
    if ($karyawan_jenis == "Permanent") {

        $cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN upah_karyawan ON karyawan.karyawan_ktp=upah_karyawan.upah_kar_ktp JOIN upah ON upah_karyawan.upah_kar_upah=upah.upah_tahun WHERE 
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_status='Aktif'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'
     ");
    } else {

        $cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN upah_karyawan ON karyawan.karyawan_ktp=upah_karyawan.upah_kar_ktp JOIN upah ON upah_karyawan.upah_kar_upah=upah.upah_tahun WHERE 
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_satu' AND karyawan.karyawan_status='Aktif'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_dua' AND karyawan.karyawan_status='Aktif'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_satu' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'
    OR
    karyawan.karyawan_jenis='$karyawan_jenis' AND karyawan.karyawan_kategori='$karyawan_kategori' AND karyawan.karyawan_jabatan='$jabatan_dua' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'
     ");
    }
    while ($v_karyawan = mysql_fetch_array($cek_karyawan)) {
        $upah_kal_id = $v_karyawan['upah_kal_id'];
        $karyawan_ktp = $v_karyawan['karyawan_ktp'];
        $upah_jumlah = $v_karyawan['upah_jumlah'];
        $upah_kar_kompensasi = $v_karyawan['upah_kar_kompensasi'];
        $upah_kar_insentif = $v_karyawan['upah_kar_insentif'];

        $kompensasi = $upah_jumlah * ($upah_kar_kompensasi / 100);

        // input kalkulasi
        $input_upah_kalkulasi = mysql_query("UPDATE upah_kalkulasi SET
            upah_kal_ktp='$karyawan_ktp',
            upah_kal_kategori='$jabatan_kategori',
            upah_kal_awal='$periode_awal',
            upah_kal_akhir='$periode_akhir',
            upah_kal_upah='$upah_jumlah',
            upah_kal_kompensasi='$kompensasi',
            upah_kal_insentif='$upah_kar_insentif'
            WHERE upah_kal_id='$upah_kal_id'
        ");
    }
}

if ($input_upah_kalkulasi) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Salary Calculation Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=salary_report';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Salary Calculation Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=salary_report';
}, 1000);
</script>
<?php
}

?>