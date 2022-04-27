<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$npwp_ktp = addslashes($_POST['npwp_ktp']);
$npwp_nomor = addslashes($_POST['npwp_nomor']);
$npwp_alamat = addslashes($_POST['npwp_alamat']);

$query_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$npwp_ktp' ");
$hasil = mysql_fetch_array($query_npwp);
if (empty($hasil)) {
    $query_npwp = mysql_query("INSERT INTO biodata_npwp VALUES('$npwp_ktp', '$npwp_nomor', '$npwp_alamat' )");
} else {
    //input data npwp 
    $query_npwp = mysql_query("UPDATE npwp SET
	npwp_nomor='$npwp_nomor',
	npwp_alamat='$npwp_alamat'
	WHERE 
	npwp_ktp='$npwp_ktp'
");
}

if ($query_npwp) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'NPWP Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=user_edit&ktp_nomor=<?php echo $npwp_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! NPWP data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=user_edit&ktp_nomor=<?php echo $npwp_ktp; ?>';
}, 1000);
</script>
<?php
}

?>