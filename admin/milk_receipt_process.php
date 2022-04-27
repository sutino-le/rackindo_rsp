<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Tanda Terima Gaji.xls");

include "koneksi.php";

$karyawan_kategori = $_POST['karyawan_kategori'];
$periode_akhir = date("Y-m-25");
$tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
$periode_awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));

$karyawan = mysql_query("SELECT * FROM karyawan JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_kategori='$karyawan_kategori' GROUP BY karyawan.karyawan_bagian ORDER BY bagian.bagian_nama ASC ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="asset/dist/img/logo.png" />
    <title>Rackindo</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">

    <link type="text/css" rel="stylesheet" href="JS/simplePagination.css" />
    <link rel="stylesheet" type="text/css" href="tabel/jquery.dataTables.min.css">
    <link rel="stylesheet" href="alert/css/sweetalert.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="tabel/jquery-1.12.0.min.js"></script>
    <script src="tabel/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="JS/jquery.simplePagination.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script src="alert/js/sweetalert.min.js"></script>
    <script src="alert/js/qunit-1.18.0.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
    b {
        font-weight: bold;
    }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <br>
    <center>
        DATA PEMBAGIAN SUSU KARYAWAN<br>
        PERIODE : <?php echo date("F Y", strtotime($periode_akhir)); ?>
        <br>
        <br>
    </center>
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row col-12">

                    <?php
                    $total_pembagian = 0;
                    while ($v_karyawan = mysql_fetch_array($karyawan)) {
                        $bagian_id = $v_karyawan['karyawan_bagian'];
                        $bagian_nama = $v_karyawan['bagian_nama']; {
                    ?>
                    <!-- Karyawan aktif -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-honeydew">

                            <table width="100%" border="1">
                                <tr>
                                    <td colspan="5" bgcolor="#3bc190" align="center"><b><?php echo $bagian_nama; ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#3bc190">No</td>
                                    <td align="center" bgcolor="#3bc190">Nama</td>
                                    <td align="center" bgcolor="#3bc190">Tgl Masuk</td>
                                    <td align="center" bgcolor="#3bc190">Pcs</td>
                                    <td align="center" bgcolor="#3bc190">Paraf</td>
                                </tr>
                                <?php
                                        $dakar = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan.karyawan_bagian='$bagian_id' AND karyawan.karyawan_status='Aktif' OR karyawan.karyawan_bagian='$bagian_id' AND karyawan.karyawan_status='Keluar' AND karyawan.karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir' ORDER BY karyawan.karyawan_jabatan, karyawan.karyawan_finger ASC ");
                                        $no = 1;
                                        $total_susu = 0;
                                        while ($v_dakar = mysql_fetch_array($dakar)) {

                                            $karyawan_jenis = $v_dakar['karyawan_jenis'];

                                            if ($v_dakar['jabatan_nama'] == "Koordinator") {
                                                $color = "#ffb3b3";
                                            } else if ($v_dakar['jabatan_nama'] == "Wakil Koordinator") {
                                                $color = "#b3ffcc";
                                            } else if ($v_dakar['jabatan_nama'] == "Operator") {
                                                $color = "#ffffff";
                                            } else if ($v_dakar['jabatan_nama'] == "Suport") {
                                                $color = "#ffffff";
                                            }

                                            //Warna untuk jenis karyawan
                                            if ($karyawan_jenis == "Permanent") {
                                                $b1 = "<b>";
                                                $b2 = "</b>";
                                            } else {
                                                $b1 = "";
                                                $b2 = "";
                                            }

                                            if ($v_dakar['karyawan_status'] == "Keluar") {
                                                $color_keluar = "red";
                                            } else {
                                                $color_keluar = "";
                                            }

                                        ?>
                                <tr bgcolor="<?php echo $color_keluar; ?>">
                                    <td align="center" bgcolor="<?php echo $color; ?>">
                                        <?php echo $b1 . "" . $no . "" . $b2; ?>
                                    </td>
                                    <td>
                                        <?php echo $b1 . "" . $v_dakar['ktp_nama'] . "" . $b2; ?>
                                    </td>
                                    <?php
                                                $ktp = $v_dakar['karyawan_ktp'];
                                                $pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_ktp='$ktp' ORDER BY pkwt_awal ASC ");
                                                $v_pkwt = mysql_fetch_array($pkwt);
                                                $tanggal_awal = date("Y-m-d", strtotime($v_pkwt['pkwt_awal']));
                                                $tanggal_sekarang = date("Y-m-d");

                                                $date1 = new DateTime($tanggal_awal);
                                                $date2 = new DateTime($tanggal_sekarang);
                                                $diff = $date1->diff($date2);
                                                $lama_bekerja = $diff->y;
                                                if ($v_dakar['jabatan_nama'] == "Koordinator") {
                                                    $jumlah_susu = "4";
                                                    $ttd = "";
                                                    $color_ttd = "";
                                                } else if ($lama_bekerja >= "1") {
                                                    $jumlah_susu = "2";
                                                    $ttd = "";
                                                    $color_ttd = "";
                                                } else {
                                                    $jumlah_susu = "";
                                                    $ttd = "Belum Dapat";
                                                    $color_ttd = "gray";
                                                }

                                                ?>
                                    <td align="center"><?php echo date("d-M-y", strtotime($tanggal_awal)); ?></td>
                                    <td align="center"><?php echo $jumlah_susu; ?></td>
                                    <td bgcolor="<?php echo $color_ttd; ?>"><?php echo $ttd; ?></td>
                                </tr>
                                <?php
                                            $total_susu += $jumlah_susu;
                                            $no++;
                                        }
                                        ?>

                                <tr>
                                    <td colspan="3" align="center" bgcolor="#3bc190"><?php echo $bagian_nama; ?></td>
                                    <td align="center" bgcolor="#3bc190"><?php echo $total_susu; ?></td>
                                    <td bgcolor="#3bc190">&nbsp;</td>
                                </tr>
                            </table>
                            <br>
                        </div>
                    </div>
                    <?php
                            $total_pembagian += $total_susu;
                        }
                    }

                    ?>
                </div>

            </div><!-- /.container-fluid -->
        </section>

    </div>



    <br>
    <center>
        TOTAL PEMBAGIAN SUSU : <?php echo $total_pembagian; ?>
    </center>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="asset/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="asset/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="asset/dist/js/demo.js"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>



</body>

</html>