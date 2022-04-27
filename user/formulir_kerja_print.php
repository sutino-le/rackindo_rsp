<?php
include "koneksi.php";

$ktp_nomor = $_GET['ktp_nomor'];

//karyawan
$karyawan = mysql_query("SELECT * FROM karyawan JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_ktp='$ktp_nomor' ");
$v_karyawan = mysql_fetch_array($karyawan);

//biodata_ktp
$biodata_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$v_biodata_ktp = mysql_fetch_array($biodata_ktp);

//biodata_npwp
$biodata_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$ktp_nomor' ");
$v_biodata_npwp = mysql_fetch_array($biodata_npwp);
$npwp = $v_biodata_npwp['npwp_nomor'];

//user
$user = mysql_query("SELECT * FROM user WHERE user_ktp='$ktp_nomor' ");
$v_user = mysql_fetch_array($user);

//biodata_domisili
$biodata_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$ktp_nomor' ");
$v_biodata_domisili = mysql_fetch_array($biodata_domisili);

//biodata_keluarga
$biodata_keluarga = mysql_query("SELECT * FROM biodata_keluarga JOIN keluarga_silsilah ON biodata_keluarga.keluarga_jenis=keluarga_silsilah.silsilah_id WHERE biodata_keluarga.keluarga_ktp='$ktp_nomor' ");

//pendidikan
$pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$ktp_nomor' ORDER BY pendidikan_awal DESC ");

//biodata_pengalaman
$biodata_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_ktp='$ktp_nomor' ORDER BY pengalaman_awal DESC ");

//biodata_darurat
$biodata_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$ktp_nomor' ");




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Aplikasi Pekerjaan</title>
    <style type="text/css">
    body,
    td,
    th {
        font-size: small;
    }
    </style>
</head>

