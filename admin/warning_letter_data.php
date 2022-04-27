<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'wl_id',
    2   =>  'wl_nomor',
    3   =>  'wl_tanggal',
    4   =>  'wl_ktp',
    5   =>  'wl_ke',
    6   =>  'wl_durasi',
    7   =>  'wl_awal',
    8   =>  'wl_akhir',
    9   =>  'wl_keterangan',
    10   =>  'ktp_nomor'
);  //create column like table in database

$sql = "SELECT * FROM warning_letter JOIN karyawan ON warning_letter.wl_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM warning_letter JOIN karyawan ON warning_letter.wl_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (wl.wl_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR wl.wl_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR wl.wl_ktp Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR wl.wl_ke Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR wl.wl_durasi Like '%" . $request['search']['value'] . "%' ";
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
    $subdata[] = $row['karyawan_npk'];
    $subdata[] = $row['ktp_nama'];
    $subdata[] = $row['wl_nomor'];
    $subdata[] = $row['wl_tanggal'];
    $subdata[] = $row['wl_ke'];
    $subdata[] = $row['wl_durasi'];
    $subdata[] = $row['wl_awal'];
    $subdata[] = $row['wl_akhir'];
    $subdata[] = '
            <a href="warning_letter_print.php?wl_id=' . $row['wl_id'] . '" target="_blank"><button type="button" class="btn btn-success btn-xs" title="Cetak" ><i class="fa fa-print"></i></button></a>
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