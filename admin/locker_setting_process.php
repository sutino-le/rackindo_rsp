<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$karyawan_ktp = addslashes($_POST['karyawan_ktp']);
$karyawan_loker = addslashes($_POST['karyawan_loker']);

//input loker
$query_loker = mysql_query("UPDATE karyawan SET karyawan_loker='$karyawan_loker' WHERE karyawan_ktp='$karyawan_ktp' ");

if ($query_loker) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Locker Data Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=locker';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Locker Data Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=locker';
}, 1000);
</script>
<?php
}

?>