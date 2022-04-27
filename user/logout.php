<?php
session_start();
unset($_SESSION['ktp_nama']);
session_destroy();
	header("Location:index.php");