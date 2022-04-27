<?php
include("koneksi.php");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Keluar-Masuk Barang.xls");

$query_barang = mysql_query("SELECT * FROM tb_barang ORDER BY barang_nama ASC");
?>
<center>
    <h3>Rekapan Keluar - Masuk Barang</h3>
</center>
<table border="1" width="100%" cellpadding="0" cellspacing="0">
    <thead>
        <tr align="center">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Barang Masuk</th>
            <th>Barang Keluar</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $stock = 0;
        while ($row_barang = mysql_fetch_array($query_barang)) {
            $id_barang = $row_barang['barang_id'];
            $nama_barang = $row_barang['barang_nama']; {
        ?>
        <tr>
            <td align="center"><?php echo $no++; ?></td>
            <td><?php echo $nama_barang; ?></td>

            <?php
                    // barang masuk
                    $query_masuk = mysql_query("SELECT SUM(masuk_jumlah) as jumlah_masuk FROM tb_masuk WHERE masuk_idbarang='$id_barang' ");
                    $row_masuk = mysql_fetch_array($query_masuk);
                    ?>
            <td align="center"><?php echo number_format($row_masuk['jumlah_masuk'], 0, ",", "."); ?></td>

            <?php
                    // barang keluar
                    $query_keluar = mysql_query("SELECT SUM(keluar_jumlah) as jumlah_keluar FROM tb_keluar WHERE keluar_idbarang='$id_barang' ");
                    $row_keluar = mysql_fetch_array($query_keluar);

                    // stok
                    $stock = ($row_masuk['jumlah_masuk'] - $row_keluar['jumlah_keluar']);

                    ?>
            <td align="center"><?php echo number_format($row_keluar['jumlah_keluar'], 0, ",", "."); ?></td>
            <td align="center"><?php echo number_format($stock, 0, ",", "."); ?></td>
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>