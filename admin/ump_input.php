<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_tahun = addslashes($_POST['upah_tahun']);
$upah_jumlah = addslashes($_POST['upah_jumlah']);
$upah_wilayah = addslashes($_POST['upah_wilayah']);

//input upah
$query_upah = mysql_query("INSERT INTO upah VALUES (
	'$upah_tahun',
	'$upah_jumlah',
	'$upah_wilayah'
)");

if ($query_upah) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Data upah berhasil diinput!',
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
        title: 'Oooopppsssss......!!!! Data upah gagal diinput!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=ump_view';
}, 1000);
</script>
<?php
}

?>