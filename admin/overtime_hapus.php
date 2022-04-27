<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$lembur_id = $_GET['lembur_id'];

//input data lembur 
$query_lembur = mysql_query("DELETE FROM upah_lembur WHERE lembur_id='$lembur_id' ");

if ($query_lembur) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Overtime delete Successfully!',
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
        title: 'Oooopppsssss......!!!! Overtime failed to delete!',
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