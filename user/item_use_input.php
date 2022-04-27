<?php
include "koneksi.php";

$barang_id = $_GET['id'];

$query_pemakaian = mysql_query("SELECT * FROM tb_barang WHERE barang_id='$barang_id' ");
$data_barang = mysql_fetch_array($query_pemakaian);

$barang_nama = $data_barang['barang_nama'];

?>
<div class="container-fluid">
    <form class="form-horizontal" action="home_admin.php?page=item_use_input_process" method="post"
        enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="keluar_idbarang" value="<?php echo $barang_id; ?>"
            name="keluar_idbarang">

        <div class="form-group row mb-2">
            <label class="control-label col-sm-2" for="keluar_barang">Nama Barang</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="keluar_barang" value="<?php echo $barang_nama; ?>"
                    name="keluar_barang" disabled>
            </div>
            <label class="control-label col-sm-2" for="keluar_tanggal">Tanggal Pemakaian</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" id="keluar_tanggal" value="<?php echo date("Y-m-d"); ?>"
                    name="keluar_tanggal" required>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="control-label col-sm-2" for="keluar_jumlah">Jumlah Pemakaian</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="keluar_jumlah" onkeypress="return hanyaAngka(event)"
                    placeholder="Masukan Total" name="keluar_jumlah" required>
            </div>
            <label class="control-label col-sm-2" for="keluar_user">Nama User</label>
            <div class="col-sm-4">
                <input type="hidden" class="form-control" id="keluar_user" placeholder="Masukan User" name="keluar_user"
                    value="<?php echo $ktp_nama; ?>" required>

                <input type="text" class="form-control" id="keluar_user" placeholder="Masukan User" name="keluar_user"
                    value="<?php echo $ktp_nama; ?>" disabled>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="control-label col-sm-2" for="keluar_deskripsi">Keterangan :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="keluar_deskripsi" placeholder="Masukan Keterangan"
                    name="keluar_deskripsi">
            </div>
        </div>

        <div align="center">
            <div class="col-sm-4" align="center">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="home_admin.php?page=item_view"><button type="button"
                        class="btn btn-secondary btn-sm">Kembali</button></a>
            </div>
        </div>

    </form>
</div>