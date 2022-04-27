<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");
$year = date("Y");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'ln_id',
    2   =>  'ln_tanggal',
    3   =>  'ln_keterangan'
);  //create column like table in database

$sql = "SELECT * FROM libur_nasional WHERE ln_tanggal LIKE '%$year%' ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM libur_nasional  WHERE ln_tanggal LIKE '%$year%' ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (ln_id Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ln_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR ln_keterangan Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['ln_tanggal'];
    $subdata[] = $row['ln_keterangan'];
    $subdata[] = '
    <a href="home_admin.php?page=libur_nasional_edit&id=' . $row['ln_id'] . '"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a>

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