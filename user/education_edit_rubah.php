<?php
include("koneksi.php");

$pendidikan_id = $_GET['pendidikan_id'];

$query_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_id='$pendidikan_id' ");
$v_pendidikan = mysql_fetch_array($query_pendidikan);
$pendidikan_ktp = $v_pendidikan['pendidikan_ktp'];
$pendidikan_awal = $v_pendidikan['pendidikan_awal'];
$pendidikan_akhir = $v_pendidikan['pendidikan_akhir'];
$pendidikan_nama = $v_pendidikan['pendidikan_nama'];
$pendidikan_jurusan = $v_pendidikan['pendidikan_jurusan'];
$pendidikan_nilai = $v_pendidikan['pendidikan_nilai'];
$pendidikan_kota = $v_pendidikan['pendidikan_kota'];



$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$pendidikan_ktp' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nomor = $hasil_ktp['ktp_nomor'];
$ktp_nama = $hasil_ktp['ktp_nama'];

?>



<div class="card card-info">
    <div class="card-header">
        <h4 class="card-title">Pendidikan</h4>
        <p>
            <font color="red">* Lengkapi data Pendidikan sesuai dengan riwayat sekolah.</font>
        </p>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=education_edit_rubah_process" method="post">

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pendidikan_ktp">Nomor KTP </label>
                <div class="col-sm-4">
                    <input type="hidden" name="pendidikan_id" value="<?php echo $pendidikan_id; ?>" required>
                    <input type="hidden" name="pendidikan_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="pendidikan_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                        value="<?php echo $ktp_nomor; ?>" name="pendidikan_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lengkap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Nama Lengkap"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pendidikan_awal">Tahun Masuk</label>
                <div class="col-sm-4">
                    <select class="form-control" name="pendidikan_awal" required>
                        <option value="<?php echo $pendidikan_awal; ?>"><?php echo $pendidikan_awal; ?></option>
                        <option value=""></option>
                        <?php
                        for ($start = date('Y'); $start >= date('Y') - 70; $start -= 1) {
                            echo "<option value='$start'> $start </option>";
                        }
                        ?>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="pendidikan_akhir">Tahun Lulus</label>
                <div class="col-sm-4">
                    <select class="form-control" name="pendidikan_akhir" required>
                        <option value="<?php echo $pendidikan_akhir; ?>"><?php echo $pendidikan_akhir; ?></option>
                        <option value=""></option>
                        <?php
                        for ($end = date('Y'); $end >= date('Y') - 70; $end -= 1) {
                            echo "<option value='$end'> $end </option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pendidikan_tingkatan">Tingkat Pendidikan</label>
                <div class="col-sm-4">
                    <select class="form-control" name="pendidikan_tingkatan" required>
                        <option value="">Pilih Tingkat</option>
                        <option value=""></option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="MTS">MTS</option>
                        <option value="SMA">SMA</option>
                        <option value="SMK">SMK</option>
                        <option value="MA">MA</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pendidikan_nama">Nama Sekolah </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pendidikan_nama" placeholder="Masukan Nama Sekolah"
                        name="pendidikan_nama" value="<?php echo $pendidikan_nama; ?>" required>
                </div>
                <label class="control-label col-sm-2" for="pendidikan_jurusan">Jurusan </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pendidikan_jurusan" placeholder="Masukan Jurusan"
                        name="pendidikan_jurusan" value="<?php echo $pendidikan_jurusan; ?>" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pendidikan_nilai">IPK / Nilai </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pendidikan_nilai" placeholder="Masukan IPK / Nilai"
                        name="pendidikan_nilai" value="<?php echo $pendidikan_nilai; ?>" required>
                </div>
                <label class="control-label col-sm-2" for="pendidikan_kota">Alamat Sokalah </label>
                <div class="col-sm-4">
                    <select name="pendidikan_kota" class="form-control" required>
                        <option value="<?php echo $pendidikan_kota; ?>"><?php echo $pendidikan_kota; ?></option>
                        <option value=""></option>
                        <?php
                        $kota = mysql_query("SELECT *  FROM data_wilayah GROUP BY kota_kabupaten ASC");
                        while ($v_kota = mysql_fetch_array($kota)) {
                        ?>
                        <option value="<?php echo $v_kota['kota_kabupaten']; ?>">
                            <?php echo $v_kota['kota_kabupaten']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=education_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Batal</button></a>
        </div>

    </form>

</div>