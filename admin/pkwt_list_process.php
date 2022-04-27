<?php
include "koneksi.php";


$tahun_sekarang = date("Y");

$pkwt_ktp = addslashes($_POST['pkwt_ktp']);
$pkwt_kategori = addslashes($_POST['pkwt_kategori']);
$pkwt_tanggal = addslashes($_POST['pkwt_tanggal']);
$pkwt_jenis = addslashes($_POST['pkwt_jenis']);
$pkwt_awal = addslashes($_POST['pkwt_awal']);
$pkwt_akhir = addslashes($_POST['pkwt_akhir']);
$pkwt_bagian = addslashes($_POST['pkwt_bagian']);
$pkwt_jabatan = addslashes($_POST['pkwt_jabatan']);

$periode_awal = date("Y-01-01", strtotime($pkwt_awal));
$periode_akhir = date("Y-12-31", strtotime($pkwt_awal));

//Cek NPK terakhir
$cek_pkwt_npk = mysql_query("SELECT * FROM pkwt WHERE pkwt_awal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY pkwt_id DESC");
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


$input_pkwt = mysql_query("INSERT INTO pkwt VALUES('', '$pkwt_ktp', '',  '$pkwt_nomor',  '$pkwt_tanggal',  '$pkwt_jenis',  '$pkwt_kategori',  'KUSNADI',  'PERSONALIA',  '$pkwt_awal',  '$pkwt_akhir',  '$pkwt_bagian',  '$pkwt_jabatan',  'Progres' ) ");

if ($input_pkwt) {

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Agreement Data Input Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=pkwt_list';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Agreement data failed to Input!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=pkwt_list';
}, 1000);
</script>
<?php
}

?>