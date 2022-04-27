<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'ktp_nomor',
    2   =>  'ktp_nama'
);  //create column like table in database

$sql = "SELECT * FROM biodata_ktp";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM biodata_ktp  WHERE 1=1 ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (ktp_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ktp_nama Like '%" . $request['search']['value'] . "%'  )";
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
    $subdata[] = $row['ktp_nomor'];
    $subdata[] = $row['ktp_nama'];

    //tampil vaksin
    $ktp_nomor = $row['ktp_nomor'];
    $query_v1 = mysqli_query($con, "SELECT * FROM vaksin  WHERE vaksin_ktp='$ktp_nomor' AND vaksin_ke='1' ");
    $tampil_v1 = mysqli_fetch_array($query_v1);

    $query_v2 = mysqli_query($con, "SELECT * FROM vaksin  WHERE vaksin_ktp='$ktp_nomor' AND vaksin_ke='2' ");
    $tampil_v2 = mysqli_fetch_array($query_v2);

    $query_v3 = mysqli_query($con, "SELECT * FROM vaksin  WHERE vaksin_ktp='$ktp_nomor' AND vaksin_ke='3' ");
    $tampil_v3 = mysqli_fetch_array($query_v3);

    //tampil bagian
    $query_bagian = mysqli_query($con, "SELECT * FROM karyawan JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id  WHERE karyawan.karyawan_ktp='$ktp_nomor' ");
    $tampil_bagian = mysqli_fetch_array($query_bagian);

    $subdata[] = $tampil_bagian['bagian_nama'];
    $subdata[] = $tampil_v1['vaksin_jenis'] . "<br>" . $tampil_v1['vaksin_tanggal'];
    $subdata[] = $tampil_v2['vaksin_jenis'] . "<br>" . $tampil_v2['vaksin_tanggal'];
    $subdata[] = $tampil_v3['vaksin_jenis'] . "<br>" . $tampil_v3['vaksin_tanggal'];
    $subdata[] = '
    <a href="home_admin.php?page=vaccine_input&id=' . $row['ktp_nomor'] . '"><button type="button" class="btn btn-primary btn-sm" title="Input" ><i class="fa fa-plus"></i></button></a>

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