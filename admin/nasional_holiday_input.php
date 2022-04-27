<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$ln_tanggal = addslashes($_POST['ln_tanggal']);
$ln_keterangan = addslashes($_POST['ln_keterangan']);

//input libur_nasional
$query_libur_nasional = mysql_query("INSERT INTO libur_nasional VALUES (
    '',
	'$ln_tanggal',
    'LN',
	'$ln_keterangan'
)");

if ($query_libur_nasional) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Nasional Holiday Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=nasional_holiday_view';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Nasional Holiday Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=nasional_holiday_view';
}, 1000);
</script>
<?php
}

?>