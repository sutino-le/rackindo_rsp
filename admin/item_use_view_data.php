
<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");

$con=mysqli_connect('localhost','root','','rackindo')
    or die("connection failed".mysqli_errno());

$request=$_REQUEST;
$col =array(
    0   =>  'no',
    1   =>  'keluar_id',
    2   =>  'barang_nama',
    3   =>  'keluar_tanggal',
    4   =>  'keluar_status',
    5   =>  'keluar_user',
    6   =>  'keluar_deskripsi'
);  //create column like table in database

$sql ="SELECT * FROM tb_keluar INNER JOIN tb_barang ON tb_keluar.keluar_idbarang=tb_barang.barang_id";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM tb_keluar INNER JOIN tb_barang ON tb_keluar.keluar_idbarang=tb_barang.barang_id";
if(!empty($request['search']['value'])){
    $sql.=" AND (tb_keluar.keluar_id Like '%".$request['search']['value']."%' ";
    $sql.=" OR tb_barang.barang_nama Like '%".$request['search']['value']."%' ";
    $sql.=" OR tb_keluar.keluar_tanggal Like '%".$request['search']['value']."%' ";
    $sql.=" OR tb_keluar.keluar_deskripsi Like '%".$request['search']['value']."%' ";
    $sql.=" OR tb_keluar.keluar_status Like '%".$request['search']['value']."%' ";
    $sql.=" OR tb_keluar.keluar_user Like '%".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][1]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);

$data=array();
$no = $_POST['start'];
while($row=mysqli_fetch_array($query)){
    $no++;
    $subdata=array();
    $subdata[]=$no;
    $subdata[]=$row['barang_nama'];
    $subdata[]=date('d-m-Y', strtotime($row['keluar_tanggal']));
    $subdata[]=$row['keluar_jumlah'];
    $subdata[]=$row['keluar_user'];
    $subdata[]=$row['keluar_deskripsi'];
    $subdata[]=$row['keluar_status'];
   
        $keluar_id=$row['keluar_id'];
        $keluar_status=$row['keluar_status'];
        if ($keluar_status=="Progres") {
            $aprove='<a href="home_admin.php?page=item_use_aprove&keluar_id='.$keluar_id.'"><button type="button" class="btn btn-primary btn-xs" title="Aprove" ><i class="far fa-handshake"></i></button></a>';
        } else {
            $aprove='';
        }
    $subdata[]=$aprove;
    $data[]=$subdata;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>