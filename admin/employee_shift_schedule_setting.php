<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pin = $_POST['pin'];
    $periode_awal = $_POST['awal'];
    $periode_akhir = $_POST['akhir'];


    $data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_finger='$pin'");
    $v_data_karyawan = mysql_fetch_array($data_karyawan);

    $nama = $v_data_karyawan['ktp_nama'];
    $bagian = $v_data_karyawan['bagian_nama'];
    $jabatan = $v_data_karyawan['jabatan_nama'];
} else if ($_GET['pin']) {

    $pin = $_GET['pin'];
    $periode_awal = $_GET['awal'];
    $periode_akhir = $_GET['akhir'];


    $data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_finger='$pin'");
    $v_data_karyawan = mysql_fetch_array($data_karyawan);

    $nama = $v_data_karyawan['ktp_nama'];
    $bagian = $v_data_karyawan['bagian_nama'];
    $jabatan = $v_data_karyawan['jabatan_nama'];
} else {
    $nama = "Select Employee";
    $periode_akhir = date("Y-m-d");
    $periode_awal = date("Y-m-d");
}


$shift_schedule = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN karyawan_schedule ON karyawan.karyawan_finger=karyawan_schedule.ks_finger WHERE karyawan_schedule.ks_finger='$pin' AND karyawan_schedule.ks_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY karyawan_schedule.ks_tanggal ASC ");





?>
<form class="form-horizontal" action="" method="post">
    <div class=" card-body">
        <div class="form-group row">
            <input type="date" class="form-control col-2" name="awal" value="<?php echo $periode_awal; ?>"
                required>&nbsp;
            <input type="date" class="form-control col-2" name="akhir" value="<?php echo $periode_akhir; ?>"
                required>&nbsp;
            <select class="form-control col-4" name="pin" id="pin" required>
                <option value="<?php echo $pin; ?>"><?php echo $nama . " - [ " . $bagian . " ]"; ?></option>
                <option value=""></option>
                <?php
                $karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ORDER BY biodata_ktp.ktp_nama ASC ");
                while ($v_karyawan = mysql_fetch_array($karyawan)) {
                ?>
                <option value="<?php echo $v_karyawan['karyawan_finger']; ?>">
                    <?php echo $v_karyawan['ktp_nama'] . " - [ " . $v_karyawan['bagian_nama'] . " ]"; ?></option>
                <?php
                }
                ?>
            </select>&nbsp;
            <button type="submit" class="btn btn-info btn-sm">Show Attendance</button>
        </div>
    </div>
</form>

Finger ID : <?php echo $pin; ?><br>
Name : <?php echo $nama; ?><br>
Department : <?php echo $jabatan . " / " . $bagian; ?><br>

<table class="table" width="100%">
    <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Shift Schedule</td>
        <td>Action</td>

    </tr>
    <?php
    while ($v_shift_schedule = mysql_fetch_array($shift_schedule)) {
        $ks_id = $v_shift_schedule['ks_id'];
        $ks_tanggal = $v_shift_schedule['ks_tanggal'];
        $ks_schedule = $v_shift_schedule['ks_schedule']; {

    ?>
    <tr>
        <td><?php echo $ks_id; ?></td>
        <td><?php echo $ks_tanggal; ?></td>
        <td>
            <?php
                    $data_shift = mysql_query("SELECT * FROM shift_daily WHERE sd_id='$ks_schedule' ");
                    $v_data_shift = mysql_fetch_array($data_shift);
                    echo $v_data_shift['sd_type'] . " - " . date("H:i", strtotime($v_data_shift['sd_masuk'])) . " - " . date("H:i", strtotime($v_data_shift['sd_pulang'])) . " ( Break : " . date("H:i", strtotime($v_data_shift['sd_break_awal'])) . " - " . date("H:i", strtotime($v_data_shift['sd_break_akhir'])) . " )";
                    ?>
        </td>
        <td align="center">
            <button onclick="document.getElementById('<?php echo $ks_schedule; ?>').style.display='block'" type="button"
                title="Edit Absen" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></button>
        </td>

        <div id="<?php echo $ks_schedule; ?>" class="w3-modal small">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-teal">
                    <span onclick="document.getElementById('<?php echo $ks_schedule; ?>').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>
                    <h2>Update Attendance <?php echo $ks_tanggal; ?></h2>
                </header>

                <form action="home_admin.php?page=employee_shift_schedule_setting_edit_process" method="POST">
                    <input type="hidden" name="ks_id" value="<?php echo $ks_id; ?>">
                    <input type="hidden" name="pin" value="<?php echo $pin; ?>">
                    <input type="hidden" name="awal" value="<?php echo $periode_awal; ?>">
                    <input type="hidden" name="akhir" value="<?php echo $periode_akhir; ?>">

                    <div class="w3-container">
                        <br>
                        <div class="form-group">
                            <select class="form-control" name="ks_schedule" id="ks_schedule" required>
                                <option value="<?php echo $ks_schedule; ?>" selected>
                                    <?php echo $v_data_shift['sd_type'] . " - " . date("H:i", strtotime($v_data_shift['sd_masuk'])) . " - " . date("H:i", strtotime($v_data_shift['sd_pulang'])) . " ( Break : " . date("H:i", strtotime($v_data_shift['sd_break_awal'])) . " - " . date("H:i", strtotime($v_data_shift['sd_break_akhir'])) . " )"; ?>
                                </option>
                                <option></option>
                                <?php
                                        $shift_daily = mysql_query("SELECT * FROM shift_daily ORDER BY sd_masuk, sd_pulang ASC");
                                        while ($v_shift_daily = mysql_fetch_array($shift_daily)) {
                                        ?>
                                <option value="<?php echo $v_shift_daily['sd_id']; ?>">
                                    <?php echo $v_shift_daily['sd_code'] . " [" . $v_shift_daily['sd_type'] . "] : " . $v_shift_daily['sd_masuk'] . " - " . $v_shift_daily['sd_pulang'] . " [ Break : " . $v_shift_daily['sd_break_awal'] . " - " . $v_shift_daily['sd_break_akhir'] . " ]"; ?>
                                </option>
                                <?php
                                        }
                                        ?>
                            </select>
                        </div>
                    </div>
                    <footer class="w3-container w3-teal">
                        <button type="submit" class="btn btn-info btn-sm">Submit</button>
                        <span onclick="document.getElementById('<?php echo $ks_schedule; ?>').style.display='none'"
                            class="w3-button"><button type="button"
                                class="btn btn-secondary btn-sm">Kembali</button></span>
                    </footer>
                </form>
            </div>
        </div>
    </tr>
    <?php
        }
    }
    ?>
</table>