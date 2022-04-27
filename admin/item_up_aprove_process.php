
<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$permintaan_id=addslashes($_POST['permintaan_id']);
$masuk_jumlah=addslashes($_POST['masuk_jumlah']);
$masuk_tanggal=addslashes($_POST['masuk_tanggal']);
$permintaan_tanda_terima=addslashes($_POST['permintaan_tanda_terima']);
$masuk_deskripsi=addslashes($_POST['masuk_deskripsi']);


$query_permintaan=mysql_query("SELECT * FROM tb_permintaan WHERE permintaan_id='$permintaan_id' ");
$data_permintaan=mysql_fetch_array($query_permintaan);

$permintaan_idbarang=$data_permintaan['permintaan_idbarang'];
$permintaan_tanggal=$data_permintaan['permintaan_tanggal'];


$target_dir = "tt_permintaan/";
$target_file = $target_dir . basename($_FILES["permintaan_tanda_terima"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["permintaan_tanda_terima"]["tmp_name"]);
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
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["permintaan_tanda_terima"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
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
  if (move_uploaded_file($_FILES["permintaan_tanda_terima"]["tmp_name"], $target_file)) {
  	$foto=$_FILES["permintaan_tanda_terima"]["name"];
    //input data ktp 
	$query_permintaan=mysql_query("UPDATE tb_permintaan SET 
		permintaan_status='Sudah Diterima',
		permintaan_aprove_tanggal='$masuk_tanggal',
		permintaan_aprove_foto='$foto'
		WHERE permintaan_id='$permintaan_id'
	 ");
	
	if ($query_permintaan) {
		$query_masuk=mysql_query("INSERT INTO tb_masuk VALUES (
		'',
		'$permintaan_idbarang',
		'$permintaan_id',
		'$permintaan_tanggal',
		'$masuk_tanggal',
		'$masuk_jumlah',
		'$masuk_deskripsi'
	 )");
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'The data request has been completed!',
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
				title: 'Oooopppsssss......!!!! The request data is not finished yet!s',
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
  } else {
  	?>
		
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! The request data is not finished yet!s',
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