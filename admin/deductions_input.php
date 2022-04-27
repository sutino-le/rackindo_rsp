<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$upah_pot_ktp = addslashes($_POST['upah_pot_ktp']);
$upah_pot_tanggal = addslashes($_POST['upah_pot_tanggal']);
$upah_pot_jumlah = addslashes($_POST['upah_pot_jumlah']);

$cek_upah_potongan_jam = mysql_query("SELECT * FROM upah_potongan_jam WHERE upah_pot_ktp='$upah_pot_ktp' AND upah_pot_tanggal='$upah_pot_tanggal' ");
$v_upah_potongan_jam = mysql_fetch_array($cek_upah_potongan_jam);
$upah_pot_id = $v_upah_potongan_jam['upah_pot_id'];

if (empty($upah_pot_id)) {

    //input upah_potongan_jam
    $upah_potongan_jam = mysql_query("INSERT INTO upah_potongan_jam VALUES (
    '',
	'$upah_pot_ktp',
	'$upah_pot_tanggal',
	'$upah_pot_jumlah'
)");
} else {
    //edit upah_potongan_jam
    $upah_potongan_jam = mysql_query("UPDATE upah_potongan_jam SET
	upah_pot_tanggal='$upah_pot_tanggal',
	upah_pot_jumlah='$upah_pot_jumlah'
WHERE upah_pot_id='$upah_pot_id' ");
}

if ($upah_potongan_jam) {


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Deductions Entered Successfully!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=deductions';
}, 1000);
</script>
<?php
} else {
    //Jika Gagal
?>

<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Deductions Input Failed!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=deductions';
}, 1000);
</script>
<?php
}

?>