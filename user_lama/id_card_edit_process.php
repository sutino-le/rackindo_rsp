<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$ktp_nomor = addslashes($_POST['ktp_nomor']);
$ktp_nama = addslashes($_POST['ktp_nama']);
$ktp_tempat_lahir = addslashes($_POST['ktp_tempat_lahir']);
$ktp_tanggal_lahir = addslashes($_POST['ktp_tanggal_lahir']);
$ktp_kelamin = addslashes($_POST['ktp_kelamin']);
$ktp_gol_darah = addslashes($_POST['ktp_gol_darah']);
$ktp_alamat = addslashes($_POST['ktp_alamat']);
$ktp_rt = addslashes($_POST['ktp_rt']);
$ktp_rw = addslashes($_POST['ktp_rw']);
$ktp_kelurahan = addslashes($_POST['ktp_kelurahan']);
$ktp_kecamatan = addslashes($_POST['ktp_kecamatan']);
$ktp_kabupaten = addslashes($_POST['ktp_kabupaten']);
$ktp_propinsi = addslashes($_POST['ktp_propinsi']);
$ktp_kodepos = addslashes($_POST['ktp_kodepos']);
$ktp_agama = addslashes($_POST['ktp_agama']);
$ktp_status = addslashes($_POST['ktp_status']);
$ktp_kewarganegaraan = addslashes($_POST['ktp_kewarganegaraan']);

//propinsi
$v_propinsi = mysql_query("SELECT * FROM wilayah WHERE kode='$ktp_propinsi' ");
$h_propinsi = mysql_fetch_array($v_propinsi);
$propinsi = ucwords(strtolower($h_propinsi['nama']));

//kabupaten
$v_kabupaten = mysql_query("SELECT * FROM wilayah WHERE kode='$ktp_kabupaten' ");
$h_kabupaten = mysql_fetch_array($v_kabupaten);
$kabupaten = ucwords(strtolower($h_kabupaten['nama']));

//kecamatan
$v_kecamatan = mysql_query("SELECT * FROM wilayah WHERE kode='$ktp_kecamatan' ");
$h_kecamatan = mysql_fetch_array($v_kecamatan);
$kecamatan = ucwords(strtolower($h_kecamatan['nama']));

//kelurahan
$v_kelurahan = mysql_query("SELECT * FROM wilayah WHERE kode='$ktp_kelurahan' ");
$h_kelurahan = mysql_fetch_array($v_kelurahan);
$kelurahan = ucwords(strtolower($h_kelurahan['nama']));

//input data ktp 
$query_ktp = mysql_query("UPDATE biodata_ktp SET
	ktp_nama='$ktp_nama',
	ktp_tempat_lahir='$ktp_tempat_lahir',
	ktp_tanggal_lahir='$ktp_tanggal_lahir',
	ktp_kelamin='$ktp_kelamin',
	ktp_gol_darah='$ktp_gol_darah',
	ktp_alamat='$ktp_alamat',
	ktp_rt='$ktp_rt',
	ktp_rw='$ktp_rw',
	ktp_kelurahan='$kelurahan',
	ktp_kecamatan='$kecamatan',
	ktp_kabupaten='$kabupaten',
	ktp_propinsi='$propinsi',
	ktp_kodepos='$ktp_kodepos',
	ktp_agama='$ktp_agama',
	ktp_status='$ktp_status',
	ktp_kewarganegaraan='$ktp_kewarganegaraan'
	WHERE 
	ktp_nomor='$ktp_nomor'
");

if ($query_ktp) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'ID Card Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=residence_address_edit&ktp_nomor=<?php echo $ktp_nomor; ?>';
}, 1000);
</script>
<?php
} else {
	//Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! ID card data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=id_card_edit&ktp_nomor=<?php echo $ktp_nomor; ?>';
}, 1000);
</script>
<?php
}

?>