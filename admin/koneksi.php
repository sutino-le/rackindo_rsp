<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbnm = "rackindo";
$sambungkan = mysql_connect($server, $user, $pass);
$buka = mysql_select_db($dbnm, $sambungkan);


$pdo = new PDO('mysql:host=' . $server . ';dbname=' . $dbnm, $user, $pass);

if (!$buka) {
	echo "Database tidak dapat dibuka";
}