<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$pengalaman_id = $_GET['pengalaman_id'];
$cek_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_id='$pengalaman_id' ");
$hasil = mysql_fetch_array($cek_pengalaman);
$pengalaman_ktp = $hasil['pengalaman_ktp'];

//input data pengalaman 
$query_pengalaman = mysql_query("DELETE FROM biodata_pengalaman WHERE pengalaman_id='$pengalaman_id' ");

if ($query_pengalaman) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Experience Data delete Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=experience_edit&ktp_nomor=<?php echo $pengalaman_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!!Experience data failed to delete!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=experience_edit&ktp_nomor=<?php echo $pengalaman_ktp; ?>';
}, 1000);
</script>
<?php
}

?>