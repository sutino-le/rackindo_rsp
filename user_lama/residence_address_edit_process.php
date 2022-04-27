<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$domisili_ktp = addslashes($_POST['domisili_ktp']);
$domisili_alamat = addslashes($_POST['domisili_alamat']);
$domisili_rt = addslashes($_POST['domisili_rt']);
$domisili_rw = addslashes($_POST['domisili_rw']);
$domisili_kelurahan = addslashes($_POST['domisili_kelurahan']);
$domisili_kecamatan = addslashes($_POST['domisili_kecamatan']);
$domisili_kabupaten = addslashes($_POST['domisili_kabupaten']);
$domisili_propinsi = addslashes($_POST['domisili_propinsi']);
$domisili_kodepos = addslashes($_POST['domisili_kodepos']);

//propinsi
$v_propinsi = mysql_query("SELECT * FROM wilayah WHERE kode='$domisili_propinsi' ");
$h_propinsi = mysql_fetch_array($v_propinsi);
$propinsi = ucwords(strtolower($h_propinsi['nama']));

//kabupaten
$v_kabupaten = mysql_query("SELECT * FROM wilayah WHERE kode='$domisili_kabupaten' ");
$h_kabupaten = mysql_fetch_array($v_kabupaten);
$kabupaten = ucwords(strtolower($h_kabupaten['nama']));

//kecamatan
$v_kecamatan = mysql_query("SELECT * FROM wilayah WHERE kode='$domisili_kecamatan' ");
$h_kecamatan = mysql_fetch_array($v_kecamatan);
$kecamatan = ucwords(strtolower($h_kecamatan['nama']));

//kelurahan
$v_kelurahan = mysql_query("SELECT * FROM wilayah WHERE kode='$domisili_kelurahan' ");
$h_kelurahan = mysql_fetch_array($v_kelurahan);
$kelurahan = ucwords(strtolower($h_kelurahan['nama']));





$query_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$domisili_ktp' ");
$hasil = mysql_fetch_array($query_domisili);
if (empty($hasil)) {
    $query_domisili = mysql_query("INSERT INTO biodata_domisili VALUES('$domisili_ktp', '$domisili_alamat', '$domisili_rt', '$domisili_rw', '$kelurahan', '$kecamatan', '$kabupaten', '$propinsi', '$domisili_kodepos')");
} else {
    //input data domisili 
    $query_domisili = mysql_query("UPDATE biodata_domisili SET
	domisili_alamat='$domisili_alamat',
	domisili_rt='$domisili_rt',
	domisili_rw='$domisili_rw',
	domisili_kelurahan='$kelurahan',
	domisili_kecamatan='$kecamatan',
	domisili_kabupaten='$kabupaten',
	domisili_propinsi='$propinsi',
	domisili_kodepos='$domisili_kodepos'
	WHERE 
	domisili_ktp='$domisili_ktp'
");
}

if ($query_domisili) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Residence Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=education_edit&ktp_nomor=<?php echo $domisili_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Residence data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?pageresidence_address_edit&ktp_nomor=<?php echo $domisili_ktp; ?>';
}, 1000);
</script>
<?php
}

?>