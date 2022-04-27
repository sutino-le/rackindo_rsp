<?php
include"koneksi.php";

date_default_timezone_set('Asia/Jakarta');// Set timezone
//variabel ini bisa kita isi dengan tanggal statis misalnya, '2017-05-01"

$awal=$_POST['generate_awal'];
$akhir=$_POST['generate_akhir'];

while (strtotime($awal) <= strtotime($akhir)) {

    $karyawan=mysql_query("SELECT * FROM karyawan ");
    while($v_karyawan=mysql_fetch_array($karyawan)){
        $pin=$v_karyawan['karyawan_finger'];
        $karyawan_ktp=$v_karyawan['karyawan_ktp'];
        {
            $absen_cek=mysql_query("SELECT * FROM absen_karyawan WHERE absen_kar_pin='$pin' AND absen_kar_tanggal='$awal' ");
            $v_absen_cek=mysql_fetch_array($absen_cek);
            if(empty($v_absen_cek)){
                $input_absen=mysql_query("INSERT INTO absen_karyawan VALUES('', '$pin', '$awal', '', '')");
                if($input_absen){
                    
                    $finger_in=$awal." 00:00:00";
                    $finger_out=$awal." 23:59:59";

                    //In
                    $in=mysql_query("SELECT * FROM absen_finger WHERE pin='$pin' AND waktu BETWEEN '$finger_in' AND '$finger_out' ORDER BY waktu ASC ");
                    $v_in=mysql_fetch_array($in);
                        if(empty($v_in)){
                            $masuk="00:00:00";
                        } else {
                            $masuk=date('H:i:s',strtotime($v_in['waktu']));
                        }

                    //Out
                    $out=mysql_query("SELECT * FROM absen_finger WHERE pin='$pin' AND waktu BETWEEN '$finger_in' AND '$finger_out' ORDER BY waktu DESC ");
                    $v_out=mysql_fetch_array($out);
                        if(empty($v_out)){
                            $keluar="00:00:00";
                        } else {
                            $keluar=date('H:i:s',strtotime($v_out['waktu']));
                        }

                    $update_absen=mysql_query("UPDATE absen_karyawan SET absen_kar_in='$masuk', absen_kar_out='$keluar' WHERE absen_kar_pin='$pin' AND absen_kar_tanggal='$awal' ");

                    if($update_absen){
                        //Cek Izin Karyawan
                        $absen_izin_cek=mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$pin' AND absen_izin_tanggal='$awal' ORDER BY absen_izin_id DESC");
                        $v_absen_izin_cek=mysql_fetch_array($absen_izin_cek);
                        $nomor_terakhir=$v_absen_izin_cek['absen_izin_nomor'];

                        $absen_izin_tahun=date("Y",strtotime($v_absen_izin_cek['absen_izin_tanggal_buat']));
                        $absen_izin_tahun_sekarang=date("Y");

                        if(empty($nomor_terakhir)){
                            $nomor_absen_izin=1;
                            $absen_izin_tanggal_buat=date("Y-m-d");
                        } else if($absen_izin_tahun==$absen_izin_tahun_sekarang){
                            $nomor_absen_izin=$nomor_terakhir+1;
                            $absen_izin_tanggal_buat=date("Y-m-d");
                        } else {
                            $nomor_absen_izin=1;
                            $absen_izin_tanggal_buat=date("Y-m-d");
                        }

                        //Cek data Vaksin
                        $vaksin_cek=mysql_query("SELECT * FROM vaksin WHERE vaksin_ktp='$karyawan_ktp' AND vaksin_tanggal='$awal' ");
                        $v_vaksin_cek=mysql_fetch_array($vaksin_cek);
                        $keterangan_vaksin="Vaksin Ke - ".$v_vaksin_cek['vaksin_ke'];

                        if(empty($v_absen_izin_cek) AND empty($v_vaksin_cek)){
                            //jika absen izin kosong dan vaksin kosong
                        } else if(empty($v_absen_izin_cek) AND !empty($v_vaksin_cek)){
                            // Jika absen izin kosong dan vaksin tidak kosong
                            $input_absen_izin=mysql_query("INSERT INTO absen_izin VALUES ('', '$nomor_absen_izin', '$absen_izin_tanggal_buat', '$pin', '$awal', 'Vaks', '$keterangan_vaksin' )");
                        } else if(!empty($v_absen_izin_cek) AND !empty($v_vaksin_cek)){
                            $update_absen_izin=mysql_query("UPDATE absen_izin SET absen_izin_nomor='$nomor_absen_izin', absen_izin_tanggal_buat='$absen_izin_tanggal_buat', absen_izin_jenis='Vaks', absen_izin_keterangan='$keterangan_vaksin' WHERE absen_izin_pin='$pin' AND absen_izin_tanggal='$awal' ");
                        }
                    }

                }
            } else {
                $finger_in=$awal." 00:00:00";
                $finger_out=$awal." 23:59:59";

                //In
                $in=mysql_query("SELECT * FROM absen_finger WHERE pin='$pin' AND waktu BETWEEN '$finger_in' AND '$finger_out' ORDER BY waktu ASC ");
                $v_in=mysql_fetch_array($in);
                    if(empty($v_in)){
                        $masuk="00:00:00";
                    } else {
                        $masuk=date('H:i:s',strtotime($v_in['waktu']));
                    }

                //Out
                $out=mysql_query("SELECT * FROM absen_finger WHERE pin='$pin' AND waktu BETWEEN '$finger_in' AND '$finger_out' ORDER BY waktu DESC ");
                $v_out=mysql_fetch_array($out);
                    if(empty($v_out)){
                        $keluar="00:00:00";
                    } else {
                        $keluar=date('H:i:s',strtotime($v_out['waktu']));
                    }

                $update_absen=mysql_query("UPDATE absen_karyawan SET absen_kar_in='$masuk', absen_kar_out='$keluar' WHERE absen_kar_pin='$pin' AND absen_kar_tanggal='$awal' ");


                if($update_absen){
                    //Cek Izin Karyawan
                    $absen_izin_cek=mysql_query("SELECT * FROM absen_izin WHERE absen_izin_pin='$pin' AND absen_izin_tanggal='$awal' ORDER BY absen_izin_id DESC");
                    $v_absen_izin_cek=mysql_fetch_array($absen_izin_cek);
                    $nomor_terakhir=$v_absen_izin_cek['absen_izin_nomor'];

                    $absen_izin_tahun=date("Y",strtotime($v_absen_izin_cek['absen_izin_tanggal_buat']));
                    $absen_izin_tahun_sekarang=date("Y");

                    if(empty($nomor_terakhir)){
                        $nomor_absen_izin=1;
                        $absen_izin_tanggal_buat=date("Y-m-d");
                    } else if($absen_izin_tahun==$absen_izin_tahun_sekarang){
                        $nomor_absen_izin=$nomor_terakhir+1;
                        $absen_izin_tanggal_buat=date("Y-m-d");
                    } else {
                        $nomor_absen_izin=1;
                        $absen_izin_tanggal_buat=date("Y-m-d");
                    }

                    //Cek data Vaksin
                    $vaksin_cek=mysql_query("SELECT * FROM vaksin WHERE vaksin_ktp='$karyawan_ktp' AND vaksin_tanggal='$awal' ");
                    $v_vaksin_cek=mysql_fetch_array($vaksin_cek);
                    $keterangan_vaksin="Vaksin Ke - ".$v_vaksin_cek['vaksin_ke'];

                    if(empty($v_absen_izin_cek) AND empty($v_vaksin_cek)){
                        //jika absen izin kosong dan vaksin kosong
                    } else if(empty($v_absen_izin_cek) AND !empty($v_vaksin_cek)){
                        // Jika absen izin kosong dan vaksin tidak kosong
                        $input_absen_izin=mysql_query("INSERT INTO absen_izin VALUES ('', '$nomor_absen_izin', '$absen_izin_tanggal_buat', '$pin', '$awal', 'Vaks', '$keterangan_vaksin' )");
                    } else if(!empty($v_absen_izin_cek) AND !empty($v_vaksin_cek)){
                        $update_absen_izin=mysql_query("UPDATE absen_izin SET absen_izin_nomor='$nomor_absen_izin', absen_izin_tanggal_buat='$absen_izin_tanggal_buat', absen_izin_jenis='Vaks', absen_izin_keterangan='$keterangan_vaksin' WHERE absen_izin_pin='$pin' AND absen_izin_tanggal='$awal' ");
                    }
                }
            }
        }
    }
    ?>
        <script type='text/javascript'>
        setTimeout(function() {
            swal({
                title: 'Generate selesai',
                type: 'success',
                timer: 1000,
                showConfirmButton: true
            });
        }, 10);
        window.setTimeout(function() {
            document.location = 'home_admin.php?page=finger_generate';
        }, 1000);
        </script>
    <?php
 $awal = date ("Y-m-d", strtotime("+1 day", strtotime($awal)));//looping tambah 1 date
}

?>