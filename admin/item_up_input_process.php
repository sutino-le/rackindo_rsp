<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$jumlah_up=addslashes($_POST['jumlah_up']);
$up_nomor=addslashes($_POST['up_nomor']);
$up_tanggal=addslashes($_POST['up_tanggal']);

if ($jumlah_up==1) {
	$barang_id1=$_POST['barang_id1'];
	$up_jumlah1a=$_POST['up_jumlah1a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==2) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==3) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];
	$barang_id3=$_POST['barang_id3'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];
	$up_jumlah3a=$_POST['up_jumlah3a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");
	$input3=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id3', '$up_tanggal', '$up_nomor', '$up_jumlah3a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==4) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];
	$barang_id3=$_POST['barang_id3'];
	$barang_id4=$_POST['barang_id4'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];
	$up_jumlah3a=$_POST['up_jumlah3a'];
	$up_jumlah4a=$_POST['up_jumlah4a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");
	$input3=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id3', '$up_tanggal', '$up_nomor', '$up_jumlah3a', 'Progres', '', ''  )");
	$input4=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id4', '$up_tanggal', '$up_nomor', '$up_jumlah4a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==5) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];
	$barang_id3=$_POST['barang_id3'];
	$barang_id4=$_POST['barang_id4'];
	$barang_id5=$_POST['barang_id5'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];
	$up_jumlah3a=$_POST['up_jumlah3a'];
	$up_jumlah4a=$_POST['up_jumlah4a'];
	$up_jumlah5a=$_POST['up_jumlah5a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");
	$input3=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id3', '$up_tanggal', '$up_nomor', '$up_jumlah3a', 'Progres', '', ''  )");
	$input4=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id4', '$up_tanggal', '$up_nomor', '$up_jumlah4a', 'Progres', '', ''  )");
	$input5=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id5', '$up_tanggal', '$up_nomor', '$up_jumlah5a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==6) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];
	$barang_id3=$_POST['barang_id3'];
	$barang_id4=$_POST['barang_id4'];
	$barang_id5=$_POST['barang_id5'];
	$barang_id6=$_POST['barang_id6'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];
	$up_jumlah3a=$_POST['up_jumlah3a'];
	$up_jumlah4a=$_POST['up_jumlah4a'];
	$up_jumlah5a=$_POST['up_jumlah5a'];
	$up_jumlah6a=$_POST['up_jumlah6a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");
	$input3=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id3', '$up_tanggal', '$up_nomor', '$up_jumlah3a', 'Progres', '', ''  )");
	$input4=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id4', '$up_tanggal', '$up_nomor', '$up_jumlah4a', 'Progres', '', ''  )");
	$input5=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id5', '$up_tanggal', '$up_nomor', '$up_jumlah5a', 'Progres', '', ''  )");
	$input6=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id6', '$up_tanggal', '$up_nomor', '$up_jumlah6a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==7) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];
	$barang_id3=$_POST['barang_id3'];
	$barang_id4=$_POST['barang_id4'];
	$barang_id5=$_POST['barang_id5'];
	$barang_id6=$_POST['barang_id6'];
	$barang_id7=$_POST['barang_id7'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];
	$up_jumlah3a=$_POST['up_jumlah3a'];
	$up_jumlah4a=$_POST['up_jumlah4a'];
	$up_jumlah5a=$_POST['up_jumlah5a'];
	$up_jumlah6a=$_POST['up_jumlah6a'];
	$up_jumlah7a=$_POST['up_jumlah7a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");
	$input3=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id3', '$up_tanggal', '$up_nomor', '$up_jumlah3a', 'Progres', '', ''  )");
	$input4=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id4', '$up_tanggal', '$up_nomor', '$up_jumlah4a', 'Progres', '', ''  )");
	$input5=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id5', '$up_tanggal', '$up_nomor', '$up_jumlah5a', 'Progres', '', ''  )");
	$input6=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id6', '$up_tanggal', '$up_nomor', '$up_jumlah6a', 'Progres', '', ''  )");
	$input7=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id7', '$up_tanggal', '$up_nomor', '$up_jumlah7a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($jumlah_up==8) {
	$barang_id1=$_POST['barang_id1'];
	$barang_id2=$_POST['barang_id2'];
	$barang_id3=$_POST['barang_id3'];
	$barang_id4=$_POST['barang_id4'];
	$barang_id5=$_POST['barang_id5'];
	$barang_id6=$_POST['barang_id6'];
	$barang_id7=$_POST['barang_id7'];
	$barang_id8=$_POST['barang_id8'];

	$up_jumlah1a=$_POST['up_jumlah1a'];
	$up_jumlah2a=$_POST['up_jumlah2a'];
	$up_jumlah3a=$_POST['up_jumlah3a'];
	$up_jumlah4a=$_POST['up_jumlah4a'];
	$up_jumlah5a=$_POST['up_jumlah5a'];
	$up_jumlah6a=$_POST['up_jumlah6a'];
	$up_jumlah7a=$_POST['up_jumlah7a'];
	$up_jumlah8a=$_POST['up_jumlah8a'];

	$input1=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id1', '$up_tanggal', '$up_nomor', '$up_jumlah1a', 'Progres', '', ''  )");
	$input2=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id2', '$up_tanggal', '$up_nomor', '$up_jumlah2a', 'Progres', '', ''  )");
	$input3=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id3', '$up_tanggal', '$up_nomor', '$up_jumlah3a', 'Progres', '', ''  )");
	$input4=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id4', '$up_tanggal', '$up_nomor', '$up_jumlah4a', 'Progres', '', ''  )");
	$input5=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id5', '$up_tanggal', '$up_nomor', '$up_jumlah5a', 'Progres', '', ''  )");
	$input6=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id6', '$up_tanggal', '$up_nomor', '$up_jumlah6a', 'Progres', '', ''  )");
	$input7=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id7', '$up_tanggal', '$up_nomor', '$up_jumlah7a', 'Progres', '', ''  )");
	$input8=mysql_query("INSERT INTO tb_permintaan VALUES('', '$barang_id8', '$up_tanggal', '$up_nomor', '$up_jumlah8a', 'Progres', '', ''  )");

	if ($input1) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Item Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Item Data Failed to Enter!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=item_up_view';
		} ,1000);	
	  	</script>
	<?php
	}
}
?>