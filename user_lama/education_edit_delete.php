<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$pendidikan_id = $_GET['pendidikan_id'];
$cek_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_id='$pendidikan_id' ");
$hasil = mysql_fetch_array($cek_pendidikan);
$pendidikan_ktp = $hasil['pendidikan_ktp'];

//input data pendidikan 
$query_pendidikan = mysql_query("DELETE FROM pendidikan WHERE pendidikan_id='$pendidikan_id' ");

if ($query_pendidikan) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Education Data delete Successfully!',
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
        title: 'Oooopppsssss......!!!! Education data failed to delete!',
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