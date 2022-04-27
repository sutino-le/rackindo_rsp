
<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$barang_id=addslashes($_POST['barang_id']);
$barang_nama=addslashes($_POST['barang_nama']);
$barang_barcode=addslashes($_POST['barang_barcode']);
$barang_harga=addslashes($_POST['barang_harga']);
$barang_satuan=addslashes($_POST['barang_satuan']);
$barang_detail=addslashes($_POST['barang_detail']);
$barang_foto=addslashes($_POST['barang_foto']);

if(empty($_FILES["barang_foto"]["name"])){
	$query_barang=mysql_query("UPDATE tb_barang SET barang_nama='$barang_nama',	barang_barcode='$barang_barcode', barang_harga='$barang_harga',	barang_satuan='$barang_satuan',	barang_detail='$barang_detail' WHERE barang_id='$barang_id' ");

	if ($query_barang) {
		?>
		<script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Data Barang Berhasil Diedit!',
					type: 'success',
					timer: 1000,
					showConfirmButton: true
				});		
			},10);	
			window.setTimeout(function(){ 
				document.location='home_sir.php?page=barang_lihat';
			} ,1000);	
		  	</script>
		<?php
		}else{
		?>
			<script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Oooopppsssss......!!!! Data Barang Gagal Diedit!',
					type: 'error',
					timer: 1000,
					showConfirmButton: true
				});		
			},10);	
			window.setTimeout(function(){ 
				document.location='home_sir.php?page=barang_lihat';
			} ,1000);	
		  	</script>
		<?php
		}

} else{
	$target_dir = "gambar/";
	$target_file = $target_dir . basename($_FILES["barang_foto"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	  $check = getimagesize($_FILES["barang_foto"]["tmp_name"]);
	  if($check !== false) {
	    echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	  } else {
	    echo "File is not an image.";
	    $uploadOk = 0;
	  }
	}


	// Check if file already exists
	if (file_exists($target_file)) {
	  
		?>
		<script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Data Barang Berhasil Diedit!',
					type: 'success',
					timer: 1000,
					showConfirmButton: true
				});		
			},10);	
			window.setTimeout(function(){ 
				document.location='home_sir.php?page=barang_lihat';
			} ,1000);	
		  	</script>
		<?php
	  $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["barang_foto"]["size"] > 500000) {
	  
		?>
		<script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Data Barang Berhasil Diedit!',
					type: 'success',
					timer: 1000,
					showConfirmButton: true
				});		
			},10);	
			window.setTimeout(function(){ 
				document.location='home_sir.php?page=barang_lihat';
			} ,1000);	
		  	</script>
		<?php
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file(filename)
	} else {
	  	if (move_uploaded_file($_FILES["barang_foto"]["tmp_name"], $target_file)) {
		  	$foto=$_FILES["barang_foto"]["name"];
		    //input data ktp 
			$query_barang=mysql_query("UPDATE tb_barang SET barang_nama='$barang_nama',	barang_barcode='$barang_barcode', barang_harga='$barang_harga',	barang_satuan='$barang_satuan',	barang_detail='$barang_detail',	barang_foto='$foto' WHERE barang_id='$barang_id' ");
			
			if ($query_barang) {
			?>
			<script type='text/javascript'>
				setTimeout(function () { 	
					swal({
						title: 'Data Barang Berhasil Diedit!',
						type: 'success',
						timer: 1000,
						showConfirmButton: true
					});		
				},10);	
				window.setTimeout(function(){ 
					document.location='home_sir.php?page=barang_lihat';
				} ,1000);	
			  	</script>
			<?php
		}else{
			?>
				<script type='text/javascript'>
				setTimeout(function () { 	
					swal({
						title: 'Oooopppsssss......!!!! Data Barang Gagal Diedit!',
						type: 'error',
						timer: 1000,
						showConfirmButton: true
					});		
				},10);	
				window.setTimeout(function(){ 
					document.location='home_sir.php?page=barang_lihat';
				} ,1000);	
			  	</script>
			<?php
			}
		}
	}
}
?>