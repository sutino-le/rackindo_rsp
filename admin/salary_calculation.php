<?php
$periode_akhir = date("Y-m-25");
$tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
$periode_awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));



//karyawan_kategori
$karyawan_kategori = mysql_query("SELECT * FROM karyawan WHERE karyawan_status='Aktif' OR karyawan_status='Keluar' AND karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir' GROUP BY karyawan_kategori ASC");

//karyawan_jenis
$karyawan_jenis = mysql_query("SELECT * FROM karyawan WHERE karyawan_status='Aktif' OR karyawan_status='Keluar' AND karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir' GROUP BY karyawan_jenis ASC");

//karyawan_jabatan
$karyawan_jabatan = mysql_query("SELECT * FROM karyawan JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_status='Aktif' OR karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir' GROUP BY jabatan.jabatan_id ASC");
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Calculation</h3>
    </div>
    <form class="form-horizontal" action="salary_calculation_proses.php" method="post">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="karyawan_kategori">Category of Employee</label>
                <div class="col-sm-10">
                    <select name="karyawan_kategori" id="karyawan_kategori" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value=""></option>
                        <?php
                        while ($v_karyawan_kategori = mysql_fetch_array($karyawan_kategori)) {
                        ?>
                        <option value="<?php echo  $v_karyawan_kategori['karyawan_kategori']; ?>">
                            <?php echo  $v_karyawan_kategori['karyawan_kategori']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="karyawan_jenis">Type of Employee</label>
                <div class="col-sm-10">
                    <select name="karyawan_jenis" id="karyawan_jenis" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value=""></option>
                        <?php
                        while ($v_karyawan_jenis = mysql_fetch_array($karyawan_jenis)) {
                        ?>
                        <option value="<?php echo  $v_karyawan_jenis['karyawan_jenis']; ?>">
                            <?php echo  $v_karyawan_jenis['karyawan_jenis']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="karyawan_jabatan">Position of Employee</label>
                <div class="col-sm-10">
                    <select name="karyawan_jabatan" id="karyawan_jabatan" class="form-control">
                        <option value="">Select Position</option>
                        <option value=""></option>
                        <?php
                        while ($v_karyawan_jabatan = mysql_fetch_array($karyawan_jabatan)) {
                        ?>
                        <option value="<?php echo  $v_karyawan_jabatan['jabatan_id']; ?>">
                            <?php echo  $v_karyawan_jabatan['jabatan_nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="periode_awal">Start Date</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="periode_awal" id="periode_awal"
                        value="<?php echo $periode_awal; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="periode_akhir">End Date</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="periode_akhir" id="periode_akhir"
                        value="<?php echo $periode_akhir; ?>" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=residence_address_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button
                    type="button" class="btn btn-secondary btn-sm">Next</button></a>
        </div>

    </form>

</div>