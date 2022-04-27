<?php
include "koneksi.php";

$pkwt_npk = addslashes($_POST['pkwt_npk']);
$pkwt_ktp = addslashes($_POST['pkwt_ktp']);
$pkwt_jenis = addslashes($_POST['pkwt_jenis']);
$pkwt_pihak_satu = addslashes($_POST['pkwt_pihak_satu']);
$pkwt_pihak_satu_jabatan = addslashes($_POST['pkwt_pihak_satu_jabatan']);
$pkwt_awal = addslashes($_POST['pkwt_awal']);
$pkwt_bagian = addslashes($_POST['pkwt_bagian']);
$pkwt_jabatan = addslashes($_POST['pkwt_jabatan']);
$terminate_jenis = addslashes($_POST['terminate_jenis']);
$terminate_tanggal = addslashes($_POST['terminate_tanggal']);
$terminate_keterangan = addslashes($_POST['terminate_keterangan']);

$periode_awal = date("Y-01-01", strtotime($terminate_tanggal));
$periode_akhir = date("Y-12-31", strtotime($terminate_tanggal));

$query_terminate = mysql_query("SELECT * FROM terminate WHERE terminate_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY terminate_nomor DESC");
$hasil_terminate = mysql_fetch_array($query_terminate);

$tahun = date("Y", strtotime($hasil_terminate['terminate_tanggal']));
$tahun_terminate = date("Y", strtotime($terminate_tanggal));
if ($tahun == $tahun_terminate) {
  $nomor_terminate = $hasil_terminate['terminate_nomor'] + 1;
} else {
  $nomor_terminate = 1;
}

$query_pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY pkwt_nomor DESC");
$hasil_pkwt = mysql_fetch_array($query_pkwt);

$tahun_pkwt = date("Y", strtotime($hasil_pkwt['pkwt_tanggal']));
if ($tahun == $tahun_pkwt) {
  $nomor_pkwt = $hasil_pkwt['pkwt_nomor'] + 1;
} else {
  $nomor_pkwt = 1;
}

$pkwt_tetap = mysql_query("SELECT * FROM pkwt WHERE pkwt_npk='$pkwt_npk' ORDER BY pkwt_id DESC");
$v_pkwt_tetap = mysql_fetch_array($pkwt_tetap);
if ($v_pkwt_tetap['pkwt_jenis'] == "Permanent") {
  $update_tanggal_tetap = $terminate_tanggal;
  $update_id_pkwt_tetap = $v_pkwt_tetap['pkwt_id'];
} else {
  $update_tanggal_tetap = $v_pkwt_tetap['pkwt_akhir'];
  $update_id_pkwt_tetap = $v_pkwt_tetap['pkwt_id'];
}


$terminate = mysql_query("INSERT INTO terminate VALUES ('$pkwt_npk', '$nomor_terminate', '$terminate_jenis', '$terminate_tanggal',	'$terminate_keterangan')");

if ($terminate) {
  //input data ktp 
  $pkwt = mysql_query("INSERT INTO pkwt VALUES (
        '',
        '$pkwt_ktp',
        '$pkwt_npk',
        '$nomor_terminate',
        '$terminate_tanggal',
        '$pkwt_jenis',
        'Terminate',
        '$pkwt_pihak_satu',
        '$pkwt_pihak_satu_jabatan',
        '$pkwt_awal',
        '$terminate_tanggal',
        '$pkwt_bagian',
        '$pkwt_jabatan',
        'Oke'
     )");

  $karyawan = mysql_query("UPDATE karyawan SET karyawan_status='Keluar', karyawan_terminate='$terminate_tanggal' WHERE karyawan_ktp='$pkwt_ktp' ");

  $update_pkwt_tetap = mysql_query("UPDATE pkwt SET pkwt_akhir='$terminate_tanggal' WHERE pkwt_id='$$update_id_pkwt_tetap' ");

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Terminate Data Input Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=career_history_view&karyawan_ktp=<?php echo $pkwt_ktp; ?>';
}, 1000);
</script>
<?php
} else {
  //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Terminate data failed to enter!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=career_history_view&karyawan_ktp=<?php echo $pkwt_ktp; ?>';
}, 1000);
</script>
<?php
}

?>