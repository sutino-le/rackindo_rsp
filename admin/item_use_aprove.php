<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$keluar_id=$_GET['keluar_id'];
$keluar_tanggal_aprove=date("Y-m-d");
$keluar_status="Selesai";


$query_keluar=mysql_query("UPDATE tb_keluar SET 
	keluar_tanggal_aprove='$keluar_tanggal_aprove',
	keluar_status='Selesai'
	WHERE keluar_id='$keluar_id' ");
	
if ($query_keluar) {
?>
<script type='text/javascript'>
	setTimeout(function () { 	
		swal({
			title: 'Usage Data has been processed!',
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
}else{
?>
	<script type='text/javascript'>
	setTimeout(function () { 	
		swal({
			title: 'Oooopppsssss......!!!! Usage data has not been processed yet!',
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