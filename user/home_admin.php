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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HRIS | PT Rackindo Setara Perkasa</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png" class="rounded-circle" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble img-circle" src="assets/img/logo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                        data-toggle="dropdown" aria-expanded="false"> <?php echo $ktp_nama; ?>
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
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home_admin.php" class="brand-link">
                <img src="assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">RSP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../admin/foto/<?php echo $user_ktp; ?>.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $ktp_nama; ?></a>
                    </div>
                </div>



                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <form action="home_admin.php?page=item_view" method="post">
                        <div class="input-group">
                            <input class="form-control form-control-sidebar" type="text" name="barang_nama"
                                placeholder="Cari Barang">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar" type="submit">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-database"></i>
                                <p>
                                    Absensi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="home_admin.php?page=absensi_lihat" class="nav-link">
                                        <i class="fas fa-fingerprint nav-icon"></i>
                                        <p>Lihat Absensi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="home_admin.php?page=absensi_permohonan" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Lihat Permohonan Absen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="home_admin.php?page=memo_view" class="nav-link">
                                        <i class="fas fa-clinic-medical nav-icon"></i>
                                        <p>Permohonan Memo</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-pencil-ruler"></i>
                                <p>
                                    ATK
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="home_admin.php?page=item_view" class="nav-link">
                                        <i class="fas fa-cart-arrow-down nav-icon"></i>
                                        <p>Data ATK</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="home_admin.php?page=item_use_view" class="nav-link">
                                        <i class="fas fa-external-link-alt nav-icon"></i>
                                        <p>Pemakaian ATK</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home_admin.php">Home</a></li>
                                <li class="breadcrumb-item active"><?php echo $page; ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


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
                                case 'absensi_permohonan_input_simpan':
                                    include "absensi_permohonan_input_simpan.php";
                                    break;
                                case 'absensi_permohonan_edit':
                                    include "absensi_permohonan_edit.php";
                                    break;
                                case 'absensi_permohonan_edit_simpan':
                                    include "absensi_permohonan_edit_simpan.php";
                                    break;

                                    //Data profile
                                case 'profile':
                                    include "profile.php";
                                    break;

                                    //Data memo_view
                                case 'memo_view':
                                    include "memo_view.php";
                                    break;
                                case 'memo_input':
                                    include "memo_input.php";
                                    break;

                                case 'user':
                                default:
                                    include 'aboutuser.php';
                            }
                            ?>


                            <br><br><br><br>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer fixed-bottom">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2021 <a href="https://localhost/rackindo/index.php">Rackindo HRIS</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/jszip/jszip.min.js"></script>
    <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>