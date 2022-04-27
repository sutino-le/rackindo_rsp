<?php
include "koneksi.php";

$pkwt_id = addslashes($_POST['pkwt_id']);
$pkwt_npk_lama = addslashes($_POST['pkwt_npk_lama']);
$pkwt_npk = addslashes($_POST['pkwt_npk']);
$pkwt_nomor = addslashes($_POST['pkwt_nomor']);
$pkwt_tanggal = addslashes($_POST['pkwt_tanggal']);
$pkwt_jenis = addslashes($_POST['pkwt_jenis']);
$pkwt_awal = addslashes($_POST['pkwt_awal']);
$pkwt_akhir = addslashes($_POST['pkwt_akhir']);
$pkwt_bagian = addslashes($_POST['pkwt_bagian']);
$pkwt_jabatan = addslashes($_POST['pkwt_jabatan']);

$cek_pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_id='$pkwt_id' ");
$v_cek_pkwt = mysql_fetch_array($cek_pkwt);

$cek_pkwt_npk = $v_cek_pkwt['pkwt_npk'];
$cek_pkwt_ktp = $v_cek_pkwt['pkwt_ktp'];

$update_pkwt = mysql_query("UPDATE pkwt SET pkwt_npk='$pkwt_npk', pkwt_nomor='$pkwt_nomor', pkwt_tanggal='$pkwt_tanggal', pkwt_jenis='$pkwt_jenis', pkwt_awal='$pkwt_awal', pkwt_akhir='$pkwt_akhir', pkwt_bagian='$pkwt_bagian', pkwt_jabatan='$pkwt_jabatan' WHERE pkwt_id='$pkwt_id' ");

if ($update_pkwt) {
    //Edit NPK karyawan 
    $karyawan = mysql_query("UPDATE karyawan SET karyawan_npk='$pkwt_npk', karyawan_jenis='$pkwt_jenis', karyawan_bagian='$pkwt_bagian', karyawan_jabatan='$pkwt_jabatan', karyawan_join='$pkwt_awal' WHERE karyawan_ktp='$cek_pkwt_ktp'   ");

    //Edit NPK User
    $user = mysql_query("UPDATE user SET user_npk='$pkwt_npk' WHERE user_ktp='$pkwt_ktp'   ");

    //Edit NPK Warning Letter
    // $warning_letter = mysql_query("UPDATE warning_letter SET wl_npk='$pkwt_npk' WHERE wl_npk='$pkwt_npk_lama'   ");

    //Edit NPK terminate
    // $terminate = mysql_query("UPDATE terminate SET terminate_npk='$pkwt_npk' WHERE terminate_npk='$pkwt_npk_lama'   ");

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Agreement Data Edit Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=career_history_view&karyawan_ktp=<?php echo $cek_pkwt_ktp; ?>';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Agreement data failed to Edit!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=career_history_view&karyawan_ktp=<?php echo $cek_pkwt_ktp; ?>';
}, 1000);
</script>
<?php
}

?>