<body>


    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <td colspan="6" align="center" valign="top">
                <p><strong>FORMULIR APLIKASI PELAMAR</strong><br><strong>PT RACKINDO SETARA PERKASA</strong></p>
            </td>
        </tr>
        <tr>
            <td colspan="6" valign="top" bgcolor="#00AEA6"><strong>A. Identitas Pribadi</strong></td>
        </tr>
        <tr>
            <td valign="top">Nomor KTP</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_biodata_ktp['ktp_nomor']; ?></td>
            <td rowspan="10" align="center" valign="top"><img src="../admin/foto/<?php echo $v_user['user_foto']; ?>"
                    class="rounded avatar-xl img-thumbnail" alt="<?php echo $v_user['user_foto']; ?>" width="150"
                    height="150">
            </td>
        </tr>
        <tr>
            <td valign="top">Nama Lengkap</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_biodata_ktp['ktp_nama']; ?></td>
        </tr>
        <tr>
            <td valign="top">Tempat/Tgl lahir</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">
                <?php echo $v_biodata_ktp['ktp_tempat_lahir'] . " / " . date("d F Y", strtotime($v_biodata_ktp['ktp_tanggal_lahir'])); ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Jenis Kelamin</td>
            <td valign="top">:</td>
            <td valign="top"><?php echo $v_biodata_ktp['ktp_kelamin']; ?></td>
            <td valign="top">Gol. Darah : <?php echo $v_biodata_ktp['ktp_gol_darah']; ?></td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">Agama</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_biodata_ktp['ktp_agama']; ?></td>
        </tr>
        <tr>
            <td valign="top">Status Perkawinan</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_biodata_ktp['ktp_status']; ?></td>
        </tr>
        <tr>
            <td valign="top">Kewarganegaraan</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_biodata_ktp['ktp_kewarganegaraan']; ?></td>
        </tr>
        <tr>
            <td valign="top">Nomor Hp</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_user['user_hp']; ?></td>
        </tr>
        <tr>
            <td valign="top">Email</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top"><?php echo $v_user['user_email']; ?></td>
        </tr>
        <tr>
            <td valign="top">NPWP</td>
            <td valign="top">:</td>
            <td colspan="3" valign="top">
                <?php echo substr($npwp, 0, 2) . "." . substr($npwp, 2, 3) . "." . substr($npwp, 5, 3) . "." . substr($npwp, 8, 1) . "-" . substr($npwp, 9, 3) . "." . substr($npwp, 12, 3); ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Alamat KTP</td>
            <td valign="top">:</td>
            <td colspan="4" valign="top">
                <?php echo $v_biodata_ktp['ktp_alamat'] . ", RT/RW " . $v_biodata_ktp['ktp_rt'] . "/" . $v_biodata_ktp['ktp_rw'] . ", Kel. " . $v_biodata_ktp['ktp_kelurahan'] . ", Kec. " . $v_biodata_ktp['ktp_kecamatan'] . ", " . $v_biodata_ktp['ktp_kabupaten'] . " <br> " . $v_biodata_ktp['ktp_propinsi'] . " " . $v_biodata_ktp['ktp_kodepos'] . "."; ?>
            </td>
        </tr>
        <tr>
            <td valign="top">Alamat Domisili</td>
            <td valign="top">:</td>
            <td colspan="4" valign="top">
                <?php echo $v_biodata_domisili['domisili_alamat'] . ", RT/RW " . $v_biodata_domisili['domisili_rt'] . "/" . $v_biodata_domisili['domisili_rw'] . ", Kel. " . $v_biodata_domisili['domisili_kelurahan'] . ", Kec. " . $v_biodata_domisili['domisili_kecamatan'] . ", " . $v_biodata_domisili['domisili_kabupaten'] . " <br> " . $v_biodata_domisili['domisili_propinsi'] . " " . $v_biodata_domisili['domisili_kodepos'] . "."; ?>
            </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" valign="top" bgcolor="#00AEA6"><strong>B. Data Keluarga</strong></td>
        </tr>
        <tr>
            <td colspan="6" valign="top">
                <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000">
                    <tr>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Hubungan</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Nama Lengkap</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Tanggal Lahir / Jenis Kelamin</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Alamat</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>No. HP</strong></td>
                    </tr>
                    <?php
                    while ($v_biodata_keluarga = mysql_fetch_array($biodata_keluarga)) {
                    ?>
                    <tr>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_keluarga['silsilah_nama']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_keluarga['keluarga_nama']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF">
                            <?php echo date("d M Y", strtotime($v_biodata_keluarga['keluarga_lahir'])); ?>
                            / <?php echo $v_biodata_keluarga['keluarga_kelamin']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_keluarga['keluarga_alamat']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_keluarga['keluarga_hp']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" valign="top" bgcolor="#00AEA6"><strong>C. Pendidikan</strong></td>
        </tr>
        <tr>
            <td colspan="6" valign="top">
                <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000">
                    <tr>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Durasi</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Nama Sekolah</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Jurusan</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Kota</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Nilai/IPK</strong></td>
                    </tr>
                    <?php
                    while ($v_pendidikan = mysql_fetch_array($pendidikan)) {
                    ?>
                    <tr>
                        <td valign="top" bgcolor="#FFFFFF">
                            <?php echo $v_pendidikan['pendidikan_awal'] . " - " . $v_pendidikan['pendidikan_akhir']; ?>
                        </td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_pendidikan['pendidikan_nama']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_pendidikan['pendidikan_jurusan']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_pendidikan['pendidikan_kota']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_pendidikan['pendidikan_nilai']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" valign="top" bgcolor="#00AEA6"><strong>C. Pengalaman Kerja</strong></td>
        </tr>
        <tr>
            <td colspan="6" valign="top">
                <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000">
                    <tr>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Durasi</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Nama Perusahaan</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Bagian</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Alasan Keluar</strong></td>
                    </tr>
                    <?php
                    while ($v_biodata_pengalaman = mysql_fetch_array($biodata_pengalaman)) {

                        if ($v_biodata_pengalaman['pengalaman_status'] == "Tidak Aktif") {
                            $akhir = date("Y", strtotime($v_biodata_pengalaman['pengalaman_akhir']));
                        } else {
                            $akhir = $v_biodata_pengalaman['pengalaman_status'];
                        }
                    ?>
                    <tr>
                        <td valign="top" bgcolor="#FFFFFF">
                            <?php echo date("Y", strtotime($v_biodata_pengalaman['pengalaman_awal'])) . " - " . $akhir; ?>
                        </td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_pengalaman['pengalaman_perusahaan']; ?>
                        </td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_pengalaman['pengalaman_bagian']; ?>
                        </td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_pengalaman['pengalaman_keluar']; ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" valign="top" bgcolor="#00AEA6"><strong>D. Kontak Darurat</strong></td>
        </tr>
        <tr>
            <td colspan="6" valign="top">
                <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000">
                    <tr>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Hubungan</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Nama Lengkap</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>Alamat</strong></td>
                        <td valign="top" bgcolor="#D6D6D6"><strong>No. HP</strong></td>
                    </tr>
                    <?php
                    while ($v_biodata_darurat = mysql_fetch_array($biodata_darurat)) {
                    ?>
                    <tr>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_darurat['darurat_hubungan']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_darurat['darurat_nama']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_darurat['darurat_alamat']; ?></td>
                        <td valign="top" bgcolor="#FFFFFF"><?php echo $v_biodata_darurat['darurat_hp']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" valign="top">Saya menyatakan bahwa informasi yang saya berikan pada formulir ini adalah
                lengkap dan benar. Jika terdapat pemalsuan atau pengurangan informasi dapat mengakibatkan pemutusan
                hubungan kerja. </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="center" valign="top">Jakarta, <?php echo date("d F Y"); ?></td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="center" valign="top">
                <?php echo $v_biodata_ktp['ktp_nama'] . "<br>" . $v_karyawan['bagian_nama']; ?>

            </td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
        </tr>
    </table>



</body>

</html>