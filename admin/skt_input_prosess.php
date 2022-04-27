<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$skt_ktp = addslashes($_POST['skt_ktp']);
$skt_nomor = addslashes($_POST['skt_nomor']);
$skt_tanggal = addslashes($_POST['skt_tanggal']);
$skt_jenis = addslashes($_POST['skt_jenis']);
$skt_status_karyawan = addslashes($_POST['skt_status_karyawan']);
$skt_aprove = addslashes($_POST['skt_aprove']);
$skt_aprove_jabatan = addslashes($_POST['skt_aprove_jabatan']);

//input data ktp 
$query_skt = mysql_query("INSERT INTO skt VALUES (
	'',
	'$skt_nomor',
	'$skt_tanggal',
	'$skt_ktp',
	'$skt_jenis',
	'$skt_status_karyawan',
	'$skt_aprove',
	'$skt_aprove_jabatan'
 )");

if ($query_skt) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Certificate Data Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=skt_view';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Data Certificate Failed to Enter!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=skt_view';
}, 1000);
</script>
<?php
}

?>