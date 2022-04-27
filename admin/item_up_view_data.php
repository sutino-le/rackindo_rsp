<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());

$request = $_REQUEST;
$col = array(
    0   =>  'no',
    1   =>  'permintaan_id',
    2   =>  'permintaan_nomor',
    3   =>  'barang_nama',
    4   =>  'permintaan_tanggal',
    5   =>  'permintaan_status'
);  //create column like table in database

$sql = "SELECT * FROM tb_permintaan INNER JOIN tb_barang ON tb_permintaan.permintaan_idbarang=tb_barang.barang_id";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM tb_permintaan INNER JOIN tb_barang ON tb_permintaan.permintaan_idbarang=tb_barang.barang_id";
if (!empty($request['search']['value'])) {
    $sql .= " AND (tb_permintaan.permintaan_id Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR tb_permintaan.permintaan_nomor Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR tb_barang.barang_nama Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR tb_permintaan.permintaan_tanggal Like '%" . $request['search']['value'] . "%' ";
    $sql .= " OR tb_permintaan.permintaan_status Like '%" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['permintaan_nomor'];
    $subdata[] = $row['permintaan_tanggal'];
    $subdata[] = $row['barang_nama'];
    $subdata[] = $row['permintaan_jumlah'];
    $subdata[] = $row['permintaan_status'];

    $permintaan_id = $row['permintaan_id'];
    $permintaan_idbarang = $row['permintaan_idbarang'];
    $permintaan_nomor = $row['permintaan_nomor'];
    $permintaan_tanggal = $row['permintaan_tanggal'];

    $masuk = mysql_query("SELECT * FROM tb_masuk WHERE masuk_permintaan_id='$permintaan_id' ");
    $hasil_masuk = mysql_fetch_array($masuk);
    if (empty($hasil_masuk['masuk_jumlah'])) {
        $jumlah_masuk = "";
        $satuan = "";
    } elseif ($hasil_masuk['masuk_jumlah'] < 2) {
        $jumlah_masuk = $hasil_masuk['masuk_jumlah'];
        $satuan = "Pc";
    } else {
        $jumlah_masuk = $hasil_masuk['masuk_jumlah'];
        $satuan = "Pcs";
    }

    $subdata[] = $jumlah_masuk . " " . $satuan;

    $permintaan_status = $row['permintaan_status'];
    if ($permintaan_status == "Progres") {
        $cetak = '<a href="item_up_receipt_request.php?permintaan_id=' . $permintaan_id . '" target="_blank"><button type="button" class="btn btn-success btn-xs" title="Cetak Tanda Terima" ><i class="fas fa-print"></i></button></a>';
        $aprove = '<a href="home_admin.php?page=item_up_aprove&permintaan_id=' . $permintaan_id . '"><button type="button" class="btn btn-primary btn-xs" title="Aprove" ><i class="fas fa-hands-helping"></i></button></a>';
    } else {
        $cetak = '';
        $aprove = '<a href="item_up_receipt_request.php?permintaan_id=' . $permintaan_id . '" target="_blank"><button type="button" class="btn btn-warning btn-xs" title="Bukti Tanda Terima" ><i class="fas fa-search"></i></button></a>';
    }
    $subdata[] = $cetak . '&nbsp;' . $aprove;
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);