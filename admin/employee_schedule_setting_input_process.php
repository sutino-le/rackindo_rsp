<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$karyawan_npk = addslashes($_POST['karyawan_npk']);
$karyawan_schedule_start = addslashes($_POST['karyawan_schedule_start']);
$karyawan_schedule = addslashes($_POST['karyawan_schedule']);

//input data ktp 
$query_absen_group_schedule = mysql_query("UPDATE karyawan SET karyawan_schedule='$karyawan_schedule', karyawan_schedule_start='$karyawan_schedule_start' WHERE karyawan_npk='$karyawan_npk' ");

if ($query_absen_group_schedule) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Data Schedule Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=employee_schedule_setting';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Data Schedule Failed To Enter!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=employee_schedule_setting';
}, 1000);
</script>
<?php
}

?>