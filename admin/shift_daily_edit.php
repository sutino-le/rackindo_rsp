
    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Input Shift Daily</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="home_admin.php?page=shift_daily_edit_process" method="post">
            <div class=" card-body">

            <?php
                $sd_id=$_GET['id'];
                $shift_daily=mysql_query("SELECT * FROM shift_daily WHERE sd_id='$sd_id' ");
                $v_shift_daily=mysql_fetch_array($shift_daily);
            ?>
                <div class="form-group row">
                    <label for="sd_id" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-4">
                        <input type="hidden" class="form-control" name="sd_id" value="<?php echo $v_shift_daily['sd_id']; ?>">
                        <input type="text" class="form-control" name="sd_id" value="<?php echo $v_shift_daily['sd_id']; ?>" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sd_code" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="sd_code" id="sd_code" value="<?php echo $v_shift_daily['sd_code']; ?>" placeholder="Enter Code" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sd_type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="sd_type" id="sd_type" required>
                            <option value="<?php echo $v_shift_daily['sd_type']; ?>" selected><?php echo $v_shift_daily['sd_type']; ?></option>
                            <option></option>
                            <option value="Holiday">Holiday</option>
                            <option value="Work Day">Work Day</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sd_masuk" class="col-sm-2 col-form-label">In</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="sd_masuk" id="sd_masuk" value="<?php echo $v_shift_daily['sd_masuk']; ?>" required>
                    </div>
                    <label for="sd_pulang" class="col-sm-2 col-form-label">Out</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="sd_pulang" id="sd_pulang" value="<?php echo $v_shift_daily['sd_pulang']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sd_break_awal" class="col-sm-2 col-form-label">Break Start</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="sd_break_awal" id="sd_break_awal" value="<?php echo $v_shift_daily['sd_break_awal']; ?>" required>
                    </div>
                    <label for="sd_break_akhir" class="col-sm-2 col-form-label">Break End</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" name="sd_break_akhir" id="sd_break_akhir" value="<?php echo $v_shift_daily['sd_break_akhir']; ?>" required>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=shift_daily_view"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->