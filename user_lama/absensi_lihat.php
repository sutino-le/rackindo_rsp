<!DOCTYPE html>
<html>

<head>

    <style style="text/css">
    /* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
        background-color: #20B2AA;
    }

    thead {
        display: block;
    }

    tbody {
        display: block;
        overflow-y: scroll;
        height: 350px;
    }

    td,
    th {
        width: 137px;
        height: 1px;
    }

    table {
        width: 100%;
    }
    </style>

</head>

<body>


    <?php
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $pin = $_POST['pin'];
        $periode_awal = $_POST['awal'];
        $periode_akhir = $_POST['akhir'];


        $data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id  JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_finger='$pin'");
        $v_data_karyawan = mysql_fetch_array($data_karyawan);
        $nama = $v_data_karyawan['ktp_nama'];
        $bagian = $v_data_karyawan['bagian_nama'];
        $jabatan = $v_data_karyawan['jabatan_nama'];
    } else {
        $karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_ktp='$user_ktp' ");
        $v_karyawan = mysql_fetch_array($karyawan);
        $pin = $v_karyawan['karyawan_finger'];
        $nama = $v_karyawan['ktp_nama'];
        $bagian = $v_karyawan['bagian_nama'];
        $jabatan = $v_karyawan['jabatan_nama'];
        $periode_akhir = date("Y-m-25");
        $tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
        $periode_awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));
    }


    $absensi = mysql_query("SELECT * FROM absen_karyawan JOIN karyawan ON absen_karyawan.absen_kar_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE absen_karyawan.absen_kar_pin='$pin' AND absen_karyawan.absen_kar_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY absen_kar_tanggal ASC ");





    ?>
    <form class="form-horizontal" action="" method="post">
        <div class=" card-body">
            <div class="form-group row">
                <div class="col col-3">
                    <input type="date" class="form-control col-2" name="awal" value="<?php echo $periode_awal; ?>"
                        required>
                </div>
                <div class="col col-3">
                    <input type="date" class="form-control col-2" name="akhir" value="<?php echo $periode_akhir; ?>"
                        required>
                </div>
                <div class="col col-3">
                    <select class="form-control col-2" name="pin" id="pin" required>
                        <option value="<?php echo $pin; ?>"><?php echo $nama . " - " . $bagian; ?></option>
                        <option value=""></option>
                        <?php
                        $karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_ktp='$user_ktp' ");
                        while ($v_karyawan = mysql_fetch_array($karyawan)) {
                        ?>
                        <option value="<?php echo $v_karyawan['karyawan_finger']; ?>">
                            <?php echo $v_karyawan['ktp_nama'] . " - " . $v_karyawan['bagian_nama']; ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col col-3">
                    <button type="submit" class="btn btn-info btn-sm">Show Attendance</button>
                </div>
            </div>
        </div>
    </form>

    ID Finger : <?php echo "<b>" . $pin . "</b>"; ?>&nbsp;|&nbsp;Nama :
    <?php echo "<b>" . $nama . "</b>"; ?>&nbsp;|&nbsp;Jabatan/Bagian
    :
    <?php echo "<b>" . $jabatan . "</b>" . "/<b>" . $bagian . "</b>"; ?>



    <table class="table table-bordered hoverTable">
        <thead>
            <tr bgcolor="#20B2AA" align="center">
                <th colspan="3"><b>Work schedule</b></th>
                <th colspan="2"><b>Fingerprint</b></th>
                <th colspan="3"><b>Notes</b></th>
                <th colspan="2"><b>Presence</b></th>

            </tr>
            <tr bgcolor="#20B2AA" align="center">
                <th><b>Date</b></th>
                <th><b>In</b></th>
                <th><b>Out</b></th>
                <th><b>In</b></th>
                <th><b>Out</b></th>
                <th><b>Late</b></th>
                <th><b>Early Out</b></th>
                <th><b>Over</b></th>
                <th><b>Type</b></th>
                <th><b>Information</b></th>

            </tr>
        </thead>
        <tbody class="text-left">
            <?php


            while ($v_absensi = mysql_fetch_array($absensi)) {
                $absen_kar_pin = $v_absensi['absen_kar_pin'];
                $nama = $v_absensi['finger_nama'];
                $absen_kar_id = $v_absensi['absen_kar_id'];
                $absen_kar_tanggal = $v_absensi['absen_kar_tanggal'];
                $absen_kar_in = $v_absensi['absen_kar_in'];
                $absen_kar_out = $v_absensi['absen_kar_out'];
                $karyawan_schedule = $v_absensi['karyawan_schedule']; {
                    $schedule = mysql_query("SELECT * FROM karyawan_schedule JOIN shift_daily ON karyawan_schedule.ks_schedule=shift_daily.sd_id WHERE karyawan_schedule.ks_finger='$absen_kar_pin' AND karyawan_schedule.ks_tanggal='$absen_kar_tanggal' ");
                    $v_schedule = mysql_fetch_array($schedule);

                    //Schedule Masuk
                    if ($v_schedule['sd_masuk'] == "00:00:00" or empty($v_schedule['sd_masuk'])) {
                        $schedule_masuk = "";
                    } else {
                        $schedule_masuk = date("H:i", strtotime($v_schedule['sd_masuk']));
                    }

                    //Schedule Pulang
                    if ($v_schedule['sd_pulang'] == "00:00:00" or empty($v_schedule['sd_pulang'])) {
                        $schedule_pulang = "";
                    } else {
                        $schedule_pulang = date("H:i", strtotime($v_schedule['sd_pulang']));
                    }

                    //Schedule Break Start
                    if ($v_schedule['sd_break_awal'] == "00:00:00" or empty($v_schedule['sd_break_awal'])) {
                        $sd_break_awal = "";
                    } else {
                        $sd_break_awal = date("H:i", strtotime($v_schedule['sd_break_awal']));
                    }

                    //Schedule Break End
                    if ($v_schedule['sd_break_akhir'] == "00:00:00" or empty($v_schedule['sd_break_akhir'])) {
                        $sd_break_akhir = "";
                    } else {
                        $sd_break_akhir = date("H:i", strtotime($v_schedule['sd_break_akhir']));
                    }


                    //Absen Masuk
                    if ($absen_kar_in == "00:00:00") {
                        $absen_masuk = "";
                    } else {
                        $absen_masuk = date("H:i", strtotime($absen_kar_in));
                        if ($absen_masuk > $schedule_masuk) {

                            //Menghitung keterlambatan
                            $jam_schedule_masuk = date_create($schedule_masuk);
                            $jam_actual_masuk = date_create($absen_masuk);
                            $diff_late = date_diff($jam_schedule_masuk, $jam_actual_masuk);
                            $selisih_late_jam = $diff_late->format('%h%');
                            $selisih_late_menit = $diff_late->format('%i%');

                            //Istirahat
                            $break_start = date_create($sd_break_awal);
                            $break_end = date_create($sd_break_akhir);
                            $diff_break = date_diff($break_start, $break_end);
                            $selisih_break = $diff_break->format('%h%');
                            $selisih_break_menit = $diff_break->format('%i%');

                            $late = (($selisih_late_jam * 60) + ($selisih_late_menit));
                        } else {
                            $late = "";
                        }
                    }

                    //Absen Pulang
                    if ($absen_kar_out == "00:00:00") {
                        $absen_pulang = "";
                        $early = "";
                        $over = "";
                    } else {
                        $absen_pulang = date("H:i", strtotime($absen_kar_out));
                        if ($absen_pulang < $schedule_pulang) {

                            //Menghitung pulang cepat
                            $jam_schedule_pulang = date_create($schedule_pulang);
                            $jam_actual_pulang = date_create($absen_pulang);
                            $diff_early = date_diff($jam_actual_pulang, $jam_schedule_pulang);
                            $selisih_early_jam = $diff_early->format('%h%');
                            $selisih_early_menit = $diff_early->format('%i%');

                            //Istirahat
                            $break_start = date_create($sd_break_awal);
                            $break_end = date_create($sd_break_akhir);
                            $diff_break = date_diff($break_start, $break_end);
                            $selisih_break = $diff_break->format('%h%');
                            $selisih_break_menit = $diff_break->format('%i%');

                            $selisih_early = (($selisih_early_jam * 60) + ($selisih_early_menit));
                            $jumlah_selesih_break = ($selisih_break * 60) + ($selisih_break_menit);

                            if ($absen_pulang < $sd_break_akhir) {
                                $early = $selisih_early - $jumlah_selesih_break;
                                $over = "";
                            } else if ($absen_pulang > $sd_break_akhir and $absen_pulang < $schedule_pulang) {
                                $early = $selisih_early;
                                $over = "";
                            }
                        } else if ($absen_pulang > $schedule_pulang) {
                            //Menghitung pulang lebih
                            $jam_schedule_pulang = date_create($schedule_pulang);
                            $jam_actual_pulang = date_create($absen_pulang);
                            $diff_over = date_diff($jam_schedule_pulang, $jam_actual_pulang);
                            $selisih_over = $diff_over->format('%h%');
                            $selisih_over_menit = $diff_over->format('%i%');

                            $over = (($selisih_over * 60) + ($selisih_over_menit)) / 60;
                            $early = "";
                        }
                    }


                    //Cek absen izin
                    $absen_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_kar_pin' AND absen_izin_tanggal='$absen_kar_tanggal' ");
                    $v_absen_izin = mysql_fetch_array($absen_izin);

                    if ($v_schedule['sd_type'] == "Holiday") {
                        $color_izin = "#F08080";
                        $absen_izin_jenis = "Off";
                        $title_izin = "";
                    } else if ($v_absen_izin['absen_izin_jenis'] == "LN") {
                        $color_izin = "#F08080";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "Vaks") {
                        $color_izin = "#6495ED";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "S") {
                        $color_izin = "#9ACD32";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "I") {
                        $color_izin = "#9ACD32";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "ITD") {
                        $color_izin = "#FF8C00";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "1/2") {
                        $color_izin = "#FFA500";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "STK") {
                        $color_izin = "#FF8C00";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else if ($v_absen_izin['absen_izin_jenis'] == "A") {
                        $color_izin = "#DC143C";
                        $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                        $title_izin = $v_absen_izin['absen_izin_keterangan'];
                    } else {
                        $color_izin = "";
                        $absen_izin_jenis = "";
                        $koreksi_absen = mysql_query("SELECT * FROM absen_koreksi WHERE absen_koreksi_pin='$absen_kar_pin' AND absen_koreksi_tanggal='$absen_kar_tanggal' ");
                        $v_koreksi_absen = mysql_fetch_array($koreksi_absen);
                        if (empty($v_koreksi_absen)) {
                            $title_izin = "";
                        } else {
                            $title_izin = "Koreksi absen : " . $v_koreksi_absen['absen_koreksi_keterangan'];
                        }
                    }

            ?>
            <tr bgcolor="<?php echo $color_izin; ?>">
                <td align="center"><b><?php echo $absen_kar_tanggal; ?></b></td>
                <td align="center"><b><?php echo $schedule_masuk; ?></b></td>
                <td align="center"><b><?php echo $schedule_pulang; ?></b></td>
                <td align="center"><?php echo $absen_masuk; ?></td>
                <td align="center"><?php echo $absen_pulang; ?></td>
                <td align="center"><?php echo $late; ?></td>
                <td align="center"><?php echo round($early / 60, 1); ?></td>
                <td align="center"><?php echo round($over, 1); ?></td>
                <td align="center"><b><?php echo $absen_izin_jenis; ?></b></td>
                <td><?php echo $title_izin; ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>




</body>

</html>