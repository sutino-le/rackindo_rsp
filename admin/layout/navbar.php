<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="home_admin.php" class="nav-link">Home</a>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Employee</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=employee_information" class="dropdown-item">Employee Information</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Career</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=career_history" class="dropdown-item">Career History</a>
                <a href="home_admin.php?page=career_movement" class="dropdown-item">Career Movement</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">BPJS TK</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=bpjstk_register" class="dropdown-item">Register</a>
                <a href="home_admin.php?page=bpjstk_approve" class="dropdown-item">Approve</a>
                <a href="home_admin.php?page=bpjstk_information" class="dropdown-item">BPJS TK Information</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">BPJS Kes</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=bpjskes_register" class="dropdown-item">Register</a>
                <a href="home_admin.php?page=bpjskes_approve" class="dropdown-item">Approve</a>
                <a href="home_admin.php?page=bpjskes_information" class="dropdown-item">BPJS Kes Information</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Letter</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=warning_letter_view" class="dropdown-item">Warning Letter</a>
                <a href="home_admin.php?page=skt_view" class="dropdown-item">Letter of Statement</a>
                <a href="home_admin.php?page=paklaring_view" class="dropdown-item">Certificate of Employment</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Attendance</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=attendance_view" class="dropdown-item">Attendance View</a>
                <a href="home_admin.php?page=attendance_recap" class="dropdown-item">Attendance Recap</a>
                <a href="home_admin.php?page=attendance_recap_staff" class="dropdown-item">Attendance Recap Staff</a>
                <a href="home_admin.php?page=attendance_review" class="dropdown-item">Attendance Review</a>
                <a href="home_admin.php?page=attendance_no_info" class="dropdown-item">Attendance No Info</a>
                <a href="home_admin.php?page=attendance_late" class="dropdown-item">Attendance Late</a>
                <a href="home_admin.php?page=attendance_correction" class="dropdown-item">Attendance Correction</a>
                <a href="home_admin.php?page=attendance_request" class="dropdown-item">Attendance Request</a>
                <a href="home_admin.php?page=memo_view" class="dropdown-item">Memo Request</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Setting</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=locker" class="dropdown-item">Locker</a>
                <a href="home_admin.php?page=employee_schedule_setting" class="dropdown-item">Group Schedule</a>
                <a href="home_admin.php?page=employee_shift_schedule_setting" class="dropdown-item">Shift Schedule</a>
                <a href="home_admin.php?page=setting_ump" class="dropdown-item">UMP</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Overtime and Deductions</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=overtime" class="dropdown-item">Overtime</a>
                <a href="home_admin.php?page=deductions" class="dropdown-item">Deductions</a>
                <a href="home_admin.php?page=addition" class="dropdown-item">Addition</a>
                <a href="home_admin.php?page=corporate_debt" class="dropdown-item">Corporate Debt</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Salary</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=salary_calculation" class="dropdown-item">Salary Calculation</a>
                <a href="home_admin.php?page=salary_report" class="dropdown-item">Salary Report</a>
            </div>
        </li>
    </ul>

    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Report</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="home_admin.php?page=salary_receipt" class="dropdown-item">Salary Receipt</a>
                <a href="home_admin.php?page=milk_receipt" class="dropdown-item">Milk Receipt</a>
            </div>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="logout.php" role="button">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>


</nav>
<!-- /.navbar -->