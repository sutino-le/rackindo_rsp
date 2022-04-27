<style>
ol.c {
    list-style-type: decimal;
}

ol.k {
    list-style-type: lower-alpha;
}


ul.k {
    list-style-type: lower-alpha;
}
</style>



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
$ktp_kelamin = $v_pkwt['ktp_kelamin'];
$ktp_alamat = $v_pkwt['ktp_alamat'];
$ktp_rt = $v_pkwt['ktp_rt'];
$ktp_rw = $v_pkwt['ktp_rw'];
$ktp_kelurahan = $v_pkwt['ktp_kelurahan'];
$ktp_kecamatan = $v_pkwt['ktp_kecamatan'];
$ktp_kabupaten = $v_pkwt['ktp_kabupaten'];
$ktp_propinsi = $v_pkwt['ktp_propinsi'];
$ktp_kodepos = $v_pkwt['ktp_kodepos'];
$ktp_agama = $v_pkwt['ktp_agama'];
$ktp_status = $v_pkwt['ktp_status'];
$ktp_kewarganegaraan = $v_pkwt['ktp_kewarganegaraan'];
$user_email = $v_pkwt['user_email'];
$pkwt_nomor = $v_pkwt['pkwt_nomor'];
$pkwt_tanggal = $v_pkwt['pkwt_tanggal'];
$bagian_nama = $v_pkwt['bagian_nama'];
$jabatan_nama = $v_pkwt['jabatan_nama'];
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


if ($v_pkwt['user_hp'] == "0") {
    $user_hp = "";
} else {
    $user_hp = $v_pkwt['user_hp'];
}

//Pendidikan
$cek_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$ktp_nomor' ORDER BY pendidikan_akhir DESC");
$v_pendidikan = mysql_fetch_array($cek_pendidikan);
$pendidikan = $v_pendidikan['pendidikan_tingkatan'];

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
    <title>PKWT</title>
</head>

