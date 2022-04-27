<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'absen_izin_id',
    2   =>  'absen_izin_pin',
    3   =>  'ktp_nama',
    4   =>  'absen_izin_tanggal',
    5   =>  'absen_izin_jenis',
    6   =>  'absen_izin_keterangan'
);  //create column like table in database

$sql = "SELECT * FROM absen_izin JOIN karyawan ON absen_izin.absen_izin_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM absen_izin JOIN karyawan ON absen_izin.absen_izin_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (absen_izin.absen_izin_pin Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR absen_izin.absen_izin_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR absen_izin.absen_izin_jenis Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR absen_izin.absen_izin_keterangan Like '%" . $request['search']['value'] . "%'  )";
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
    $subdata[] = $row['absen_izin_tanggal'];
    $subdata[] = $row['absen_izin_jenis'];
    $subdata[] = $row['absen_izin_keterangan'];
    if ($row['absen_izin_jenis'] == "Vaks") {
        $edit = '';
    } else {
        $edit = '<a href="home_admin.php?page=attendance_request_edit&absen_izin_id=' . sha1($row['absen_izin_id'])  . '"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a>';
    }
    $subdata[] = $edit . '
    
    <a href="attendance_request_print.php?absen_izin_id=' . $row['absen_izin_id'] . '" target="_blank"><button type="button" class="btn btn-primary btn-sm" title="print" ><i class="fa fa-print"></i></button></a>

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