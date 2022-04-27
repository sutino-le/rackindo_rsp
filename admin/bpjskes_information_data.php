<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'bpjskes_ktp',
    2   =>  'bpjskes_nomor',
    3   =>  'bpjskes_masuk',
    4   =>  'bpjskes_keluar',
    5   =>  'bpjskes_status',
    6   =>  'ktp_nomor',
    7   =>  'ktp_nama',
    8   =>  'karyawan_kategori'
);  //create column like table in database

$sql = "SELECT * FROM bpjs_kes JOIN biodata_ktp ON bpjs_kes.bpjskes_ktp=biodata_ktp.ktp_nomor JOIN karyawan ON karyawan.karyawan_ktp=bpjs_kes.bpjskes_ktp ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM bpjs_kes JOIN biodata_ktp ON bpjs_kes.bpjskes_ktp=biodata_ktp.ktp_nomor JOIN karyawan ON karyawan.karyawan_ktp=bpjs_kes.bpjskes_ktp ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (bpjs_kes.bpjskes_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_kes.bpjskes_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_kes.bpjskes_masuk Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_kes.bpjskes_keluar Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_kes.bpjskes_status Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['karyawan_kategori'];
    $subdata[] = $row['bpjskes_nomor'];
    $subdata[] = date("M - Y", strtotime($row['bpjskes_masuk']));
    if ($row['bpjskes_keluar'] == "0000-00-00") {
        $bpjskes_keluar = "";
    } else {
        $bpjskes_keluar = date("M - Y", strtotime($row['bpjskes_keluar']));
    }
    $subdata[] = $bpjskes_keluar;
    $subdata[] = $row['bpjskes_status'];
    $subdata[] = '';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);