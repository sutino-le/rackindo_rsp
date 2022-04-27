<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$absen_izin_id = addslashes($_POST['absen_izin_id']);
$absen_izin_tanggal = addslashes($_POST['absen_izin_tanggal']);
$absen_izin_nomor = addslashes($_POST['absen_izin_nomor']);
$absen_izin_jenis = addslashes($_POST['absen_izin_jenis']);
$absen_izin_keterangan = addslashes($_POST['absen_izin_keterangan']);
$absen_izin_tahun = addslashes($_POST['absen_izin_tahun']);
$absen_izin_spv = addslashes($_POST['absen_izin_spv']);

//input data ktp 
$edit_attendance_request = mysql_query("UPDATE absen_izin SET
	absen_izin_tanggal='$absen_izin_tanggal',
	absen_izin_nomor='$absen_izin_nomor',
	absen_izin_jenis='$absen_izin_jenis',
	absen_izin_keterangan='$absen_izin_keterangan',
	absen_izin_tahun='$absen_izin_tahun',
	absen_izin_spv='$absen_izin_spv'
	WHERE 
	absen_izin_id='$absen_izin_id'
");

if ($edit_attendance_request) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Attendance Request Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=attendance_request';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Attendance Request data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=attendance_request';
}, 1000);
</script>
<?php
}

?>