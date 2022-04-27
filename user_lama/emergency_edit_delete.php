<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$darurat_id = $_GET['darurat_id'];
$cek_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_id='$darurat_id' ");
$hasil = mysql_fetch_array($cek_darurat);
$darurat_ktp = $hasil['darurat_ktp'];

//input data darurat 
$query_darurat = mysql_query("DELETE FROM biodata_darurat WHERE darurat_id='$darurat_id' ");

if ($query_darurat) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Emergency Data delete Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $darurat_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Emergency data failed to delete!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $keluarga_ktp; ?>';
}, 1000);
</script>
<?php
}

?>