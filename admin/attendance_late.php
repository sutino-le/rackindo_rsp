<!DOCTYPE html>
<html>

<head>

</head>

<body>


    <?php
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $periode_awal = $_POST['awal'];
        $tanggal_sekarang = $_POST['akhir'];
        $karyawan_kategori = $_POST['kategori'];
    } else {
        $periode_awal = date("Y-m-d");
        $tanggal_sekarang = date("Y-m-d");
        $karyawan_kategori = "";
        // $periode_akhir=date("Y-m-25");
        // $tambah1=date ("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
        // $periode_awal=date ("Y-m-d", strtotime("-1 month", strtotime($tambah1)));


    }

    ?>
    <form class="form-horizontal" action="" method="post">
        <div class=" card-body">
            <div class="form-group row">
                <input type="date" class="form-control col-2" name="awal" value="<?php echo $periode_awal; ?>"
                    required>&nbsp;
                <input type="date" class="form-control col-2" name="akhir" value="<?php echo $tanggal_sekarang; ?>"
                    required>&nbsp;
                <select class="form-control col-2" name="kategori" id="kategori">
                    <option value="">Select Category</option>
                    <option value=""></option>
                    <option value="Staff">Staff</option>
                    <option value="Karyawan">Karyawan</option>
                </select>&nbsp;
                <button type="submit" class="btn btn-info btn-sm">Show Attendance</button>
            </div>
        </div>
    </form>


    <table border="1" cellpadding="5" width="100%">
        <tr bgcolor="#20B2AA" align="center">
            <td colspan="10"><b>Employee Late Data</b></td>
        </tr>
        <tr bgcolor="#20B2AA" align="center">
            <td colspan="5"><b>Employee</b></td>
            <td colspan="2"><b>Schedule</b></td>
            <td colspan="3"><b>Actual</b></td>
        </tr>
        <tr bgcolor="#20B2AA" align="center">
            <td><b>Pin</b></td>
            <td><b>Name</b></td>
            <td><b>Status</b></td>
            <td><b>Job Title</b></td>
            <td><b>Position</b></td>
            <td><b>Date</b></td>
            <td><b>Schedule In</b></td>
            <td><b>In</b></td>
            <td><b>Out</b></td>
            <td><b>Late</b></td>
        </tr>
        <?php
        $absensi_karyawan = mysql_query("SELECT * FROM absen_karyawan JOIN karyawan ON absen_karyawan.absen_kar_pin=karyawan.karyawan_finger WHERE karyawan.karyawan_status='Aktif' AND karyawan.karyawan_kategori like '%$karyawan_kategori%'  AND absen_karyawan.absen_kar_tanggal BETWEEN '$periode_awal' AND '$tanggal_sekarang' ORDER BY karyawan.karyawan_bagian, karyawan.karyawan_jabatan, karyawan.karyawan_join, absen_karyawan.absen_kar_tanggal ASC ");

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
                        $data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_finger='$absen_kar_pin' ");
                        $v_data_karyawan = mysql_fetch_array($data_karyawan);

        ?>
        <tr>
            <td align="center"><b><?php echo $absen_kar_pin; ?></b></td>
            <td><b><?php echo $v_data_karyawan['ktp_nama']; ?></b></td>
            <td><?php echo $v_data_karyawan['karyawan_jenis']; ?></td>
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