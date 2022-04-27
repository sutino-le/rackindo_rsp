<?php 
include"koneksi.php";

$barang_id=$_GET['id'];

$query_pemakaian=mysql_query("SELECT * FROM tb_barang WHERE barang_id='$barang_id' ");
$data_barang=mysql_fetch_array($query_pemakaian);

$barang_nama=$data_barang['barang_nama'];

?>
<div class="container-fluid">
  <form class="form-horizontal" action="home_admin.php?page=item_use_input_process" method="post" enctype="multipart/form-data">
          <input type="hidden" class="form-control" id="keluar_idbarang" value="<?php echo $barang_id; ?>" name="keluar_idbarang">

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="keluar_barang">Item :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="keluar_barang" value="<?php echo $barang_nama; ?>" name="keluar_barang" disabled>
        </div>
        <label class="control-label col-sm-2" for="keluar_tanggal">Date :</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="keluar_tanggal" value="<?php echo date("Y-m-d"); ?>" name="keluar_tanggal" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="keluar_jumlah">Total :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="keluar_jumlah" onkeypress="return hanyaAngka(event)"  placeholder="Enter Total" name="keluar_jumlah" required>
        </div>
        <label class="control-label col-sm-2" for="keluar_user">User :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="keluar_user" placeholder="Enter User" name="keluar_user" value="<?php echo $nama_user; ?>" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="keluar_deskripsi">Information :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="keluar_deskripsi" placeholder="Enter Information" name="keluar_deskripsi">
        </div>
      </div>
    </div>
      
    <div align="center">
      <div class="col-sm-4" align="center">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        <a href="home_admin.php?page=item_view"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
      </div>
    </div>

  </form>
</div>