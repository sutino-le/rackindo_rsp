<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

$skt_id = $_GET['skt_id'];

$biodata = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN skt ON karyawan.karyawan_ktp=skt.skt_ktp WHERE skt.skt_id='$skt_id' ");
$v_biodata = mysql_fetch_array($biodata);

$skt_nomor = $v_biodata['skt_nomor'];
$skt_tanggal = $v_biodata['skt_tanggal'];
$karyawan_npk = $v_biodata['karyawan_npk'];
$ktp_nama = $v_biodata['ktp_nama'];
$ktp_tempat_lahir = $v_biodata['ktp_tempat_lahir'];
$ktp_tanggal_lahir = $v_biodata['ktp_tanggal_lahir'];
$ktp_alamat = $v_biodata['ktp_alamat'];
$ktp_rt = $v_biodata['ktp_rt'];
$ktp_rw = $v_biodata['ktp_rw'];
$ktp_kelurahan = $v_biodata['ktp_kelurahan'];
$ktp_kecamatan = $v_biodata['ktp_kecamatan'];
$ktp_kabupaten = $v_biodata['ktp_kabupaten'];
$ktp_propinsi = $v_biodata['ktp_propinsi'];
$skt_jenis = $v_biodata['skt_jenis'];
$skt_status_karyawan = $v_biodata['skt_status_karyawan'];
$skt_location = $v_biodata['skt_location'];
$skt_aprove = $v_biodata['skt_aprove'];
$skt_aprove_jabatan = $v_biodata['skt_aprove_jabatan'];



$bln = $array_bln[date('n', strtotime($skt_tanggal))];


$blnbuat = date('M', strtotime($skt_tanggal));
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


$blnlahir = date('M', strtotime($ktp_tanggal_lahir));
$blnlahirList = array(
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

<table width="100%" height="100%" border="0">
    <tr height="151">
        <td valign="top">
            <table width="100%">
                <tr>
                    <td colspan="2">
                        <hr size="4px" color="#20B2AA">
                    </td>
                </tr>
                <tr>
                    <td width="14%" align="right"><img src="asset/dist/img/logo.png" width="60" height="60"></td>
                    <td width="86%" align="left">
                        <font size="4" color="#20B2AA"><b>PT. Rackindo Setara Perkasa</b></font>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <blockquote>

                <table width="100%" background="img/bacgkground-logo - Copy.jpg">
                    <tr>
                        <td align="center" colspan="5">
                            <b><u>SURAT KETERANGAN</u></b><br>
                            <?php echo "No : " . $skt_nomor . "/HRD/Skt/" . $bln . "/RSP/" . date("Y", strtotime($skt_tanggal)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">Yang bertandatangan di bawah ini menerangkan bahwa :</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><b><?php echo $ktp_nama; ?></b></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>:</td>
                        <td>
                            <?php echo $ktp_tempat_lahir . "/ "; ?><?php echo date("d", strtotime($ktp_tanggal_lahir)) . " " . $blnlahirList[$blnlahir] . " " . date("Y", strtotime($ktp_tanggal_lahir)); ?>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . ucwords(strtolower($ktp_kelurahan)) . ", Kec. " . ucwords(strtolower($ktp_kecamatan)) . ", " . ucwords(strtolower($ktp_kabupaten)) . "-" . ucwords(strtolower($ktp_propinsi)); ?>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <br>
                            <p align="justify">
                                Menerangkan bahwa nama tersebut diatas, adalah benar karyawan
                                <?php echo $skt_status_karyawan; ?> di PT. Rackindo Setara Perkasa hingga saat ini.
                                <br>
                                <br>
                                Surat Keterangan kerja ini digunakan sebagai syarat administrasi untuk
                                <b><?php echo $skt_jenis; ?></b>.
                                <br>
                                <br>
                                Demikian Surat Keterangan ini dibuat agar dapat digunakan sebagaimana mestinya.

                            </p>
                            <br>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">Jakarta,
                            <?php echo date("d", strtotime($skt_tanggal)) . " " . $blnbuatList[$blnbuat] . " " . date("Y", strtotime($skt_tanggal)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <?php
                            echo "<b><u>" . $skt_aprove . "</u></b><br>" . $skt_aprove_jabatan;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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