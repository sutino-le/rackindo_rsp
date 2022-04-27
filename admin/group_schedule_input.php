
<div class="container">
  <form class="form-horizontal" action="" method="post">

    <div class="form-group">
      <div class="form-row">
        <label class="control-label col-sm-2" for="gs_durasi">Enter Duration :</label>
        <div class="col-sm-4">
          <select class="form-control" name="gs_durasi" id="gs_durasi">
              <option value="">Select Duration</option>
              <option value=""></option>
              <option value="7">1 Week</option>
              <option value="14">2 Week</option>
              <option value="28">4 Week</option>
          </select>
        </div>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
      </div>
    </div>

  </form>
</div>



<!-- /.card -->
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Input Group Schedule</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="home_admin.php?page=group_schedule_input_process" method="post">
        <div class=" card-body">

        <?php
            $gs_duration=$_POST['gs_durasi'];

            $group_schedule=mysql_query("SELECT * FROM group_schedule ORDER BY gs_id DESC ");
            $v_group_schedule=mysql_fetch_array($group_schedule);
        ?>
            <div class="form-group row">
                <label for="gs_code" class="col-sm-2 col-form-label">Last Code</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="gs_code" value="<?php echo $v_group_schedule['gs_code']."-".$v_group_schedule['gs_nama']; ?>" disabled>

                    <input type="hidden"  id="gs_duration" name="gs_duration" value="<?php echo $gs_duration; ?>" required>

                </div>
            </div>

            <div class="form-group row">
                <label for="gs_code" class="col-sm-2 col-form-label">Code</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="gs_code" id="gs_code" placeholder="Enter Code" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="gs_nama" class="col-sm-2 col-form-label">Name Schedule</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="gs_nama" id="gs_nama" placeholder="Enter Name Schedule" required>
                </div>
            </div>
            

            <?php
                for($i = 1; $i <= $gs_duration; $i++){
                    if($i==1 OR $i==8 OR $i==15 OR $i==22){
                        $a="Senin";
                    } else if($i==2 OR $i==9 OR $i==16 OR $i==23){
                        $a="Selasa";
                    } else if($i==3 OR $i==10 OR $i==17 OR $i==24){
                        $a="Rabu";
                    } else if($i==4 OR $i==11 OR $i==18 OR $i==25){
                        $a="Kamis";
                    } else if($i==5 OR $i==12 OR $i==19 OR $i==26){
                        $a="Jumat";
                    } else if($i==6 OR $i==13 OR $i==20 OR $i==27){
                        $a="Sabtu";
                    } else if($i==7 OR $i==14 OR $i==21 OR $i==28){
                        $a="Minggu";
                    }
            ?>
            

            <div class="form-group row">
                <label for="gs_type<?php echo $i; ?>" class="col-sm-3 col-form-label">Days to - <?php echo $i.". ".$a; ?></label>
                <div class="col-sm-6">
                    <select class="form-control" name="gs_type<?php echo $i; ?>" id="gs_type<?php echo $i; ?>" required>
                        <option value="" selected>Select Shift</option>
                        <option></option>
                        <?php
                            $shift_daily=mysql_query("SELECT * FROM shift_daily ORDER BY sd_masuk, sd_pulang ASC");
                            while($v_shift_daily=mysql_fetch_array($shift_daily)){
                        ?>
                        <option value="<?php echo $v_shift_daily['sd_id']; ?>"><?php echo $v_shift_daily['sd_code']." [".$v_shift_daily['sd_type']."] : ".$v_shift_daily['sd_masuk']." - ".$v_shift_daily['sd_pulang']." [ Break : ".$v_shift_daily['sd_break_awal']." - ".$v_shift_daily['sd_break_akhir']." ]"; ?> </option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <?php
                }
            ?>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=group_schedule_view"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->