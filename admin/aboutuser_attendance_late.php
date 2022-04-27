<!DOCTYPE html>
<html>

<head>

</head>

<body>


    <?php
    include "koneksi.php";

    $tanggal_sekarang = date("Y-m-d");
    ?>


    <table width="100%" class="table table-bordered table-striped">
        <tr bgcolor="#20B2AA" align="center">
            <td colspan="9"><b>Employee Late Data</b></td>
        </tr>
        <tr bgcolor="#20B2AA" align="center">
            <td colspan="4"><b>Employee</b></td>
            <td colspan="2"><b>Schedule</b></td>
            <td colspan="3"><b>Actual</b></td>
        </tr>
        <tr bgcolor="#20B2AA" align="center">
            <td><b>Pin</b></td>
            <td><b>Name</b></td>
            <td><b>Job Title</b></td>
            <td><b>Position</b></td>
            <td><b>Date</b></td>
            <td><b>Schedule In</b></td>
            <td><b>In</b></td>
            <td><b>Out</b></td>
            <td><b>Late</b></td>
        </tr>
        <?php
        $absensi_karyawan = mysql_query("SELECT * FROM absen_karyawan JOIN karyawan ON absen_karyawan.absen_kar_pin=karyawan.karyawan_finger WHERE karyawan.karyawan_status='Aktif' AND absen_karyawan.absen_kar_tanggal='$tanggal_sekarang' ORDER BY karyawan.karyawan_bagian, karyawan.karyawan_jabatan ASC ");

        $jumlah_late = 1;
        while ($v_absensi_karyawan = mysql_fetch_array($absensi_karyawan)) {

            $absen_kar_id = $v_absensi_karyawan['absen_kar_id'];
            $absen_kar_pin = $v_absensi_karyawan['absen_kar_pin'];
            $absen_kar_tanggal = $v_absensi_karyawan['absen_kar_tanggal'];
            $absen_kar_in = $v_absensi_karyawan['absen_kar_in'];
            $absen_kar_out = $v_absensi_karyawan['absen_kar_out']; {
                //Schedule Karyawan
                $karyawan_schedule = mysql_query("SELECT * FROM karyawan_schedule JOIN shift_daily ON karyawan_schedule.ks_schedule=shift_daily.sd_id WHERE karyawan_schedule.ks_finger='$absen_kar_pin' AND karyawan_schedule.ks_tanggal='$absen_kar_tanggal' ");
                $v_karyawan_schedule = mysql_fetch_array($karyawan_schedule);



                if ($absen_kar_in > $v_karyawan_schedule['sd_masuk']) {

                    //Menghitung keterlambatan
                    $jam_schedule_masuk = date_create($v_karyawan_schedule['sd_masuk']);
                    $jam_actual_masuk = date_create($absen_kar_in);
                    $diff_late = date_diff($jam_schedule_masuk, $jam_actual_masuk);
                    $selisih_late = $diff_late->format('%h%');
                    $selisih_late_menit = $diff_late->format('%i%');

                    $late = (($selisih_late * 60) + ($selisih_late_menit));

                    if ($late > 0) {
                        $data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_finger='$absen_kar_pin' ORDER BY karyawan.karyawan_bagian, karyawan.karyawan_jabatan ASC ");
                        $v_data_karyawan = mysql_fetch_array($data_karyawan);

                        $jumlah_late_total = $jumlah_late++;

        ?>
        <tr>
            <td align="center"><b><?php echo $absen_kar_pin; ?></b></td>
            <td><b><?php echo $v_data_karyawan['ktp_nama']; ?></b></td>
            <td><?php echo $v_data_karyawan['bagian_nama']; ?></td>
            <td><?php echo $v_data_karyawan['jabatan_nama']; ?></td>
            <td align="center"><?php echo $absen_kar_tanggal; ?></td>
            <td align="center"><?php echo date("H:i", strtotime($v_karyawan_schedule['sd_masuk'])); ?></td>
            <td align="center"><?php echo date("H:i", strtotime($absen_kar_in)); ?></td>
            <td align="center"><?php echo date("H:i", strtotime($absen_kar_out)); ?></td>
            <td align="center"><?php echo $late; ?></td>

        </tr>
        <?php
                    } else {
                    }
                } else {
                }
            }
        }
        ?>
    </table>


</body>

</html>
<br>