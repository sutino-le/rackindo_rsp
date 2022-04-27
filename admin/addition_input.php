<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_tambahan_ktp = addslashes($_POST['upah_tambahan_ktp']);
$upah_tambahan_tanggal = addslashes($_POST['upah_tambahan_tanggal']);
$upah_tambahan_jumlah = addslashes($_POST['upah_tambahan_jumlah']);

$cek_upah_tambahan = mysql_query("SELECT * FROM upah_tambahan WHERE upah_tambahan_ktp='$upah_tambahan_ktp' AND upah_tambahan_tanggal='$upah_tambahan_tanggal' ");
$v_upah_tambahan = mysql_fetch_array($cek_upah_tambahan);
$upah_tambahan_id = $v_upah_tambahan['upah_tambahan_id'];

if (empty($upah_tambahan_id)) {

    //input upah_tambahan
    $upah_tambahan = mysql_query("INSERT INTO upah_tambahan VALUES (
    '',
	'$upah_tambahan_ktp',
	'$upah_tambahan_tanggal',
	'$upah_tambahan_jumlah'
)");
} else {
    //edit upah_tambahan
    $upah_tambahan = mysql_query("UPDATE upah_tambahan SET
	upah_tambahan_tanggal='$upah_tambahan_tanggal',
	upah_tambahan_jumlah='$upah_tambahan_jumlah'
WHERE upah_tambahan_id='$upah_tambahan_id' ");
}

if ($upah_tambahan) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Addition Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=addition';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Addition Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=addition';
}, 1000);
</script>
<?php
}

?>