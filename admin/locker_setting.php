<?php
$karyawan_ktp = $_GET['id'];
$data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_ktp='$karyawan_ktp' ");
$v_data_karyawan = mysql_fetch_array($data_karyawan);
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Locker Setting</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=locker_setting_process" method="post">

        <input type="hidden" name="karyawan_ktp" id="karyawan_ktp" value="<?php echo $karyawan_ktp; ?>">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="ktp">Card ID :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp" placeholder="Enter KTP" name="ktp"
                        value="<?php echo $karyawan_ktp; ?>" disabled>
                </div>
                <label class="control-label col-sm-2" for="nama">Full Name :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama"
                        value="<?php echo $v_data_karyawan['ktp_nama']; ?>" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="karyawan_bagian">Job Title :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="karyawan_bagian" placeholder="Enter Job Title"
                        name="karyawan_bagian" value="<?php echo $v_data_karyawan['bagian_nama']; ?>" disabled>
                </div>
                <label class="control-label col-sm-2" for="karyawan_jabatan">Position :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="karyawan_jabatan" placeholder="Enter Nama"
                        name="karyawan_jabatan" value="<?php echo $v_data_karyawan['jabatan_nama']; ?>" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="karyawan_loker" class="col-sm-2 col-form-label">Select Locker</label>
                <div class="col-sm-4">
                    <select class="form-control" name="karyawan_loker" id="karyawan_loker" required>
                        <option value="" selected>Selelct Locker</option>
                        <option></option>
                        <?php
                        $cek_locker = mysql_query("SELECT * FROM loker ORDER BY loker_nomor ASC");
                        while ($v_cek_locker = mysql_fetch_array($cek_locker)) {
                            $loker_id = $v_cek_locker['loker_id'];
                            $cek_lokar = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_loker='$loker_id' ");
                            $v_cek_lokar = mysql_fetch_array($cek_lokar);
                            if (empty($v_cek_lokar)) {
                                $nomor_loker = $v_cek_locker['loker_nomor'];
                                $id_loker = $v_cek_locker['loker_id'];
                            } else {
                                $nomor_loker = $v_cek_locker['loker_nomor'] . " - Sudah Terpakai : " . $v_cek_lokar['ktp_nama'];
                                $id_loker = "";
                            }
                        ?>
                        <option value="<?php echo $id_loker; ?>"><?php echo $nomor_loker; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=locker"><button type="button"
                    class="btn btn-secondary btn-sm">Back</button></a>
        </div>

    </form>

</div>