<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$pendidikan_id = addslashes($_POST['pendidikan_id']);
$pendidikan_ktp = addslashes($_POST['pendidikan_ktp']);
$pendidikan_awal = addslashes($_POST['pendidikan_awal']);
$pendidikan_akhir = addslashes($_POST['pendidikan_akhir']);
$pendidikan_tingkatan = addslashes($_POST['pendidikan_tingkatan']);
$pendidikan_nama = addslashes($_POST['pendidikan_nama']);
$pendidikan_jurusan = addslashes($_POST['pendidikan_jurusan']);
$pendidikan_nilai = addslashes($_POST['pendidikan_nilai']);
$pendidikan_kota = addslashes($_POST['pendidikan_kota']);

$query_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_id='$pendidikan_id' ");
$hasil = mysql_fetch_array($query_pendidikan);


//input data pendidikan 
$query_pendidikan = mysql_query("UPDATE pendidikan SET
	pendidikan_awal='$pendidikan_awal',
	pendidikan_akhir='$pendidikan_akhir',
	pendidikan_tingkatan='$pendidikan_tingkatan',
	pendidikan_nama='$pendidikan_nama',
	pendidikan_jurusan='$pendidikan_jurusan',
	pendidikan_nilai='$pendidikan_nilai',
	pendidikan_kota='$pendidikan_kota'
	WHERE 
	pendidikan_id='$pendidikan_id'
");

if ($query_pendidikan) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Education Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=education_edit&ktp_nomor=<?php echo $pendidikan_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Education data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=education_edit&ktp_nomor=<?php echo $pendidikan_ktp; ?>';
}, 1000);
</script>
<?php
}

?>