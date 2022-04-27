<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$ks_id = addslashes($_POST['ks_id']);
$pin = addslashes($_POST['pin']);
$awal = addslashes($_POST['awal']);
$akhir = addslashes($_POST['akhir']);
$ks_schedule = addslashes($_POST['ks_schedule']);

//input data ktp 
$query_karyawan_schedule = mysql_query("UPDATE karyawan_schedule SET ks_schedule='$ks_schedule' WHERE ks_id='$ks_id' ");

if ($query_karyawan_schedule) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Shift Schedule Data Edit Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=employee_shift_schedule_setting&pin=<?php echo $pin; ?>&awal=<?php echo $awal; ?>&akhir=<?php echo $akhir; ?>';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Shift Schedule Data Edit Failed To Enter!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=employee_shift_schedule_setting&pin=<?php echo $pin; ?>&awal=<?php echo $awal; ?>&akhir=<?php echo $akhir; ?>';
}, 1000);
</script>
<?php
}

?>