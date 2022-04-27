<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_kar_ktp = addslashes($_POST['upah_kar_ktp']);
$upah_kar_upah = addslashes($_POST['upah_kar_upah']);
$upah_kar_kompensasi = addslashes($_POST['upah_kar_kompensasi']);
$upah_kar_insentif = addslashes($_POST['upah_kar_insentif']);

$cek_upah_karyawan = mysql_query("SELECT * FROM upah_karyawan WHERE upah_kar_ktp='$upah_kar_ktp' ");
$v_upah_karyawan = mysql_fetch_array($cek_upah_karyawan);
$upah_kar_id = $v_upah_karyawan['upah_kar_id'];

if (empty($upah_kar_id)) {

    //input upah_karyawan
    $upah_karyawan = mysql_query("INSERT INTO upah_karyawan VALUES (
    '',
	'$upah_kar_ktp',
	'$upah_kar_upah',
	'$upah_kar_kompensasi',
	'$upah_kar_insentif'
)");
} else {
    //edit upah_karyawan
    $upah_karyawan = mysql_query("UPDATE upah_karyawan SET
	upah_kar_upah='$upah_kar_upah',
	upah_kar_kompensasi='$upah_kar_kompensasi',
	upah_kar_insentif='$upah_kar_insentif'
WHERE upah_kar_id='$upah_kar_id' ");
}

if ($upah_karyawan) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Salary Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=setting_ump';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Salary Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=setting_ump';
}, 1000);
</script>
<?php
}

?>