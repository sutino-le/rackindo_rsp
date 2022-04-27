<?php
include "koneksi.php";

date_default_timezone_set('Asia/Jakarta'); // Set timezone
//variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"
$mulai_tanggal = date("Y-01-01");
$periode_awal = $_POST['generate_awal'];
$periode_akhir = $_POST['generate_akhir'];
$kategori = $_POST['kategori'];


while (strtotime($periode_awal) <= strtotime($periode_akhir)) {
    // echo $periode_awal." : ";

    $periode_finger_in = $periode_awal . " 00:00:00";
    $periode_finger_out = $periode_awal . " 23:59:00";


    $data_karyawan = mysql_query("SELECT * FROM karyawan WHERE karyawan_kategori like '%$kategori%' ORDER BY karyawan_finger ASC");
    while ($v_data_karyawan = mysql_fetch_array($data_karyawan)) {

        $pin_finger = $v_data_karyawan['karyawan_finger'];
        $karyawan_ktp = $v_data_karyawan['karyawan_ktp'];
        $karyawan_schedule = $v_data_karyawan['karyawan_schedule'];
        $karyawan_schedule_start = $v_data_karyawan['karyawan_schedule_start'];

        //cek absen di finger masuk
        $cek_absen_finger_masuk = mysql_query("SELECT * FROM absen_finger WHERE pin='$pin_finger' AND waktu BETWEEN '$periode_finger_in' AND '$periode_finger_out' ORDER BY waktu ASC ");
        $v_cek_absen_finger_masuk = mysql_fetch_array($cek_absen_finger_masuk);
        if (empty($v_cek_absen_finger_masuk)) {
            $tampil_absen_finger_masuk = "00:00:00";
        } else {
            $tampil_absen_finger_masuk = date('H:i:s', strtotime($v_cek_absen_finger_masuk['waktu']));
        }

        //cek absen di finger pulang
        $cek_absen_finger_pulang = mysql_query("SELECT * FROM absen_finger WHERE pin='$pin_finger' AND waktu BETWEEN '$periode_finger_in' AND '$periode_finger_out' ORDER BY waktu DESC ");
        $v_cek_absen_finger_pulang = mysql_fetch_array($cek_absen_finger_pulang);
        if (empty($v_cek_absen_finger_pulang)) {
            $tampil_absen_finger_pulang = "00:00:00";
        } else {
            $tampil_absen_finger_pulang = date('H:i:s', strtotime($v_cek_absen_finger_pulang['waktu']));
        }


        //Cek schedule Karyawan
        $query_schedule_karyawan = mysql_query("SELECT * FROM group_schedule WHERE gs_code='$karyawan_schedule' ");
        $v_schedule_karyawan = mysql_num_rows($query_schedule_karyawan);

        $schedule_akhir = date('Y-m-d', strtotime('+1 days', strtotime($periode_awal)));
        // $schedule_awal_karyawan = new DateTime($karyawan_schedule_start);
        // $schedule_akhir_karyawan = new DateTime($schedule_akhir);
        // $diff_schedule_karyawan = $schedule_awal_karyawan->diff($schedule_akhir_karyawan);
        // $jumlah_hari_schedule=$diff_schedule_karyawan->format("%d");

        $jarak_awal = strtotime($karyawan_schedule_start);
        $jarak_akhir = strtotime($schedule_akhir);

        $jarak_semuanya = $jarak_akhir - $jarak_awal;

        $jumlah_hari_schedule = $jarak_semuanya / 60 / 60 / 24;

        if ($jumlah_hari_schedule > $v_schedule_karyawan) {
            if ($jumlah_hari_schedule != 0 and $v_schedule_karyawan != 0) {
                $gs_durasi_a = ($jumlah_hari_schedule % $v_schedule_karyawan);
            }
        } else if ($jumlah_hari_schedule <= $v_schedule_karyawan) {
            $gs_durasi_a = $jumlah_hari_schedule;
        }


        if ($gs_durasi_a == 0) {
            $gs_durasi = $v_schedule_karyawan;
        } else {
            $gs_durasi = $gs_durasi_a;
        }

        $tampilakan_group_schedule = mysql_query("SELECT * FROM group_schedule WHERE gs_code='$karyawan_schedule' AND gs_durasi='$gs_durasi' ");
        $v_tampilakan_group_schedule = mysql_fetch_array($tampilakan_group_schedule);
        $gs_shift = $v_tampilakan_group_schedule['gs_shift'];

        if ($karyawan_schedule == "0") {
        } else if ($periode_awal >= $karyawan_schedule_start) {
            $cek_group_schedule = mysql_query("SELECT * FROM karyawan_schedule WHERE ks_finger='$pin_finger' AND ks_tanggal='$periode_awal' ");
            $v_cek_group_schedule = mysql_fetch_array($cek_group_schedule);
            $id_karyawan_schedule = $v_cek_group_schedule['ks_id'];

            if (empty($v_cek_group_schedule)) {
                $input_karyawan_schedule = mysql_query("INSERT INTO karyawan_schedule VALUES('', '$pin_finger', '$periode_awal', '$gs_shift' )");
            } else {
                $update_karyawan_schedule = mysql_query("UPDATE karyawan_schedule SET ks_tanggal='$periode_awal', ks_schedule='$gs_shift' WHERE ks_id='$id_karyawan_schedule' ");
            }
        } else {
        }




        //Cek absen karyawan
        $cek_absen_karyawan = mysql_query("SELECT * FROM absen_karyawan WHERE absen_kar_pin='$pin_finger' AND absen_kar_tanggal='$periode_awal' ");
        $v_cek_absen_karyawan = mysql_fetch_array($cek_absen_karyawan);

        $absen_kar_id = $v_cek_absen_karyawan['absen_kar_id'];
        $absen_kar_tanggal = $v_cek_absen_karyawan['absen_kar_tanggal'];

        if (empty($absen_kar_id)) {
            $update_absen_karyawan = mysql_query("INSERT INTO absen_karyawan VALUES('', '$pin_finger', '$periode_awal', '$tampil_absen_finger_masuk', '$tampil_absen_finger_pulang'  )");
        } else if ($periode_awal == $absen_kar_tanggal) {
            $update_absen_karyawan = mysql_query("UPDATE absen_karyawan SET absen_kar_in='$tampil_absen_finger_masuk', absen_kar_out='$tampil_absen_finger_pulang' WHERE absen_kar_pin='$pin_finger' AND absen_kar_tanggal='$absen_kar_tanggal' ");
        }

        if ($update_absen_karyawan) {
            //Cek Izin Karyawan
            $absen_izin_cek = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$pin_finger' AND absen_izin_tanggal='$periode_awal' ORDER BY absen_izin_id DESC");
            $v_absen_izin_cek = mysql_fetch_array($absen_izin_cek);

            $cek_nomor_izin = mysql_query("SELECT * FROM absen_izin WHERE absen_izin_tanggal_buat BETWEEN '$mulai_tanggal' AND '$periode_awal' ORDER BY absen_izin_nomor  DESC");
            $v_cek_nomor_izin = mysql_fetch_array($cek_nomor_izin);
            $nomor_terakhir = $v_absen_izin_cek['absen_izin_nomor'];

            $absen_izin_tahun = date("Y", strtotime($v_absen_izin_cek['absen_izin_tanggal_buat']));
            $absen_izin_tahun_sekarang = date("Y");

            if (empty($nomor_terakhir)) {
                $nomor_absen_izin = 1;
                $absen_izin_tanggal_buat = date("Y-m-d");
                $absen_izin_tahun = date("Y");
            } else if ($absen_izin_tahun == $absen_izin_tahun_sekarang) {
                $nomor_absen_izin = $nomor_terakhir + 1;
                $absen_izin_tanggal_buat = date("Y-m-d");
                $absen_izin_tahun = date("Y");
            } else {
                $nomor_absen_izin = 1;
                $absen_izin_tanggal_buat = date("Y-m-d");
                $absen_izin_tahun = date("Y");
            }

            //Cek Libur Nasional
            $libur_nasional = mysql_query("SELECT * FROM libur_nasional WHERE ln_tanggal='$periode_awal' ");
            $v_libur_nasional = mysql_fetch_array($libur_nasional);
            $tanggal_libur_nasional = $v_libur_nasional['ln_tanggal'];
            $jenis_libur_nasional = $v_libur_nasional['ln_jenis'];
            $keterangan_libur_nasional = $v_libur_nasional['ln_keterangan'];

            if (empty($v_absen_izin_cek) and empty($v_libur_nasional)) {
                //jika absen izin kosong dan Libur Nasional kosong
            } else if (empty($v_absen_izin_cek) and !empty($v_libur_nasional)) {
                // Jika absen izin kosong dan Libur Nasional tidak kosong
                $update_absen_izin_ln = mysql_query("INSERT INTO absen_izin VALUES ('', '$nomor_absen_izin', '$absen_izin_tanggal_buat', '$pin_finger', '$tanggal_libur_nasional', '$jenis_libur_nasional', '$keterangan_libur_nasional', '$absen_izin_tahun', '' )");
            } else if (!empty($v_absen_izin_cek) and !empty($v_libur_nasional)) {
                $update_absen_izin_ln = mysql_query("UPDATE absen_izin SET absen_izin_nomor='$nomor_absen_izin', absen_izin_tanggal_buat='$absen_izin_tanggal_buat', absen_izin_jenis='$jenis_libur_nasional', absen_izin_keterangan='$keterangan_libur_nasional', absen_izin_tahun='$absen_izin_tahun' WHERE absen_izin_pin='$pin_finger' AND absen_izin_tanggal='$tanggal_libur_nasional' ");
            }

            //Cek data Vaksin
            $vaksin_cek = mysql_query("SELECT * FROM vaksin WHERE vaksin_ktp='$karyawan_ktp' AND vaksin_tanggal='$periode_awal' ");
            $v_vaksin_cek = mysql_fetch_array($vaksin_cek);
            $keterangan_vaksin = "Vaksin Ke - " . $v_vaksin_cek['vaksin_ke'];

            if (empty($v_absen_izin_cek) and empty($v_vaksin_cek)) {
                //jika absen izin kosong dan vaksin kosong
            } else if (empty($v_absen_izin_cek) and !empty($v_vaksin_cek)) {
                // Jika absen izin kosong dan vaksin tidak kosong
                $update_absen_izin_vaksin = mysql_query("INSERT INTO absen_izin VALUES ('', '$nomor_absen_izin', '$absen_izin_tanggal_buat', '$pin_finger', '$periode_awal', 'Vaks', '$keterangan_vaksin', '$absen_izin_tahun', '' )");
            } else if (!empty($v_absen_izin_cek) and !empty($v_vaksin_cek)) {
                $update_absen_izin_vaksin = mysql_query("UPDATE absen_izin SET absen_izin_nomor='$nomor_absen_izin', absen_izin_tanggal_buat='$absen_izin_tanggal_buat', absen_izin_jenis='Vaks', absen_izin_keterangan='$keterangan_vaksin', absen_izin_tahun='$absen_izin_tahun' WHERE absen_izin_pin='$pin_finger' AND absen_izin_tanggal='$periode_awal' ");
            }
        }
    }


?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Generate done',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=generate_attendance';
}, 1000);
</script>
<?php

    $periode_awal = date("Y-m-d", strtotime("+1 day", strtotime($periode_awal))); //looping tambah 1 date
}

?>