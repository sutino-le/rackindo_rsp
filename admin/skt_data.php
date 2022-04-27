<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'skt_id',
    2   =>  'skt_nomor',
    3   =>  'skt_tanggal',
    4   =>  'skt_ktp',
    5   =>  'skt_jenis',
    6   =>  'skt_status_karyawan',
    7   =>  'ktp_nama'
);  //create column like table in database

$sql = "SELECT * FROM skt JOIN karyawan ON skt.skt_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM skt JOIN karyawan ON skt.skt_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (skt.skt_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR skt.skt_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR skt.skt_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR skt.skt_jenis Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR skt.skt_status_karyawan Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);

//Order
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][8]['dir'] . "  LIMIT " .
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
    $subdata[] = $row['skt_nomor'];
    $subdata[] = date("d-M-Y", strtotime($row['skt_tanggal']));
    $subdata[] = $row['skt_jenis'];
    $subdata[] = '
            <a href="skt_print.php?skt_id=' . $row['skt_id'] . '" target="_blank"><button type="button" class="btn btn-success btn-xs" title="Cetak" ><i class="fa fa-print"></i></button></a>
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