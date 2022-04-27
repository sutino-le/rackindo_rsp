<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$bagian_nama = addslashes($_POST['bagian_nama']);
$bagian_parent = addslashes($_POST['bagian_parent']);

//input bagian
$query_bagian = mysql_query("INSERT INTO bagian VALUES (
    '',
	'$bagian_nama',
	'$bagian_parent'
)");

if ($query_bagian) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Part Data Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=job_title_input';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Part Data Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=job_title_input';
}, 1000);
</script>
<?php
}

?>