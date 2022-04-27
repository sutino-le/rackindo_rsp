<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$karyawan_ktp = $_GET['karyawan_ktp'];
$tanggal_sekarang = date("Y-m-d");

$lihat_memo = mysql_query("SELECT * FROM memo ORDER BY memo_id DESC ");
$v_lihat_memo = mysql_fetch_array($lihat_memo);

if (date("Y", strtotime($tanggal_sekarang)) == date("Y", strtotime($v_lihat_memo['memo_tanggal']))) {
    $memo_no = $v_lihat_memo['memo_no'] + 1;
} else {
    $memo_no = 1;
}

//input memo
$query_memo = mysql_query("INSERT INTO memo VALUES (
    '',
	'$karyawan_ktp',
	'$memo_no',
	'$tanggal_sekarang'
)");

if ($query_memo) {
    $hasil_memo = mysql_query("SELECT * FROM memo WHERE memo_ktp='$karyawan_ktp' AND memo_tanggal='$tanggal_sekarang' ");
    $v_hasil_memo = mysql_fetch_array($hasil_memo);
    $memo_id = $v_hasil_memo['memo_id'];

?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Memo Data Edited Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'memo_print.php?memo_id=<?php echo $memo_id; ?>';
}, 1000);
</script>
<?php
}

?>