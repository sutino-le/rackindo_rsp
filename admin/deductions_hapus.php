<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_pot_id = $_GET['upah_pot_id'];

//input data upah_pot 
$query_upah_pot = mysql_query("DELETE FROM upah_potongan_jam WHERE upah_pot_id='$upah_pot_id' ");

if ($query_upah_pot) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Deductions delete Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=deductions';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Deductions failed to delete!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=deductions';
}, 1000);
</script>
<?php
}

?>