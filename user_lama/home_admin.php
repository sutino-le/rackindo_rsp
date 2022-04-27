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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HRIS | PT Rackindo Setara Perkasa</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png" class="rounded-circle" />

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="template/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="template/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->

    <link href="template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="template/build/css/custom.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="nav-md footer_fixed">
    <div class="container body">
        <div class="main_container">

            <!-- side bar -->
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="home_admin.php" class="site_title"><i class="fa fa-connectdevelop"></i> <span>PT.
                                Rackindo</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">

                                <li><a><i class="fa fa-500px"></i> Absensi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="home_admin.php?page=absensi_lihat" class="dropdown-item">Absensi
                                                Lihat</a>
                                        </li>
                                        <li><a href="home_admin.php?page=absensi_permohonan" class="dropdown-item">Permohonan Izin</a></li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-columns"></i> ATK <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="home_admin.php?page=item_view" class="dropdown-item">Data Barang
                                                ATK</a>
                                        </li>
                                        <li><a href="home_admin.php?page=item_use_view" class="dropdown-item">Pemakaian
                                                Barang ATK</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>


                    <nav class="nav navbar-nav">

                        <ul class="navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../admin/foto/<?php echo $user_ktp; ?>.jpg" alt=""><?php echo $ktp_nama; ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="home_admin.php?page=profile"> Profile</a>
                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out pull-right"></i>
                                        Log Out</a>
                                </div>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="">


                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">

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

                                    //Data profile
                                case 'profile':
                                    include "profile.php";
                                    break;

                                case 'user':
                                default:
                                    include 'aboutuser.php';
                            }
                            ?>

                        </div>
                    </div>

                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <strong>Copyright &copy; 2021 <a href="https://localhost/rackindo/index.php">Rackindo
                            HRIS</a>.</strong>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="template/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="template/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="template/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="template/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="template/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="template/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="template/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="template/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="template/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="template/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="template/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="template/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="template/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="template/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="template/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="template/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="template/vendors/jszip/dist/jszip.min.js"></script>
    <script src="template/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="template/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="template/build/js/custom.min.js"></script>

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