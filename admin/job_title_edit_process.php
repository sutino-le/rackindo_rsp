<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$bagian_id = addslashes($_POST['bagian_id']);
$bagian_nama = addslashes($_POST['bagian_nama']);
$bagian_parent = addslashes($_POST['bagian_parent']);

//input bagian
$query_bagian = mysql_query("UPDATE bagian SET bagian_nama='$bagian_nama', bagian_parent='$bagian_parent' WHERE bagian_id='$bagian_id' ");

if ($query_bagian) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Section Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=job_title';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Part Data Edit Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=job_title';
}, 1000);
</script>
<?php
}

?>