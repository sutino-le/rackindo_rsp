<?php
$query_pemakaian = mysql_query("SELECT * FROM tb_keluar JOIN tb_barang ON tb_keluar.keluar_idbarang=tb_barang.barang_id WHERE tb_keluar.keluar_user='$ktp_nama' ");
?>

<div class="card">

    <div class="card-header">


        <div class="row">
            <div class="col-sm-6">
                <h5>Data Pemakaian</h5>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Pemakaian</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Pemakai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor_pemakaian = 1;
                while ($hasil_pemakaian = mysql_fetch_array($query_pemakaian)) {
                ?>
                <tr>
                    <td><?php echo $nomor_pemakaian; ?></td>
                    <td><?php echo $hasil_pemakaian['barang_nama']; ?></td>
                    <td><?php echo date("d M Y", strtotime($hasil_pemakaian['keluar_tanggal'])); ?></td>
                    <td><?php echo $hasil_pemakaian['keluar_jumlah']; ?></td>
                    <td><?php echo $hasil_pemakaian['keluar_deskripsi']; ?></td>
                    <td><?php echo $hasil_pemakaian['keluar_user']; ?></td>
                    <td><?php echo $hasil_pemakaian['keluar_status']; ?></td>
                </tr>
                <?php
                    $nomor_pemakaian++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>