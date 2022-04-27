<?php
$periode_akhir = date("Y-m-25");
$tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
$awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));
?>
<!-- /.card -->
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Generate Attendance</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="home_admin.php?page=generate_attendance_process" method="post">
        <div class=" card-body">

            <div class="form-group row">
                <label for="generate_awal" class="col-sm-1 col-form-label">Start Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="generate_awal" id="generate_awal"
                        value="<?php echo $awal; ?>" required>
                </div>
                <label for="generate_akhir" class="col-sm-1 col-form-label">End Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="generate_akhir" id="generate_akhir"
                        value="<?php echo date("Y-m-d"); ?>" required>
                </div>
                <label for="kategori" class="col-sm-1 col-form-label">Type</label>
                <div class="col-sm-3">
                    <select class="form-control" name="kategori" id="kategori" required>
                        <option value="">Select Category</option>
                        <option value=""></option>
                        <option value="Staff">Staff</option>
                        <option value="Karyawan">Karyawan</option>
                    </select>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=generate_attendance"><button type="button"
                    class="btn btn-secondary btn-sm">Back</button></a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->