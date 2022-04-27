<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data karyawan.xls");

include"koneksi.php";


$query_karyawan=mysql_query("SELECT * FROM biodata_ktp JOIN karyawan ON biodata_ktp.ktp_nomor=karyawan.karyawan_ktp JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN user ON karyawan.karyawan_npk=user.user_npk ORDER BY karyawan.karyawan_join, biodata_ktp.ktp_nama ASC ");
?>

<table border="1">
    <tr>
        <td>Nomor Induk Karyawan </td>
        <td>Nomor Pegawai Karyawan </td>
        <td>Nama depan karyawan</td>
        <td>Nama belakang karyawan</td>
        <td>Tanggal/ waktu masuk perusahaan</td>
        <td>Tanggal/ waktu resign dari perusahaan</td>
        <td>Posisi pekerjaan karyawan. Contohnya Admin Gudang Regional (AD_AGR01)</td>
        <td>Golongan karyawan</td>
        <td>Status karyawan (Kontrak/ Permanen/ Harian)</td>
        <td>Kode Status keluarga karyawan (TK, K/0, K/1, dst). TK artinya tidak kawin dan K/0, K/1, dst artinya Kawin dengan x tanggungan</td>
        <td>Nomor BPJS karyawan</td>
        <td>Tanggal BPJS karyawan</td>
        <td>Tanggal/ Waktu BPJS Kesehatan karyawan</td>
        <td>Nomor BPJS Kesehatan karyawan</td>
        <td>Tanggal/ waktu BPJS Pensiun</td>
        <td>Nomor BPJS Pensiun karyawan</td>
        <td>Nomor NPWP Karyawan</td>
        <td>Kode dari PTKP (Pendapatan Tidak Kena Pajak)/ status keluarga di pajak</td>
        <td>Jenis kelamin</td>
        <td>Status karyawan (Married/ Single)</td>
        <td>Tempat lahir karyawan</td>
        <td>Tanggal lahir karyawan</td>
        <td>Agama</td>
        <td colspan="7">Alamat karyawan</td>
        <td>Kota dari alamat domisili karyawan yang dicantumkan pada address 1</td>
        <td>Kode Pos dari alamat yang dicantumkan pada address 1</td>
        <td>Alamat kedua dari karyawan (jika ada)</td>
        <td>Kota dari alamat kedua karyawan yang dicantumkan pada address 2</td>
        <td>Kode Pos dari alamat yang dicantumkan pada address 2</td>
        <td>Nomor telepon karyawan 1</td>
        <td>Nomor telepon karyawan 2</td>
        <td>Nomor telepon mobile karyawan</td>
        <td>Nomor telepon fax karyawan</td>
        <td>Email yang dimiliki oleh karyawan</td>
        <td>Tinggi badan karyawan</td>
        <td>Berat badan Karyawan</td>
        <td>Contact Emergency</td>
        <td>Alamat dari orang emergency karyawan</td>
        <td>Nomor telepon dari orang emergency karyawan</td>
        <td>Golongan darah karyawan</td>
        <td>Kode kewarganegaraan karyawan</td>
        <td>etnis karyawan</td>
        <td>Relasi karyawan terhadap orang emergency yang telah dicantumkan</td>
        <td>Nomor telepon mobile dari orang emergency karyawan</td>
        <td>Tanggal NPWP karyawan</td>
        <td>Imbuhan nama karyawan (Mr/ Mrs)</td>
        <td>Nama gelar karyawan</td>
        <td>Nama panggilan karyawan</td>
        <td>Alamat NPWP</td>
        <td>Kode area dari NPWP karyawan</td>
        <td>Kode pos NPWP Karyawan</td>
        <td>Kota NPWP</td>
    </tr>
    <tr>
        <td>KTP</td>
        <td>EmpNo</td>
        <td>FirstName</td>
        <td>LastName</td>
        <td>JoinDate</td>
        <td>ResignDate</td>s
        <td>EmpPosition</td>
        <td>EmpClass</td>
        <td>EmpStatus</td>
        <td>FamilyCode</td>
        <td>BPJSNo</td>
        <td>BPJSRegDate</td>
        <td>BPJSKesehatanDate</td>
        <td>BPJSKesehatanNo</td>
        <td>BPJSPensiunDate</td>
        <td>BPJSPensiunNo</td>
        <td>NPWP No</td>
        <td>PTKPCode</td>
        <td>Gender</td>
        <td>MaritalStatus</td>
        <td>BirthPlace</td>
        <td>Birthdate</td>
        <td>Religion</td>
        <td colspan="7">Address1</td>
        <td>City1</td>
        <td>ZipCode1</td>
        <td>Address2</td>
        <td>City2</td>
        <td>ZipCode2</td>
        <td>Phone1</td>
        <td>Phone2</td>
        <td>MPhone</td>
        <td>FPhone</td>
        <td>EMail</td>
        <td>EmpHeight</td>
        <td>EmpWeight</td>
        <td>EmName</td>
        <td>EmAddress</td>
        <td>EmPhone</td>
        <td>BloodType</td>
        <td>NationalityCode</td>
        <td>EthnicCode</td>
        <td>EmRelationship</td>
        <td>EmPhoneMobile</td>
        <td>NPWPDate</td>
        <td>PrefixName</td>
        <td>SuffixName</td>
        <td>NickName</td>
        <td>NPWPAddress</td>
        <td>AreaCode</td>
        <td>ZIPCodeNPWP</td>
        <td>CityNPWP</td>
    </tr>
