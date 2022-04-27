<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'pkwt_id',
    2   =>  'terminate_nomor',
    3   =>  'terminate_tanggal',
    4   =>  'terminate_npk',
    5   =>  'terminate_jenis',
    6   =>  'terminate_keterangan',
    7   =>  'ktp_nama'
);  //create column like table in database

$sql = "SELECT * FROM pkwt JOIN terminate ON pkwt.pkwt_npk=terminate.terminate_npk JOIN karyawan ON pkwt.pkwt_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE pkwt.pkwt_kategori='Terminate' AND pkwt.pkwt_jenis='Permanent' OR  pkwt.pkwt_jenis='Contract' ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM pkwt JOIN terminate ON pkwt.pkwt_npk=terminate.terminate_npk JOIN karyawan ON pkwt.pkwt_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE pkwt.pkwt_kategori='Terminate' AND pkwt.pkwt_jenis='Permanent' OR  pkwt.pkwt_jenis='Contract'";
if (!empty($request['search']['value'])) {
    $sql .= " AND (terminate.terminate_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR terminate.terminate_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR terminate.terminate_npk Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR terminate.terminate_jenis Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR terminate.terminate_keterangan Like '%" . $request['search']['value'] . "%' ";
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
    $subdata[] = $row['terminate_npk'];
    $subdata[] = $row['ktp_nama'];
    $subdata[] = $row['terminate_nomor'];
    $subdata[] = date("d-M-Y", strtotime($row['terminate_tanggal']));
    $subdata[] = $row['terminate_jenis'];
    $subdata[] = '
    <a href="career_history_paklaring.php?karyawan_npk=' . $row['terminate_npk'] . '"
                                            target="_blank"><button type="button" class="btn btn-primary btn-sm"
                                                title="print" target="_blank"><i class="fa fa-print"></i></button></a>
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