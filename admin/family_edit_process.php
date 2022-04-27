<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$keluarga_ktp = addslashes($_POST['keluarga_ktp']);
$keluarga_jenis = addslashes($_POST['keluarga_jenis']);
$keluarga_nama = addslashes($_POST['keluarga_nama']);
$keluarga_lahir = addslashes($_POST['keluarga_lahir']);
$keluarga_kelamin = addslashes($_POST['keluarga_kelamin']);
$keluarga_alamat = addslashes($_POST['keluarga_alamat']);
$keluarga_hp = addslashes($_POST['keluarga_hp']);
$keluarga_nomor = addslashes($_POST['keluarga_nomor']);

$query_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_ktp='$keluarga_ktp' AND keluarga_nama='$keluarga_nama' ");
$hasil = mysql_fetch_array($query_keluarga);
if (empty($hasil)) {
    $input_keluarga = mysql_query("INSERT INTO biodata_keluarga VALUES('', '$keluarga_ktp', '$keluarga_jenis', '$keluarga_nama', '$keluarga_lahir', '$keluarga_kelamin', '$keluarga_alamat', '$keluarga_hp', '$keluarga_nomor' )");
} else {
    //input data keluarga 
    $input_keluarga = mysql_query("UPDATE keluarga SET
	keluarga_jenis='$keluarga_jenis',
	keluarga_nama='$keluarga_nama',
	keluarga_lahir='$keluarga_lahir',
	keluarga_kelamin='$keluarga_kelamin',
	keluarga_alamat='$keluarga_alamat',
	keluarga_hp='$keluarga_hp',
	keluarga_nomor='$keluarga_nomor'
	WHERE 
	keluarga_ktp='$keluarga_ktp' AND keluarga_nama='$keluarga_nama'
");
}

if ($input_keluarga) {


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