<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$pengalaman_id = addslashes($_POST['pengalaman_id']);
$pengalaman_ktp = addslashes($_POST['pengalaman_ktp']);
$pengalaman_awal = addslashes($_POST['pengalaman_awal']);
$pengalaman_akhir = addslashes($_POST['pengalaman_akhir']);
$pengalaman_status = addslashes($_POST['pengalaman_status']);
$pengalaman_bagian = addslashes($_POST['pengalaman_bagian']);
$pengalaman_perusahaan = addslashes($_POST['pengalaman_perusahaan']);
$pengalaman_deskripsi = addslashes($_POST['pengalaman_deskripsi']);
$pengalaman_keluar = addslashes($_POST['pengalaman_keluar']);

//input data pengalaman 
$query_pengalaman = mysql_query("UPDATE biodata_pengalaman SET
	pengalaman_awal='$pengalaman_awal',
	pengalaman_akhir='$pengalaman_akhir',
	pengalaman_status='$pengalaman_status',
	pengalaman_bagian='$pengalaman_bagian',
	pengalaman_perusahaan='$pengalaman_perusahaan',
	pengalaman_deskripsi='$pengalaman_deskripsi',
	pengalaman_keluar='$pengalaman_keluar'
	WHERE 
	pengalaman_id='$pengalaman_id'
");

if ($query_pengalaman) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Experience Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=experience_edit&ktp_nomor=<?php echo $pengalaman_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Experience data failed to edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=experience_edit&ktp_nomor=<?php echo $pengalaman_ktp; ?>';
}, 1000);
</script>
<?php
}

?>