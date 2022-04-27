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
        $periode_awal_schedule = date("00:00:00");
        $tanggal_sekarang_schedule = date("23:59:00");
        $karyawan_kategori = $_POST['kategori'];
    } else {
        $periode_awal = date("Y-m-d");
        $tanggal_sekarang = date("Y-m-d");
        $periode_awal_schedule = date("00:00:00");
        $tanggal_sekarang_schedule = date("23:59:00");
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


    <table width="100%" class="table table-bordered table-striped">
        <tr bgcolor="#20B2AA" align="center">
            <td colspan="10"><b>Employee No Info</b></td>
        </tr>
        <tr bgcolor="#20B2AA" align="center">
            <td colspan="4"><b>Employee</b></td>
            <td colspan="3"><b>Schedule</b></td>
            <td colspan="3"><b>Actual</b></td>
        </tr>
        <tr bgcolor="#20B2AA" align="center">
            <td><b>Pin</b></td>
            <td><b>Name</b></td>
            <td><b>Job Title</b></td>
            <td><b>Position</b></td>
            <td><b>Date</b></td>
            <td><b>Schedule In</b></td>
            <td><b>Schedule Out</b></td>
            <td><b>In</b></td>
            <td><b>Out</b></td>
            <td><b>Info</b></td>
        </tr>
        <?php
        $absensi_karyawan = mysql_query("SELECT * FROM absen_karyawan JOIN karyawan ON absen_karyawan.absen_kar_pin=karyawan.karyawan_finger WHERE karyawan.karyawan_status='Aktif' AND karyawan.karyawan_kategori like '%$karyawan_kategori%' AND absen_karyawan.absen_kar_tanggal BETWEEN '$periode_awal' AND '$tanggal_sekarang' ORDER BY karyawan.karyawan_bagian, karyawan.karyawan_jabatan ASC ");

        while ($v_absensi_karyawan = mysql_fetch_array($absensi_karyawan)) {

            $karyawan_ktp = $v_absensi_karyawan['karyawan_ktp'];
            $absen_kar_id = $v_absensi_karyawan['absen_kar_id'];
            $absen_kar_pin = $v_absensi_karyawan['absen_kar_pin'];
            $absen_kar_tanggal = $v_absensi_karyawan['absen_kar_tanggal'];
            $absen_kar_in = $v_absensi_karyawan['absen_kar_in'];
            $absen_kar_out = $v_absensi_karyawan['absen_kar_out']; {

                //izin
                $absen_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_kar_pin' AND absen_izin_tanggal='$absen_kar_tanggal' ");
                $v_absen_izin = mysql_fetch_array($absen_izin);
                $jenis_izin = $v_absen_izin['absen_izin_jenis'];
                $keterangan = $v_absen_izin['absen_izin_keterangan'];
                if (empty($v_absen_izin)) {
                    $izin = "";
                } else {
                    $izin = $jenis_izin . " = " . $keterangan;
                }

                //Memo
                $memo = mysql_query("SELECT * FROM memo WHERE memo_ktp='$karyawan_ktp' AND memo_tanggal='$absen_kar_tanggal' ");
                $v_memo = mysql_fetch_array($memo);
                if (empty($v_memo)) {
                    $cek_memo = "";
                } else {
                    $cek_memo = "Telah dibuatkan memo <br>";
                }

                //Schedule Karyawan
                $karyawan_schedule = mysql_query("SELECT * FROM karyawan_schedule JOIN shift_daily ON karyawan_schedule.ks_schedule=shift_daily.sd_id WHERE karyawan_schedule.ks_finger='$absen_kar_pin' AND karyawan_schedule.ks_tanggal='$absen_kar_tanggal' AND shift_daily.sd_masuk BETWEEN '$periode_awal_schedule' AND '$tanggal_sekarang_schedule' ");
                $v_karyawan_schedule = mysql_fetch_array($karyawan_schedule);


                if ($absen_kar_in == "00:00:00" and !empty($v_karyawan_schedule)) {
                    $data_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_finger='$absen_kar_pin'  ORDER BY karyawan.karyawan_bagian, karyawan.karyawan_jabatan ASC ");
                    $v_data_karyawan = mysql_fetch_array($data_karyawan);

        ?>
        <tr>
            <td align="center"><b><?php echo $absen_kar_pin; ?></b></td>
            <td><b><?php echo $v_data_karyawan['ktp_nama']; ?></b></td>
            <td><?php echo $v_data_karyawan['bagian_nama']; ?></td>
            <td><?php echo $v_data_karyawan['jabatan_nama']; ?></td>
            <td align="center"><?php echo $absen_kar_tanggal; ?></td>
            <td align="center"><?php echo date("H:i", strtotime($v_karyawan_schedule['sd_masuk'])); ?></td>
            <td align="center"><?php echo date("H:i", strtotime($v_karyawan_schedule['sd_pulang'])); ?></td>
            <td align="center"><?php echo date("H:i", strtotime($absen_kar_in)); ?></td>
            <td align="center"><?php echo date("H:i", strtotime($absen_kar_out)); ?></td>
            <td><?php echo $cek_memo . "" . $izin; ?></td>

        </tr>
        <?php
                } else {
                }
            }
        }
        ?>
    </table>


</body>

</html>