<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

$memo_id = $_GET['memo_id'];

$biodata = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN memo ON karyawan.karyawan_ktp=memo.memo_ktp WHERE memo.memo_id='$memo_id' ORDER BY memo.memo_id DESC ");
$v_biodata = mysql_fetch_array($biodata);



$bln = $array_bln[date('n', strtotime($v_biodata['memo_tanggal']))];


$blnbuat = date('M', strtotime($v_biodata['memo_tanggal']));
$blnbuatList = array(
    'Jan' => 'Januari',
    'Feb' => 'Februari',
    'Mar' => 'Maret',
    'Apr' => 'April',
    'May' => 'Mei',
    'Jun' => 'Juni',
    'Jul' => 'Juli',
    'Aug' => 'Agustus',
    'Sep' => 'September',
    'Oct' => 'Oktober',
    'Nov' => 'November',
    'Dec' => 'Desember'
);

?>

<table width="50%" height="793" border="0" background="assets/img/bacgkground-logo.jpg">
    <tr height="151">
        <td valign="top">
            <hr size="4px" color="#20B2AA">
            <table width="100%">
                <tr>
                    <td width="20%" align="right"><img src="assets/img/logo.png" width="60" height="60"></td>
                    <td width="80%" align="left">
                        <font size="4" color="#20B2AA"><b>PT. Rackindo Setara Perkasa</b></font>
                    </td>
                </tr>
            </table>


        </td>
    </tr>
    <tr>
        <td valign="top">
            <center>
                <b><?php echo "No : RSP/" . $v_biodata['memo_no'] . "/" . $bln . "/" . date("Y", strtotime($v_biodata['memo_tanggal'])); ?></b>
            </center>
            <blockquote>
                Kepada Yth. <br>
                Klinik Dharma Asih <br>
                Jakarta <br>
                <br>
                <p class="MsoNormal" style="text-align: justify; text-indent: 0.5in;">Dengan hormat,</p>
                <p class="MsoNormal" style="text-align: justify; text-indent: 0.5in;">Dengan memo ini mohon untuk
                    dilakukan pemeriksaan kesehatan dan pengobatan terhadap salah satu karyawan kami sebagai berikut :
                </p>
                <blockquote>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo $v_biodata['ktp_nama']; ?></td>
                        </tr>
                        <tr>
                            <td>Bagian</td>
                            <td>:</td>
                            <td><?php echo $v_biodata['bagian_nama']; ?></td>
                        </tr>
                    </table>
                </blockquote>
                <p class="MsoNormal" style="text-align: justify; text-indent: 0.5in;">Sekian dan terimakasih atas
                    kerjasama yang diberikan.</p><br><br>
                <table width="100%">
                    <tr>
                        <td align="center">Mengetahui,</td>
                        <td colspan="2" align="center">Hormat Kami</td>
                    </tr>
                    <tr>
                        <td><br><br><br><br><br></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center"><u>(________________)</u><br>Supervisor</td>
                        <td align="center"><u>( Lim Tjon Hoe )</u><br>Kepala Pabrik</td>
                        <td align="center"><u>( Nasirin )</u><br>Personalia</td>
                    </tr>
                </table>

            </blockquote>
        </td>
    </tr>
    <tr>
        <td height="75" valign="top">
            <table width="100%">
                <tr>
                    <td colspan="3">
                        <font size="2" color="#20B2AA"><b>PT. Rackindo Setara Perkasa</b></font>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40%">
                        <font size="2" color="gray"> Kompleks Pergudangan Kamal Indah, Jl. Kapuk Kamal Indah Kav. 15-17,
                            Jakarta Barat 11810, Indonesia</font>
                    </td>
                    <td width="10%">
                        <font size="2">Telp <br>Fax <br>Website</font>
                    </td>
                    <td width="50%">
                        <font size="2" color="gray">021 5595 1295 / 5595 1393 / 5595 8524 / 55958527 <br>021 2255 6109
                            <br>www.rackindo-furniture.com
                        </font>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
</table>