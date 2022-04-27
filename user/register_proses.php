<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$ktp_nomor = addslashes($_POST['ktp_nomor']);
$ktp_nama = addslashes($_POST['ktp_nama']);
$nomor_hp = addslashes($_POST['nomor_hp']);
$email = addslashes($_POST['email']);
$pwd = addslashes($_POST['pwd']);
$pwd2 = addslashes($_POST['pwd2']);

if (substr($nomor_hp, 0, 2) == "08") {
	$hasil_hp = "+628" . substr($nomor_hp, 2);
} else {
	$hasil_hp = $nomor_hp;
}

//input data ktp 
$query_biodata = mysql_query("INSERT INTO biodata_ktp VALUES (
	'$ktp_nomor',
	'$ktp_nama',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	''
)");

if ($query_biodata) {
	//input data ktp 
	$foto = $ktp_nomor . ".jpg";
	$password = md5($pwd);
	$query_user = mysql_query("INSERT INTO user VALUES (
		'', 
		'$ktp_nomor', 
		'$hasil_hp', 
		'$email', 
		'$foto', 
		'$password'
		)");

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Akun Berhasil dibuat!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'index.php';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Akun gagal dibuatr!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'index.php';
}, 1000);
</script>
<?php
}

?>