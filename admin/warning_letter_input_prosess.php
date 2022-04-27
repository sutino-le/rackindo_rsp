<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$wl_ktp = addslashes($_POST['wl_ktp']);
$wl_nomor = addslashes($_POST['wl_nomor']);
$wl_tanggal = addslashes($_POST['wl_tanggal']);
$wl_ke = addslashes($_POST['wl_ke']);
$wl_durasi = addslashes($_POST['wl_durasi']);
$wl_awal = addslashes($_POST['wl_awal']);
$wl_akhir = addslashes($_POST['wl_akhir']);
$wl_keterangan = addslashes($_POST['wl_keterangan']);

//input data ktp 
$query_warning_letter = mysql_query("INSERT INTO warning_letter VALUES (
	'',
	'$wl_ktp',
	'$wl_nomor',
	'$wl_tanggal',
	'$wl_ke',
	'$wl_durasi',
	'$wl_awal',
	'$wl_akhir',
	'$wl_keterangan'
 )");

if ($query_warning_letter) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Warning Letter Data Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=warning_letter_view';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Data Warning Letter Failed to Enter!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=warning_letter_view';
}, 1000);
</script>
<?php
}

?>