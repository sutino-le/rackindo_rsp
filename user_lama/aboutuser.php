<?php
$birthdate = date("m-d");
$ultah = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$user_ktp' ");
$v_ultah = mysql_fetch_array($ultah);

if ($birthdate == date("m-d", strtotime($v_ultah['ktp_tanggal_lahir']))) {

?>
<div class="card mb-1">
    <div class="inner text-center">
        <img src="img/ultah3.gif" alt="Selamat Ulang Tahun" width="150" height="150">
        <h1 style="font-family:Brush Script MT;">Happy Birthday to You</h1>
    </div>
</div>

<?php
}
?>