<!-- /.card -->
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Input Job Title</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="home_admin.php?page=job_title_input_process" method="post">
        <div class=" card-body">

            <div class="form-group row">
                <label for="bagian_parent" class="col-sm-2 col-form-label">Parent Of job title</label>
                <div class="col-sm-4">
                    <select class="form-control" name="bagian_parent" id="bagian_parent" required>
                        <option value="" selected>Parent</option>
                        <option></option>
                        <?php
                        $parent = mysql_query("SELECT * FROM bagian ORDER BY bagian_id ");
                        while ($tampil_parent = mysql_fetch_array($parent)) {
                        ?>
                        <option value="<?php echo $tampil_parent['bagian_id']; ?>">
                            <?php echo $tampil_parent['bagian_nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="bagian_nama" class="col-sm-2 col-form-label">Job Title</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="bagian_nama" id="bagian_nama" required>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=job_title"><button type="button"
                    class="btn btn-secondary btn-sm">Back</button></a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->