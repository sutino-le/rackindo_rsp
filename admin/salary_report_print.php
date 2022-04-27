<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Upah Karyawan.xls");

include "koneksi.php";

$kategori = $_GET['kategori'];
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

$jam_awal = "00:00:01";
$jam_akhir = "23:59:59";

$upah_kalkulasi = mysql_query("SELECT * FROM upah_kalkulasi JOIN karyawan ON upah_kalkulasi.upah_kal_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian On karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE upah_kalkulasi.upah_kal_kategori='$kategori' AND upah_kalkulasi.upah_kal_awal='$awal' AND upah_kalkulasi.upah_kal_akhir='$akhir' ORDER BY bagian.bagian_nama ASC ");

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">

    <tr bgcolor="#66CDAA" align="center">
        <td align="center" colspan="41">
            <b>
                Upah : <?php echo $kategori; ?><br>
                Periode : <?php echo date("d F Y", strtotime($awal)); ?> s/d
                <?php echo date("d F Y", strtotime($akhir)); ?>
            </b>
        </td>
    </tr>
    <tr bgcolor="#66CDAA" align="center">
        <td align="center" colspan="4">Data Karyawan</td>
        <td align="center" colspan="4">Rincian Upah</td>
        <td align="center" colspan="3">Lembur Harian</td>
        <td align="center" colspan="3">Lembur Minggu</td>
        <td align="center" colspan="3">Lembur Buang Abu</td>
        <td align="center" colspan="11">Rincian Potongan</td>
        <td>Tambahan</td>
        <td>Total</td>
        <td bgcolor="gray">&nbsp;&nbsp;</td>
        <td align="center" colspan="10">Absensi</td>
    </tr>
    <tr bgcolor="#66CDAA" align="center">
        <td>No</td>
        <td>ID</td>
        <td>Nama Lengkap</td>
        <td>Departemen</td>
        <td>Upah</td>
        <td>Kompensasi</td>
        <td>Insentif</td>
        <td>Total Upah</td>
        <td>Lembur /Jam</td>
        <td>Jumlah Jam</td>
        <td>Upah Lembur Harian</td>
        <td>Lembur /Jam</td>
        <td>Jumlah Jam Minggu</td>
        <td>Upah Lembur Minggu</td>
        <td>Lembur /Jam</td>
        <td>Jumlah Jam Buang Abu</td>
        <td>Upah Lembur Buang Abu</td>
        <td>Uang Pot. /Hari</td>
        <td>Pot. /Hari</td>
        <td>Jumlah Pot. /Hari</td>
        <td>Pot. /Jam</td>
        <td>Uang Pot. /jam</td>
        <td>Jumlah Pot. /Jam</td>
        <td>BPJS TK<br>JHT</td>
        <td>BPJS TK<br>JP</td>
        <td>BPJS Kes<br>Kesehatan</td>
        <td>Total Pot.</td>
        <td>Hutang</td>
        <td>Tambahan</td>
        <td>Upah Diterima</td>
        <td bgcolor="gray">&nbsp;&nbsp;</td>
        <td>&nbsp;H&nbsp;</td>
        <td>&nbsp;Off&nbsp;</td>
        <td>&nbsp;LN&nbsp;</td>
        <td>&nbsp;Vaks&nbsp;</td>
        <td>&nbsp;S&nbsp;</td>
        <td>&nbsp;I&nbsp;</td>
        <td>&nbsp;STK&nbsp;</td>
        <td>&nbsp;ITD&nbsp;</td>
        <td>&nbsp;A&nbsp;</td>
        <td>&nbsp;Jumlah Absen&nbsp;</td>
    </tr>
    <?php
    $no = 0;
    while ($v_upah_kalkulasi = mysql_fetch_array($upah_kalkulasi)) {
        $karyawan_ktp = $v_upah_kalkulasi['karyawan_ktp'];
        $karyawan_finger = $v_upah_kalkulasi['karyawan_finger'];
        $ktp_nama = $v_upah_kalkulasi['ktp_nama'];
        $jabatan_nama = $v_upah_kalkulasi['jabatan_nama'];
        $bagian_nama = $v_upah_kalkulasi['bagian_nama'];
        $upah_kal_upah = $v_upah_kalkulasi['upah_kal_upah'];
        $upah_kal_kompensasi = $v_upah_kalkulasi['upah_kal_kompensasi'];
        $upah_kal_insentif = $v_upah_kalkulasi['upah_kal_insentif']; {
            $no++;

            // Total upah
            $total_upah = $upah_kal_upah + $upah_kal_kompensasi + $upah_kal_insentif;

            // absen masuk
            $absensi = mysql_query("SELECT * FROM absen_karyawan WHERE 
            absen_kar_pin='$karyawan_finger' AND absen_kar_tanggal BETWEEN '$awal' AND '$akhir' AND absen_kar_in BETWEEN '$jam_awal' AND '$jam_akhir'
            OR
            absen_kar_pin='$karyawan_finger' AND absen_kar_tanggal BETWEEN '$awal' AND '$akhir' AND absen_kar_out BETWEEN '$jam_awal' AND '$jam_akhir'
            ");
            $jumlah_masuk = mysql_num_rows($absensi);

            // absen off
            $absensi_off = mysql_query("SELECT * FROM karyawan_schedule WHERE ks_finger='$karyawan_finger' AND ks_tanggal BETWEEN '$awal' AND '$akhir' AND ks_schedule='1'
            ");
            $jumlah_off = mysql_num_rows($absensi_off);

            // absen ln
            $absensi_ln = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$karyawan_finger' AND absen_izin_tanggal BETWEEN '$awal' AND '$akhir' AND absen_izin_jenis='LN'
            ");
            $jumlah_ln = mysql_num_rows($absensi_ln);

            // absen vaks
            $absensi_vaks = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$karyawan_finger' AND absen_izin_tanggal BETWEEN '$awal' AND '$akhir' AND absen_izin_jenis='Vaks'
            ");
            $jumlah_vaks = mysql_num_rows($absensi_vaks);

            // absen sick
            $absensi_sick = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$karyawan_finger' AND absen_izin_tanggal BETWEEN '$awal' AND '$akhir' AND absen_izin_jenis='S'
            ");
            $jumlah_sick = mysql_num_rows($absensi_sick);

            // absen ijin
            $absensi_ijin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$karyawan_finger' AND absen_izin_tanggal BETWEEN '$awal' AND '$akhir' AND absen_izin_jenis='I'
            ");
            $jumlah_ijin = mysql_num_rows($absensi_ijin);

            // absen stk
            $absensi_stk = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$karyawan_finger' AND absen_izin_tanggal BETWEEN '$awal' AND '$akhir' AND absen_izin_jenis='STK'
            ");
            $jumlah_stk = mysql_num_rows($absensi_stk);

            // absen itd
            $absensi_itd = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$karyawan_finger' AND absen_izin_tanggal BETWEEN '$awal' AND '$akhir' AND absen_izin_jenis='ITD'
            ");
            $jumlah_itd = mysql_num_rows($absensi_itd);

            // absen alpa
            $alpa = "00:00:00";
            $absensi_alpa = mysql_query("SELECT * FROM absen_karyawan WHERE 
            absen_kar_pin='$karyawan_finger' AND absen_kar_tanggal BETWEEN '$awal' AND '$akhir' AND absen_kar_in BETWEEN '$alpa' AND '$alpa'
            OR
            absen_kar_pin='$karyawan_finger' AND absen_kar_tanggal BETWEEN '$awal' AND '$akhir' AND absen_kar_out BETWEEN '$alpa' AND '$alpa'
            ");
            $jumlah_alpa = mysql_num_rows($absensi_alpa);

            // absen potongan jam
            $absensi_pot_jam = mysql_query("SELECT SUM(upah_pot_jumlah) AS jumlah_absensi_pot_jam FROM upah_potongan_jam WHERE upah_pot_ktp='$karyawan_ktp' AND upah_pot_tanggal BETWEEN '$awal' AND '$akhir' ");
            $jumlah_pot_jam = mysql_fetch_array($absensi_pot_jam);

            // absen Lembur biasa
            $jenis_lembur_biasa = "Hari Biasa";
            $cek_lembur_biasa = mysql_query("SELECT SUM(lembur_jam) AS jumlah_lembur_biasa FROM upah_lembur WHERE lembur_ktp='$karyawan_ktp' AND lembur_jenis='$jenis_lembur_biasa' AND lembur_tanggal BETWEEN '$awal' AND '$akhir' ");
            $v_jumlah_lembur_biasa = mysql_fetch_array($cek_lembur_biasa);
            $jam_lembur_biasa = $v_jumlah_lembur_biasa['jumlah_lembur_biasa'];

            // absen Lembur minggu
            $jenis_lembur_minggu = "Hari Libur";
            $cek_lembur_minggu = mysql_query("SELECT SUM(lembur_jam) AS jumlah_lembur_minggu FROM upah_lembur WHERE lembur_ktp='$karyawan_ktp' AND lembur_jenis='$jenis_lembur_minggu' AND lembur_tanggal BETWEEN '$awal' AND '$akhir' ");
            $jumlah_lembur_minggu = mysql_fetch_array($cek_lembur_minggu);
            $jam_lembur_minggu = $jumlah_lembur_minggu['jumlah_lembur_minggu'];

            // absen Lembur buang_abu
            $jenis_lembur_buang_abu = "Buang Abu";
            $cek_lembur_buang_abu = mysql_query("SELECT SUM(lembur_jam) AS jumlah_lembur_buang_abu FROM upah_lembur WHERE lembur_ktp='$karyawan_ktp' AND lembur_jenis='$jenis_lembur_buang_abu' AND lembur_tanggal BETWEEN '$awal' AND '$akhir' ");
            $jumlah_lembur_buang_abu = mysql_fetch_array($cek_lembur_buang_abu);
            $jam_lembur_buang_abu = $jumlah_lembur_buang_abu['jumlah_lembur_buang_abu'];

            // absen Tambahan
            $cek_upah_tambahan = mysql_query("SELECT SUM(upah_tambahan_jumlah) AS jumlah_upah_tambahan FROM upah_tambahan WHERE upah_tambahan_ktp='$karyawan_ktp' AND upah_tambahan_tanggal BETWEEN '$awal' AND '$akhir' ");
            $jumlah_upah_tambahan = mysql_fetch_array($cek_upah_tambahan);
            $total_upah_tambahan = $jumlah_upah_tambahan['jumlah_upah_tambahan'];

            // BPJS Kesehatan
            $cek_bpjskes = mysql_query("SELECT * FROM bpjs_kes WHERE bpjskes_ktp='$karyawan_ktp' ");
            $v_cek_bpjskes = mysql_fetch_array($cek_bpjskes);
            $bpjskes_status = $v_cek_bpjskes['bpjskes_status'];
            if ($bpjskes_status == "Aktif") {
                $total_potongan_kes = $upah_kal_upah * (1 / 100);
            } else {
                $total_potongan_kes = 0;
            }

            // BPJS Ketenagakerjaan
            $cek_bpjstk = mysql_query("SELECT * FROM bpjs_tk WHERE bpjstk_ktp='$karyawan_ktp' ");
            $v_cek_bpjstk = mysql_fetch_array($cek_bpjstk);
            $bpjstk_status = $v_cek_bpjstk['bpjstk_status'];
            if ($bpjstk_status == "Aktif") {
                $total_potongan_jht = $upah_kal_upah * (2 / 100);
                $total_potongan_jp = $upah_kal_upah * (1 / 100);
            } else {
                $total_potongan_jht = 0;
                $total_potongan_jp = 0;
            }

            // Lembur
            $upah_lembur_biasa_perjam = 21000;
            $upah_lembur_minggu_perjam = 200000 / 7;
            $upah_lembur_buang_abu_perjam = 271564 / 14;

            // Upah lembur
            $upah_lembur_biasa = $upah_lembur_biasa_perjam * $jam_lembur_biasa;
            $upah_lembur_minggu = $upah_lembur_minggu_perjam * $jam_lembur_minggu;
            $upah_lembur_buang_abu = $upah_lembur_buang_abu_perjam * $jam_lembur_buang_abu;



            // Total alpa
            $total_alpa = $jumlah_alpa - $jumlah_off - $jumlah_ln - $jumlah_vaks - $jumlah_sick - $jumlah_ijin - $jumlah_stk - $jumlah_itd;

            // Total absen keseluruhan
            $total_absen_keseluruhan = $jumlah_masuk + $jumlah_off + $jumlah_ln + $jumlah_vaks + $jumlah_sick + $jumlah_ijin + $jumlah_stk + $jumlah_itd + $total_alpa;

            // upah pemotong perhari
            $upah_pemotong_perhari = $total_upah / 30;

            // upah pemoton perjam
            $upah_pemotong_perjam = $upah_pemotong_perhari * 7;

            // menghitung potongan perhari
            $potongan_absen_perhari = $total_alpa + $jumlah_itd + $jumlah_stk;
            $jumlah_potongan_hari = $upah_pemotong_perhari * $potongan_absen_perhari;

            // menghitung potongan perjam
            $potongan_absen_perjam = $jumlah_pot_jam['jumlah_absensi_pot_jam'];
            $jumlah_potongan_perjam = $upah_pemotong_perjam * $potongan_absen_perjam;

            // Total potongan
            $total_potongan_upah = $jumlah_potongan_hari + $jumlah_potongan_perjam + $total_potongan_kes + $total_potongan_jht + $total_potongan_jp;

            // Upah diterima
            $upah_diterima = ($total_upah - $total_potongan_upah) + $total_upah_tambahan;
    ?>
    <tr>
        <td align="center"><?php echo $no; ?></td>
        <td align="center"><?php echo $karyawan_finger; ?></td>
        <td><?php echo $ktp_nama; ?></td>
        <td><?php echo $jabatan_nama . " - " . $bagian_nama; ?></td>
        <td align="right">&nbsp;<?php echo number_format($upah_kal_upah, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_kal_kompensasi, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_kal_insentif, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($total_upah, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_lembur_biasa_perjam, 0, ",", "."); ?>&nbsp;</td>
        <td align="center">&nbsp;<?php echo number_format($jam_lembur_biasa); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_lembur_biasa, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_lembur_minggu_perjam, 0, ",", "."); ?>&nbsp;</td>
        <td align="center">&nbsp;<?php echo number_format($jam_lembur_minggu); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_lembur_minggu, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_lembur_buang_abu_perjam, 0, ",", "."); ?>&nbsp;</td>
        <td align="center">&nbsp;<?php echo number_format($jam_lembur_buang_abu); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_lembur_buang_abu, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_pemotong_perhari, 0, ",", "."); ?>&nbsp;</td>
        <td align="center">&nbsp;<?php echo number_format($potongan_absen_perhari); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($jumlah_potongan_hari, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_pemotong_perjam, 0, ",", "."); ?>&nbsp;</td>
        <td align="center">&nbsp;<?php echo number_format($potongan_absen_perjam); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($jumlah_potongan_perjam, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($total_potongan_jht, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($total_potongan_jp, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($total_potongan_kes, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($total_potongan_upah, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($hutang, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($total_upah_tambahan, 0, ",", "."); ?>&nbsp;</td>
        <td align="right">&nbsp;<?php echo number_format($upah_diterima, 0, ",", "."); ?>&nbsp;</td>
        <td bgcolor="gray"></td>
        <td align="center">
            <?php
                    if ($jumlah_masuk == "0") {
                        echo "";
                    } else {
                        echo $jumlah_masuk;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_off == "0") {
                        echo "";
                    } else {
                        echo $jumlah_off;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_ln == "0") {
                        echo "";
                    } else {
                        echo $jumlah_ln;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_vaks == "0") {
                        echo "";
                    } else {
                        echo $jumlah_vaks;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_sick == "0") {
                        echo "";
                    } else {
                        echo $jumlah_sick;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_ijin == "0") {
                        echo "";
                    } else {
                        echo $jumlah_ijin;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_stk == "0") {
                        echo "";
                    } else {
                        echo $jumlah_stk;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($jumlah_itd == "0") {
                        echo "";
                    } else {
                        echo $jumlah_itd;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($total_alpa == "0") {
                        echo "";
                    } else {
                        echo $total_alpa;
                    }
                    ?>
        </td>
        <td align="center">
            <?php
                    if ($total_absen_keseluruhan == "0") {
                        echo "";
                    } else {
                        echo $total_absen_keseluruhan;
                    }
                    ?>
        </td>
    </tr>
    <?php

        }
    }
    ?>
</table>