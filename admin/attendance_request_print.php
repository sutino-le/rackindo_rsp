<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

$absen_izin_id = $_GET['absen_izin_id'];

$biodata = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN absen_izin ON karyawan.karyawan_finger=absen_izin.absen_izin_pin WHERE absen_izin.absen_izin_id='$absen_izin_id' ORDER BY absen_izin.absen_izin_id DESC ");
$v_biodata = mysql_fetch_array($biodata);



$bln = $array_bln[date('n', strtotime($v_biodata['absen_izin_tanggal_buat']))];


$blnbuat = date('M', strtotime($v_biodata['absen_izin_tanggal_buat']));
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


$tanggal_dibuat = $v_biodata['absen_izin_tanggal_buat'];
$tanggal_tidak_masuk = $v_biodata['absen_izin_tanggal'];
if ($tanggal_dibuat > $tanggal_tidak_masuk) {
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
                        <td align="left" colspan="3">
                            <b><?php echo "No : " . $v_biodata['absen_izin_nomor'] . "/HRD/PTMK/" . $bln . "/RSP/" . date("Y", strtotime($v_biodata['absen_izin_tanggal_buat'])); ?></b>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="right" colspan="3">Tgl :
                            <?php echo date("d/m/Y", strtotime($v_biodata['absen_izin_tanggal_buat'])); ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">Saya yang bertandatangan di bawah ini :</td>
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
                        <td><?php echo $v_biodata['ktp_nama']; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>:</td>
                        <td><?php echo $v_biodata['bagian_nama']; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?php echo $v_biodata['jabatan_nama']; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                        $absen_izin_pin = $v_biodata['absen_izin_pin'];
                        $nomor_izin = $v_biodata['absen_izin_nomor'];
                        $tanggal_izin_buat = $v_biodata['absen_izin_tanggal_buat'];

                        //total hari
                        $query_jumlah_hari = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");

                        //tanggal izin
                        $query_tanggal_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");

                        // Keterangan
                        $query_keterangan_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");
                        $v_keterangan_izin = mysql_fetch_array($query_keterangan_izin);

                        //tanggal izin disetujui
                        $query_tanggal_izin_disetujui = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");




                        $v_query_jumlah_hari = mysql_num_rows($query_jumlah_hari);
                        ?>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><?php echo $v_keterangan_izin['absen_izin_keterangan']; ?> pada tanggal (
                            <?php
                                while ($tanggal_ijin_karyawan = mysql_fetch_array($query_tanggal_izin)) {
                                    echo date("d/m/Y", strtotime($tanggal_ijin_karyawan['absen_izin_tanggal'])) . ", ";
                                }
                                ?>
                            )</td>
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
                                Demikian surat bukti lapor ini dibuat dengan tujuan untuk menerangkan bahwa
                                karyawan yang bersangkutan memang benar melakukan ijin pada tanggal tersebut dan
                                memberikan
                                pengarahan sekaligus peringatan kepada karyawan agar menaati seluruh tata tertib dan
                                peraturan perusahaan.
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
                        <td>Pemohon</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Koordinator</td>
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
                        <td>( <?php echo $v_biodata['ktp_nama']; ?> )</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <?php
                            $bagian_karyawan = $v_biodata['karyawan_bagian'];
                            $jabatan_karyawan = $v_biodata['karyawan_jabatan'];
                            $query_koordinator = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$bagian_karyawan' AND karyawan.karyawan_jabatan='4' OR  karyawan.karyawan_bagian='$bagian_karyawan' AND karyawan.karyawan_jabatan='3' ORDER BY karyawan.karyawan_jabatan ASC");
                            $v_query_koordinator = mysql_fetch_array($query_koordinator);

                            if ($jabatan_karyawan == '4' or $jabatan_karyawan == '3') {
                                $koordinator = "";
                            } else {
                                if ($bagian_karyawan == '66' or $bagian_karyawan == '67') {
                                    $koordinator = "Ahyani";
                                } else {
                                    $koordinator = $v_query_koordinator['ktp_nama'];
                                }
                            }

                            ?>
                        <td>( <?php echo $koordinator; ?> )</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">
                            Menyetujui,
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
                        <td colspan="5" align="center">
                            <table width="100%">
                                <tr align="center">
                                    <td>Supervisor</td>
                                    <td>Kepala Shift</td>
                                    <td>Kepala Produksi</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <br><br><br><br><br>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>( <?php echo $v_keterangan_izin['absen_izin_spv']; ?> )</td>
                                    <td>( Bpk Nasirin )</td>
                                    <td>( Bpk Tutur )</td>
                                </tr>
                            </table>
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



<?php
} else {

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
                        <td align="left" colspan="3">
                            <b><?php echo "No : " . $v_biodata['absen_izin_nomor'] . "/HRD/PTMK/" . $bln . "/RSP/" . date("Y", strtotime($v_biodata['absen_izin_tanggal_buat'])); ?></b>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="right" colspan="3">Tgl :
                            <?php echo date("d/m/Y", strtotime($v_biodata['absen_izin_tanggal_buat'])); ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="5">Saya yang bertandatangan di bawah ini :</td>
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
                        <td><?php echo $v_biodata['ktp_nama']; ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Departemen</td>
                        <td>:</td>
                        <td><?php echo $v_biodata['bagian_nama']; ?></td>
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
                        <td colspan="5">Dengan ini mengajukan permohonan untuk tidak Masuk Kerja</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                        $absen_izin_pin = $v_biodata['absen_izin_pin'];
                        $nomor_izin = $v_biodata['absen_izin_nomor'];
                        $tanggal_izin_buat = $v_biodata['absen_izin_tanggal_buat'];

                        //total hari
                        $query_jumlah_hari = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");

                        //tanggal izin
                        $query_tanggal_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");

                        // Keterangan
                        $query_keterangan_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");
                        $v_keterangan_izin = mysql_fetch_array($query_keterangan_izin);

                        //tanggal izin disetujui
                        $query_tanggal_izin_disetujui = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_izin_pin' AND absen_izin_tanggal_buat='$tanggal_izin_buat'  ");




                        $v_query_jumlah_hari = mysql_num_rows($query_jumlah_hari);
                        ?>
                    <tr>
                        <td>Selama</td>
                        <td>:</td>
                        <td><?php echo $v_query_jumlah_hari; ?> hari (
                            <?php echo $v_keterangan_izin['absen_izin_jenis']; ?> )</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>
                            <?php
                                while ($tanggal_ijin_karyawan = mysql_fetch_array($query_tanggal_izin)) {
                                    echo date("d/m/Y", strtotime($tanggal_ijin_karyawan['absen_izin_tanggal'])) . " - ";
                                }
                                ?>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Keperluan</td>
                        <td>:</td>
                        <td><?php echo $v_keterangan_izin['absen_izin_keterangan']; ?></td>
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
                        <td colspan="5">Saya mengetahui dan menyetujui segala bentuk ketidakhadiran di luar tanggal
                            tersebut di atas dengan alasan apapun akan diperhitungkan sebagai ALPA.</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Pemohon</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>Koordinator</td>
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
                        <td>( <?php echo $v_biodata['ktp_nama']; ?> )</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <?php
                            $bagian_karyawan = $v_biodata['karyawan_bagian'];
                            $jabatan_karyawan = $v_biodata['karyawan_jabatan'];
                            $query_koordinator = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$bagian_karyawan' AND karyawan.karyawan_jabatan='4' OR  karyawan.karyawan_bagian='$bagian_karyawan' AND karyawan.karyawan_jabatan='3' ORDER BY karyawan.karyawan_jabatan ASC");
                            $v_query_koordinator = mysql_fetch_array($query_koordinator);

                            if ($jabatan_karyawan == '4' or $jabatan_karyawan == '3') {
                                $koordinator = "";
                            } else {
                                if ($bagian_karyawan == '66' or $bagian_karyawan == '67') {
                                    $koordinator = "Ahyani";
                                } else {
                                    $koordinator = $v_query_koordinator['ktp_nama'];
                                }
                            }

                            ?>
                        <td>( <?php echo $koordinator; ?> )</td>
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
                            Disetujui / Tidak Disetujui* selama
                            <br>
                            <?php
                                while ($v_tanggal_izin_disetujui = mysql_fetch_array($query_tanggal_izin_disetujui)) {
                                    echo date("d/m/Y", strtotime($v_tanggal_izin_disetujui['absen_izin_tanggal'])) . " - ";
                                }
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
                        <td colspan="5" align="center">
                            <table width="100%">
                                <tr align="center">
                                    <td>Supervisor</td>
                                    <td>Kepala Shift</td>
                                    <td>Kepala Produksi</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <br><br><br><br><br>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td>( <?php echo $v_keterangan_izin['absen_izin_spv']; ?> )</td>
                                    <td>( Bpk Nasirin )</td>
                                    <td>( Bpk Tutur )</td>
                                </tr>
                            </table>
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
<?php
}
?>