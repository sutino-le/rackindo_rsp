<?php
include("koneksi.php");

$gs_duration=addslashes($_POST['gs_duration']);
$gs_code=addslashes($_POST['gs_code']);
$gs_nama=addslashes($_POST['gs_nama']);


if ($gs_duration==7) {
	$durasi1=1;
	$durasi2=2;
	$durasi3=3;
	$durasi4=4;
	$durasi5=5;
	$durasi6=6;
	$durasi7=7;
	$gs_type1=$_POST['gs_type1'];
	$gs_type2=$_POST['gs_type2'];
	$gs_type3=$_POST['gs_type3'];
	$gs_type4=$_POST['gs_type4'];
	$gs_type5=$_POST['gs_type5'];
	$gs_type6=$_POST['gs_type6'];
	$gs_type7=$_POST['gs_type7'];

    
    $input1=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi1', '$gs_type1' )");
    $input2=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi2', '$gs_type2' )");
    $input3=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi3', '$gs_type3' )");
    $input4=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi4', '$gs_type4' )");
    $input5=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi5', '$gs_type5' )");
    $input6=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi6', '$gs_type6' )");
    $input7=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi7', '$gs_type7' )");

	if ($input7) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Application Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=group_schedule_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Application Data Input Failed!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=group_schedule_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($gs_duration==14) {
	$durasi1=1;
	$durasi2=2;
	$durasi3=3;
	$durasi4=4;
	$durasi5=5;
	$durasi6=6;
	$durasi7=7;
	$durasi8=8;
	$durasi9=9;
	$durasi10=10;
	$durasi11=11;
	$durasi12=12;
	$durasi13=13;
	$durasi14=14;
	$gs_type1=$_POST['gs_type1'];
	$gs_type2=$_POST['gs_type2'];
	$gs_type3=$_POST['gs_type3'];
	$gs_type4=$_POST['gs_type4'];
	$gs_type5=$_POST['gs_type5'];
	$gs_type6=$_POST['gs_type6'];
	$gs_type7=$_POST['gs_type7'];
	$gs_type8=$_POST['gs_type8'];
	$gs_type9=$_POST['gs_type9'];
	$gs_type10=$_POST['gs_type10'];
	$gs_type11=$_POST['gs_type11'];
	$gs_type12=$_POST['gs_type12'];
	$gs_type13=$_POST['gs_type13'];
	$gs_type14=$_POST['gs_type14'];

    
    $input1=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi1', '$gs_type1' )");
    $input2=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi2', '$gs_type2' )");
    $input3=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi3', '$gs_type3' )");
    $input4=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi4', '$gs_type4' )");
    $input5=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi5', '$gs_type5' )");
    $input6=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi6', '$gs_type6' )");
    $input7=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi7', '$gs_type7' )");
    $input8=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi8', '$gs_type8' )");
    $input9=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi9', '$gs_type9' )");
    $input10=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi10', '$gs_type10' )");
    $input11=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi11', '$gs_type11' )");
    $input12=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi12', '$gs_type12' )");
    $input13=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi13', '$gs_type13' )");
    $input14=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi14', '$gs_type14' )");

	if ($input14) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Application Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=group_schedule_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Application Data Input Failed!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=group_schedule_view';
		} ,1000);	
	  	</script>
	<?php
	}
} else if ($gs_duration==28) {
	$durasi1=1;
	$durasi2=2;
	$durasi3=3;
	$durasi4=4;
	$durasi5=5;
	$durasi6=6;
	$durasi7=7;
	$durasi8=8;
	$durasi9=9;
	$durasi10=10;
	$durasi11=11;
	$durasi12=12;
	$durasi13=13;
	$durasi14=14;
	$durasi15=15;
	$durasi16=16;
	$durasi17=17;
	$durasi18=18;
	$durasi19=19;
	$durasi20=20;
	$durasi21=21;
	$durasi22=22;
	$durasi23=23;
	$durasi24=24;
	$durasi25=25;
	$durasi26=26;
	$durasi27=27;
	$durasi28=28;
	$gs_type1=$_POST['gs_type1'];
	$gs_type2=$_POST['gs_type2'];
	$gs_type3=$_POST['gs_type3'];
	$gs_type4=$_POST['gs_type4'];
	$gs_type5=$_POST['gs_type5'];
	$gs_type6=$_POST['gs_type6'];
	$gs_type7=$_POST['gs_type7'];
	$gs_type8=$_POST['gs_type8'];
	$gs_type9=$_POST['gs_type9'];
	$gs_type10=$_POST['gs_type10'];
	$gs_type11=$_POST['gs_type11'];
	$gs_type12=$_POST['gs_type12'];
	$gs_type13=$_POST['gs_type13'];
	$gs_type14=$_POST['gs_type14'];
	$gs_type15=$_POST['gs_type15'];
	$gs_type16=$_POST['gs_type16'];
	$gs_type17=$_POST['gs_type17'];
	$gs_type18=$_POST['gs_type18'];
	$gs_type19=$_POST['gs_type19'];
	$gs_type20=$_POST['gs_type20'];
	$gs_type21=$_POST['gs_type21'];
	$gs_type22=$_POST['gs_type22'];
	$gs_type23=$_POST['gs_type23'];
	$gs_type24=$_POST['gs_type24'];
	$gs_type25=$_POST['gs_type25'];
	$gs_type26=$_POST['gs_type26'];
	$gs_type27=$_POST['gs_type27'];
	$gs_type28=$_POST['gs_type28'];

    $input1=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi1', '$gs_type1' )");
    $input2=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi2', '$gs_type2' )");
    $input3=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi3', '$gs_type3' )");
    $input4=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi4', '$gs_type4' )");
    $input5=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi5', '$gs_type5' )");
    $input6=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi6', '$gs_type6' )");
    $input7=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi7', '$gs_type7' )");
    $input8=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi8', '$gs_type8' )");
    $input9=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi9', '$gs_type9' )");
    $input10=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi10', '$gs_type10' )");
    $input11=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi11', '$gs_type11' )");
    $input12=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi12', '$gs_type12' )");
    $input13=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi13', '$gs_type13' )");
    $input14=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi14', '$gs_type14' )");
    $input15=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi15', '$gs_type15' )");
    $input16=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi16', '$gs_type16' )");
    $input17=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi17', '$gs_type17' )");
    $input18=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi18', '$gs_type18' )");
    $input19=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi19', '$gs_type19' )");
    $input20=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi20', '$gs_type20' )");
    $input21=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi21', '$gs_type21' )");
    $input22=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi22', '$gs_type22' )");
    $input23=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi23', '$gs_type23' )");
    $input24=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi24', '$gs_type24' )");
    $input25=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi25', '$gs_type25' )");
    $input26=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi26', '$gs_type26' )");
    $input27=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi27', '$gs_type27' )");
    $input28=mysql_query("INSERT INTO group_schedule VALUES('', '$gs_code', '$gs_nama', '$durasi28', '$gs_type28' )");

	if ($input28) {
	?>
	<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Application Data Entered Successfully!',
				type: 'success',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=group_schedule_view';
		} ,1000);	
	  	</script>
	<?php
	}else{
	?>
		<script type='text/javascript'>
		setTimeout(function () { 	
			swal({
				title: 'Oooopppsssss......!!!! Application Data Input Failed!',
				type: 'error',
				timer: 1000,
				showConfirmButton: true
			});		
		},10);	
		window.setTimeout(function(){ 
			document.location='home_admin.php?page=group_schedule_view';
		} ,1000);	
	  	</script>
	<?php
	}
}