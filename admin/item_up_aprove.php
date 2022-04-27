<?php 
include("koneksi.php");

$permintaan_id=$_GET['permintaan_id'];

$query_permintaan=mysql_query("SELECT * FROM tb_permintaan WHERE permintaan_id='$permintaan_id' ");
$data_permintaan=mysql_fetch_array($query_permintaan);
$permintaan_idbarang=$data_permintaan['permintaan_idbarang'];
$permintaan_nomor=$data_permintaan['permintaan_nomor'];
$permintaan_tanggal=$data_permintaan['permintaan_tanggal'];


$query_barang=mysql_query("SELECT * FROM tb_barang WHERE barang_id='$permintaan_idbarang' ");
$data_barang=mysql_fetch_array($query_barang);



?>
<div class="container-fluid">
  <form class="form-horizontal" action="home_admin.php?page=item_up_aprove_process" method="post" enctype="multipart/form-data">
    <input type="hidden" id="permintaan_id" value="<?php echo $permintaan_id; ?>" name="permintaan_id" >

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="permintaan_nomor">Number UP :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="permintaan_nomor" placeholder="Enter Nomor UP" value="<?php echo $permintaan_nomor; ?>" name="permintaan_nomor" disabled>
        </div>
        <label class="control-label col-sm-2" for="permintaan_tanggal">Date UP :</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="permintaan_tanggal" placeholder="Enter Tanggal UP" value="<?php echo $permintaan_tanggal; ?>" name="permintaan_tanggal" disabled>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="permintaan_barang">Item :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="permintaan_barang" placeholder="Enter Item" value="<?php echo $data_barang['barang_nama']; ?>" name="permintaan_barang" disabled>
        </div>
        <label class="control-label col-sm-2" for="permintaan_jumlah">Number of Requests :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="permintaan_jumlah" placeholder="Enter Number of Requests" value="<?php echo $data_permintaan['permintaan_jumlah']; ?>" name="permintaan_jumlah" disabled>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="masuk_jumlah">Quantity Received :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="masuk_jumlah" placeholder="Enter Quantity Received" name="masuk_jumlah" required>
        </div>
        <label class="control-label col-sm-2" for="masuk_tanggal">Date :</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="masuk_tanggal" placeholder="Enter Tanggal" name="masuk_tanggal" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="permintaan_tanda_terima">Upload Receipt :</label>
        <div class="col-sm-4">
          <input type="file" class="form-control" id="permintaan_tanda_terima" placeholder="Enter upload Receipt" name="permintaan_tanda_terima" required>
        </div>
        <label class="control-label col-sm-2" for="masuk_deskripsi">Information :</label>
        <div class="col-sm-4">
          <textarea class="form-control" id="masuk_deskripsi" name="masuk_deskripsi" required></textarea>
        </div>
      </div>
    </div>
      
    <div align="center">
      <div class="col-sm-4" align="center">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        <a href="home_sir.php?page=barang_up_lihat"><button type="button" class="btn btn-secondary btn-sm">Kembali</button></a>
      </div>
    </div>

  </form>
</div>