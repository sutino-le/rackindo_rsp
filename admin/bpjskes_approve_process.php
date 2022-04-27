<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$bpjskes_ktp = addslashes($_POST['bpjskes_ktp']);
$bpjskes_nomor = addslashes($_POST['bpjskes_nomor']);

//input bpjs_kes
$query_bpjs_kes = mysql_query("UPDATE bpjs_kes SET bpjskes_nomor='$bpjskes_nomor', bpjskes_status='Aktif' WHERE bpjskes_ktp='$bpjskes_ktp' ");

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
    document.location = 'home_admin.php?page=bpjskes_approve';
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
    document.location = 'home_admin.php?page=bpjskes_approve';
}, 1000);
</script>
<?php
}

?>