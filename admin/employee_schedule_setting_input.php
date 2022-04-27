<?php
$karyawan_npk = $_GET['id'];
$karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_npk='$karyawan_npk' ");
$v_karyawan = mysql_fetch_array($karyawan);
?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Setting Schedule</h3>
    </div>

    <form action="home_admin.php?page=employee_schedule_setting_input_process" method="post">

        <input type="hidden" class="form-control" name="karyawan_npk" id="karyawan_npk"
            value="<?php echo $karyawan_npk; ?>" required>
        <div class=" card-body">

            <div class="form-group row">
                <label for="karyawan_npk" class="col-sm-2 col-form-label">NPK </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="karyawan_npk" value="<?php echo $karyawan_npk; ?>"
                        id="karyawan_npk" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="karyawan_nama" class="col-sm-2 col-form-label">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="karyawan_nama"
                        value="<?php echo $v_karyawan['ktp_nama']; ?>" id="karyawan_nama" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="karyawan_schedule_start" class="col-sm-2 col-form-label">Start Date </label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" name="karyawan_schedule_start" id="karyawan_schedule_start"
                        required>
                </div>
            </div>

            <div class="form-group row">
                <label for="schedule" class="col-sm-2 col-form-label">Select Schedule</label>
                <div class="col-sm-10">
                    <table cellspacing="10" cellpadding="10" border="0">
                        <?php
                        $no = 1;
                        $schedule = mysql_query("SELECT * FROM group_schedule GROUP BY gs_code DESC ");
                        while ($tampil_schedule = mysql_fetch_array($schedule)) {
                            if (fmod($no, 2) == 0) {
                                $color = "#AFEEEE";
                            } else {
                                $color = "";
                            }
                        ?>
                        <tr valign="top" bgcolor="<?php echo $color; ?>">
                            <td>
                                <input type="radio" id="karyawan_schedule" name="karyawan_schedule"
                                    value="<?php echo $tampil_schedule['gs_code']; ?>">
                            </td>
                            <td><?php echo $tampil_schedule['gs_code']; ?></td>
                            <td><?php echo $tampil_schedule['gs_nama']; ?></td>
                            <td>
                                <?php
                                    $gs_code = $tampil_schedule['gs_code'];
                                    $shift_daily = mysql_query("SELECT * FROM group_schedule JOIN shift_daily ON group_schedule.gs_shift=shift_daily.sd_id WHERE group_schedule.gs_code='$gs_code' ORDER BY group_schedule.gs_code ASC ");
                                    while ($v_shift_daily = mysql_fetch_array($shift_daily)) {
                                        echo $v_shift_daily['sd_code'] . " - " . $v_shift_daily['sd_type'] . " : " . date("H:i", strtotime($v_shift_daily['sd_masuk'])) . " - " . date("H:i", strtotime($v_shift_daily['sd_pulang'])) . " ( Break : " . date("H:i", strtotime($v_shift_daily['sd_break_awal'])) . " - " . date("H:i", strtotime($v_shift_daily['sd_break_akhir'])) . " ) <br>";
                                    }
                                    ?>
                            </td>
                        </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=employee_schedule_setting"><button type="button"
                        class="btn btn-secondary btn-sm">Back</button></a>
            </div>

        </div>
    </form>