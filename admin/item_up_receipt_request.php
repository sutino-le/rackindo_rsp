<?php 
include"koneksi.php";
$permintaan_id=$_GET['permintaan_id'];

$query_permintaan=mysql_query("SELECT * FROM tb_permintaan JOIN tb_barang ON tb_permintaan.permintaan_idbarang=tb_barang.barang_id WHERE tb_permintaan.permintaan_id='$permintaan_id' ");
$data_permintaan=mysql_fetch_array($query_permintaan);

$permintaan_idbarang=$data_permintaan['permintaan_idbarang'];
$barang_nama=$data_permintaan['barang_nama'];
$permintaan_tanggal=$data_permintaan['permintaan_tanggal'];
$permintaan_nomor=$data_permintaan['permintaan_nomor'];
$permintaan_jumlah=$data_permintaan['permintaan_jumlah'];


$uqery_up_barang=mysql_query("SELECT * FROM tb_permintaan JOIN tb_barang ON tb_permintaan.permintaan_idbarang=tb_barang.barang_id WHERE tb_permintaan.permintaan_nomor='$permintaan_nomor' AND  tb_permintaan.permintaan_tanggal='$permintaan_tanggal' ");
$uqery_up_jumlah=mysql_query("SELECT * FROM tb_permintaan JOIN tb_barang ON tb_permintaan.permintaan_idbarang=tb_barang.barang_id WHERE tb_permintaan.permintaan_nomor='$permintaan_nomor' AND  tb_permintaan.permintaan_tanggal='$permintaan_tanggal' ");
?>
<center>
	<b>PERMINTAAN ATK</b><br>
	No : <?php echo $permintaan_nomor; ?>/PATK/RSP/<?php echo date("m", strtotime($permintaan_tanggal)); ?>/<?php echo date("Y", strtotime($permintaan_tanggal)); ?>
</center>
<br>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center"><b>No</b></td>
		<td align="center"><b>Nama Barang</b></td>
		<td align="center"><b>Jumlah</b></td>
		<td align="center"><b>Satuan</b></td>
		<td align="center"><b>Ketarangan</b></td>
	</tr>
	<?php
		$no=1;
		while($hasil_barang=mysql_fetch_array($uqery_up_barang)){
	?>
	<tr>
		<td align="center"><?php echo $no; ?></td>
		<td><?php echo $hasil_barang['barang_nama']; ?></td>
		<td align="center"><?php echo $hasil_barang['permintaan_jumlah']; ?></td>
		<?php
			if($hasil_barang['permintaan_jumlah']>1){
				$satuan="Pcs";
			} else {
				$satuan="Pc";
			}
		?>
		<td align="center"><?php echo $satuan; ?></td>
		<td></td>
	</tr>
	<?php
		$no++;
		}
	?>
</table>
<br>
<table width="100%">
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center">Mengetahui</td>
		<td align="center"></td>
		<td align="center">Menyetujui</td>
	</tr>
	<tr>
		<td align="center"><br><br><br><br></td>
		<td align="center"></td>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center">Puji Astuti</td>
		<td align="center"></td>
		<td align="center">Ibu Merriana</td>
	</tr>
</table>