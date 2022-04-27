<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");


$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());
?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Data Agreement
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Card Id</th>
                                <th>Full Name</th>
                                <th>Agreement Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $array_bln = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
                            $query = mysql_query("SELECT * FROM biodata_ktp INNER JOIN pkwt ON biodata_ktp.ktp_nomor=pkwt.pkwt_ktp GROUP BY pkwt.pkwt_ktp ORDER BY pkwt.pkwt_status DESC ");
                            while ($data_pkwt = mysql_fetch_array($query)) {
                                $pkwt_id = $data_pkwt['pkwt_id'];
                                $ktp_nomor = $data_pkwt['ktp_nomor'];
                                $ktp_nama = $data_pkwt['ktp_nama'];
                                $pkwt_nomor = $data_pkwt['pkwt_nomor'];
                                $pkwt_tanggal = $data_pkwt['pkwt_tanggal'];
                                $pkwt_status = $data_pkwt['pkwt_status']; {
                                    $nomer++;
                            ?>
                            <tr>
                                <td><?php echo $nomer; ?></td>
                                <td><?php echo $ktp_nomor; ?></td>
                                <td><?php echo $ktp_nama; ?></td>
                                <?php
                                        $bln = $array_bln[date('n', strtotime($pkwt_tanggal))];
                                        ?>
                                <td><?php echo $pkwt_nomor . "/PK-PKWT/HRD/RSP/" . $bln . "/" . date("Y", strtotime($pkwt_tanggal)); ?>
                                </td>
                                <td><?php echo $pkwt_status; ?></td>
                                <td>
                                    <?php
                                            if ($pkwt_status == "Oke") {
                                                echo "";
                                            } else {
                                            ?>
                                    <a href="home_admin.php?page=pkwt_data_process&id=<?php echo $pkwt_id; ?>"><button
                                            type="button" class="btn btn-info btn-xs" title="Proses"><i
                                                class="fa fa-handshake"></i></button></a>
                                    <?php
                                            }
                                            ?>
                                    <a href="pkwt_data_print.php?id=<?php echo $pkwt_id; ?>" target="_blank"><button
                                            type="button" class="btn btn-success btn-xs" title="Cetak"><i
                                                class="fa fa-print"></i></button></a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>