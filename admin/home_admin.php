<?php
session_start();
$nama_user = $_SESSION['nama'];
//cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    die("Anda belum login   <a href='index.php'>Kembali</a>"); //jika belum login jangan lanjut
}
//cek level user
if ($_SESSION['level'] != "Admin") {
    die("Anda bukan user Admin"); //jika bukan admin jangan lanjut
}

include "koneksi.php";
date_default_timezone_set("Asia/Jakarta");


$user = $_SESSION['user'];
$data_user = mysql_query("SELECT * FROM login WHERE user='$user' ");
$lihat_user = mysql_fetch_array($data_user);

$data_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nama like '%$nama_user%' ");
$lihat_ktp = mysql_fetch_array($data_ktp);
$ktp_nomor = $lihat_ktp['ktp_nomor'];


$page = (isset($_GET['page'])) ? $_GET['page'] : "main";

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


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php
        include "layout/navbar.php";
        include "layout/sidebar.php";
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="home_admin.php?page=aboutuser">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo $page ?></li>
                    </ol>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <?php
                    $page = (isset($_GET['page'])) ? $_GET['page'] : "main";
                    switch ($page) {

                            //Data Biodata
                        case 'id_card_information':
                            include "id_card_information.php";
                            break;
                        case 'id_card_input':
                            include "id_card_input.php";
                            break;
                        case 'id_card_input_process':
                            include "id_card_input_process.php";
                            break;
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

                            //Data Keluarga
                        case 'family_edit':
                            include "family_edit.php";
                            break;
                        case 'family_edit_process':
                            include "family_edit_process.php";
                            break;

                            //Data darurat
                        case 'emergency_edit':
                            include "emergency_edit.php";
                            break;
                        case 'emergency_edit_process':
                            include "emergency_edit_process.php";
                            break;

                            //Data pengalaman kerja
                        case 'experience_edit':
                            include "experience_edit.php";
                            break;
                        case 'experience_edit_process':
                            include "experience_edit_process.php";
                            break;

                            //Data NPWP
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

                            //Data Libur Nasional
                        case 'nasional_holiday_view':
                            include "nasional_holiday_view.php";
                            break;
                        case 'nasional_holiday_input':
                            include "nasional_holiday_input.php";
                            break;

                            //Data Vaksin
                        case 'vaccine_view':
                            include "vaccine_view.php";
                            break;
                        case 'vaccine_input':
                            include "vaccine_input.php";
                            break;
                        case 'vaccine_input_process':
                            include "vaccine_input_process.php";
                            break;

                            //Data PKWT
                        case 'pkwt_list':
                            include "pkwt_list.php";
                            break;
                        case 'pkwt_list_process':
                            include "pkwt_list_process.php";
                            break;
                        case 'pkwt_data':
                            include "pkwt_data.php";
                            break;
                        case 'pkwt_data_process':
                            include "pkwt_data_process.php";
                            break;
                        case 'pkwt_data_process_input':
                            include "pkwt_data_process_input.php";
                            break;

                            //Data Bagian
                        case 'job_title':
                            include "job_title.php";
                            break;
                        case 'job_title_input':
                            include "job_title_input.php";
                            break;
                        case 'job_title_input_process':
                            include "job_title_input_process.php";
                            break;
                        case 'job_title_edit':
                            include "job_title_edit.php";
                            break;
                        case 'job_title_edit_process':
                            include "job_title_edit_process.php";
                            break;

                            //Data Finger
                        case 'fingerprint_upload':
                            include "fingerprint_upload.php";
                            break;
                        case 'fingerprint_upload_process':
                            include "fingerprint_upload_process.php";
                            break;
                        case 'fingerprint_view':
                            include "fingerprint_view.php";
                            break;
                        case 'fingerprint_download':
                            include "fingerprint_download.php";
                            break;
                        case 'generate_attendance':
                            include "generate_attendance.php";
                            break;
                        case 'generate_attendance_process':
                            include "generate_attendance_process.php";
                            break;

                            //Data Absen
                        case 'attendance_view':
                            include "attendance_view.php";
                            break;
                        case 'attendance_view_edit_proses':
                            include "attendance_view_edit_proses.php";
                            break;
                        case 'attendance_recap':
                            include "attendance_recap.php";
                            break;
                        case 'attendance_recap_staff':
                            include "attendance_recap_staff.php";
                            break;
                        case 'attendance_review':
                            include "attendance_review.php";
                            break;
                        case 'attendance_late':
                            include "attendance_late.php";
                            break;
                        case 'attendance_no_info':
                            include "attendance_no_info.php";
                            break;
                        case 'attendance_request':
                            include "attendance_request.php";
                            break;
                        case 'attendance_request_input':
                            include "attendance_request_input.php";
                            break;
                        case 'attendance_request_input_process':
                            include "attendance_request_input_process.php";
                            break;
                        case 'attendance_request_edit':
                            include "attendance_request_edit.php";
                            break;
                        case 'attendance_request_edit_process':
                            include "attendance_request_edit_process.php";
                            break;
                        case 'attendance_correction':
                            include "attendance_correction.php";
                            break;
                        case 'attendance_correction_input':
                            include "attendance_correction_input.php";
                            break;

                            //Report
                        case 'report_download':
                            include "report_download.php";
                            break;

                            //Seting Schedule karyawan setting
                        case 'employee_schedule_setting':
                            include "employee_schedule_setting.php";
                            break;
                        case 'employee_schedule_setting_input':
                            include "employee_schedule_setting_input.php";
                            break;
                        case 'employee_schedule_setting_input_process':
                            include "employee_schedule_setting_input_process.php";
                            break;

                            //Seting shift Schedule karyawan setting
                        case 'employee_shift_schedule_setting':
                            include "employee_shift_schedule_setting.php";
                            break;
                        case 'employee_shift_schedule_setting_input':
                            include "employee_shift_schedule_setting_input.php";
                            break;
                        case 'employee_shift_schedule_setting_input_process':
                            include "employee_shift_schedule_setting_input_process.php";
                            break;
                        case 'employee_shift_schedule_setting_edit_process':
                            include "employee_shift_schedule_setting_edit_process.php";
                            break;

                            //Data Shift schedule
                        case 'shift_daily_view':
                            include "shift_daily_view.php";
                            break;
                        case 'shift_daily_input':
                            include "shift_daily_input.php";
                            break;
                        case 'shift_daily_input_process':
                            include "shift_daily_input_process.php";
                            break;
                        case 'shift_daily_edit':
                            include "shift_daily_edit.php";
                            break;
                        case 'shift_daily_edit_process':
                            include "shift_daily_edit_process.php";
                            break;

                            //Group Schedule
                        case 'group_schedule_view':
                            include "group_schedule_view.php";
                            break;
                        case 'group_schedule_input':
                            include "group_schedule_input.php";
                            break;
                        case 'group_schedule_input_process':
                            include "group_schedule_input_process.php";
                            break;

                            //Data Karyawan
                        case 'employee_information':
                            include "employee_information.php";
                            break;
                        case 'employee_details':
                            include "employee_details.php";
                            break;

                            //Data lcoker
                        case 'locker':
                            include "locker.php";
                            break;
                        case 'locker_view':
                            include "locker_view.php";
                            break;
                        case 'locker_setting':
                            include "locker_setting.php";
                            break;
                        case 'locker_setting_process':
                            include "locker_setting_process.php";
                            break;

                            //Data Memo
                        case 'memo_view':
                            include "memo_view.php";
                            break;

                            //Data User
                        case 'user_lihat':
                            include "user_lihat.php";
                            break;
                        case 'user_edit_kontak':
                            include "user_edit_kontak.php";
                            break;

                            //Data Barang
                        case 'item_view':
                            include "item_view.php";
                            break;
                        case 'item_input':
                            include "item_input.php";
                            break;
                        case 'item_input_process':
                            include "item_input_process.php";
                            break;
                        case 'item_edit':
                            include "item_edit.php";
                            break;
                        case 'item_edit_process':
                            include "item_edit_process.php";
                            break;

                        case 'item_up_view':
                            include "item_up_view.php";
                            break;
                        case 'item_up_input':
                            include "item_up_input.php";
                            break;
                        case 'item_up_input_process':
                            include "item_up_input_process.php";
                            break;
                        case 'item_up_aprove':
                            include "item_up_aprove.php";
                            break;
                        case 'item_up_aprove_process':
                            include "item_up_aprove_process.php";
                            break;

                        case 'item_use_view':
                            include "item_use_view.php";
                            break;
                        case 'item_use_input':
                            include "item_use_input.php";
                            break;
                        case 'item_use_input_process':
                            include "item_use_input_process.php";
                            break;
                        case 'item_use_aprove':
                            include "item_use_aprove.php";
                            break;

                            //Data Career
                        case 'career_history':
                            include "career_history.php";
                            break;
                        case 'career_history_view':
                            include "career_history_view.php";
                            break;
                        case 'career_history_input':
                            include "career_history_input.php";
                            break;
                        case 'career_history_edit':
                            include "career_history_edit.php";
                            break;
                        case 'career_history_terminate':
                            include "career_history_terminate.php";
                            break;
                        case 'career_movement':
                            include "career_movement.php";
                            break;

                            //Data Warning Letter
                        case 'warning_letter_view':
                            include "warning_letter_view.php";
                            break;
                        case 'warning_letter_input':
                            include "warning_letter_input.php";
                            break;
                        case 'warning_letter_input_prosess':
                            include "warning_letter_input_prosess.php";
                            break;

                            //Data Letter of Statement 
                        case 'skt_view':
                            include "skt_view.php";
                            break;
                        case 'skt_input':
                            include "skt_input.php";
                            break;
                        case 'skt_input_prosess':
                            include "skt_input_prosess.php";
                            break;

                            //Data Paklaring 
                        case 'paklaring_view':
                            include "paklaring_view.php";
                            break;

                            //Data UMP 
                        case 'ump_view':
                            include "ump_view.php";
                            break;
                        case 'ump_input':
                            include "ump_input.php";
                            break;
                        case 'ump_edit':
                            include "ump_edit.php";
                            break;
                        case 'ump_edit_process':
                            include "ump_edit_process.php";
                            break;

                            //Data Setting 
                        case 'setting_ump':
                            include "setting_ump.php";
                            break;
                        case 'setting_ump_input':
                            include "setting_ump_input.php";
                            break;

                            //Data overtime 
                        case 'overtime':
                            include "overtime.php";
                            break;
                        case 'overtime_input':
                            include "overtime_input.php";
                            break;
                        case 'overtime_hapus':
                            include "overtime_hapus.php";
                            break;

                            //Data deductions 
                        case 'deductions':
                            include "deductions.php";
                            break;
                        case 'deductions_input':
                            include "deductions_input.php";
                            break;
                        case 'deductions_hapus':
                            include "deductions_hapus.php";
                            break;

                            //Data addition 
                        case 'addition':
                            include "addition.php";
                            break;
                        case 'addition_input':
                            include "addition_input.php";
                            break;
                        case 'addition_hapus':
                            include "addition_hapus.php";
                            break;

                            //Data corporate_debt 
                        case 'corporate_debt':
                            include "corporate_debt.php";
                            break;
                        case 'corporate_debt_input':
                            include "corporate_debt_input.php";
                            break;
                        case 'corporate_debt_hapus':
                            include "corporate_debt_hapus.php";
                            break;

                            //Data Salary 
                        case 'salary_calculation':
                            include "salary_calculation.php";
                            break;
                        case 'salary_calculation_proses':
                            include "salary_calculation_proses.php";
                            break;
                        case 'salary_calculation':
                            include "salary_calculation.php";
                            break;
                        case 'salary_report':
                            include "salary_report.php";
                            break;
                        case 'salary_receipt':
                            include "salary_receipt.php";
                            break;
                        case 'milk_receipt':
                            include "milk_receipt.php";
                            break;

                            //Data BPJS TK 
                        case 'bpjstk_register':
                            include "bpjstk_register.php";
                            break;
                        case 'bpjstk_register_process':
                            include "bpjstk_register_process.php";
                            break;
                        case 'bpjstk_approve':
                            include "bpjstk_approve.php";
                            break;
                        case 'bpjstk_approve_process':
                            include "bpjstk_approve_process.php";
                            break;
                        case 'bpjstk_information':
                            include "bpjstk_information.php";
                            break;

                            //Data BPJS Kes 
                        case 'bpjskes_register':
                            include "bpjskes_register.php";
                            break;
                        case 'bpjskes_register_process':
                            include "bpjskes_register_process.php";
                            break;
                        case 'bpjskes_approve':
                            include "bpjskes_approve.php";
                            break;
                        case 'bpjskes_approve_process':
                            include "bpjskes_approve_process.php";
                            break;
                        case 'bpjskes_information':
                            include "bpjskes_information.php";
                            break;

                        case 'main':
                        default:
                            include 'aboutuser.php';
                    }
                    ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2021 <a href="https://localhost/rackindo/index.php">Rackindo HRIS</a>.</strong> All
            rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
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
</script>eturn false;
return true;
}
</script>