<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'memo_id',
    2   =>  'memo_ktp',
    3   =>  'ktp_nama',
    4   =>  'memo_no',
    5   =>  'memo_tanggal'
);  //create column like table in database

$sql = "SELECT * FROM memo JOIN karyawan ON memo.memo_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM memo JOIN karyawan ON memo.memo_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor";
if (!empty($request['search']['value'])) {
    $sql .= " AND (memo.memo_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR memo.memo_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR memo.memo_no Like '%" . $request['search']['value'] . "%'  )";
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
    $subdata[] = $row['karyawan_npk'];
    $subdata[] = $row['ktp_nama'];
    $subdata[] = $row['memo_no'];
    $subdata[] = $row['memo_tanggal'];
    $subdata[] = '
    <a href="memo_print.php?memo_id=' . $row['memo_id'] . '" target="_blank"><button type="button" class="btn btn-primary btn-sm" title="print" ><i class="fa fa-print"></i></button></a>

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