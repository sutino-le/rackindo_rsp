<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_tahun_lama = addslashes($_POST['upah_tahun_lama']);
$upah_tahun = addslashes($_POST['upah_tahun']);
$upah_jumlah = addslashes($_POST['upah_jumlah']);
$upah_wilayah = addslashes($_POST['upah_wilayah']);

//input data upah 
$query_upah = mysql_query("UPDATE upah SET
    upah_tahun='$upah_tahun',
	upah_jumlah='$upah_jumlah',
	upah_wilayah='$upah_wilayah'
	WHERE 
	upah_tahun='$upah_tahun_lama'
");

if ($query_upah) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Upah Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=ump_view';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! upah data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=ump_edit&upah_tahun=<?php echo $upah_tahun_lama; ?>';
}, 1000);
</script>
<?php
}

?>