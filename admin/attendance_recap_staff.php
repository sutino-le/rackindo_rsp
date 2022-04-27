<style style="text/css">
/* Define the hover highlight color for the table row */
.hoverTable tr:hover {
    background-color: #20B2AA;
}
</style>

<?php

if ($_POST['periode_awal']) {
    $periode_awal = $_POST['periode_awal'];
    $periode_akhir = $_POST['periode_akhir'];
} else {
    $periode_akhir = date("Y-m-25");
    $tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
    $periode_awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));
}


$daftar_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_kategori='Staff' AND karyawan.karyawan_status='Aktif' OR karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir' AND  karyawan.karyawan_bagian='$bagian'  ORDER BY bagian.bagian_parent,  bagian.bagian_id, karyawan.karyawan_join ASC ");

//Cari bagian
$cari_bagian = mysql_query("SELECT * FROM bagian WHERE bagian_id='$bagian' ");
$v_cari_bagian = mysql_fetch_array($cari_bagian);
?>

<form action="" method="POST">
    <div class="form-row">

        <div class="form-group col-md-3">
            <input type="date" class="form-control" name="periode_awal" value="<?php echo $periode_awal; ?>" required>
        </div>
        <div class="form-group col-md-3">
            <input type="date" class="form-control" name="periode_akhir" value="<?php echo $periode_akhir; ?>" required>
        </div>

        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> Show</button>
        </div>
    </div>
</form>
<br>
<table width="100%" border="0" cellspacing="10" cellpadding="10">
    <tr valign="top" align="right">
        <td>Periods : <b><?php echo date("d F Y", strtotime($periode_awal)); ?></b> s/d
            <b><?php echo date("d F Y", strtotime($periode_akhir)); ?></b>
        </td>
        <td bgcolor="#F08080" align="center"><b>Off</b></td>
        <td bgcolor="#F08080" align="center"><b>LN</b></td>
        <td bgcolor="#6495ED" align="center"><b>Vaksin</b></td>
        <td bgcolor="#9ACD32" align="center"><b>S</b></td>
        <td bgcolor="#9ACD32" align="center"><b>I</b></td>
        <td bgcolor="#FF8C00" align="center"><b>STK</b></td>
        <td bgcolor="#FF8C00" align="center"><b>ITD</b></td>
        <td bgcolor="#DC143C" align="center"><b>A</b></td>
    </tr>
</table>


