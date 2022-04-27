<?php
session_start();
$user_ktp = $_SESSION['user_ktp'];
$ktp_nama = $_SESSION['ktp_nama'];
//cek apakah user sudah login
if (!isset($_SESSION['user_ktp'])) {
    die("Anda belum login   <a href='index.php'>Kembali</a>"); //jika belum login jangan lanjut
}
//cek level user
if (empty($_SESSION['user_ktp'])) {
    die("Anda bukan user"); //jika bukan admin jangan lanjut
}

include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");


$data_user = mysql_query("SELECT * FROM user WHERE user_ktp='$user_ktp' ");
$lihat_user = mysql_fetch_array($data_user);


$page = (isset($_GET['page'])) ? $_GET['page'] : "user";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HRIS | PT Rackindo Setara Perkasa</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png" />
    <style>
    .disabled-link {
        pointer-events: none;
    }
    </style>


    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->

    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">


</head>

<body>

    </head>

    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark fixed-top">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">
                <font color="green">Selamat datang</font>
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Search-->

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Absensi</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a href="home_admin.php?page=absensi_lihat" class="dropdown-item">Absensi Lihat</a></li>
                        <li><a href="#" class="dropdown-item">Koreksi Absen</a>
                        </li>
                        <li><a href="home_admin.php?page=absensi_permohonan" class="dropdown-item">Permohonan Izin</a>
                        </li>
                        <li><a href="home_admin.php?page=memo_view" class="dropdown-item">Permohonan Memo</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
                action="home_admin.php?page=item_view" method="POST">
                <div class="input-group">
                    <input name="barang_nama" class="form-control" type="text" placeholder="Cari Barang Pemakaian"
                        aria-label="Cari Barang Pemakaian" aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->

            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading mt-5">Menu</div>
                            <a class="nav-link" href="home_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Profil
                            </a>
                            <a href="organizational_structure_view.php" target="_blank" class="nav-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-sitemap"></i></div>
                                Organizational Structure
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-pencil-ruler"></i></div>
                                ATK
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="home_admin.php?page=item_view">
                                        <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                                        Data Barang ATK
                                    </a>
                                    <a class="nav-link" href="home_admin.php?page=item_use_view">
                                        <div class="sb-nav-link-icon"><i class="fas fa-external-link-alt"></i></div>
                                        Pemakaian Barang ATK
                                    </a>
                                </nav>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content" class="container-fluit mt-4">
                <div class="container-fluid mt-4">
                    <div class="card mt-4">
                        <div class="card-body">
                            <?php
                            $page = (isset($_GET['page'])) ? $_GET['page'] : "user";
                            switch ($page) {

                                    //Data Biodata
                                case 'id_card_edit':
                                    include "id_card_edit.php";
                                    break;
                                case 'id_card_edit_process':
                                    include "id_card_edit_process.php";
                                    break;

                                    //Data Domisili
                                case 'residence_address_edit':
                                    include "residence_address_edit.php";
                                    break;
                                case 'residence_address_edit_process':
                                    include "residence_address_edit_process.php";
                                    break;

                                    //Data Pendidikan
                                case 'education_edit':
                                    include "education_edit.php";
                                    break;
                                case 'education_edit_process':
                                    include "education_edit_process.php";
                                    break;
                                case 'education_edit_rubah':
                                    include "education_edit_rubah.php";
                                    break;
                                case 'education_edit_rubah_process':
                                    include "education_edit_rubah_process.php";
                                    break;
                                case 'education_edit_delete':
                                    include "education_edit_delete.php";
                                    break;

                                    //Data Keluarga
                                case 'family_edit':
                                    include "family_edit.php";
                                    break;
                                case 'family_edit_process':
                                    include "family_edit_process.php";
                                    break;
                                case 'family_edit_rubah':
                                    include "family_edit_rubah.php";
                                    break;
                                case 'family_edit_rubah_process':
                                    include "family_edit_rubah_process.php";
                                    break;
                                case 'family_edit_delete':
                                    include "family_edit_delete.php";
                                    break;

                                    //Data darurat
                                case 'emergency_edit':
                                    include "emergency_edit.php";
                                    break;
                                case 'emergency_edit_process':
                                    include "emergency_edit_process.php";
                                    break;
                                case 'emergency_edit_delete':
                                    include "emergency_edit_delete.php";
                                    break;

                                    //Data pengalaman kerja
                                case 'experience_edit':
                                    include "experience_edit.php";
                                    break;
                                case 'experience_edit_process':
                                    include "experience_edit_process.php";
                                    break;
                                case 'experience_edit_rubah':
                                    include "experience_edit_rubah.php";
                                    break;
                                case 'experience_edit_rubah_process':
                                    include "experience_edit_rubah_process.php";
                                    break;
                                case 'experience_edit_delete':
                                    include "experience_edit_delete.php";
                                    break;

                                    //Data npwp
                                case 'npwp_edit':
                                    include "npwp_edit.php";
                                    break;
                                case 'npwp_edit_process':
                                    include "npwp_edit_process.php";
                                    break;

                                    //Data user
                                case 'user_edit':
                                    include "user_edit.php";
                                    break;
                                case 'user_edit_process':
                                    include "user_edit_process.php";
                                    break;

                                    //Data barang
                                case 'item_view':
                                    include "item_view.php";
                                    break;
                                case 'item_use_input':
                                    include "item_use_input.php";
                                    break;
                                case 'item_use_input_process':
                                    include "item_use_input_process.php";
                                    break;
                                case 'item_use_view':
                                    include "item_use_view.php";
                                    break;

                                    //Data absensi
                                case 'absensi_lihat':
                                    include "absensi_lihat.php";
                                    break;
                                case 'absensi_permohonan':
                                    include "absensi_permohonan.php";
                                    break;
                                case 'absensi_permohonan_input':
                                    include "absensi_permohonan_input.php";
                                    break;
                                case 'absensi_permohonan_edit':
                                    include "absensi_permohonan_edit.php";
                                    break;

                                case 'user':
                                default:
                                    include 'aboutuser.php';
                            }
                            ?>
                        </div>
                    </div>

                </div>


                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->


            </div>
        </div>



        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- FastClick -->
        <script src="vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="vendors/nprogress/nprogress.js"></script>
        <!-- iCheck -->
        <script src="vendors/iCheck/icheck.min.js"></script>
        <!-- Datatables -->
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="build/js/custom.min.js"></script>

    </body>

</html>

<script language="javascript">
function hanyaAngka(e, decimal) {
    var key;
    var keychar;
    if (window.event) {
        key = window.event.keyCode;
    } else if (e) {
        key = e.which;
    } else return true;

    keychar = String.fromCharCode(key);
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
}

function golongan(e, decimal) {
    var key;
    var keychar;
    if (window.event) {
        key = window.event.keyCode;
    } else if (e) {
        key = e.which;
    } else return true;

    keychar = String.fromCharCode(key);
    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
        return true;
    } else
    if ((("aboABO+-").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
}

function huruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 32)
        return false;
    return true;
}
</script>