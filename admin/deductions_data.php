<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'upah_pot_id',
    2   =>  'upah_pot_ktp',
    3   =>  'ktp_nama',
    4   =>  'upah_pot_tanggal',
    5   =>  'upah_pot_jam'
);  //create column like table in database

$sql = "SELECT * FROM upah_potongan_jam JOIN karyawan ON upah_potongan_jam.upah_pot_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id  JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM upah_potongan_jam JOIN karyawan ON upah_potongan_jam.upah_pot_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id  JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (upah_potongan_jam.upah_pot_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR upah_potongan_jam.upah_pot_tanggal Like '%" . $request['search']['value'] . "%'  )";
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
    $subdata[] = $row['upah_pot_tanggal'];
    $subdata[] = $row['upah_pot_jumlah'];
    $subdata[] = '
    
    <a href="home_admin.php?page=deductions_hapus&upah_pot_id=' . $row['upah_pot_id'] . '"><button type="button" class="btn btn-danger btn-sm" title="Delete" ><i class="fas fa-trash-alt"></i></button></a>

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