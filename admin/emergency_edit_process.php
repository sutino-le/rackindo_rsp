<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$darurat_ktp = addslashes($_POST['darurat_ktp']);
$darurat_hubungan = addslashes($_POST['darurat_hubungan']);
$darurat_nama = addslashes($_POST['darurat_nama']);
$darurat_alamat = addslashes($_POST['darurat_alamat']);
$darurat_hp = addslashes($_POST['darurat_hp']);

$query_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$darurat_ktp' AND darurat_hubungan='$darurat_hubungan' ");
$hasil = mysql_fetch_array($query_darurat);
if (empty($hasil)) {
    $query_darurat = mysql_query("INSERT INTO biodata_darurat VALUES('', '$darurat_ktp', '$darurat_hubungan', '$darurat_nama', '$darurat_alamat', '$darurat_hp' )");
} else {
    //input data darurat 
    $query_darurat = mysql_query("UPDATE darurat SET
	darurat_hubungan='$darurat_hubungan',
	darurat_nama='$darurat_nama',
	darurat_alamat='$darurat_alamat',
	darurat_hp='$darurat_hp'
	WHERE 
	darurat_ktp='$darurat_ktp' AND darurat_hubungan='$darurat_hubungan'
");
}

if ($query_darurat) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Emergency Data Edited Successfully!',
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
        title: 'Oooopppsssss......!!!! Emergency data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $darurat_ktp; ?>';
}, 1000);
</script>
<?php
}

?>