<?php
include "koneksi.php";
include "phpqrcode/qrlib.php";

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
$pkwt_npk = $_GET['karyawan_npk'];
$query_pkwt = mysql_query("SELECT * FROM pkwt JOIN terminate ON pkwt.pkwt_npk=terminate.terminate_npk JOIN karyawan ON pkwt.pkwt_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE pkwt.pkwt_npk='$pkwt_npk' ");
$data_pkwt = mysql_fetch_array($query_pkwt);

$terminate_nomor = $data_pkwt['terminate_nomor'];
$pkwt_aprove = $data_pkwt['pkwt_aprove'];
$pkwt_pihak_satu = $data_pkwt['pkwt_pihak_satu'];
$pkwt_pihak_satu_jabatan = $data_pkwt['pkwt_pihak_satu_jabatan'];
$pkwt_awal = $data_pkwt['pkwt_awal'];
$terminate_tanggal = $data_pkwt['terminate_tanggal'];
$terminate_jenis = $data_pkwt['terminate_jenis'];
$ktp_nama = $data_pkwt['ktp_nama'];
$ktp_alamat = $data_pkwt['ktp_alamat'];
$ktp_rt = $data_pkwt['ktp_rt'];
$ktp_rw = $data_pkwt['ktp_rw'];
$ktp_kelurahan = $data_pkwt['ktp_kelurahan'];
$ktp_kecamatan = $data_pkwt['ktp_kecamatan'];
$ktp_kabupaten = $data_pkwt['ktp_kabupaten'];
$ktp_propinsi = $data_pkwt['ktp_propinsi'];
$bagian_nama = $data_pkwt['bagian_nama'];



$bln = $array_bln[date('n', strtotime($terminate_tanggal))];

$blnjoin = date('M', strtotime($pkwt_awal));
$blnjoinList = array(
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

$blnterminate = date('M', strtotime($terminate_tanggal));
$blnterminateList = array(
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

$blnbuat = date('M', strtotime($terminate_tanggal));
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="gambar/icon.png" />
    <title>SK-<?php echo $terminate_nomor . "-" . $ktp_nama; ?></title>
    <style type="text/css">
    p {
        font-family: calibri;
    }

    tr {
        font-family: calibri;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: white;
    }
    </style>

</head>

<body id="page-top">

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
                            <td>

                                <center>
                                    <p>
                                        <font size="5px"><u><b>SURAT KETERANGAN</b></u></font><br>
                                        <font size="4px">No. :
                                            <?php echo $terminate_nomor . "/SKK/RSP/" . $bln . "/" . date("Y", strtotime($terminate_tanggal)); ?>
                                        </font>
                                    </p>
                                </center>
                                <br>
                                <br>
                                <p>
                                    Yang bertanda tangan di bawah ini menerangkan bahwa :
                                    <br>
                                    <br>
                                    <dd>
                                        <table>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td><b><?php echo $ktp_nama; ?></b></td>
                                            </tr>
                                            <tr>
                                                <td>NPK</td>
                                                <td>:</td>
                                                <td><?php echo $pkwt_npk; ?></td>
                                            </tr>
                                            <tr valign="top">
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . ucwords(strtolower($ktp_kelurahan)) . ", Kec. " . ucwords(strtolower($ktp_kecamatan)) . ", " . ucwords(strtolower($ktp_kabupaten)) . "-" . ucwords(strtolower($ktp_propinsi)); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </dd>
                                    <br>
                                <p align="justify">
                                    Telah bekerja di perusahaan kami sejak tanggal
                                    <?php echo date("d", strtotime($pkwt_awal)) . " " . $blnjoinList[$blnjoin] . " " . date("Y", strtotime($pkwt_awal)); ?>
                                    s.d
                                    <?php echo date("d", strtotime($terminate_tanggal)) . " " . $blnterminateList[$blnterminate] . " " . date("Y", strtotime($terminate_tanggal)); ?>
                                    dengan jabatan
                                    terakhir sebagai <b><?php echo $bagian_nama; ?></b>.
                                    <?php
                                    if ($terminate_jenis == "Prosedur") {
                                    ?>
                                    <br>
                                    <br>
                                    Selama bekerja yang bersangkutan telah melaksanakan tugas dan tanggung jawabnya
                                    dengan baik.
                                    <br>
                                    Kami atas nama Perusahaan mengucapkan terima kasih atas kerjasamanya selama ini.
                                    <?php
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                    <br>
                                    <br>
                                    Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan seperlunya.

                                </p>
                                <br>
                                <br>
                                <table width="100%">
                                    <tr valign="bottom">
                                        <td>
                                            Jakarta,
                                            <?php echo date("d", strtotime($terminate_tanggal)) . " " . $blnbuatList[$blnbuat] . " " . date("Y", strtotime($terminate_tanggal)); ?>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <?php
                                            echo "<b><u>" . $pkwt_pihak_satu . "</u></b><br>" . $pkwt_pihak_satu_jabatan;
                                            ?>
                                        </td>
                                        <td></td>
                                        <td valign="top">
                                            <?php
                                            $kode = "(" . $pkwt_npk . "-" . $ktp_nama . ") - " . $terminate_nomor . "-SKK-RSP-" . $bln . "-" . date("Y", strtotime($terminate_tanggal));

                                            $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
                                            if (!file_exists($tempdir)) //Buat folder bername temp
                                                mkdir($tempdir);

                                            //isi qrcode jika di scan
                                            $codeContents = $kode;
                                            //nama file qrcode yang akan disimpan
                                            $namaFile = $kode . ".png";
                                            //ECC Level
                                            $level = QR_ECLEVEL_H;
                                            //Ukuran pixel
                                            $UkuranPixel = 3;
                                            //Ukuran frame
                                            $UkuranFrame = 2;
                                            QRcode::png($codeContents, $tempdir . $namaFile, $level, $UkuranPixel, $UkuranFrame);
                                            echo '<img src="' . $tempdir . $namaFile . '" />';
                                            ?>
                                        </td>
                                    </tr>
                                </table>



                            </td>
                        </tr>
                    </table>
                </blockquote>
            </td>
        </tr>
    </table>



    <div class="footer">
        <blockquote>
            <table>
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
                                    <font size="2" color="gray"> Kompleks Pergudangan Kamal Indah, Jl. Kapuk Kamal Indah
                                        Kav.
                                        15-17,
                                        Jakarta Barat 11810, Indonesia</font>
                                </td>
                                <td width="10%">
                                    <font size="2">Telp <br>Fax <br>Website</font>
                                </td>
                                <td width="50%">
                                    <font size="2" color="gray">021 5595 1295 / 5595 1393 / 5595 8524 / 55958527 <br>021
                                        2255
                                        6109
                                        <br>www.rackindo-furniture.com
                                    </font>
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </blockquote>
    </div>

</body>

</html>