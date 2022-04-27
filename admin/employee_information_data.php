<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'karyawan_npk',
    2   =>  'ktp_nomor',
    3   =>  'ktp_nama',
    4   =>  'bagian_id',
    5   =>  'jabatan_id',
    6   =>  'karyawan_join',
    7   =>  'user_foto',
    8   =>  'karyawan_status',
    9   =>  'karyawan_jenis'
);  //create column like table in database

$sql = "SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN user ON biodata_ktp.ktp_nomor=user.user_ktp   ";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN user ON biodata_ktp.ktp_nomor=user.user_ktp   ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (karyawan.karyawan_npk Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR biodata_ktp.ktp_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR bagian.bagian_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR jabatan.jabatan_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR karyawan.karyawan_status Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR karyawan.karyawan_jenis Like '%" . $request['search']['value'] . "%' ";
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
    if ($row['karyawan_status'] == "Keluar") {
        $color = 'red';
    } else {
        $color = '';
    }
    $subdata[] = '<font color="' . $color . '">' . $no . '</font>';
    $subdata[] = '<img src="foto/' . $row['user_foto'] . '" class="img-circle" width="50px" height="50px" />';
    $subdata[] = '<font color="' . $color . '">' .  $row['karyawan_npk'] . '<br>' . $row['ktp_nama'] . '</font>';
    $subdata[] = '<font color="' . $color . '">' . $row['karyawan_kategori'] . '</font>';
    $subdata[] = '<font color="' . $color . '">' . $row['karyawan_status'] . '<br>' . $row['karyawan_jenis'] . '</font>';
    $subdata[] = '<font color="' . $color . '">' . $row['jabatan_nama'] . '<br>' . $row['bagian_nama'] . '</font>';
    $subdata[] = '<font color="' . $color . '">' . $row['karyawan_join'] . '</font>';
    $subdata[] = '<font color="' . $color . '">' . $row['karyawan_terminate'] . '</font>';

    if ($row['karyawan_status'] == "Aktif") {
        $id_card = '<a href="card_id.php?karyawan_npk=' . $row['karyawan_npk'] . '" target="_blank" ><button type="button" class="btn btn-info btn-sm" title="ID Card" ><i class="fa fa-id-card"></i></button></a>';

        $memo = '<a href="memo_input.php?karyawan_ktp=' . $row['karyawan_ktp'] . '" target="_blank" ><button type="button" class="btn btn-danger btn-sm" title="Cerate Memo" ><i class="fa fa-stethoscope"></i></button></a>';

        $warning_leter = '<a href="home_admin.php?page=warning_letter_input&karyawan_ktp=' . $row['karyawan_ktp'] . '" ><button type="button" class="btn btn-warning btn-sm" title="Cerate Warning Letter" ><i class="fa fa-exclamation-triangle"></i></button></a>';

        $skt = '<a href="home_admin.php?page=skt_input&karyawan_npk=' . $row['karyawan_npk'] . '" ><button type="button" class="btn btn-primary btn-sm" title="Cerate Letter of Statement" ><i class="fa fa-plus"></i></button></a>';
    }

    $subdata[] = '
    <a href="home_admin.php?page=employee_details&id=' . $row['karyawan_ktp'] . '"><button type="button" class="btn btn-success btn-sm" title="Detail" ><i class="fa fa-search"></i></button></a>
    ' . $id_card . ' ' . $memo . ' ' . $warning_leter . ' ' . $skt;
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);