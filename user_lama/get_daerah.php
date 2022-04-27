<?php
include 'koneksi.php';

$data = $_POST['data'];
$id = $_POST['id'];

$n = strlen($id);
$m = ($n == 2 ? 5 : ($n == 5 ? 8 : 13));
// $wil=($n==2?'Kota/Kab':($n==5?'Kecamatan':'Desa/Kelurahan'));
?>
<?php
if ($data == "kabupaten") {
?>
Kabupaten/Kota
<select class="form-control" id="form_kab" required>
    <option value="">Pilih Kabupaten/Kota</option>
    <?php
		$daerah = mysql_query("SELECT kode,nama FROM wilayah WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");

		while ($d = mysql_fetch_array($daerah)) {
		?>
    <option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
    <?php
		}
		?>
</select>

<?php
} else if ($data == "kecamatan") {
?>
<select class="form-control" id="form_kec" required>
    <option value="">Pilih Kecamatan</option>
    <?php
		$daerah = mysql_query("SELECT kode,nama FROM wilayah WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");

		while ($d = mysql_fetch_array($daerah)) {
		?>
    <option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
    <?php
		}
		?>
</select>

<?php
} else if ($data == "desa") {
?>

<select class="form-control" id="form_kel" required>
    <option value="">Pilih Desa</option>
    <?php
		$daerah = mysql_query("SELECT kode,nama FROM wilayah WHERE LEFT(kode,'$n')='$id' AND CHAR_LENGTH(kode)=$m ORDER BY nama");
		while ($d = mysql_fetch_array($daerah)) {
		?>
    <option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
    <?php
		}
		?>
</select>

<?php

}
?>