<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$vaksin_ktp = addslashes($_POST['vaksin_ktp']);
$vaksin_ke = addslashes($_POST['vaksin_ke']);
$vaksin_jenis = addslashes($_POST['vaksin_jenis']);
$vaksin_tanggal = addslashes($_POST['vaksin_tanggal']);

//input data ktp 
$query_vaksin = mysql_query("INSERT INTO vaksin VALUES (
    '',
	'$vaksin_ktp',
	'$vaksin_ke',
	'$vaksin_jenis',
	'$vaksin_tanggal'
)");

if ($query_vaksin) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Data Vaksin Berhasil Diinput!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=vaccine_view';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Data Vaksin Gagal Diinput!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=vaccine_view';
}, 1000);
</script>
<?php
}

?>