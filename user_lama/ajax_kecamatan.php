<?php
include("koneksi.php");
$kota_kabupaten = $_GET['kota_kabupaten'];
$query = mysql_query("SELECT * FROM data_wilayah WHERE kota_kabupaten ='$kota_kabupaten' GROUP BY kecamatan ASC ");
echo "<select class='form-control' name='ktp_kecamatan' onchange='biodata_kelurahan($(this).val())'  required>";
echo "<option value='' selected>- Select District -</option>";
while( $data = mysql_fetch_array( $query ) ){
	echo "<option value='".$data['kecamatan']."'>".$data['kecamatan']."</option>";
}
echo "</select>";
?>
