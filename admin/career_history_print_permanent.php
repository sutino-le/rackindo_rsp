<?php
include "koneksi.php";
$id = $_GET['pkwt_id'];

$pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_id='$id' ");
$v_pkwt = mysql_fetch_array($pkwt);