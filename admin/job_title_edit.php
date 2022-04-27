<?php
include("koneksi.php");

$bagian_id = $_GET['id'];

$query_bagian = mysql_query("SELECT * FROM bagian WHERE bagian_id='$bagian_id' ");
$hasil_bagian = mysql_fetch_array($query_bagian);
$bagian_id=$hasil_bagian['bagian_id'];
$bagian_nama=$hasil_bagian['bagian_nama'];
$bagian_parent=$hasil_bagian['bagian_parent'];

$query_parent = mysql_query("SELECT * FROM bagian WHERE bagian_id='$bagian_parent' ");
$hasil_parent = mysql_fetch_array($query_parent);
$parent_nama=$hasil_parent['bagian_nama'];
?>

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Edit Job Title</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="home_admin.php?page=job_title_edit_process" method="post">
            <div class="card-body">

                <div class="form-group row">
                    <label for="bagian_parent" class="col-sm-2 col-form-label">Parent Of job title</label>
                    <div class="col-sm-4">
                        <input type="hidden" class="form-control" name="bagian_id" id="bagian_id" value="<?php echo $bagian_id; ?>"
                            required>
                        <select class="form-control" name="bagian_parent" id="bagian_parent" required>
                            <option value="<?php echo $bagian_parent; ?>" selected><?php echo $parent_nama; ?></option>
                            <option></option>
                            <?php
                                $parent=mysql_query("SELECT * FROM bagian ORDER BY bagian_id ");
                                while($tampil_parent=mysql_fetch_array($parent)){
                            ?>
                            <option value="<?php echo $tampil_parent['bagian_id']; ?>"><?php echo $tampil_parent['bagian_nama']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bagian_nama" class="col-sm-2 col-form-label">Job Title</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="bagian_nama" id="bagian_nama" value="<?php echo $bagian_nama; ?>"
                            required>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=job_title"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->