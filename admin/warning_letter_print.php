<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

$wl_id = $_GET['wl_id'];

$biodata = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN warning_letter ON karyawan.karyawan_ktp=warning_letter.wl_ktp JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE warning_letter.wl_id='$wl_id' ");
$v_biodata = mysql_fetch_array($biodata);

$wl_ktp = $v_biodata['wl_ktp'];
$wl_nomor = $v_biodata['wl_nomor'];
$wl_tanggal = $v_biodata['wl_tanggal'];
$wl_ke = $v_biodata['wl_ke'];
$wl_durasi = $v_biodata['wl_durasi'];
$wl_awal = $v_biodata['wl_awal'];
$wl_akhir = $v_biodata['wl_akhir'];
$wl_keterangan = $v_biodata['wl_keterangan'];
$ktp_nomor = $v_biodata['ktp_nomor'];
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
$bagian_nama = $v_biodata['bagian_nama'];
$jabatan_nama = $v_biodata['jabatan_nama'];
$karyawan_kategori = $v_biodata['karyawan_kategori'];

if ($wl_ke == "lisan") {
    $sp_selanjutnya = "ke-1 (satu)";
} else if ($wl_ke == "ke-1") {
    $sp_selanjutnya = "ke-2 (dua)";
} else if ($wl_ke == "ke-2") {
    $sp_selanjutnya = "ke-3 (tiga)";
}

if ($karyawan_kategori == "Karyawan") {
    $approve = "Bpk. Nasirin";
} else if ($karyawan_kategori == "Staff") {
    $approve = "Ibu Sharleen Wiryawan";
}



$bln = $array_bln[date('n', strtotime($wl_tanggal))];


$blnbuat = date('M', strtotime($wl_tanggal));
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


$blnwlawal = date('M', strtotime($wl_awal));
$blnwlawalList = array(
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


$blnwl_akhir = date('M', strtotime($wl_akhir));
$blnwl_akhirList = array(
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
                            <b><u>SURAT PERINGATAN <?php echo strtoupper($wl_ke); ?> </u></b><br>
                            <?php echo "No : " . $wl_nomor . "/HRD/SP/" . $bln . "/RSP/" . date("Y", strtotime($wl_tanggal)); ?>
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
                        <td colspan="5">
                            <p align="justify">
                                Bahwa untuk menegakan disiplin dan kinerja karyawan, nama yang tercamtum di
                                bawah ini :
                            </p>
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
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $ktp_nama; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>No KTP</td>
                        <td>:</td>
                        <td><?php echo $ktp_nomor; ?></td>
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
                        <td>Jabatan - Bagian</td>
                        <td>:</td>
                        <td><?php echo $jabatan_nama . " - " . $bagian_nama; ?></td>
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

                                <?php echo $wl_keterangan; ?>
                                <br>
                                <br>
                                Sehubungan dengan tindakan indisipliner tersebut maka pihak perusahaan memberikan sanksi
                                berupa surat Peringatan <?php echo ucwords(strtolower($wl_ke)); ?> yang berlaku
                                selama
                                <b><?php echo $wl_durasi; ?></b> terhitung sejak tanggal
                                <b><?php echo date("d", strtotime($wl_awal)) . " " . $blnwlawalList[$blnwlawal] . " " . date("Y", strtotime($wl_awal)); ?></b>
                                sampai dengan
                                <b><?php echo date("d", strtotime($wl_akhir)) . " " . $blnwl_akhirList[$blnwl_akhir] . " " . date("Y", strtotime($wl_akhir)); ?></b>.
                                Apabila dalam jangka waktu tersebut saudara melakukan keselahan yang jenis atau beratnya
                                sama dan/atau lebih rendah, maka saudara akan diberikan surat peringatan
                                <?php echo $sp_selanjutnya; ?>.
                                <br>
                                <br>
                                Demikian Surat Peringatan <?php echo $wl_ke; ?> ini dibuat bertujuan untuk memberikan
                                pengarahan dan seekaligus peringatan kepada saudara agar bersedia menaati tata tertib
                                perusahaan dan tidak melakukan kesalahan yang merugikan perusahaan.

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
                        <td colspan="5">
                            <table width="100%">
                                <tr align="center">
                                    <td colspan="2">
                                        Jakarta,
                                        <?php echo date("d", strtotime($wl_tanggal)) . " " . $blnbuatList[$blnbuat] . " " . date("Y", strtotime($wl_tanggal)); ?>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>Penerima Sanksi</td>
                                    <td>Diberikan oleh</td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2">
                                        <br><br><br><br><br>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>( <?php echo $ktp_nama; ?> )</td>
                                    <td>( <?php echo $approve; ?> )</td>
                                </tr>
                            </table>
                        </td>
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