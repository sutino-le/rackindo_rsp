<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_tambahan_id = $_GET['upah_tambahan_id'];

//input data upah_tambahan 
$query_upah_tambahan = mysql_query("DELETE FROM upah_tambahan WHERE upah_tambahan_id='$upah_tambahan_id' ");

if ($query_upah_tambahan) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Addition delete Successfully!',
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
        title: 'Oooopppsssss......!!!! Addition failed to delete!',
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