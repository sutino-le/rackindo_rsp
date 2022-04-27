<?php
include"koneksi.php";
include "phpqrcode/qrlib.php"; 

$karyawan_npk=$_GET['karyawan_npk'];

$query=mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN user ON karyawan.karyawan_npk=user.user_npk WHERE karyawan.karyawan_npk='$karyawan_npk' ");
$hasil=mysql_fetch_array($query);

$npk=$hasil['karyawan_npk'];

?>

<table width="100%">
    <tr>
        <td align="left">

            <table width="204px" height="323px" border="0" background="img/ID Card depan.jpg">
                <tr>
                    <td align="center">
                        <table>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center"><img src="foto/<?php echo $hasil['user_foto']; ?>" width="70px" height="90px"></td>
                            </tr>
                            <tr>
                                <td align="center"><u><b><?php echo $hasil['ktp_nama']; ?></b></u></td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo $hasil['bagian_nama']; ?></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <?php
                                        $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
                                        if (!file_exists($tempdir)) //Buat folder bername temp
                                        mkdir($tempdir);

                                        //isi qrcode jika di scan
                                        $codeContents = $npk;
                                        //nama file qrcode yang akan disimpan
                                        $namaFile=$npk.".png";
                                        //ECC Level
                                        $level=QR_ECLEVEL_H;
                                        //Ukuran pixel
                                        $UkuranPixel=3;
                                        //Ukuran frame
                                        $UkuranFrame=2;
                                        QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 
                                        echo '<img src="'.$tempdir.$namaFile.'" />';  
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><b><?php echo $hasil['karyawan_npk']; ?></b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                            
            </table>

        </td>
        <td align="right">

            <table width="204px" height="323px" border="0" background="img/ID Card belakang.jpg">
                <tr>
                    <td align="center">
                        <table>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <br>
                                    <br>
                                    <br>
                                    <?php
                                        $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
                                        if (!file_exists($tempdir)) //Buat folder bername temp
                                        mkdir($tempdir);

                                        //isi qrcode jika di scan
                                        $codeContents = $npk;
                                        //nama file qrcode yang akan disimpan
                                        $namaFile=$npk.".png";
                                        //ECC Level
                                        $level=QR_ECLEVEL_H;
                                        //Ukuran pixel
                                        $UkuranPixel=3;
                                        //Ukuran frame
                                        $UkuranFrame=2;
                                        QRcode::png($codeContents, $tempdir.$namaFile, $level, $UkuranPixel, $UkuranFrame); 
                                        echo '<img src="'.$tempdir.$namaFile.'" />';  
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                            
            </table>

        </td>
    </tr>
</table>