<?php 
include("koneksi.php");

?>
<!DOCTYPE html>
<html>
<body>

<div class="container-fluid">
  <form class="form-horizontal" action="" method="post">

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="jumlah_up">Enter Number of Requests :</label>
        <div class="col-sm-4">
          <input type="number" class="form-control" id="jumlah_up" onkeypress="return hanyaAngka(event)" placeholder="Enter Number of Requests" maxlength="1" min="1" max="8" name="jumlah_up" required>
        </div>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
      </div>
    </div>

  </form>
</div>
<br>

<?php

  if($_POST['jumlah_up']){

    $jumlah_up=$_POST['jumlah_up'];

    $query_up=mysql_query("SELECT * FROM tb_permintaan ORDER BY permintaan_id DESC ");
    $v_query_up=mysql_fetch_array($query_up);

    $tahun=date("Y");
    if($tahun==date("Y",strtotime($v_query_up['permintaan_tanggal']))){
      $up_nomor=$v_query_up['permintaan_nomor']+1;
    } else {
      $up_nomor=1;
    }
  }

?>

<h2>Rincian Permintaan</h2>
<div class="container-fluid">
  <form class="form-horizontal" action="home_admin.php?page=item_up_input_process" method="post" enctype="multipart/form-data">

    <input type="hidden"  id="jumlah_up" name="jumlah_up" value="<?php echo $jumlah_up; ?>" required>

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="up_nomor">Number Purchase Proposal :</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="up_nomor" value="<?php echo $up_nomor; ?>" name="up_nomor" placeholder="Enter Number" required>
        </div>
        <label class="control-label col-sm-2" for="up_tanggal">Date Purchase Proposal :</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="up_tanggal" name="up_tanggal" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
      </div>
    </div>

<?php

for($i = 1; $i <= $jumlah_up; $i++){
?>

    <div class="form-group">
      <div class="form-row">

        <div class="col-sm-3">
          <?php       
            ;
          ?>
          <select class="form-control" name="barang_id<?php echo $i; ?>" id="barang_id" required>
            <option value="" selected>Select Item</option>
            <option></option>
            <?php
              $query_barang=mysql_query("SELECT * FROM tb_barang ORDER BY barang_nama ASC ");
              while ($data_barang=mysql_fetch_array($query_barang)){  
            ?>
            <option value="<?php echo $data_barang['barang_id']; ?>"><?php echo $data_barang['barang_nama']; ?></option>
            <?php 
              }
            ?>
          </select>
        </div>

        <div class="col-sm-3">
          <input type="text" class="form-control" name="up_jumlah<?php echo $i; ?>a" id="up_jumlah" placeholder="Enter Total" onkeypress="return hanyaAngka(event)" required>
        </div>

      </div>
    </div>
<?php
  }
?>
      
    <div align="center">
      <div class="col-sm-4" align="center">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        <a href="home_admin.php?page=item_view"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
      </div>
    </div>

  </form>
</div>

</body>
</html>