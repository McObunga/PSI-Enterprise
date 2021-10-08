<?php
include('functions.php');
$user_email = $_SESSION['psi']['email'];
$current_token = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM wp_users where user_login = '$user_email'"))['current_session'];
if (!isset($_SESSION['psi'])) {
    session_destroy();
    unset($_SESSION['psi']);
    header('location: login');
}
if ($current_token != session_id()) {
    session_destroy();
    unset($_SESSION['psi']);
    header('location: login');
}
$date = date('m/d/Y', time());
$first_day_of_month = date('1, Y', strtotime($date));
$last_date = date("Y-m-t", strtotime($date));
$last_d = date("t, Y", strtotime($last_date));
$monthNum  = date('m', time());
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="My Health Africa"/>
    <meta name="author" content="My Health Africa Devs" />
    <title>PS Kenya - Dashboard</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="assets/bundles/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--bootstrap -->
    <link href="assets/bundles/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/bundles/select2/css/select2.min.css">
    <!-- daterange picker -->
    <link href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <!--jquery toast -->
    <link href="assets/bundles/jquery-toast-plugin-master/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/material_style.css">
    <!-- Data Tables -->
    <link href="assets/bundles/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/bundles/datatables/export/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="css/theme.css" rel="stylesheet" type="text/css" />
    <link href="css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/theme-color.css" rel="stylesheet" type="text/css" />
    
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <?php require_once('navbar.php'); ?>
        <div class="page-container">
            <?php require_once('sidebar.php'); ?>
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="card-body" style="margin-top:25px; padding: 0 !important"></div>
                    <div id="wrapper">
                        <!-- Content Wrapper -->
                        <div id="content-wrapper" class="d-flex flex-column">
                            <!-- Main Content -->
                            <div id="content">
                                <!-- Begin Page Content -->
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <div class="d-sm-flex justify-content-between mb-4">
                                        <h3 class="h3 mb-0  font-weight-bold">Enterprise Overview</h3>
                                        <!-- Period filter -->
                                        <div class="pull-left dashboard d-sm-flex align-items-center justify-content-between" style="margin-top: 25px;margin-left:-160px !important;">
                                            <button type="button" class="btn pull-left" id="date-range-btn">
                                                <span name="date_range" id="date_range"><i class="fa fa-calendar"></i> <?php echo $monthName.' '.$first_day_of_month; ?> - <?php echo $monthName.' '.$last_d; ?> </span>
                                                <i class="fa fa-caret-down"></i>
                                            </button>
                                        </div>
                                        <div class="dashboard d-sm-flex align-items-center justify-content-between pull right" style="margin-top: 25px;">
                                            <button href="#filters" data-toggle="collapse" class=" btn btn-default shadow">Filters <i class="fa fa-caret-down"></i> </button>
                                        </div>
                                    </div>

                                    <!-- Filters collapsed -->
                                    <div id = "filters" class = "collapse fade">
                                        <div class = "row">
                                            <div class=" col-xl-4 col-md-6 mb-4 font-weight-bold">
                                                <label>Location</label>
                                                <select data-tags="true" data-placeholder="Select clinic location" type="text" name="clinic-location" id="clinic-location" class="form-control select2" style="width: 100%;">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-6 mb-4 font-weight-bold">
                                                <label>Age group</label>
                                                <select data-tags="true" id="age-group" name="age-group" class="form-control shadow select2" style="width: 100%;">                        
                                                    <option selected disabled value="">Select age group</option>
                                                    <option value="0-10">00 - 10</option>
                                                    <option value="11-20">11 - 20</option>
                                                    <option value="21-30">21 - 30</option>
                                                    <option value="31-40">31 - 40</option>
                                                    <option value="41-50">41 - 50</option>
                                                    <option value="51-60">51 - 60</option>
                                                    <option value="61-70">61 - 70</option>
                                                    <option value="71-80">71 - 80</option>
                                                    <option value="81-90">81 - 90</option>
                                                    <option value="91-100">91 - 100</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-6 mb-4 font-weight-bold">
                                                <label for="gender">Gender</label>
                                                <select data-tags="true" id="gender" name="gender" class="form-control shadow select2" style="width: 100%;">
                                                    <option selected disabled value="">Select gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Prefer not to say">Prefer not to say</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sidebar-dark hr-b "></div>
                                    </div>
                                    <div class="row">
                                        <!-- column 1 -->
                                        <div class = "col-xl-9">
                                            <!-- Content Row -->
                                            <div class="row">
                                                <!-- Total appointments card -->
                                                <div class="col-xl-4 col-md-6 mb-4">
                                                    <div class="card shadow py-2 hg">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold  mb-1">
                                                                        Total appointments
                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">5000</div>
                                                                        <div class = "row">
                                                                            <div class = "column">
                                                                                <div class="col-xs-4 topbar-divider d-none d-sm-block"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 small">
                                                                            Telemedicine
                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">1000</div>
                                                                        </div>
                                                                        <div class="col-md-6 border-left small">
                                                                            In-person
                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">1000</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Income card -->
                                                <div class="col-xl-6 col-md-6 mb-4">
                                                    <div class="card shadow py-2 hg">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold  mb-1">
                                                                        Income</div>
                                                                        <div >&nbsp</div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 border-right small">
                                                                            This Month
                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">KES 200,000</div>
                                                                        </div>
                                                                        <div class="col-md-6 small">
                                                                            Previous Month
                                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">KES 1,300,000</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Total clinics Card -->
                                                <div class="col-xl-2 col-md-6 mb-4">
                                                    <div class="card shadow  py-2 hg">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">
                                                                    <div class="text-xs font-weight-bold  mb-1 small">Total clinics<br/><span style="font-size: 1rem;">8</span></div>
                                                                    <hr>
                                                                    <div class="text-xs font-weight-bold  mb-1 small">Total Doctors<br/><span style="font-size: 1rem;">80</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                            
                                            </div>
                                            <!-- Area Chart -->
                                            <div class="col-xl-12 p-0 col-lg-7">
                                                <div class="trend card shadow mb-4">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header col-md-12">
                                                        <h6 class="col-md-6 pull-left">Booking trends</h6>
                                                        <div class="col-md-4 pull-right">
                                                            <select id="service" name="gender" class="form-control shadow-none" required> 
                                                                <option value="">Service</option>
                                                                <option value="Male">Gender</option>
                                                                <option value="Female">Age group</option>
                                                                <option value="Female">Time</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="card-body no-padding height-12">
                                                        <div class="col-md-12 chart-area">
                                                            <canvas id="booking-trend"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- table -->
                                            <div class="col-xl-12 p-0 col-lg-7">
                                                <?php require "clinics-data.php";?>
                                            </div>
                                        </div>
                                        <!-- Column 2 -->
                                        <div class="col-xl-3 p-0">
                                            <!-- Pie Chart -->
                                            <div class="col-xl-12 col-lg-5">
                                                <div class="card shadow mb-4 h-100">
                                                    <!-- Card Header - Dropdown -->
                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                        <h6 class="m-0 font-weight-bold ">Medical Conditions</h6>
                                                    </div>
                                                    <!-- Card Body -->
                                                    <div class="card-body">
                                                        <h6 class="small">Total clinics<span class="totals pull-right">8</span></h6>
                                                        <h6 class="small">Total appointments <span class = "totals pull-right">5,000</span></h6><br>
                                                        <div class="chart-pie">
                                                            <canvas width="600" height="200" id="medical-conditions-doughnut"></canvas>
                                                        </div>
                                                        <span class="condition-title pull-left">Condition</span><span class="condition-title pull-right">Bookings</span><br>
                                                        <div class="conditions-desc">
                                                            <h5 class="conditions"><span class="dot-green"></span> Maternal care<span class="booking-count pull-right">5,000</span></h5>
                                                            <h5 class="conditions"><span class="dot-light-orange"></span> Child healthcare<span class="booking-count pull-right">5,000</span></h5>
                                                            <h5 class="conditions"><span class="dot-light-green"></span> Family planning<span class="booking-count pull-right">5,000</span></h5>
                                                            <h5 class="conditions"><span class="dot-light-blue"></span> Non communicable<span class="booking-count pull-right">5,000</span></h5>
                                                            <h5 class="conditions"><span class="dot-light-pink"></span> Tuberculosis<span class="booking-count pull-right">5,000</span></h5>
                                                            <h5 class="conditions"><span class="dot-red"></span> HIV &amp; AIDS<span class="booking-count pull-right">5,000</span></h5>
                                                            <h5 class="conditions"><span class="dot-blue"></span> Other<span class="booking-count pull-right">5,000</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page content -->
            </div>
            <!-- end page container -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        <?php require_once('footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"> <i class="fa fa-angle-up"></i> </a>

    <!-- start js include path -->
    <script src="assets/bundles/jquery/jquery.min.js"></script>
    <script src="assets/bundles/popper/popper.js"></script>
    <script src="assets/bundles/jquery-blockUI/jquery.blockui.min.js"></script>
    <script src="assets/bundles/jquery.slimscroll/jquery.slimscroll.js"></script>
    <!-- bootstrap -->
    <script src="assets/bundles/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bundles/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- Select2 -->
    <script src="assets/bundles/select2/js/select2.full.min.js"></script>
    <!-- date-range-picker -->
    <script src="assets/bundles/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- jquery toast -->
    <script src="assets/bundles/jquery-toast-plugin-master/jquery.toast.min.js"></script>
    <!-- Data Table -->
    <script src="assets/bundles/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/bundles/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/dataTables.responsive.min.js"></script>
    <!-- Common js-->
    <script type="text/javascript" src="assets/sidebar.js"></script>
    <script src="assets/app.js"></script>
    <script src="assets/layout.js"></script>
    <script src="assets/theme-color.js"></script>
    <!-- material -->
    <script src="assets/bundles/material/material.min.js"></script>
    <!-- Chart Plugins Js -->
    <script src="assets/bundles/charts/chartscripts.bundle.js"></script>
    <script src="assets/bundles/charts/sparklinescripts.bundle.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/index.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!--Chart JS-->
	<script src="assets/bundles/chart-js/Chart.bundle.js"></script>
	<script src="assets/bundles/chart-js/utils.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-data.js"></script>
</body>

</html>