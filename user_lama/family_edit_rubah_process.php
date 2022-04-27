<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$keluarga_id = addslashes($_POST['keluarga_id']);
$keluarga_ktp = addslashes($_POST['keluarga_ktp']);
$keluarga_jenis = addslashes($_POST['keluarga_jenis']);
$keluarga_nama = addslashes($_POST['keluarga_nama']);
$keluarga_lahir = addslashes($_POST['keluarga_lahir']);
$keluarga_kelamin = addslashes($_POST['keluarga_kelamin']);
$keluarga_alamat = addslashes($_POST['keluarga_alamat']);
$keluarga_hp = addslashes($_POST['keluarga_hp']);
$keluarga_nomor = addslashes($_POST['keluarga_nomor']);


//input data keluarga 
$query_keluarga = mysql_query("UPDATE biodata_keluarga SET
	keluarga_jenis='$keluarga_jenis',
	keluarga_nama='$keluarga_nama',
	keluarga_lahir='$keluarga_lahir',
	keluarga_kelamin='$keluarga_kelamin',
	keluarga_alamat='$keluarga_alamat',
	keluarga_hp='$keluarga_hp',
	keluarga_nomor='$keluarga_nomor'
	WHERE 
	keluarga_id='$keluarga_id'
");

if ($query_keluarga) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Family Data Edited Successfully!',
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
        title: 'Oooopppsssss......!!!! Family data failed to edit!',
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