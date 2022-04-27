<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'ktp_nomor',
    2   =>  'ktp_nama',
    3   =>  'ktp_tempat_lahir',
    4   =>  'ktp_tanggal_lahir',
    5   =>  'ktp_alamat',
    6   =>  'ktp_rt',
    7   =>  'ktp_rw',
    8   =>  'ktp_kelurahan',
    9   =>  'ktp_kabupaten',
    10   =>  'ktp_propinsi',
    11   =>  'ktp_kodepos',
    12   =>  'user_ktp',
    13   =>  'email',
    14   =>  'user_hp'
);  //create column like table in database

$sql = "SELECT * FROM biodata_ktp JOIN user ON biodata_ktp.ktp_nomor=user.user_ktp";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM biodata_ktp JOIN user ON biodata_ktp.ktp_nomor=user.user_ktp";
if (!empty($request['search']['value'])) {
    $sql .= " AND (ktp_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_tempat_lahir Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_tanggal_lahir Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_alamat Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_kelurahan Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_kabupaten Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_propinsi Like '%" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);

//Order
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][1]['dir'] . "  LIMIT " .
    $request['start'] . "  ," . $request['length'] . "  ";

$query = mysqli_query($con, $sql);

$data = array();
$no = $_POST['start'];
while ($row = mysqli_fetch_array($query)) {
    $no++;
    $subdata = array();
    $subdata[] = $no;

    $ktp = $row['ktp_nomor'];
    // data komplit

    //darurat
    $query_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$ktp' GROUP BY darurat_ktp ASC ");
    $v_darurat = mysql_num_rows($query_darurat);
    $darurat = 1;

    //domisili
    $query_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$ktp' GROUP BY domisili_ktp ASC ");
    $v_domisili = mysql_num_rows($query_domisili);
    $domisili = 1;

    //keluarga
    $query_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_ktp='$ktp' GROUP BY keluarga_ktp ASC ");
    $v_keluarga = mysql_num_rows($query_keluarga);
    $keluarga = 1;

    //npwp
    $query_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$ktp' GROUP BY npwp_ktp ASC ");
    $v_npwp = mysql_num_rows($query_npwp);
    $npwp = 1;

    //pengalaman
    $query_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_ktp='$ktp' GROUP BY pengalaman_ktp ASC ");
    $v_pengalaman = mysql_num_rows($query_pengalaman);
    $pengalaman = 1;

    //pendidikan
    $query_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$ktp' GROUP BY pendidikan_ktp ASC ");
    $v_pendidikan = mysql_num_rows($query_pendidikan);
    $pendidikan = 1;

    //user
    $query_user = mysql_query("SELECT * FROM user WHERE user_ktp='$ktp' GROUP BY user_ktp ASC ");
    $v_user = mysql_fetch_array($query_user);

    $wa = $v_user['user_hp'];
    $n_wa = 1;

    $email = $v_user['user_email'];
    $n_email = 1;

    if ($wa == "0" and $email == "0") {
        $nilai_wa = 0;
        $nilai_email = 0;
    } else if ($wa == "0" and $email == "0@0.com") {
        $nilai_wa = 0;
        $nilai_email = 0;
    } else {
        $nilai_wa = 1;
        $nilai_email = 1;
    }

    $komplit = $v_darurat + $v_domisili + $v_keluarga + $v_npwp + $v_pengalaman + $v_pendidikan + $nilai_wa + $nilai_email;
    $pembagi = $darurat + $domisili + $keluarga + $npwp + $pengalaman + $pendidikan + $n_wa + $n_email;
    $persentase = ($komplit / $pembagi) * 100;

    if ($persentase < 100) {
        $color = "red";
    } else {
        $color = "";
    }

    $subdata[] = '<font color="' . $color . '">' . $persentase . "% </font>";
    $subdata[] = '<img src="foto/' . $row['user_foto'] . '" class="img-circle" width="40px" height="50px" />';
    $subdata[] = $row['ktp_nomor'] . "<br>" . $row['ktp_nama'];
    $subdata[] = $row['ktp_tempat_lahir'] . "<br>" . $row['ktp_tanggal_lahir'];
    $subdata[] = $row['ktp_alamat'] . ", RT/RW " . $row['ktp_rt'] . "/" . $row['ktp_rw'] . ", Kel. " . $row['ktp_kelurahan'] . ", Kec. " . $row['ktp_kecamatan'] . ", " . $row['ktp_kabupaten'] . "-" . $row['ktp_propinsi'] . "-" . $row['ktp_kodepos'];
    $subdata[] = $row['user_email'] . "<br>" . $row['user_hp'];
    $subdata[] = '
    <a href="home_admin.php?page=id_card_edit&ktp_nomor=' . $row['ktp_nomor'] . '"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a>

    ';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);