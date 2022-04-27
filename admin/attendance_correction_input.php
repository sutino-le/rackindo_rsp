<?php
include "koneksi.php";


$tahun_sekarang = date("Y");

$absen_koreksi_pin = addslashes($_POST['absen_koreksi_pin']);
$absen_koreksi_tanggal = addslashes($_POST['absen_koreksi_tanggal']);
$absen_koreksi_jenis = addslashes($_POST['absen_koreksi_jenis']);
$absen_koreksi_waktu = addslashes($_POST['absen_koreksi_waktu']);
$absen_koreksi_keterangan = addslashes($_POST['absen_koreksi_keterangan']);
$waktu = date("Y-m-d", strtotime($absen_koreksi_tanggal)) . " " . date("H:i:s", strtotime($absen_koreksi_waktu));



$input_absen_koreksi = mysql_query("INSERT INTO absen_koreksi VALUES('', '$absen_koreksi_pin', '$absen_koreksi_tanggal',  '$absen_koreksi_jenis',  '$waktu', '$absen_koreksi_keterangan' ) ");

if ($input_absen_koreksi) {
    //input absen_koreksi .
    $finger = mysql_query("INSERT INTO absen_finger VALUES('$absen_koreksi_pin', '$waktu',  '0' ) ");

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Attendance correction successfully entered!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=attendance_correction';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Attendance correction failed to input!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=attendance_correction';
}, 1000);
</script>
<?php
}

?>