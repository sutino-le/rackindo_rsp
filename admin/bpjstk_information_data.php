<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'bpjstk_ktp',
    2   =>  'bpjstk_nomor',
    3   =>  'bpjstk_masuk',
    4   =>  'bpjstk_keluar',
    5   =>  'bpjstk_status',
    6   =>  'ktp_nomor',
    7   =>  'ktp_nama',
    8   =>  'karyawan_kategori'
);  //create column like table in database

$sql = "SELECT * FROM bpjs_tk JOIN biodata_ktp ON bpjs_tk.bpjstk_ktp=biodata_ktp.ktp_nomor JOIN karyawan ON karyawan.karyawan_ktp=bpjs_tk.bpjstk_ktp ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM bpjs_tk JOIN biodata_ktp ON bpjs_tk.bpjstk_ktp=biodata_ktp.ktp_nomor JOIN karyawan ON karyawan.karyawan_ktp=bpjs_tk.bpjstk_ktp ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (bpjs_tk.bpjstk_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_tk.bpjstk_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_tk.bpjstk_masuk Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_tk.bpjstk_keluar Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bpjs_tk.bpjstk_status Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['ktp_nomor'];
    $subdata[] = $row['ktp_nama'];
    $subdata[] = $row['karyawan_kategori'];
    $subdata[] = $row['bpjstk_nomor'];
    $subdata[] = date("M - Y", strtotime($row['bpjstk_masuk']));
    if ($row['bpjstk_keluar'] == "0000-00-00") {
        $bpjstk_keluar = "";
    } else {
        $bpjstk_keluar = date("M - Y", strtotime($row['bpjstk_keluar']));
    }
    $subdata[] = $bpjstk_keluar;
    $subdata[] = $row['bpjstk_status'];
    $subdata[] = '';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);