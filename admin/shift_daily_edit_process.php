<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$sd_id = addslashes($_POST['sd_id']);
$sd_code = addslashes($_POST['sd_code']);
$sd_type = addslashes($_POST['sd_type']);
$sd_masuk = addslashes($_POST['sd_masuk']);
$sd_pulang = addslashes($_POST['sd_pulang']);
$sd_break_awal = addslashes($_POST['sd_break_awal']);
$sd_break_akhir = addslashes($_POST['sd_break_akhir']);

//input bagian
$query_shift_daily = mysql_query("UPDATE shift_daily SET sd_code='$sd_code', sd_type='$sd_type', sd_masuk='$sd_masuk', sd_pulang='$sd_pulang', sd_break_awal='$sd_break_awal', sd_break_akhir='$sd_break_akhir' WHERE sd_id='$sd_id' ");

if ($query_shift_daily) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Section Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=shift_daily_view';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Part Data Edit Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=shift_daily_view';
}, 1000);
</script>
<?php
}

?>