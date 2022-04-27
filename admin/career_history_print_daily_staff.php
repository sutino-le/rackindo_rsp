<?php
include "koneksi.php";
$id = $_GET['pkwt_id'];

$array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

$pkwt = mysql_query("SELECT * FROM pkwt JOIN biodata_ktp ON pkwt.pkwt_ktp=biodata_ktp.ktp_nomor JOIN karyawan ON pkwt.pkwt_ktp=karyawan.karyawan_ktp JOIN bagian ON pkwt.pkwt_bagian=bagian.bagian_id JOIN jabatan ON pkwt.pkwt_jabatan=jabatan.jabatan_id JOIN user ON pkwt.pkwt_ktp=user.user_ktp WHERE pkwt.pkwt_id='$id' ");
$v_pkwt = mysql_fetch_array($pkwt);

$pkwt_id = $v_pkwt['pkwt_id'];
$ktp_nomor = $v_pkwt['ktp_nomor'];
$ktp_nama = $v_pkwt['ktp_nama'];
$ktp_tempat_lahir = $v_pkwt['ktp_tempat_lahir'];
$ktp_tanggal_lahir = $v_pkwt['ktp_tanggal_lahir'];
$ktp_jenis_kelamin = $v_pkwt['ktp_jenis_kelamin'];
$ktp_alamat = $v_pkwt['ktp_alamat'];
$ktp_rt = $v_pkwt['ktp_rt'];
$ktp_rw = $v_pkwt['ktp_rw'];
$ktp_kelurahan = $v_pkwt['ktp_kelurahan'];
$ktp_kecamatan = $v_pkwt['ktp_kecamatan'];
$ktp_kabupaten = $v_pkwt['ktp_kabupaten'];
$ktp_propinsi = $v_pkwt['ktp_propinsi'];
$ktp_kodepos = $v_pkwt['ktp_kodepos'];
$ktp_agama = $v_pkwt['ktp_agama'];
$ktp_status_perkawinan = $v_pkwt['ktp_status_perkawinan'];
$ktp_kewarganegaraan = $v_pkwt['ktp_kewarganegaraan'];
$user_email = $v_pkwt['user_email'];
$user_hp = $v_pkwt['user_hp'];
$pkwt_nomor = $v_pkwt['pkwt_nomor'];
$pkwt_tanggal = $v_pkwt['pkwt_tanggal'];
$jobtitle_nama = $v_pkwt['jobtitle_nama'];
$grade_nama = $v_pkwt['grade_nama'];
$area_nama = $v_pkwt['area_nama'];
$location_nama = $v_pkwt['location_nama'];
$pkwt_durasi = $v_pkwt['pkwt_durasi'];
$pkwt_pihak_satu = $v_pkwt['pkwt_pihak_satu'];
$pkwt_pihak_satu_jabatan = $v_pkwt['pkwt_pihak_satu_jabatan'];
$pkwt_awal = $v_pkwt['pkwt_awal'];
$pkwt_akhir = $v_pkwt['pkwt_akhir'];
$pkwt_gt = $v_pkwt['pkwt_gt'];
$pkwt_tf = $v_pkwt['pkwt_tf'];
$pkwt_te = $v_pkwt['pkwt_te'];
$pkwt_tv = $v_pkwt['pkwt_tv'];
$pkwt_bonus = $v_pkwt['pkwt_bonus'];
$pkwt_reward = $v_pkwt['pkwt_reward'];
$pkwt_status = $v_pkwt['pkwt_status'];

$bln = $array_bln[date('n', strtotime($pkwt_tanggal))];

$day = date('D', strtotime($pkwt_tanggal));
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

