<?php
include("koneksi.php");
$kelurahan = $_GET['kelurahan'];
$query = mysql_query("SELECT * FROM data_wilayah WHERE kelurahan ='$kelurahan'");
$data = mysql_fetch_array($query);
echo "<input type='text' class='form-control' name='ktp_kodepos' value='".$data['kodepos']."' required>";
?>
