<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$user_ktp = addslashes($_POST['user_ktp']);
$user_hp = addslashes($_POST['user_hp']);
$user_email = addslashes($_POST['user_email']);
$user_password = addslashes($_POST['user_password']);

//input data user 
$query_user = mysql_query("UPDATE user SET
	user_hp='$user_hp',
	user_email='$user_email',
	user_password='$user_password'
	WHERE 
	user_ktp='$user_ktp'
");

if ($query_user) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'User Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=user_edit&ktp_nomor=<?php echo $user_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! User data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=user_edit&ktp_nomor=<?php echo $user_ktp; ?>';
}, 1000);
</script>
<?php
}

?>