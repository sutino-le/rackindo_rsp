<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'lembur_id',
    2   =>  'lembur_ktp',
    3   =>  'ktp_nama',
    4   =>  'lembur_nomor',
    5   =>  'lembur_jenis',
    6   =>  'lembur_tanggal',
    7   =>  'lembur_jam'
);  //create column like table in database

$sql = "SELECT * FROM upah_lembur JOIN karyawan ON upah_lembur.lembur_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id  JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM upah_lembur JOIN karyawan ON upah_lembur.lembur_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id  JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (upah_lembur.lembur_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR upah_lembur.lembur_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR upah_lembur.lembur_jenis Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR upah_lembur.lembur_tanggal Like '%" . $request['search']['value'] . "%'  )";
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
    $subdata[] = $row['karyawan_finger'];
    $subdata[] = $row['ktp_nama'];
    $subdata[] = $row['jabatan_nama'] . "-" . $row['bagian_nama'];
    $subdata[] = $row['lembur_tanggal'];
    $subdata[] = $row['lembur_jenis'];
    $subdata[] = $row['lembur_jam'];
    $subdata[] = '
    
    <a href="home_admin.php?page=overtime_hapus&lembur_id=' . $row['lembur_id'] . '"><button type="button" class="btn btn-danger btn-sm" title="Delete" ><i class="fas fa-trash-alt"></i></button></a>

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
