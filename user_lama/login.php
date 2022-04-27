<?php
session_start();
include "koneksi.php";
$ktp_nomor = $_POST['ktp_nomor'];
$password = $_POST['password'];
$op = $_GET['op'];

if ($op == "in") {
    $sql = mysql_query("SELECT * FROM user JOIN biodata_ktp ON user.user_ktp=biodata_ktp.ktp_nomor WHERE user.user_ktp='$ktp_nomor' OR  user.user_email='$ktp_nomor' AND user.user_password='$password'");
    if (mysql_num_rows($sql) == 1) { //jika berhasil akan bernilai 1
        $qry = mysql_fetch_array($sql);
        $_SESSION['user_ktp'] = $qry['user_ktp'];
        $_SESSION['ktp_nama'] = $qry['ktp_nama'];
        $_SESSION['user_password'] = $qry['user_password'];
        if ($qry['user_ktp'] == $qry['ktp_nomor']) {
            header("location:home_admin.php");
        } else {
            header("location:index.php");
        }
    } else {
?>
<script language="JavaScript">
alert('Akun tidak ditemukan, silahkan daftar terlebih dahulu!');
document.location = 'index.php';
</script>
<?php
    }
} else if ($op == "out") {
    unset($_SESSION['user_ktp']);
    unset($_SESSION['ktp_nama']);
    header("location:index.php");
}
?>