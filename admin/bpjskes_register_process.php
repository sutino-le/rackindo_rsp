<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$bpjskes_ktp = addslashes($_POST['bpjskes_ktp']);
$bpjskes_masuk = addslashes($_POST['bpjskes_masuk']);

//input bpjs_kes
$query_bpjs_kes = mysql_query("INSERT INTO bpjs_kes VALUES (
	'$bpjskes_ktp',
    '',
	'$bpjskes_masuk',
    '',
    'Progres'
)");

if ($query_bpjs_kes) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'BPJS Health Data register Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=bpjskes_register';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! BPJS Health Data register Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=bpjskes_register';
}, 1000);
</script>
<?php
}

?>