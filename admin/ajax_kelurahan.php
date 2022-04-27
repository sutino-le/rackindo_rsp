<?php
include("koneksi.php");
$kecamatan = $_GET['kecamatan'];
$query = mysql_query("SELECT * FROM data_wilayah WHERE kecamatan ='$kecamatan' ORDER BY kelurahan ASC");
echo "<select class='form-control' name='ktp_kelurahan' onchange='biodata_kodepos($(this).val())' required>";
echo "<option value='' selected>- Select Village -</option>";
while( $data = mysql_fetch_array( $query ) ){
	echo "<option value='".$data['kelurahan']."'>".$data['kelurahan']."</option>";
}
echo "</select>";
?>
