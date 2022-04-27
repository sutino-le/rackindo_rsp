<?php
include "koneksi.php";


$tahun_sekarang = date("Y");

$pkwt_id = addslashes($_POST['pkwt_id']);
$karyawan_kategori = addslashes($_POST['karyawan_kategori']);
$karyawan_finger = addslashes($_POST['karyawan_finger']);

$pkwt_cek = mysql_query("SELECT * FROM pkwt WHERE pkwt_id='$pkwt_id' ");
$v_pkwt_cek = mysql_fetch_array($pkwt_cek);
$pkwt_awal = $v_pkwt_cek['pkwt_awal'];
$pkwt_ktp = $v_pkwt_cek['pkwt_ktp'];
$pkwt_jenis = $v_pkwt_cek['pkwt_jenis'];
$pkwt_bagian = $v_pkwt_cek['pkwt_bagian'];
$pkwt_jabatan = $v_pkwt_cek['pkwt_jabatan'];

$periode_awal = date("Y-01-01", strtotime($pkwt_awal));
$periode_akhir = date("Y-12-31", strtotime($pkwt_awal));

//Cek NPK terakhir
$cek_pkwt_npk = mysql_query("SELECT * FROM pkwt WHERE pkwt_awal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY pkwt_npk DESC");
$v_cek_pkwt_npk = mysql_fetch_array($cek_pkwt_npk);

$hasil_npk = $v_cek_pkwt_npk['pkwt_npk'];
$hasil_npk_tanggal = $v_cek_pkwt_npk['pkwt_tanggal'];

if (date("Y", strtotime($pkwt_awal)) == date("Y", strtotime($hasil_npk_tanggal))) {
    $pkwt_npk = $hasil_npk + 1;
} else {
    $pkwt_npk = date("y", strtotime($pkwt_awal)) . "0001";
}



//Cek Nomor terakhir
$cek_pkwt_nomor = mysql_query("SELECT * FROM pkwt WHERE pkwt_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY pkwt_id DESC");
$v_cek_pkwt_nomor = mysql_fetch_array($cek_pkwt_nomor);

$hasil_nomor = $v_cek_pkwt_nomor['pkwt_nomor'];
$hasil_nomor_tanggal = $v_cek_pkwt_nomor['pkwt_tanggal'];

if (date("Y", strtotime($pkwt_awal)) == date("Y", strtotime($hasil_nomor_tanggal))) {
    $pkwt_nomor = $hasil_nomor + 1;
} else {
    $pkwt_nomor = 1;
}

$update_pkwt = mysql_query("UPDATE pkwt SET pkwt_npk='$pkwt_npk', pkwt_nomor='$pkwt_nomor', pkwt_status='Oke' WHERE pkwt_id='$pkwt_id' ");


if ($update_pkwt) {

    $input_karyawan = mysql_query("INSERT INTO karyawan VALUES('$pkwt_npk', '$pkwt_ktp', '$karyawan_kategori', '$pkwt_jenis', '$pkwt_bagian', '$pkwt_jabatan', '$pkwt_awal', '', 'Aktif', '$karyawan_finger', '', '', ''  ) ");

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Agreement Data Approve Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=pkwt_data';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Agreement data failed to Approve!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=pkwt_data';
}, 1000);
</script>
<?php
}

?>