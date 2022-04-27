<?php
include"koneksi.php";

$periode_awal=date("Y-m-d");
$karyawan_schedule_start=date("Y-09-06");


//Cek schedule Karyawan
$schedule_karyawan=mysql_query("SELECT * FROM group_schedule WHERE gs_code='GS_001' ");
$v_schedule_karyawan=mysql_num_rows($schedule_karyawan);


// $schedule_akhir=date('Y-m-d', strtotime('+1 days', strtotime($periode_awal)));
// $schedule_awal_karyawan = new DateTime($karyawan_schedule_start);
// $schedule_akhir_karyawan = new DateTime($schedule_akhir);
// $diff_schedule_karyawan = $schedule_akhir_karyawan->diff($schedule_awal_karyawan);
// $jumlah_hari_schedule=$diff_schedule_karyawan->d;
// $jumlah_bulan_schedule=$diff_schedule_karyawan->m;

$awal=strtotime($karyawan_schedule_start);
$akhir=strtotime($periode_awal);

$jarak = $akhir - $awal;

$hari = $jarak / 60 / 60 / 24;
echo $hari;

if($jumlah_hari_schedule<$v_schedule_karyawan){
   echo "ini mod ".$jumlah_bulan_schedule.",".$jumlah_hari_schedule."%".$v_schedule_karyawan." :".$gs_durasi=$jumlah_hari_schedule;
} else {
   echo "ini mod ".$jumlah_bulan_schedule.",".$jumlah_hari_schedule."%".$v_schedule_karyawan." :".$gs_durasi=$jumlah_hari_schedule % $v_schedule_karyawan;
}

$tampilakan_group_schedule=mysql_query("SELECT * FROM group_schedule WHERE gs_code='GS_001' AND gs_durasi='$gs_durasi' ");
$v_tampilakan_group_schedule=mysql_fetch_array($tampilakan_group_schedule);
$gs_shift=$v_tampilakan_group_schedule['gs_shift'];

echo "<br> Ini ada shift : ".$gs_shift."<br>";

//$input_karyawan_schedule=mysql_query("INSERT INTO karyawan_schedule VALUES('', '201', '$periode_awal', '$gs_shift' )");



// tentukan waktu tujuan
$waktu_tujuan = mktime(8,0,0,9,20,2012);

// tentukan waktu saat ini
$waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

// hitung selisih kedua waktu
$selisih_waktu = $waktu_tujuan - $waktu_sekarang;

// Untuk menghitung jumlah dalam satuan hari:
$jumlah_hari = floor($selisih_waktu/86400);

// Untuk menghitung jumlah dalam satuan jam:
$sisa = $selisih_waktu % 86400;
$jumlah_jam = floor($sisa/3600);

// Untuk menghitung jumlah dalam satuan menit:
$sisa = $sisa % 3600;
$jumlah_menit = floor($sisa/60);

// Untuk menghitung jumlah dalam satuan detik:
$sisa = $sisa % 60;
$jumlah_detik = floor($sisa/1);

echo "Tanggal saat ini: ".date("d-m-Y H:i:s")."<br>";
echo "Tanggal pelaksanaan: ".date("20-9-2012 08:00:00")."<br>";
echo "<b>Waktu menjelang pelaksanaan tinggal: ".$jumlah_hari." hari ".$jumlah_jam." jam ".$jumlah_menit." menit ".$jumlah_detik." detik lagi</b>";
?>