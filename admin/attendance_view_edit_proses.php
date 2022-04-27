<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$absen_kar_id = addslashes($_POST['absen_kar_id']);
$pin = addslashes($_POST['pin']);
$awal = addslashes($_POST['awal']);
$akhir = addslashes($_POST['akhir']);
$absen_kar_in = addslashes($_POST['absen_kar_in']);
$absen_kar_out = addslashes($_POST['absen_kar_out']);

//input data ktp 
$query_absen_karyawan = mysql_query("UPDATE absen_karyawan SET absen_kar_out='$absen_kar_out', absen_kar_in='$absen_kar_in' WHERE absen_kar_id='$absen_kar_id' ");

if ($query_absen_karyawan) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Data Attendance Edit Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=attendance_view&pin=<?php echo $pin; ?>&awal=<?php echo $awal; ?>&akhir=<?php echo $akhir; ?>';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Data Attendance Edit Failed To Enter!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=attendance_view&pin=<?php echo $pin; ?>&awal=<?php echo $awal; ?>&akhir=<?php echo $akhir; ?>';
}, 1000);
</script>
<?php
}

?>