<?php
while($v_karyawan=mysql_fetch_array($query_karyawan)){
    $ktp_nomor=$v_karyawan['ktp_nomor'];
    $karyawan_npk=$v_karyawan['karyawan_npk'];
    $ktp_nama=$v_karyawan['ktp_nama'];
    $karyawan_join=$v_karyawan['karyawan_join'];
    $karyawan_terminate=$v_karyawan['karyawan_terminate'];
    $bagian_id=$v_karyawan['bagian_id'];
    $jabatan_id=$v_karyawan['jabatan_id'];
    $bagian_nama=$v_karyawan['bagian_nama'];
    $jabatan_nama=$v_karyawan['jabatan_nama'];
    $karyawan_jenis=$v_karyawan['karyawan_jenis'];
    $ktp_kelamin=$v_karyawan['ktp_kelamin'];
    $ktp_status=$v_karyawan['ktp_status'];
    $ktp_tempat_lahir=$v_karyawan['ktp_tempat_lahir'];
    $ktp_tanggal_lahir=$v_karyawan['ktp_tanggal_lahir'];
    $ktp_agama=$v_karyawan['ktp_agama'];
    $ktp_alamat=$v_karyawan['ktp_alamat'];
    $ktp_rt=$v_karyawan['ktp_rt'];
    $ktp_rw=$v_karyawan['ktp_rw'];
    $ktp_kelurahan=$v_karyawan['ktp_kelurahan'];
    $ktp_kecamatan=$v_karyawan['ktp_kecamatan'];
    $ktp_kabupaten=$v_karyawan['ktp_kabupaten'];
    $ktp_propinsi=$v_karyawan['ktp_propinsi'];
    $ktp_kodepos=$v_karyawan['ktp_kodepos'];
    $user_hp=$v_karyawan['user_hp'];
    $user_email=$v_karyawan['user_email'];
    $ktp_gol_darah=$v_karyawan['ktp_gol_darah'];
    $ktp_kewarganegaraan=$v_karyawan['ktp_kewarganegaraan'];
    {
?>

    <tr>
        <td>'<?php echo $ktp_nomor; ?></td>
        <td><?php echo $karyawan_npk; ?></td>
        <td><?php echo $ktp_nama; ?></td>
        <td></td>
        <td>'<?php echo $karyawan_join; ?></td>
        <td>'<?php echo $karyawan_terminate; ?></td>
        <td><?php echo $bagian_id; ?></td>
        <td><?php echo $jabatan_id; ?></td>
        <td><?php echo $karyawan_jenis; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $ktp_kelamin; ?></td>
        <td><?php echo $ktp_status; ?></td>
        <td><?php echo $ktp_tempat_lahir; ?></td>
        <td>'<?php echo $ktp_tanggal_lahir; ?></td>
        <td><?php echo $ktp_agama; ?></td>
        <td><?php echo $ktp_alamat; ?></td>
        <td><?php echo $ktp_rt; ?></td>
        <td><?php echo $ktp_rw; ?></td>
        <td><?php echo $ktp_kelurahan; ?></td>
        <td><?php echo $ktp_kecamatan; ?></td>
        <td><?php echo $ktp_kabupaten; ?></td>
        <td><?php echo $ktp_propinsi; ?></td>
        <td><?php echo $ktp_kabupaten; ?></td>
        <td><?php echo $ktp_kodepos; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $user_hp; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $user_email; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $ktp_gol_darah; ?></td>
        <td><?php echo $ktp_kewarganegaraan; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
<?php
    }
}
?>
</table>
