<?php 
  include("koneksi.php");

  $barang_id=$_GET['id'];

  $query_barang=mysql_query("SELECT * FROM tb_barang WHERE barang_id='$barang_id' ");
  $data_barang=mysql_fetch_array($query_barang);

  $barang_nama=$data_barang['barang_nama'];
  $barang_barcode=$data_barang['barang_barcode'];
  $barang_harga=$data_barang['barang_harga'];
  $barang_satuan=$data_barang['barang_satuan'];
  $barang_detail=$data_barang['barang_detail'];
  $barang_foto=$data_barang['barang_foto'];
?>
<div class="container-fluid">
  <form class="form-horizontal" action="barang_edit_proses.php" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" id="barang_id" value="<?php echo $barang_id; ?>" name="barang_id" required>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="barang_nama">Item Name :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_nama" value="<?php echo $barang_nama; ?>" placeholder="Enter Item" name="barang_nama" required>
        </div>
        <label class="control-label col-sm-2" for="barang_barcode">Barcode :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_barcode" value="<?php echo $barang_barcode; ?>" placeholder="Enter Barcode" name="barang_barcode" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="barang_harga">Price :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_harga" onkeypress="return hanyaAngka(event)"  value="<?php echo $barang_harga; ?>" placeholder="Enter Harga" name="barang_harga" required>
        </div>
        <label class="control-label col-sm-2" for="barang_satuan">Unit :</label>
        <div class="col-sm-4">
          <select class="form-control" name="barang_satuan" id="barang_satuan" required>
            <option value="<?php echo $barang_satuan; ?>" selected><?php echo $barang_satuan; ?></option>
            <option></option>
            <option value="Piece">Piece</option>
            <option value="Rim">Rim</option>
            <option value="Dozen">Dozen</option>
            <option value="Pack">Pack</option>
            <option value="Box">Box</option>
            <option value="Can">Can</option>
            <option value="Pouch">Pouch</option>
            <option value="Bottle">Bottle</option>
            <option value="Unit">Unit</option>
            <option value="Tablet">Tablet</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="barang_detail">Item Details :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_detail" value="<?php echo $barang_detail; ?>" placeholder="Enter Details" name="barang_detail" required>
        </div>
        <label class="control-label col-sm-2" for="barang_foto">Upload Picture :</label>
        <div class="col-sm-4">
          <input type="file" class="form-control" id="barang_foto" value="<?php echo $barang_foto; ?>" placeholder="Enter Picture" name="barang_foto">
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