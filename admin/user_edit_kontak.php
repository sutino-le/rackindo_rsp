<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$user_ktp = addslashes($_POST['user_ktp']);
$user_email = addslashes($_POST['user_email']);
$user_hp = addslashes($_POST['user_hp']);

//input user
$query_user = mysql_query("UPDATE user SET user_email='$user_email', user_hp='$user_hp' WHERE user_ktp='$user_ktp' ");

if ($query_user) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Data user Berhasil Diedit!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=employee_details&id=<?php echo $user_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Data user Gagal Diedit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=employee_details&id<?php echo $user_ktp; ?>';
}, 1000);
</script>
<?php
}

?>