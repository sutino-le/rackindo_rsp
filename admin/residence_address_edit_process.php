<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$domisili_ktp = addslashes($_POST['domisili_ktp']);
$domisili_alamat = addslashes($_POST['domisili_alamat']);
$domisili_rt = addslashes($_POST['domisili_rt']);
$domisili_rw = addslashes($_POST['domisili_rw']);
$domisili_kelurahan = addslashes($_POST['ktp_kelurahan']);
$domisili_kecamatan = addslashes($_POST['ktp_kecamatan']);
$domisili_kabupaten = addslashes($_POST['ktp_kabupaten']);
$domisili_propinsi = addslashes($_POST['ktp_propinsi']);
$domisili_kodepos = addslashes($_POST['ktp_kodepos']);

$query_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$domisili_ktp' ");
$hasil = mysql_fetch_array($query_domisili);
if (empty($hasil)) {
    $query_domisili = mysql_query("INSERT INTO biodata_domisili VALUES('$domisili_ktp', '$domisili_alamat', '$domisili_rt', '$domisili_rw', '$domisili_kelurahan', '$domisili_kecamatan', '$domisili_kabupaten', '$domisili_propinsi', '$domisili_kodepos')");
} else {
    //input data domisili 
    $query_domisili = mysql_query("UPDATE biodata_domisili SET
	domisili_alamat='$domisili_alamat',
	domisili_rt='$domisili_rt',
	domisili_rw='$domisili_rw',
	domisili_kelurahan='$domisili_kelurahan',
	domisili_kecamatan='$domisili_kecamatan',
	domisili_kabupaten='$domisili_kabupaten',
	domisili_propinsi='$domisili_propinsi',
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