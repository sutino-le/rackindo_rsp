<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'bagian_id',
    2   =>  'bagian_nama',
    3   =>  'bagian_parent'
);  //create column like table in database

$sql = "SELECT * FROM bagian";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM bagian  WHERE 1=1 ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (bagian_id Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bagian_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bagian_parent Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['bagian_nama'];

    $parent=$row['bagian_parent'];
    $c_parent=mysql_query("SELECT * FROM bagian WHERE bagian_id='$parent' ");
    $v_parent=mysql_fetch_array($c_parent);
    $subdata[] = $v_parent['bagian_nama'];
    $subdata[] = '
    <a href="home_admin.php?page=job_title_edit&id=' . $row['bagian_id'] . '"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a>

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