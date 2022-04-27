
<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$keluar_idbarang=addslashes($_POST['keluar_idbarang']);
$keluar_tanggal=addslashes($_POST['keluar_tanggal']);
$keluar_jumlah=addslashes($_POST['keluar_jumlah']);
$keluar_user=addslashes($_POST['keluar_user']);
$keluar_deskripsi=addslashes($_POST['keluar_deskripsi']);


//input data perusahaan 
$query_pemakaian=mysql_query("INSERT INTO tb_keluar VALUES (
	'',
	'$keluar_idbarang',
	'$keluar_tanggal',
	'$keluar_jumlah',
	'',
	'Progres',
	'$keluar_user',
	'$keluar_deskripsi'
 )");

if ($query_pemakaian) {
	
	
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Usage Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_use_view';
		} ,1000);	
	  	</script>
	<?php
	} else {
	//Jika Gagal
	?>
		
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Usage Data Input Failed!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_use_view';
		} ,1000);	
	  	</script>
	<?php
	}

?>