<table width="100%" border="1" class="hoverTable">
    <tr>
        <td>No</td>
        <td>Pin</td>
        <td>Nama</td>
        <td>Departemen</td>
        <?php
        $tanggal_absen = mysql_query("SELECT * FROM absen_karyawan JOIN karyawan ON absen_karyawan.absen_kar_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE absen_karyawan.absen_kar_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' GROUP BY absen_karyawan.absen_kar_tanggal ASC ");
        while ($v_tanggal_absen = mysql_fetch_array($tanggal_absen)) {
            $head_tanggal = $v_tanggal_absen['absen_kar_tanggal']; {
                //Cek Libur Nasional
                $libur_nasional = mysql_query("SELECT * FROM libur_nasional WHERE ln_tanggal='$head_tanggal' ");
                $v_libur_nasional = mysql_fetch_array($libur_nasional);

                if (!empty($v_libur_nasional)) {
                    $color = "#F08080";
                } else if (date("D", strtotime($head_tanggal)) == "Sun") {
                    $color = "#F08080";
                } else {
                    $color = "";
                }
        ?>
        <td align="center" bgcolor="<?php echo $color; ?>"> <?php echo date("d", strtotime($head_tanggal)); ?></td>
        <?php
            }
        }
        ?>
    </tr>
    <?php
    $nomor = 1;
    while ($v_daftar_karyawan = mysql_fetch_array($daftar_karyawan)) {
        $karyawan_finger = $v_daftar_karyawan['karyawan_finger'];
        $karyawan_nama = $v_daftar_karyawan['ktp_nama'];
        $karyawan_bagian = $v_daftar_karyawan['karyawan_bagian'];
        $bagian_nama = $v_daftar_karyawan['bagian_nama'];
        $karyawan_jenis = $v_daftar_karyawan['karyawan_jenis'];
        $karyawan_jabatan = $v_daftar_karyawan['karyawan_jabatan']; {
            //Warna untuk jabatan
            if ($karyawan_jabatan == "3") {
                $color = "#ffb3b3";
            } else if ($karyawan_jabatan == "4") {
                $color = "#b3ffcc";
            } else if ($karyawan_jabatan == "5") {
                $color = "#ffffff";
            } else if ($karyawan_jabatan == "6") {
                $color = "#ffffff";
            }

            //Warna untuk jenis karyawan
            if ($karyawan_jenis == "Permanent") {
                $b1 = "<b>";
                $b2 = "</b>";
            } else {
                $b1 = "";
                $b2 = "";
            }

    ?>
    <tr font-style="<?php echo $font; ?>">
        <td bgcolor="<?php echo $color; ?>" align="center"><?php echo $b1 . "" . $nomor . "" . $b2; ?></td>
        <td bgcolor="<?php echo $color; ?>" align="center"><?php echo $b1 . "" . $karyawan_finger . "" . $b2; ?></td>
        <td bgcolor="<?php echo $color; ?>"><?php echo $b1 . "" . $karyawan_nama . "" . $b2; ?></td>
        <td bgcolor="<?php echo $color; ?>"><?php echo $b1 . "" . $bagian_nama . "" . $b2; ?></td>
        <?php
                $cari_absen = mysql_query("SELECT * FROM absen_karyawan JOIN karyawan ON absen_karyawan.absen_kar_pin=karyawan.karyawan_finger WHERE absen_karyawan.absen_kar_pin='$karyawan_finger' AND absen_karyawan.absen_kar_tanggal BETWEEN '$periode_awal' AND '$periode_akhir' GROUP BY absen_karyawan.absen_kar_tanggal ASC ");
                while ($v_cari_absen = mysql_fetch_array($cari_absen)) {
                    $absen_kar_pin = $v_cari_absen['absen_kar_pin'];
                    $absen_kar_tanggal = $v_cari_absen['absen_kar_tanggal'];
                    $absen_kar_in = $v_cari_absen['absen_kar_in'];
                    $absen_kar_out = $v_cari_absen['absen_kar_out']; {
                        $schedule = mysql_query("SELECT * FROM karyawan_schedule JOIN shift_daily ON karyawan_schedule.ks_schedule=shift_daily.sd_id WHERE karyawan_schedule.ks_finger='$absen_kar_pin' AND karyawan_schedule.ks_tanggal='$absen_kar_tanggal' ");
                        $v_schedule = mysql_fetch_array($schedule);


                        //Absen Masuk
                        if ($absen_kar_in == "00:00:00") {
                            $absen_masuk = "";
                        } else {
                            $absen_masuk = date("H:i", strtotime($absen_kar_in));
                        }

                        //Absen Pulang
                        if ($absen_kar_out == "00:00:00") {
                            $absen_pulang = "";
                        } else {
                            $absen_pulang = date("H:i", strtotime($absen_kar_out));
                        }

                        //Schedule Masuk
                        if ($v_schedule['sd_masuk'] == "00:00:00" or empty($v_schedule['sd_masuk'])) {
                            $schedule_masuk = "";
                        } else {
                            $schedule_masuk = date("H:i", strtotime($v_schedule['sd_masuk']));
                        }

                        //Schedule Pulang
                        if ($v_schedule['sd_pulang'] == "00:00:00" or empty($v_schedule['sd_pulang'])) {
                            $schedule_pulang = "";
                        } else {
                            $schedule_pulang = date("H:i", strtotime($v_schedule['sd_pulang']));
                        }

                        //Cek absen izin
                        $absen_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$absen_kar_pin' AND absen_izin_tanggal='$absen_kar_tanggal' ");
                        $v_absen_izin = mysql_fetch_array($absen_izin);

                        if ($v_schedule['sd_type'] == "Holiday") {
                            $color_izin = "#F08080";
                            $absen_izin_jenis = "Off";
                            $title_izin = "Off";
                        } else if ($v_absen_izin['absen_izin_jenis'] == "Vaks") {
                            $color_izin = "#6495ED";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = "Schedule : " . $schedule_masuk . " - " . $schedule_pulang . " | Ket : " . $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "S") {
                            $color_izin = "#9ACD32";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = "Schedule : " . $schedule_masuk . " - " . $schedule_pulang . " | Ket : " . $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "I") {
                            $color_izin = "#9ACD32";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = "Schedule : " . $schedule_masuk . " - " . $schedule_pulang . " | Ket : " . $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "ITD") {
                            $color_izin = "#FF8C00";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = "Schedule : " . $schedule_masuk . " - " . $schedule_pulang . " | Ket : " . $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "1/2") {
                            $color_izin = "#FFA500";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = "Schedule : " . $schedule_masuk . " - " . $schedule_pulang . " | Ket : " . $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "STK") {
                            $color_izin = "#FF8C00";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "A") {
                            $color_izin = "#DC143C";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = $v_absen_izin['absen_izin_keterangan'];
                        } else if ($v_absen_izin['absen_izin_jenis'] == "LN") {
                            $color_izin = "#F08080";
                            $absen_izin_jenis = $v_absen_izin['absen_izin_jenis'];
                            $title_izin = $v_absen_izin['absen_izin_keterangan'];
                        } else {
                            $color_izin = "";
                            $absen_izin_jenis = "A";
                            $title_izin = "Schedule : " . $schedule_masuk . " - " . $schedule_pulang . " | Ket : ";
                        }


                        //Tampilkan Absen
                        if (empty($absen_masuk) and empty($absen_pulang)) {
                            $tampil_absen = $absen_izin_jenis;
                        } else if ($absen_masuk == "00:00" and $absen_pulang != "00:00") {
                            $tampil_absen = $absen_pulang;
                        } else if ($absen_masuk != "00:00" and $absen_pulang == "00:00") {
                            $tampil_absen = $absen_masuk;
                        } else if ($absen_masuk == $absen_pulang) {
                            $tampil_absen = $absen_masuk;
                        } else {
                            $tampil_absen = $absen_masuk . "<br>" . $absen_pulang;
                        }

                ?>
        <td align="center" bgcolor="<?php echo $color_izin; ?>"
            title="<?php echo $absen_izin_jenis . "-" . $title_izin; ?>">
            <?php echo $tampil_absen; ?>
        </td>
        <?php
                    }
                }
                ?>
    </tr>
    <?php
            $nomor++;
        }
    }
    ?>
</table>