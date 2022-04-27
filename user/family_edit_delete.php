<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$keluarga_id = $_GET['keluarga_id'];
$cek_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_id='$keluarga_id' ");
$hasil = mysql_fetch_array($cek_keluarga);
$keluarga_ktp = $hasil['keluarga_ktp'];

//input data keluarga 
$query_keluarga = mysql_query("DELETE FROM biodata_keluarga WHERE keluarga_id='$keluarga_id' ");

if ($query_keluarga) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Family Data delete Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=family_edit&ktp_nomor=<?php echo $keluarga_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Family data failed to delete!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=family_edit&ktp_nomor=<?php echo $keluarga_ktp; ?>';
}, 1000);
</script>
<?php
}

?>