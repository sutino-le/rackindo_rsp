<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'upah_tahun',
    2   =>  'upah_jumlah',
    3   =>  'upah_wilayah'
);  //create column like table in database

$sql = "SELECT * FROM upah ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM upah ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (upah_tahun Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR upah_jumlah Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR upah_wilayah Like '%" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);

//Order
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][10]['dir'] . "  LIMIT " .
    $request['start'] . "  ," . $request['length'] . "  ";

$query = mysqli_query($con, $sql);

$data = array();
$no = $_POST['start'];
while ($row = mysqli_fetch_array($query)) {
    $no++;
    $subdata = array();
    $subdata[] = $no;
    $subdata[] = $row['upah_tahun'];
    $subdata[] = number_format($row['upah_jumlah'], 0, ",", ".");
    $subdata[] = $row['upah_wilayah'];
    $subdata[] = '
    <a href="home_admin.php?page=ump_edit&upah_tahun=' . $row['upah_tahun'] . '"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a>
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