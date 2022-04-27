<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$lembur_ktp = addslashes($_POST['lembur_ktp']);
$lembur_nomor = addslashes($_POST['lembur_nomor']);
$lembur_jenis = addslashes($_POST['lembur_jenis']);
$lembur_tanggal = addslashes($_POST['lembur_tanggal']);
$lembur_jam = addslashes($_POST['lembur_jam']);

$cek_upah_lembur = mysql_query("SELECT * FROM upah_lembur WHERE lembur_ktp='$lembur_ktp' AND lembur_jenis='$lembur_jenis' AND lembur_tanggal='$lembur_tanggal' ");
$v_upah_lembur = mysql_fetch_array($cek_upah_lembur);
$lembur_id = $v_upah_lembur['lembur_id'];

if (empty($lembur_id)) {

    //input upah_lembur
    $upah_lembur = mysql_query("INSERT INTO upah_lembur VALUES (
    '',
	'$lembur_ktp',
	'$lembur_nomor',
	'$lembur_jenis',
	'$lembur_tanggal',
	'$lembur_jam'
)");
} else {
    //edit upah_lembur
    $upah_lembur = mysql_query("UPDATE upah_lembur SET
	lembur_nomor='$lembur_nomor',
	lembur_jenis='$lembur_jenis',
	lembur_tanggal='$lembur_tanggal'
WHERE lembur_id='$lembur_id' ");
}

if ($upah_lembur) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Overtime Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=overtime';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Overtime Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=overtime';
}, 1000);
</script>
<?php
}

?>