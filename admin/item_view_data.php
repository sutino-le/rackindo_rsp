<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'barang_id',
    2   =>  'barang_nama',
    3   =>  'barang_barcode',
    4   =>  'barang_harga',
    5   =>  'barang_satuan',
    6   =>  'barang_detail',
    7   =>  'barang_foto'
);  //create column like table in database

$sql = "SELECT * FROM tb_barang";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM tb_barang WHERE 1=1 ";
if (!empty($request['search']['value'])) {
    $sql .= " AND (barang_id Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR barang_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR barang_barcode Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR barang_harga Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR barang_satuan Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR barang_detail Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR barang_foto Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['barang_nama'];

    $barang_id = $row['barang_id'];

    $barang_masuk = mysql_query("SELECT SUM(masuk_jumlah) AS jumlah_masuk FROM tb_masuk WHERE masuk_idbarang='$barang_id' ");
    $data_masuk = mysql_fetch_array($barang_masuk);
    $masuk = $data_masuk['jumlah_masuk'];

    $barang_keluar = mysql_query("SELECT SUM(keluar_jumlah) AS jumlah_keluar FROM tb_keluar WHERE keluar_idbarang='$barang_id' AND keluar_status='Selesai' ");
    $data_keluar = mysql_fetch_array($barang_keluar);
    $keluar = $data_keluar['jumlah_keluar'];

    $stok = $masuk - $keluar;

    $subdata[] = '<img src="gambar/' . $row['barang_foto'] . '" width="50px" height="50px" title="' . $row['barang_detail'] . '" />';
    $subdata[] = $masuk;
    $subdata[] = $keluar;

    $subdata[] = $stok;
    $subdata[] = '
    <a href="home_admin.php?page=item_edit&id=' . $row['barang_id'] . '"><button type="button" class="btn btn-success btn-xs" title="Edit" ><i class="fas fa-edit"></i></button></a>

    <a href="home_admin.php?page=item_use_input&id=' . $row['barang_id'] . '"><button type="button" class="btn btn-primary btn-xs" title="Pemakaian" ><i class="fas fa-sign-in-alt"></i></button></a>

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