<?php
include("koneksi.php");

?>
<!DOCTYPE html>
<html>

<body>

    <div class="container-fluid">
        <form class="form-horizontal" action="" method="post">

            <div class="form-group row m-2">
                <label class="control-label col-sm-4" for="jumlah_izin">Masukan Jumlah Hari Permohonan :</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="jumlah_izin" onkeypress="return hanyaAngka(event)"
                        placeholder="Enter Jumlah Permintaan" maxlength="1" min="1" max="8" name="jumlah_izin" required>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm">Lanjutkan</button>
                </div>
            </div>

        </form>
    </div>
    <br>

    <?php
    $periode_awal = date("Y-01-01");
    $periode_akhir = date("Y-m-d");

    $jumlah_izin = $_POST['jumlah_izin'];
    $query_permohonan = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_tanggal_buat BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY absen_izin_nomor DESC ");
    $v_query_permohonan = mysql_fetch_array($query_permohonan);
    $nomor_terakhir_permohonan = $v_query_permohonan['absen_izin_nomor'];
    $tanggal_permohonan = date("Y", strtotime($v_query_permohonan['absen_izin_tanggal_buat']));
    $tahun_sekarang = date("Y");

    if ($tanggal_permohonan == $tahun_sekarang) {
        $nomor_permohonan = $nomor_terakhir_permohonan + 1;
    } else {
        $nomor_permohonan = 1;
    }


    ?>

    <h2>Permohonan Detail</h2>
    <div class="container-fluid">
        <form class="form-horizontal" action="absensi_permohonan_input_simpan.php" method="post"
            enctype="multipart/form-data">

            <input type="hidden" id="jumlah_izin" name="jumlah_izin" value="<?php echo $jumlah_izin; ?>" required>

            <div class="form-group row m-2">
                <label class="control-label col-sm-1" for="absen_izin_nomor">Nomor :</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="absen_izin_nomor"
                        value="<?php echo $nomor_permohonan; ?>" name="absen_izin_nomor" placeholder="Enter Nomor"
                        required>
                </div>
                <label class="control-label col-sm-2" for="absen_izin_tanggal_buat">Tanggal :</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="absen_izin_tanggal_buat" name="absen_izin_tanggal_buat"
                        value="<?php echo date("Y-m-d"); ?>" required>
                </div>
                <label class="control-label col-sm-2" for="karyawan_pin">Karyawan :</label>
                <div class="col-sm-4">
                    <select class="form-control" name="absen_izin_pin<?php echo $i; ?>" id="absen_izin_pin" required>
                        <?php
                        $query_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_ktp='$user_ktp' ");
                        while ($data_karyawan = mysql_fetch_array($query_karyawan)) {
                        ?>
                        <option value="<?php echo $data_karyawan['karyawan_finger']; ?>">
                            <?php echo $data_karyawan['ktp_nama'] . " [" . $data_karyawan['bagian_nama'] . "]"; ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br>

            <?php
            for ($i = 1; $i <= $jumlah_izin; $i++) {
            ?>

            <div class="form-group row m-2">
                <div class="col-sm-4">
                    <input type="date" class="form-control" name="absen_izin_tanggal<?php echo $i; ?>a"
                        id="absen_izin_tanggal" required>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" name="absen_izin_jenis<?php echo $i; ?>a" id="absen_izin_jenis"
                        required>
                        <option value="" selected>Pilih Jenis Permohonan</option>
                        <option></option>
                        <option value="Vaks">Vaksin (Vaks)</option>
                        <option value="I">Izin (I)</option>
                        <option value="1/2">1/2 Hari</option>
                        <option value="ITD">Izin Tidak Dibayar (ITD)</option>
                        <option value="S">Sakit</option>
                        <option value="STK">Surat Tanpa Keterangan (STK)</option>
                        <option value="A">Alpa</option>
                    </select>
                </div>
            </div>

            <?php
            }
            ?>



            <div class="form-group row m-2">
                <label class="col-sm-2" for="absen_izin_spv">Supervisor :</label>
                <div class="col-sm-6">
                    <select class="form-control" name="absen_izin_spv" id="absen_izin_spv">
                        <option value="">Select Supervisor</option>
                        <option value=""></option>

                        <?php
                        $cek_karyawan = mysql_query("SELECT * FROM karyawan JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_ktp='$user_ktp' ");
                        $v_cek_karyawan = mysql_fetch_array($cek_karyawan);
                        $parent0 = $v_cek_karyawan['bagian_parent'];


                        $bagian_atas0 = mysql_query("SELECT * FROM bagian WHERE bagian_id='$parent0' ");
                        $v_bagian_atas0 = mysql_fetch_array($bagian_atas0);
                        $parent1 = $v_bagian_atas0['bagian_parent'];

                        $approval_t1 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_bagian='$parent1 ' ");
                        if (!empty($approval_t1)) {
                            while ($approval = mysql_fetch_array($approval_t1)) {
                                echo "<option values='" . $approval['ktp_nama'] . "'>" . $approval['ktp_nama'] . "</option>";
                            }
                        } else {
                            $bagian_atas1 = mysql_query("SELECT * FROM bagian WHERE bagian_id='$parent1' ");
                            $v_bagian_atas1 = mysql_fetch_array($bagian_atas1);
                            $parent2 = $v_bagian_atas1['bagian_parent'];

                            $approval_t2 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_bagian='$parent2 ' ");
                            if (!empty($approval_t2)) {
                                while ($approval = mysql_fetch_array($approval_t2)) {
                                    echo "<option values='" . $approval['ktp_nama'] . "'>" . $approval['ktp_nama'] . "</option>";
                                }
                            } else {
                                $bagian_atas2 = mysql_query("SELECT * FROM bagian WHERE bagian_id='$parent2' ");
                                $v_bagian_atas2 = mysql_fetch_array($bagian_atas2);
                                $parent3 = $v_bagian_atas2['bagian_parent'];

                                $approval_t3 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_bagian='$parent3 ' ");
                                if (!empty($approval_t3)) {
                                    while ($approval = mysql_fetch_array($approval_t3)) {
                                        echo "<option values='" . $approval['ktp_nama'] . "'>" . $approval['ktp_nama'] . "</option>";
                                    }
                                } else {
                                    $bagian_atas3 = mysql_query("SELECT * FROM bagian WHERE bagian_id='$parent3' ");
                                    $v_bagian_atas3 = mysql_fetch_array($bagian_atas3);
                                    $parent4 = $v_bagian_atas3['bagian_parent'];

                                    $approval_t4 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_bagian='$parent4 ' ");
                                    if (!empty($approval_t4)) {
                                        while ($approval = mysql_fetch_array($approval_t4)) {
                                            echo "<option values='" . $approval['ktp_nama'] . "'>" . $approval['ktp_nama'] . "</option>";
                                        }
                                    } else {
                                        $bagian_atas4 = mysql_query("SELECT * FROM bagian WHERE bagian_id='$parent4' ");
                                        $v_bagian_atas4 = mysql_fetch_array($bagian_atas4);
                                        $parent5 = $v_bagian_atas4['bagian_parent'];

                                        $approval_t5 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_bagian='$parent5 ' ");
                                        if (!empty($approval_t5)) {
                                            while ($approval = mysql_fetch_array($approval_t5)) {
                                                echo "<option values='" . $approval['ktp_nama'] . "'>" . $approval['ktp_nama'] . "</option>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group row m-2">
                <label class="col-sm-2" for="absen_izin_keterangan">Information :</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="2" name="absen_izin_keterangan" id="absen_izin_keterangan"
                        required></textarea>
                </div>
            </div>

            <div align="center">
                <div class="col-sm-4" align="center">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    <a href="home_admin.php?page=attendance_request"><button type="button"
                            class="btn btn-secondary btn-sm">Back</button></a>
                </div>
            </div>

        </form>
    </div>

</body>

</html>