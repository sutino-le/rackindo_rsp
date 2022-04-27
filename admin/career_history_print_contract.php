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
                    Pada hari ini : <?php echo $dayList[$day]; ?> tanggal
                    <?php echo date("d", strtotime($pkwt_tanggal)) . " " . $monthList[$month] . " " . date("Y", strtotime($pkwt_tanggal)); ?>
                    telah diadakan Perjanjian Kerja Waktu Tertentu (untuk selanjutnya disebut Perjanjian) antara :
                    <br>
                    <br>
                </td>
            </tr>
            <tr valign="top">
                <td>I.</td>
                <td colspan="2" width="20%">Nama</td>
                <td>:</td>
                <td colspan="4">Nasirin</td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Jabatan</td>
                <td>:</td>
                <td colspan="4">Personalia</td>
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
                <td colspan="7">Selanjutnya disebut PIHAK KEDUA. <br><br></td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    <p align="justify">
                        PIHAK PERTAMA dan PIHAK KEDUA untuk selanjutnya secara bersama-sama disebut "PARA PIHAK".
                        <br>
                        Sebelumnya Para Pihak menerangkan hal-hal sebagai berikut :

                    <ol class="k">
                        <li>Bahwa Pihak Pertama adalah sebuah perusahaan Manufaktur yang bergerak di bidang industri
                            mebel dan yang terkait dengan bahan partikel kayu, dan mempekerjakan tenaga kerja yang
                            kompeten.
                        </li>
                        <li>
                            Dalam rangka memenuhi kebutuhan Pihak Pertama, maka Para Pihak sepakat dan setuju untuk
                            membuat Perjanjian Kerja Waktu Tertentu ini.
                        </li>
                        <li>
                            Bahwa Pihak Kedua bersedia untuk bekerja dalam waktu tertentu sebagaimana yang
                            diperjanjiakan.
                        </li>
                    </ol>
                    Atas beberapa hal tersebut diatas maka Para Pihak sepakat untuk mengadakan Perjanjian dengan
                    ketentuan-ketentuan sebagai berikut :
                    </p>

                    <p align="center">
                        <b>Pasal 1<br>
                            Jangka Waktu Perjanjian</b>
                    </p>

                    <p align="justify">
                    <ol class="c">
                        <li>
                            Perjanjian ini berlaku untuk jangka waktu <?php echo $pkwt_durasi; ?>, terhitung sejak
                            tanggal
                            <?php echo date("d", strtotime($pkwt_awal)) . " " . $blnawalList[$blnawal] . " " . date("Y", strtotime($pkwt_awal)); ?>
                            sampai dengan tanggal
                            <?php echo date("d", strtotime($pkwt_akhir)) . " " . $blnakhirList[$blnakhir] . " " . date("Y", strtotime($pkwt_akhir)); ?>.
                        </li>
                        <li>
                            Pihak Pertama dapat melakukan perpanjangan atau pembaharuan Perjanjian sesuai dengan
                            ketentuan dan kesepakatan Para Pihak.
                        </li>
                    </ol>
                    </p>

                    <p align="center">
                        <b>Pasal 2<br>
                            Pengupahan</b>
                    </p>

                    <p align="justify">
                        Pihak kedua berhak berhak memperoleh upah dan kompensasi sebagaimana diatur dalam lampiran 1
                        (satu) Perjanjian ini.
                    </p>

                    <p align="center">
                        <b>Pasal 3<br>
                            Jabatan dan Penempatan</b>
                    </p>

                    <p align="justify">
                    <table>
                        <tr>
                            <td colspan="4">Pihak Pertama mempekerjakan Pihak Kedua, dengan perincian sebagai berikut :
                            </td>
                        </tr>
                        <tr>
                            <td>a.</td>
                            <td>Jabatan/Bagian</td>
                            <td>:</td>
                            <td><?php echo $jabatan_nama . "/" . $bagian_nama; ?></td>
                        </tr>
                        <tr>
                            <td>b.</td>
                            <td>Tanggal Mulai Bekerja</td>
                            <td>:</td>
                            <td><?php echo date("d", strtotime($pkwt_awal)) . " " . $blnawalList[$blnawal] . " " . date("Y", strtotime($pkwt_awal)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>c.</td>
                            <td>Lokasi Penempatan</td>
                            <td>:</td>
                            <td>Jalan Kapuk Kamal Indah I Kav. 15-17</td>
                        </tr>
                    </table>
                    </p>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p align="center">
                        <b>Pasal 4<br>
                            Kewajiban Pihak Kedua</b>
                    </p>

                    <p align="justify">
                    <ol class="c">
                        <li>
                            Pihak Kedua bersedia mentaati dan melaksanakan Peraturan Perusahaan dan/atau Perjanjian
                            Bersama, Tata Tertib, dan Kode Etik Perusahaan yang berlaku di Perusahaan Pihak Pertama, dan
                            bersedia menerima sanki apabila melanggar Peraturan Perusahaan dan/atau Perjanjian Bersama,
                            Tata Tertib, dan Kode Etik Perusahaan yang berlaku.
                        </li>
                        <li>
                            Pihak Kedua bersedia untuk memberikan jasa baik dan kesetiaan pada Pihak Pertama, serta
                            melaksanakan tugas-tugas dan kewajiban dengan sebaik-baiknya untuk kepentingan Pihak
                            Pertama.
                        </li>
                        <li>
                            Pihak Kedua wajib menyelesaikan pekerjaan setiap dari dan pekerjaan yang bersifat penting
                            serta tidak bisa ditunda penyelesaiannya, serta bersedia memenuhi target pekerjaan setiap
                            bulannya.
                        </li>
                        <li>
                            Bersedia untuk dilakukan evaluasi 3 (tiga) bulan sekali terkait dengan target bulanan yang
                            diberikan oleh Pihak Pertama.
                        </li>
                        <li>
                            Dilarang untuk membuka rahasia dagang, formulasi, dan data penting milik Pihak Pertama
                            kepada Pihak Ketiga, baik selama Pihak Kedua masih bekerja dengan Pihak Pertama maupun
                            setelah Pihak Kedua sudah tidak bekerja lagi pada Pihak Pertama. Apabila Pihak Kedua
                            ternyata menyebarkan rahasia dagang Pihak Pertama maka Pihak Pertama mempunyai hak untuk
                            menuntut Pihak Kedua sesuai dengan ketentuan hukum yang berlaku.
                        </li>
                        <li>
                            Tidak akan menginformasikan atau memperlihatkan kepada siapa pun juga segala dokumen
                            rahasia, cara-cara teknik atau system / prosedur dari Pihak Pertama, baik untuk kepentingan
                            diri sendiri mau pun orang lain.
                        </li>
                        <li>
                            Tidak meminta/menerima hadiah/komsumsi atau pemberian dalam bentuk apapun yang berhubungan
                            dengan tugas/tanggung jawab/jabatannya, baik secara langsung maupun tidak langsung.
                        </li>
                        <li>
                            Dilarang merokok, mengkonsumsi minuman keras, napza, dan membawa barang-barang yang dapat
                            membahayakan keamanan, ketentraman dan keselamatan di lingkungan kerja.
                        </li>
                        <li>
                            Bersedia menjalankan kerja lembur apabila diperlukan untuk memenuhi kebutuhan Pihak Pertama
                            serta bersedia dan sanggup untuk bekerja dengan sistem shift. Perhitungan lembur sesuai
                            dengan ketentuan yang berlaku di Pihak Pertama.
                        </li>
                        <li>
                            Apabila diperlukan, Pihak Kedua bersedia untuk dirotasi atau mutasi ke bagian/lokasi lain
                            atau group Pihak Pertama sesuai dengan Peraturan Perusahaan yang berlaku.
                        </li>
                        <li>
                            Tidak melakukan rangkap pekerjaan baik untuk kepentingan pribadi maupun untuk pihak lain
                            dengan alasan apapun.
                        </li>
                        <li>
                            Tidak menggunakan fasilitas yang disediakan oleh Pihak Pertama untuk menunjang pekerjaan
                            Pihak Kedua untuk kegiatan bisnis pribadi/keluarga/pihak lain.
                        </li>
                        <li>
                            Tidak melakukan tindakan Korupsi, Kolusi dan Nepotisme (KKN) dalam bentuk apa pun, dalam
                            rangka menciptakan “<i>clean Corporate Government</i>”.
                        </li>
                        <li>
                            Apabila Pihak Kedua melakukan pelanggaran ketentuan-ketentuan dalam pasal ini, maka Pihak
                            Kedua akan dikenakan sanksi sebagaimana diatur dalam Peraturan Perusahaan serta peraturan
                            lain yang berlaku di Perusahaan Pihak Pertama.
                        </li>
                    </ol>
                    </p>


                    <p align="center">
                        <b>Pasal 5<br>
                            Berakhirnya Perjanjian</b>

                    <ol class="c">
                        <li>
                            Hubungan kerja antara Pihak Pertama dan Pihak Kedua berakhir apabila :
                            <ul class="k">
                                <li>
                                    Pihak Kedua meninggal dunia.
                                </li>
                                <li>
                                    Berakhirnya jangka waktu Perjanjian.
                                </li>
                                <li>
                                    Pihak Kedua terbukti memalsukan data dan/atau memberikan keterangan yang tidak
                                    sesuai dengan yang sebenarnya termasuk dan tidak terbatas mengenai data kesehatan
                                    Pihak Kedua, data pribadi, dan data keluarga Pihak Kedua yang secara langsung maupun
                                    tidak langsung menimbulkan akibat apapun kepada Pihak Pertama.
                                </li>
                                <li>
                                    Adanya keadaan atau kejadian tertentu seperti bencana alam, kerusuhan social,
                                    ganguan keamanan atau bencana nasional (<i>force majeur</i>) yang mengakibatkan
                                    perusahaan Pihak Pertama mengalami penurunan penghasilan atau kerugian besar.
                                </li>
                                <li>
                                    Jika terjadi pada Pasal 5 ayat 1 poin d diatas dan hubungan kerja berakhir, maka
                                    Perjanjian Kerja berakhir demi hukum dan Pihak Kedua sepakat tidak menerima
                                    kempensasi PKWT maupun kompensasi sisa waktu kontrak dari Pihak Pertama.
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
                                </li>
                            </ul>
                        </li>
                        <li>
                            Pihak Pertama berhak memutus atau mengakhiri Perjanjian sebelum berakhirnya jangka waktu
                            Perjanjian ini apabila :
                            <ul class="k">
                                <li>
                                    Hasil evaluasi dan/atau pemantauan yang dilakukan Pihak Pertama menunjukan bahwa
                                    Pihak Kedua tidak memenuhi standar kinerja, perilaku, etika, target, atau
                                    nilai-nilai professional lainnya yang telah ditentukan Pihak Pertama.
                                </li>
                                <li>
                                    Pihak Kedua melakukan perbuatan-perbuatan yang dilarang oleh peraturan
                                    Perundang-undangan dan/atau Tata Tertib dan/atau Peraturan di Perusahaan yang
                                    dikategorikan sebagai pelanggaran berat; atau
                                </li>
                                <li>
                                    Antara Pihak Pertama dan Pihak Kedua terdapat ketidak-cocokan atau terjadinya
                                    perselisihan yang tidak dapat diselesaikan dengan musyawarah Oleh Para Pihak.
                                </li>
                                <li>
                                    Dalam hal pemutusan Perjanjian sebagaimana dimaksud pada Pasal 5 ayat 2 diatas maka
                                    Pihak Pertama tidak memberikan ganti rugi dalam bentuk apapun kepada Pihak Kedua dan
                                    Pihak Kedua sepakat tidak akan meminta ganti rugi atau kompensasi PKWT dalam bentuk
                                    apapun kepada Pihak Pertama, termasuk pembayaran ganti rugi atau kompensasi sisa
                                    jangka waktu kontrak.
                                </li>
                            </ul>
                        </li>
                        <li>
                            Pihak Kedua dapat mengakhiri Perjanjian ini sebelum berakhirnya jangka waktu Perjanjian ini,
                            dengan mengajukan pengunduran diri secara tertulis dan sudah mendapatkan persetujuan dari
                            atasan Pihak Kedua terlebih dahulu. Akibat pengunduran diri ini maka, Pihak Kedua sepakat
                            tidak menerima kompensasi PKWT dari Pihak Pertama.
                        </li>
                        <li>
                            Pengunduran diri yang diajukan Pihak Kedua sebagaimana dimaksud pada Pasal 5 ayat 3,
                            diajukan oleh Pihak Kedua dengan ketentuan sebagai berikut :
                        </li>
                        <ul class="k">
                            <li>
                                Golongan 1 (operator) diajukan sekurang-kurangnya 2 (dua) minggu sebelum tanggal
                                pengunduran diri.
                            </li>
                            <li>
                                Golongan 2 (koodinator & wakil koodinator) ke atas diajukan sekurang-kurangnya 1 (satu)
                                bulan sebelum tanggal pengunduran diri.
                            </li>
                        </ul>
                    </ol>
                    </p>


                    <p align="center">
                        <b>Pasal 6<br>
                            Penyelesaian Perselisihan</b>

                    <ol class="c">
                        <li>
                            Apabila terjadi perselisihan yang timbul akibat dari pelaksanaan Perjanjian ini, maka Para
                            Pihak sepakat untuk menyelesaikannya secara musyawarah untuk mencapai mufakat.
                        </li>
                        <li>
                            Apabila secara musyawarah tidak tercapai suatu kesepakatan maka Para Pihak sepakat untuk
                            menyelesaikan sesuai dengan ketentuan hukum yang berlaku berdasarkan syarat yang diatur
                            dalam Perjanjian ini.
                        </li>
                    </ol>
                    </p>


                    <p align="center">
                        <b>Pasal 7<br>
                            Penutup</b>

                    <ol class="c">
                        <li>
                            Pihak Pertama telah menjelaskan dan Pihak Kedua dengan ini menyatakan telah mengerti serta
                            menyanggupi untuk mentaati dan melaksanakan isi Perjanjian ini.
                        </li>
                        <li>
                            Perjanjian ini dibuat rangkap 2 (dua), yang masing-masing rangkapnya ditandatangani dan
                            mengikat untuk ditaati dan dilaksanakan oleh Para Pihak serta memiliki ketentuan hukum yang
                            sama.
                        </li>
                        <li>
                            Ketentuan yang belum cukup diatur dalam Perjanjian ini dan yang perlu untuk ditambahkan
                            dan/atau diperbaharui, akan diatur lebih lanjut dalam Perjanjian tambahan (addendum), yang
                            merupakan bagian yang tidak terpisahkan dari Perjanjian ini, sesuai dengan kesepakatan Para
                            Pihak.
                        </li>
                        <li>
                            Segala lampiran yang ada merupakan satu kesatuan dengan Perjanjian ini.
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
                    <table width="100%">
                        <tr>
                            <td align="center"><u>( Nasirin )</u><br> PIHAK KE I</td>
                            <td align="center"><u>( <?php echo $ktp_nama; ?> )</u><br> PIHAK KE II</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br><br><br><br><br>

        <table width="100%">
            <tr>
                <td colspan="8"><img src="img/logo.png" alt="PT Rackindo Setara Perkasa"></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <b>
                        KESEPAKATAN BERSAMA <br>
                    </b>
                    <br>
                    <br>
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    Yang bertanda tangan di bawah ini masing-masing :
                    <br>
                    <br>
                </td>
            </tr>
            <tr valign="top">
                <td>I.</td>
                <td colspan="2" width="20%">Nama</td>
                <td>:</td>
                <td colspan="4">Nasirin</td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Jabatan</td>
                <td>:</td>
                <td colspan="4">Personalia</td>
            </tr>
            <tr align="justify" valign="top">
                <td></td>
                <td colspan="6">
                    Dalam kesepakatan ini bertindak untuk dan atas perusahaan, yang selanjutnya disebut Pihak Pertama
                    (Ke-I)
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
                <td colspan="2">Jabatan/Bagian</td>
                <td>:</td>
                <td colspan="4">
                    <?php echo $jabatan_nama . "/" . $bagian_nama; ?>
                </td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="2">Alamat</td>
                <td>:</td>
                <td colspan="4">
                    <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . ucwords(strtolower($ktp_kelurahan . ", Kec. " . $ktp_kecamatan . ", " . $ktp_kabupaten)) . " - " . $ktp_propinsi; ?>
                </td>
            </tr>
            <tr valign="top">
                <td></td>
                <td colspan="7">Dalam kesepakatan ini yang bersangkutan bertindak untuk dan atas nama Pekerja sdr.
                    <?php echo $ktp_nama; ?>, yang selanjutnya disebut Pihak Kedua (Ke-II). <br><br></td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    menerangkan dengan sesungguhnya bahwa Pihak Pertama maupun Pihak Kedua telah mengadakan kesepakatan
                    dengan jalan musyawarah untuk mufakat pada hari <?php echo $dayList[$day]; ?> tanggal
                    <?php echo date("d", strtotime($pkwt_tanggal)) . " " . $monthList[$month] . " " . date("Y", strtotime($pkwt_tanggal)); ?>
                    yang akhirnya kedua belah pihak telah tercapai Kesepakatan Bersama sebagai berikut :
                    <br>
                    <br>
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    <p align="justify">
                    <ol class="c">
                        <li>
                            Bahwa Pihak Pertama dan Pihak Kedua sepakat untuk mengadakan hubungan kerja dengan
                            Perjanjian Kerja Waktu Tertentu No.
                            <?php echo $pkwt_nomor . "/PK-PKWT/HRD-RSP/" . $bln . "/" . date("Y", strtotime($pkwt_tanggal)); ?>
                            sesuai dengan bukti kontrak. Dengan perincian upah
                            sebagai berikut :
                            <table width="100%">
                                <tr>
                                    <td colspan="3">Upah
                                        Sesuai dengan <b>Kesepakatan Bersama No. 810/PB/HRD/RSP/XII/2020</b> dan
                                        <b>Kesepakatan Bersama No. 001/PB/HRD/RSP/I/2022</b>
                                    </td>
                                </tr>
                                <?php
                                if ($jabatan_nama == "Koordinator") {
                                ?>
                                <tr>
                                    <td>Kompensasi Jabatan</td>
                                    <td>:</td>
                                    <td>
                                        5 % dari upah
                                    </td>
                                </tr>
                                <?php
                                } else if ($jabatan_nama == "Wakil Koordinator") {
                                ?>
                                <tr>
                                    <td>Kompensasi Jabatan</td>
                                    <td>:</td>
                                    <td>
                                        3 % dari upah
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>Kompensasi Jabatan</td>
                                    <td>:</td>
                                    <td>
                                        Rp. 400.000,- / 30 Hari
                                    </td>
                                </tr>
                                <tr>
                                    <td>Lembur di Hari Kerja</td>
                                    <td>:</td>
                                    <td>Rp. 21.000 / Jam.</td>
                                </tr>
                                <tr>
                                    <td>Lembur di Hari Libur</td>
                                    <td>:</td>
                                    <td>Rp. 200.000 / 7 Jam.</td>
                                </tr>
                                <tr>
                                    <td>Lembur Buang Abu</td>
                                    <td>:</td>
                                    <td>Rp. 271.564 / Hari.</td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Hari Raya (THR)</td>
                                    <td>:</td>
                                    <td>Sesuai dengan kebijakan Pihak Pertama</td>
                                </tr>
                            </table>
                        </li>
                        <li>
                            Bahwa para Pihak sepakat apabila ada pengakhiran hubungan kerja karena telah selesai
                            kontrak, maka Pihak Pertama akan memberikan kompensasi yang besarannya ditentukan oleh Pihak
                            Pertama dan Pihak Kedua dapat menerimanya.
                        </li>
                        <li>
                            Bahwa para Pihak sepakat untuk melepaskan hak hukum yang timbul dikemudian hari, baik pidana
                            maupun perdata.
                        </li>
                    </ol>
                    </p>
                </td>
            </tr>
            <tr align="justify" valign="top">
                <td colspan="8">
                    Kesepakatan Bersama ini dibuat atas dasar itikad baik dengan sama-sama menyadari adanya kekurangan
                    dari masing-masing pihak, oleh karenanya terhadap kemungkinan adanya penyimpangan atau tidak
                    terpenuhinya syarat yang ditentukan oleh Undang-Undang atau Peraturan yang berlaku maka
                    masing-masing pihak baik itu Pihak Pertama maupun Pihak Kedua melepaskan hak hukum yang timbul
                    karenanya, baik selama masih ada hubungan kerja atau setelahnya hubungan kerja.
                    <br>
                    <br>
                    Demikian kesepakatan ini dibuat, ditandatangani diatas materai yang cukup oleh Para Pihak dengan
                    sadar, baik jasmani, rohani tanpa adanya unsur paksaan dari Pihak manapun dan untuk dilaksanakan
                    sebagaimana mestinya.
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
                    <table width="100%">
                        <tr>
                            <td align="center"><u>( Nasirin )</u><br> PIHAK KE I</td>
                            <td align="center"><u>( <?php echo $ktp_nama; ?> )</u><br> PIHAK KE II</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </blockquote>

</body>

</html>