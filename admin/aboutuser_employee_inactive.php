<?php
include "koneksi.php";

$periode_akhir = date("Y-m-25");
$tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
$periode_awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));

$karyawan_keluar = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN user ON biodata_ktp.ktp_nomor=user.user_ktp WHERE karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir'  ");


?>
<table width="100%" class="table table-bordered table-striped">
    <tr bgcolor="#20B2AA" align="center">
        <th>No</th>
        <th>NPK</th>
        <th>Full Name</th>
        <th>Job Title</th>
        <th>Position</th>
        <th>Terminate</th>
    </tr>
    <?php
    $no = 1;
    while ($v_karyawan_keluar = mysql_fetch_array($karyawan_keluar)) {
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $v_karyawan_keluar['karyawan_npk']; ?></td>
        <td><?php echo $v_karyawan_keluar['ktp_nama']; ?></td>
        <td><?php echo $v_karyawan_keluar['bagian_nama']; ?></td>
        <td><?php echo $v_karyawan_keluar['jabatan_nama']; ?></td>
        <td><?php echo $v_karyawan_keluar['karyawan_terminate']; ?></td>
    </tr>
    <?php
        $no++;
    }
    ?>
</table>
<br>