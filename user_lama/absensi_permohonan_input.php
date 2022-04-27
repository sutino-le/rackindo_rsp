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
                    <select class="form-control" name="absen_izin_spv" id="absen_izin_spv" required>
                        <option value="">Select Supervisor</option>
                        <option value=""></option>
                        <option value="Bpk Asepudin">Bpk Asepudin - B [ Laminasi, Cutting ]</option>
                        <option value="Bpk Rudi Sofyan">Bpk Rudi Sofyan - A [ Laminasi, Cutting ]</option>
                        <option value="Bpk Nasirin">Bpk Nasirin - A [ Boring, Edging, Finishing, Shapping ]</option>
                        <option value="Bpk Suliswanto">Bpk Suliswanto - B [ Boring, Edging, Finishing, Shapping ]
                        </option>
                        <option value="Bpk Muslim">Bpk Muslim - B [ Packing ]</option>
                        <option value="Bpk Hamdani">Bpk Hamdani - A [ Packing ]</option>
                        <option value="Ibu Kusmiati">Ibu Kusmiati - [ Accesories ]</option>
                        <option value="Bpk Anam">Bpk Anam - [ Mekanik, General Affair ]</option>
                        <option value="Bpk Rudi">Bpk Rudi - [ Mekanik, General Affair ]</option>
                        <option value="Bpk Imal">Bpk Imal - [ Prototype ]</option>
                        <option value="Bpk Amin">Bpk Amin - [ Supir, Kernet, Gudang Depan ]</option>
                        <option value="Bpk Paryo">Bpk Paryo - [ Gudang Belakang ]</option>
                        <option value="Bpk Suhita">Bpk Suhita - B [ Service, Component, Expeditor ]</option>
                        <option value="Bpk Bambang">Bpk Bambang - A [ Service, Component, Expeditor ]</option>
                        <option value="Bpk Endang">Bpk Endang - B [ Boring ]</option>
                        <option value="Bpk Amin & Ibu Ita">Bpk Amin & Ibu Ita - [ Supir, Kernet, Gudang Depan ]
                        </option>
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