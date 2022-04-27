<?php
include("koneksi.php");
$propinsi = $_GET['propinsi'];
$query = mysql_query("SELECT * FROM data_wilayah WHERE propinsi ='$propinsi' GROUP BY kota_kabupaten ASC ");
echo "<select class='form-control' name='ktp_kabupaten'  onchange='biodata_kecamatan($(this).val())'  required>";
echo "<option value='' selected>- Select City -</option>";
while( $data = mysql_fetch_array( $query ) ){
	echo "<option value='".$data['kota_kabupaten']."'>".$data['kota_kabupaten']."</option>";
}
echo "</select>";