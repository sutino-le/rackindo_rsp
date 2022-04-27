<?php
include "koneksi.php";

$folder   = 'berkas';
$tmp_name = $_FILES["filecsv"]["tmp_name"];
$name     = "file_upload.csv";
move_uploaded_file($tmp_name, "$folder/$name");

//cek apakah delimiter menggunakan , atau ;
$file = fopen("berkas/file_upload.csv", "r"); //buka file csv
$cek  = fgetcsv($file, 0, ','); //baca isi csv perbaris dengan koma
if (!empty($cek[1])) {
    $delimiter = ",";
} else {
    $delimiter = ";";
}
fclose($file);
//batas

//insert ke database
$file = fopen("berkas/file_upload.csv", "r"); //buka file csv
$baris = 0;
while (!feof($file)) //cari akhir baris csv
{
    $data = fgetcsv($file, 0, $delimiter);
    if (!empty($data[0])) //tidak mengikutkan spasi kosong
    {
        if ($baris >= 1) //karena baris 0 adalah judul kolom/field
        {

            $pin   = $data[0];
            $waktu = $data[1];
            $status  = $data[2];

            $cekdulu = "SELECT * FROM absen_finger WHERE pin='$pin' AND waktu='$waktu' ";
            $prosescek = mysql_query($cekdulu);
            if (mysql_num_rows($prosescek) > 0) { //proses mengingatkan data sudah ada
                // echo "<script>alert('Username Sudah Digunakan');history.go(-1) </script>";
                $sql = mysql_query("DELETE FROM absen_finger WHERE pin='$pin' AND waktu='$waktu' ");
            }
            if ($prosescek['pin'] == "0") {
            } else { //proses menambahkan data, tambahkan sesuai dengan yang kalian gunakan
                $sql = "INSERT INTO absen_finger (pin, waktu, status) VALUES ('$pin','$waktu','$status')";
                mysql_query($sql) or exit(mysql_error());

                if ($sql) {
                    $hapus = mysql_query("DELETE FROM absen_finger WHERE pin='0' ");
                }
            }
        }
    }
    $baris++;
}
fclose($file); //tutup akses file csv

$pesan = "Data successfully imported!";
$url   = "home_admin.php?page=fingerprint_upload";

echo "<script> 
  alert('$pesan'); 
  location='$url';
   </script>";