$month = date('M', strtotime($pkwt_tanggal));
$monthList = array(
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

$bln_lahir = date('M', strtotime($ktp_tanggal_lahir));
$bln_lahirList = array(
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

$blnawal = date('M', strtotime($pkwt_awal));
$blnawalList = array(
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

$blnakhir = date('M', strtotime($pkwt_akhir));
$blnakhirList = array(
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKHL</title>
</head>

<body>
    <blockquote>

        <table width="100%">
            <tr>
                <td colspan="8"><img src="img/logo.png" alt="PT Rackindo Setara Perkasa"></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <b><u>
                            <h3>KESEPAKATAN HUBUNGAN KERJA
                        </u><br>Status Karyawan Harian</h3></b>
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    Yang bertanda tangan di bawah ini masing-masing:
                    <br>
                    <br>
                </td>
            </tr>
            <tr valign="top">
                <td>I.</td>
                <td colspan="2">Nama Jelas</td>
                <td>:</td>
                <td colspan="4"><?php echo $ktp_nama; ?></td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Tempat/Tgl Lahir</td>
                <td>:</td>
                <td colspan="4">
                    <?php echo $ktp_tempat_lahir . " / " . date("d", strtotime($ktp_tanggal_lahir)) . " " . $bln_lahirList[$bln_lahir] . " " . date("Y", strtotime($ktp_tanggal_lahir)); ?>
                </td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Alamat</td>
                <td>:</td>
                <td colspan="4">
                    <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . ucwords(strtolower($ktp_kelurahan . ", Kec. " . $ktp_kecamatan . "<br> " . $ktp_kabupaten . " - " . $ktp_propinsi)); ?>
                    <br>
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    <br>
                    Bertindak untuk dan atas nama sendiri sebagai pelamar untuk karyawan. Selanjutnya dalam kesepakatan
                    ini disebut PIHAK PERTAMA (ke I).
                    <br>
                    <br>
                </td>
            </tr>
            <tr valign="top">
                <td>II.</td>
                <td colspan="2">Nama</td>
                <td>:</td>
                <td colspan="4">Nasirin</td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Jabatan</td>
                <td>:</td>
                <td colspan="4">
                    Personalia
                </td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Alamat</td>
                <td>:</td>
                <td colspan="4">
                    Kapuk Kamal Indah I Kav. 15-17, Kel. Kamal, Kec. Kali Deres, Jakarta Barat
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    <p align="justify">
                        Bertindak untuk atas nama perusahaan selanjutnya dalam kesepakatan disebut PIHAK KEDUA (ke II).
                    </p>

                    <p align="justify">
                        Masing-masing pihak dalam keadaan sadar, tanpa paksaan siapapun pada kesepakatan hari
                        <?php echo $dayList[$day]; ?> tanggal
                        <?php echo date("d", strtotime($pkwt_tanggal)) . " " . $monthList[$month] . " " . date("Y", strtotime($pkwt_tanggal)); ?>
                        Telah mengadakan kesepakatan yang diatur dalam pasal sebagai berikut:
                    </p>

                    <p align="center">
                        <b>PASAL I<br>
                            SIFAT DAN STSTUS HUBUNGAN KERJA</b>
                    </p>

                    <p align="justify">
                    <ol>
                        <li>Sifat dan status hubungan kerja adalah karyawan harian.</li>
                        <li>
                            Jangka waktu hubungan kerja terbatas selama PT Rackindo setara perkasa memerlukan
                            selama-lamanya 21 (dua puluh satu) hari kerja, terhitung sejak tanggal
                            <?php echo date("d", strtotime($pkwt_awal)) . " " . $blnawalList[$blnawal] . " " . date("Y", strtotime($pkwt_awal)); ?>
                            sampai dengan tanggal
                            <?php echo date("d", strtotime($pkwt_akhir)) . " " . $blnakhirList[$blnakhir] . " " . date("Y", strtotime($pkwt_akhir)); ?>.
                        </li>
                        <li>
                            Apabila karena suatu lain hal Pihak ke II sewaktu-waktu dapat mengadakan pemutusan hubungan
                            kerja sepihak tanpa syarat apapun.
                        </li>
                    </ol>
                    </p>

                    <p align="center">
                        <b>PASAL II<br>
                            KETENTUAN HUBUNGAN KERJA</b>
                    </p>

                    <p align="justify">
                    <ol>
                        <li>Ketentuan jam kerja diatur sesuai jadwal jam kerja yang telah berlaku di pabrik.</li>
                    </ol>
                    </p>

                    <p align="center">
                        <b>PASAL III<br>
                            KEWAJIBAN PIHAK KE I</b>
                    </p>

                    <p align="justify">
                    <ol>
                        <li>Mematuhi dan melaksanakan peraturan dan perintah atasan sesuai dengan ketentuan yang
                            berlaku.</li>
                        <li>
                            Mematuhi waktu jam kerja dan tata tertib kerja yang ditentukan perusahaan.
                        </li>
                        <li>
                            Apabila Pihak ke I sering terlambat datang dan atau tidak masuk kerja dengan alasan yang
                            tidak jelas Pihak ke II dapat memberikan sangsi sesuai ketentuan yang berlaku.
                        </li>
                    </ol>
                    </p>

                    <p align="center">
                        <b>PASAL IV<br>
                            HAK-HAK PIHAK KE II</b>
                    </p>

                    <p align="justify">
                    <ol>
                        <li>Transport, makan di tanggung oleh Pihak ke I (karyawan/karyawati sendiri).</li>
                        <li>
                            Upah diberikan setiap akhir bulan di hari kerja berdasarkan absensi.
                        </li>
                        <li>
                            Upah tidak dibayar apabila Pihak ke I tidak masuk kerja dengan alasan apapun kecuali ada
                            surat izin dokter yang ditunjuk perusahaan.
                        </li>
                    </ol>
                    </p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p align="center">
                        <b>PASAL V<br>
                            PENUTUP</b>
                    </p>

                    <p align="justify">
                    <ol>
                        <li>
                            Demikian kesepakatan ini dibuat dan ditanda tangani di atas materai yang cukup oleh kedua
                            belah pihak untuk dilaksanakan sebagai mana mestinya.
                        </li>
                    </ol>
                    </p>

                </td>
            </tr>
            <tr align="center" valign="top">
                <td colspan="8">
                    <br>
                    Jakarta, <?php echo $dayList[$day]; ?> tanggal
                    <?php echo date("d", strtotime($pkwt_tanggal)) . " " . $monthList[$month] . " " . date("Y", strtotime($pkwt_tanggal)); ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <table width="100%">
                        <tr>
                            <td align="center"><u>( <?php echo $ktp_nama; ?> )</u><br> PIHAK KE I</td>
                            <td align="center"><u>( Nasirin )</u><br> PIHAK KE II</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </blockquote>

</body>

</html>