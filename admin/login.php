<?php
session_start();
include "koneksi.php";
$user = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];

if($op=="in"){
    $sql = mysql_query("SELECT * FROM login WHERE user='$user' AND password='$password'");
    if(mysql_num_rows($sql)==1){//jika berhasil akan bernilai 1
        $qry = mysql_fetch_array($sql);
        $_SESSION['user'] = $qry['user'];
		$_SESSION['nama'] = $qry['nama'];
		$_SESSION['password'] = $qry['password'];
        $_SESSION['level'] = $qry['level'];
        if($qry['level']=="Admin"){
            header("location:home_admin.php");
        } else {
					header("location:index.php");
					}
    }else{
		?>
		<script language="JavaScript">
			alert('Username atau Password tidak sesuai. Silahkan diulang kembali!');
			document.location='index.php';
		</script>
		<?php
    }
}else if($op=="out"){
    unset($_SESSION['user']);
    unset($_SESSION['level']);
    header("location:index.php");
}
?>
