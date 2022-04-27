
<div class="container-fluid">
  <form class="form-horizontal" action="home_admin.php?page=item_input_process" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="barang_nama">Item Name :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_nama" placeholder="Enter Item" name="barang_nama" required>
        </div>
        <label class="control-label col-sm-2" for="barang_barcode">Barcode :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_barcode" placeholder="Enter Barcode" name="barang_barcode" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="barang_harga">Price :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="barang_harga" onkeypress="return hanyaAngka(event)"  placeholder="Enter Price" name="barang_harga" required>
        </div>
        <label class="control-label col-sm-2" for="barang_satuan">Unit :</label>
        <div class="col-sm-4">
          <select class="form-control" name="barang_satuan" id="barang_satuan" required>
            <option value="" selected>Select unit</option>
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
          <textarea class="form-control" id="barang_detail" name="barang_detail" required></textarea>
        </div>
        <label class="control-label col-sm-2" for="barang_foto">Upload Image :</label>
        <div class="col-sm-4">
          <input type="file" class="form-control" id="barang_foto" placeholder="Enter Foto" name="barang_foto" required>
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