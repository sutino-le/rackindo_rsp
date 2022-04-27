<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$sd_code = addslashes($_POST['sd_code']);
$sd_type = addslashes($_POST['sd_type']);
$sd_masuk = addslashes($_POST['sd_masuk']);
$sd_pulang = addslashes($_POST['sd_pulang']);
$sd_break_awal = addslashes($_POST['sd_break_awal']);
$sd_break_akhir = addslashes($_POST['sd_break_akhir']);

//input shift_daily
$query_shift_daily = mysql_query("INSERT INTO shift_daily VALUES (
    '',
	'$sd_code',
	'$sd_type',
	'$sd_masuk',
	'$sd_pulang',
	'$sd_break_awal',
	'$sd_break_akhir'
)");

if ($query_shift_daily) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Part Data Entered Successfully!',
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
        title: 'Oooopppsssss......!!!! Part Data Input Failed!',
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