<body>
    <blockquote>

        <table width="100%">
            <tr>
                <td colspan="8"><img src="img/logo.png" alt="PT Rackindo Setara Perkasa"></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <b>
                        PERJANJIAN KERJA WAKTU TERTENTU <br>
                    </b>
                    No. :
                    <?php echo $pkwt_nomor . "/PK-PKWT/HRD-RSP/" . $bln . "/" . date("Y", strtotime($pkwt_tanggal)); ?>
                    <br>
                    <br>
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    Yang bertandatangan di bawah ini :
                    <br>
                    <br>
                </td>
            </tr>
            <tr valign="top">
                <td>I.</td>
                <td colspan="2" width="20%">Nama</td>
                <td>:</td>
                <td colspan="4">MICHAEL KODIAT</td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Jabatan</td>
                <td>:</td>
                <td colspan="4">MANAJER PERSONALIA</td>
            </tr>
            <tr align="justify" valign="top">
                <td></td>
                <td colspan="6">
                    Dalam hal ini bertindak dalam jabatanya tersebut diatas, dengan demikian sah bertindak untuk dan
                    atas nama PT Rackindo Setara Perkasa, berkedudukan di Kota Jakarta Barat, yang beralamat di Kompleks
                    Kamal Indah Jalan Kapuk Kamal Indah I Kav. 15-17 Kel. Kamal Kec. Kalideres Jakarta Barat,
                    selanjutnya disebut PIHAK PERTAMA.
                    <br><br>
                </td>
            </tr>
            <tr valign="top">
                <td>II.</td>
                <td colspan="2">Nama</td>
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
                <td colspan="2">Jenis Kelamin</td>
                <td>:</td>
                <td colspan="4"><?php echo $ktp_kelamin; ?></td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Agama</td>
                <td>:</td>
                <td colspan="4"><?php echo $ktp_agama; ?></td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Status</td>
                <td>:</td>
                <td colspan="4"><?php echo $ktp_status; ?></td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Pendidikan</td>
                <td>:</td>
                <td colspan="4"><?php echo $pendidikan; ?></td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Alamat / No. Hp</td>
                <td>:</td>
                <td colspan="4">
                    <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . ucwords(strtolower($ktp_kelurahan . ", Kec. " . $ktp_kecamatan . ", " . $ktp_kabupaten)) . " - " . $ktp_propinsi . ". / " . $user_hp; ?>
                </td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="7">Dalam hal ini bertindak atas nama dirinya sendiri yang selanjutnya disebut PIHAK
                    KEDUA<br><br></td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    <p align="justify">
                        Dengan ini menyatakan bahwa PARA PIHAK telah sepakat dan setuju untuk mengikatkan diri dalam
                        suatu perjanjian kerjasama dengan ketentuan-ketentuan dan syarat-syarat sebagaimana tercantum
                        dalam pasal-pasal di bawah ini :
                    </p>

                    <p align="center">
                        <b>Pasal 1<br>
                            Penempatan dan Lokasi Kerja</b>
                    </p>

                    <p align="justify">
                        PIHAK PERTAMA bersedia dan setuju untuk menerima PIHAK KEDUA sebagai karyawan dengan status
                        <u><b>karyawan kontrak untuk waktu tertentu</b></u> kepada PIHAK PERTAMA dan ditempatkan sebagai
                        <u><b><?php echo $jabatan_nama . " Bagian " . $bagian_nama; ?></b></u>, dengan lokasi kerja di
                        PT. Rackindo Setara Perkasa. PIHAK KEDUA menyatakan bersedia untuk ditempatkan pada
                        perusahaan-perusahaan yang bekerjasama dengan PT. Rackindo Setara Perkasa dan dipindahkan atau
                        dimutasikan pada bagian lain, bilamana terdapat kebutuhan untuk itu. PIHAK KEDUA juga
                        mengikatkan diri dan berjanji akan taat dan patuh terhadap peraturan-peraturan yang diberlakukan
                        oleh PIHAK PERTAMA.
                    </p>

                    <p align="center">
                        <b>Pasal 2<br>
                            Hubungan Kerja dengan Pihak Lain</b>
                    </p>

                    <p align="justify">
                        PIHAK KEDUA dengan ini menyatakan bahwa disinya tidak sedang terlibat hubungan kerja dengan
                        pihak lain, dan apabila ternyata terikat hubungan kerja dengan pihak lain, maka PARA PIHAK
                        sepakat bahwa perjanjian ini batal <u><b>tanpa syarat apapun</b></u>.
                    </p>

                    <p align="center">
                        <b>Pasal 3<br>
                            Jangka Waktu</b>
                    </p>

                    <p align="justify">
                        Perjanjian kerja waktu tertentu ini berlaku sejak tanggal
                        <b><?php echo date("d", strtotime($pkwt_awal)) . " " . $blnawalList[$blnawal] . " " . date("Y", strtotime($pkwt_awal)); ?></b>,
                        dan akan berakhir dengan sendirinya pada tanggal
                        <b><?php echo date("d", strtotime($pkwt_akhir)) . " " . $blnakhirList[$blnakhir] . " " . date("Y", strtotime($pkwt_akhir)); ?></b>.
                        Bilamana Perjanjian kerja waktu tertentu ini berakhir sesuai dengan jangka waktu yang telah
                        ditetapkan, maka hubungan hukum akan putus dengan sendirinya dan PIHAK PERTAMA tidak dibebani
                        keajiban untuk memberikan kompensasi dan/atau kebijaksanaan dalam bentuk apapun kepada PIHAK
                        KEDUA. Perpanjangan maupun pembaaharuan perjanjian kerja waktu tertentu ini sewaktu-waktu dapat
                        dilakukan, sesuai dengan kesepakatan dan persetujuan PARA PIHAK.
                    </p>

                    <br>
                    <br>
                    <br>
                    <br>
                    <p align="center">
                        <b>Pasal 4<br>
                            Waktu Kerja</b>
                    </p>

                    <p align="justify">
                        PIHAK KEDUA bersedia secara penuh dan tanpa syarat untuk mengikuti waktu kerja yang ditentukan
                        oleh PIHAK PERTAMA sebagai berikut :
                        <br>
                        <center>
                            <table width="80%" border="1" cellpadding="0" cellspacing="0">
                                <tr align="center">
                                    <td></td>
                                    <td><b>WAKTU KERJA</b></td>
                                </tr>
                                <tr align="center">
                                    <td>Jam Kerja Senin s/d Jumat</td>
                                    <td>08.30 - 17.00</td>
                                </tr>
                                <tr align="center">
                                    <td>Jam Kerja Sabtu</td>
                                    <td>08.00 - 12.30</td>
                                </tr>
                                <tr align="center">
                                    <td>Jam Istirahat Senin s/d Kamis</td>
                                    <td>12.00 - 13.00</td>
                                </tr>
                                <tr align="center">
                                    <td>Jam Istirahat Jumat</td>
                                    <td>11.30 - 13.00</td>
                                </tr>
                            </table>
                        </center>
                        <br>
                        Jika terjadi perubahan waktu kerja dikemudian hari setelah perjanjian ini disepakati dimana
                        PIHAK KEDUA ditempatkan, maka PIHAK KEDUA harus mengikuti waktu kerja yang diatur oleh PIHAK
                        PERTAMA. Dikarenakan kontrak ini bersifat project maka apabila PIHAK KEDUA melakukan pekerjaan
                        melebihi dari waktu kerja yang telah ditentukan oleh PIHAK PERTAMA maka tidak akan termasuk
                        pekerjaan lembur dan tidak akan diberikan upah lembur atas hal ini.
                    </p>


                    <p align="center">
                        <b>Pasal 5<br>
                            Pengupahan</b>
                    </p>

                    <p align="justify">
                        PIHAK KEDUA setuju untuk diberikan upah dari PIHAK PERTAMA yang dibayarkan setiap bulan sebagai
                        berikut :
                    <ul>
                        <li>
                            Perhitungan THR akan diberikan sesuai dengan peraturan atau kebijakan PIHAK PERTAMA.
                        </li>
                    </ul>
                    PIHAK PERTAMA tidak menyediakan fasilitas apapun yang tidak disebutkan selain diatas, maka hal
                    tersebut menjadi tanggung jawab PIHAK KEDUA sepenuhnya.
                    </p>


                    <p align="center">
                        <b>Pasal 6<br>
                            Status Karyawan</b>
                    </p>

                    <p align="justify">
                        Status PIHAK KEDUA dalam perjanjian ini adalah bersifat <u><b>karyawan kontrak</b></u> dan bukan
                        sebagai karyawan tetap, kecuali ada kesepakatan lain secara tertulis dikemudian dari yang
                        disetujui oleh PARA PIHAK setelah selesai masa kontrak. Apabila perjanjian ini telah berakhir
                        maka adalah hak sepenuhnya dari PIHAK PERTAMA untuk memperpanjang atau tidak atas perjanjian
                        ini, PIHAK KEDUA tidak berhak untuk meminta kompensasi atau kebijaksanaan dalam bentuk apapun
                        kepada PIHAK PERTAMA.
                    </p>

                    <p align="center">
                        <b>Pasal 7<br>
                            Pengakhiran Hubungan Kerja</b>
                    </p>

                    <p align="justify">
                        Sewaktu-waktu tanpa harus menunggu berakhirnya masa perjanjian ini, PIHAK KEDUA dapat dikenakan
                        sanksi Pemutusan Hubungan Kerja (PHK), tanpa bisa menuntut kompensasi dan/atau kebijaksanaan
                        salam bentuk apapun, baik secara pribadi maupun secara hukum dari PIHAK PERTAMA, dan PIHAK KEDUA
                        <u><b>tidak dapat kembali</b></u> bekerja kepada PIHAK PERTAMA dikemudian hari bilamana :
                    <ul>
                        <li>
                            PIHAK KEDUA melakukan tindakan dan/atau perbuatan melawan hukum sebagaimana disebutkan dalam
                            KUHP atau peraturan perundangan lainnya yang berlaku resmi di Indonesia.
                        </li>
                        <li>
                            PIHAK KEDUA melakukan tindakan dan/atau perbuatan melanggar ketentuan tata tertib dan/atau
                            peraturan PIHAK PERTAMA yang berlaku baik yang sudah ada maupun yang akan ditetapkan
                            kemudian.
                        </li>
                        <li>
                            PIHAK KEDUA tidak memenuhi standar evaluasi kualifikasi kinerja yang ditetapkan oleh PIHAK
                            PERTAMA.
                        </li>
                        <li>
                            Ada lebih dari <u><b>1 (satu) hari dalam setiap bulan</b></u> selama masa perjanjian ini
                            tidak masuk kerja tanpa informasi yang jelas, dan tidak dapat diterima oleh PIHAK PERTAMA.
                        </li>
                    </ul>
                    </p>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    <p align="center">
                        <b>Pasal 8<br>
                            Perselisihan</b>
                    </p>

                    <p align="justify">
                        Bilamana dikemudian dari timbul perselisihan diantara PARA PIHAK sebagai akibat dari pelaksanaan
                        perjanjian ini, maka PARA PIHAK sepakat untuk menyelesaikan secara musyawarah dan kekeluargaan.
                        Jika Penyelesaian melalui musyawarah dan kekeluargaan tidak juga dapat menyelesaikan
                        perselisihan, maka PARA PIHAK sepakat untuk menyelesaikannya secara hukum melalui prosedur dan
                        ketentuan hukum yang berlaku di Indonesia.
                    </p>

                    <p align="center">
                        <b>Pasal 9<br>
                            Penutup</b>
                    </p>

                    <p align="justify">
                        Demikian Perjanjian Kerja Waktu Tertentu ini dibuat, disetujui dan ditandatangani diatas materai
                        yang cukup oleh kedua belah pihak setelah dibaca dan dimengerti akan isinya tanpa paksaan dari
                        siapapun, dan dalam keadaan sehat jasmani dan rohani untuk diberlakukan sebagaimana mestinya
                        dengan penuh tanggung jawab.
                    </p>

                    <p align="center">
                        <b>Pasal 10<br>
                            Tambahan</b>
                    </p>

                    <p align="justify">
                        Apabila dikemudian dari dalam masa kontrak ini PIHAK PERTAMA pada tanggal-tanggal tertentu
                        melaukkan pertukaran hari kerja, maka PIHAK KEDUA mendukung rencana PIHAK PERTAMA dengan
                        bersedia dipekerjakan pada tanggal-tanggal tersebut dengan upah dibayar harian dan bekerja
                        dengan sifat borongan. <br>
                        PIHAK KEDUA hanya akan diperpanjang kontrak oleh PIHAK PERTAMA jika dan hanya jika dapat
                        memenuhi standarisasi PIHAK PERTAMA sesuai form evaluasi kinerja karyawan yang diberlakukan.
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
                    <table width="100%">
                        <tr>
                            <td align="center"><u><b>MICHAEL KODIAT</b></u><br> MANAJER PERSONALIA</td>
                            <td align="center"><u>( <?php echo $ktp_nama; ?> )</u><br> <?php echo $jabatan_nama; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </blockquote>

</body>

</html>