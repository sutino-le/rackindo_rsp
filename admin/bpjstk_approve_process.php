<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$bpjstk_ktp = addslashes($_POST['bpjstk_ktp']);
$bpjstk_nomor = addslashes($_POST['bpjstk_nomor']);

//input bpjs_tk
$query_bpjs_tk = mysql_query("UPDATE bpjs_tk SET bpjstk_nomor='$bpjstk_nomor', bpjstk_status='Aktif' WHERE bpjstk_ktp='$bpjstk_ktp' ");

if ($query_bpjs_tk) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'BPJS TK Data register Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=bpjstk_approve';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! BPJS TK Data register Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=bpjstk_approve';
}, 1000);
</script>
<?php
}

?>