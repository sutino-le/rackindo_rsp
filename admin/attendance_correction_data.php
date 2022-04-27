<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'absen_koreksi_id',
    2   =>  'absen_koreksi_pin',
    3   =>  'ktp_nomor',
    4   =>  'ktp_nama',
    5   =>  'absen_koreksi_tanggal',
    6   =>  'absen_koreksi_jenis',
    7   =>  'absen_koreksi_waktu'
);  //create column like table in database

$sql = "SELECT * FROM absen_koreksi JOIN karyawan ON absen_koreksi.absen_koreksi_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM absen_koreksi JOIN karyawan ON absen_koreksi.absen_koreksi_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (absen_koreksi.absen_koreksi_pin Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR absen_koreksi.absen_koreksi_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR absen_koreksi.absen_koreksi_jenis Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR absen_koreksi.absen_koreksi_waktu Like '%" . $request['search']['value'] . "%'  )";
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
    $subdata[] = $row['bagian_nama'];
    $subdata[] = $row['absen_koreksi_tanggal'];
    $subdata[] = $row['absen_koreksi_jenis'];
    $subdata[] = $row['absen_koreksi_waktu'];
    $subdata[] = $row['absen_koreksi_keterangan'];
    $subdata[] = '
    
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