<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'karyawan_npk',
    2   =>  'ktp_nama',
    3   =>  'bagian_nama',
    4   =>  'jabatan_nama',
    5   =>  'karyawan_join',
    6   =>  'karyawan_schedule',
    7   =>  'karyawan_schedule_start'
);  //create column like table in database

$sql = "SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (karyawan.karyawan_npk Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bagian.bagian_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR jabatan.jabatan_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR karyawan.karyawan_join Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['jabatan_nama'];
    $subdata[] = $row['karyawan_join'];

    //Menampilkan schedule
    $karyawan_schedule=$row['karyawan_schedule'];
    $group_schedule=mysql_query("SELECT * FROM group_schedule WHERE gs_code='$karyawan_schedule' ");
    $v_group_schedule=mysql_fetch_array($group_schedule);
    
    $subdata[] = $v_group_schedule['gs_nama'];
    $subdata[] = $row['karyawan_schedule_start'];
   
    
    $subdata[] = '
    <a href="home_admin.php?page=employee_schedule_setting_input&id=' . $row['karyawan_npk'] . '"><button type="button" class="btn btn-primary btn-sm" title="Setting Schedule" ><i class="fa fa-plus"></i></button></a>
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