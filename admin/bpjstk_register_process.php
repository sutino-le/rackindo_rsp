<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$bpjstk_ktp = addslashes($_POST['bpjstk_ktp']);
$bpjstk_masuk = addslashes($_POST['bpjstk_masuk']);

//input bpjs_tk
$query_bpjs_tk = mysql_query("INSERT INTO bpjs_tk VALUES (
	'$bpjstk_ktp',
    '',
	'$bpjstk_masuk',
    '',
    'Progres'
)");

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
    document.location = 'home_admin.php?page=bpjstk_register';
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
    document.location = 'home_admin.php?page=bpjstk_register';
}, 1000);
</script>
<?php
}

?>