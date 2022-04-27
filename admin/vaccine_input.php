<?php
$nik = $_GET['id'];
?>
<!-- /.card -->
<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Input Vaccine</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="home_admin.php?page=vaccine_input_process" method="post">
        <div class=" card-body">

            <div class="form-group row">
                <label for="vaksin_ktp" class="col-sm-2 col-form-label">Id Card Number</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="vaksin_ktp" id="vaksin_ktp"
                        value="<?php echo $nik; ?>" maxlength="16" minlength="16" onkeypress="return hanyaAngka(event)"
                        placeholder="Enter Id Card Number" required>
                </div>
                <label for="vaksin_ke" class="col-sm-2 col-form-label">Vaccine to</label>
                <div class="col-sm-4">
                    <select class="form-control" name="vaksin_ke" id="vaksin_ke" required>
                        <option value="" selected>Select Vaccine to</option>
                        <option></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="vaksin_jenis" class="col-sm-2 col-form-label">Vaccine type</label>
                <div class="col-sm-4">
                    <select class="form-control" name="vaksin_jenis" id="vaksin_jenis" required>
                        <option value="" selected>Select vaccine type</option>
                        <option></option>
                        <option value="Astra Zeneca">Astra Zeneca</option>
                        <option value="Sinovac">Sinovac</option>
                        <option value="Biofarma">Biofarma</option>
                        <option value="Pfizer">Pfizer</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <label for="vaksin_tanggal" class="col-sm-2 col-form-label">Vaccine date</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" name="vaksin_tanggal" id="vaksin_tanggal" required>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=vaccine_view"><button type="button"
                    class="btn btn-secondary btn-sm">Back</button></a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->