<?php
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
    <title>PS Kenya - Appointments</title>
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
    <link href="assets/bundles/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
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
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0  font-weight-bold">Appointments Overview</h1>

                                        <!-- Period filter -->
                                        <div class="d-sm-flex align-items-center justify-content-between">
                                            <select id="gender" name="gender" class="form-control shadow-none" required>
                                                <option selected disabled value="">Select period</option>
                                                <option value="Male">Today</option>
                                                <option value="Female">Yesterday</option>
                                                <option value="Female">Last 7 days</option>
                                                <option value="Female">Last 14 days</option>
                                                <option value="Female">Last 30 days</option>
                                                <option value="Female">Last 90 days</option>
                                                <option value="Female">Last 365 days</option>
                                            </select>
                                        </div>

                                        <!-- Toggle filters -->
                                        <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm shadow">Filters <i
                                                class="fas fa-caret-down"></i> </a>
                                    </div>

                                    <!-- Filters displayed -->
                                        <div class = "row">
                                                <div class=" col-xl-3 col-md-6 mb-4  font-weight-bold">
                                                    <label>Location</label>
                                                    <select id="location" name="gender" class="form-control shadow-none" required> 
                                                        <option selected disabled value="">Select location of clinic</option>
                                                        <option value="Male">Today</option>
                                                        <option value="Female">Yesterday</option>
                                                        <option value="Female">Last 7 days</option>
                                                        <option value="Female">Last 14 days</option>
                                                        <option value="Female">Last 30 days</option>
                                                        <option value="Female">Last 90 days</option>
                                                        <option value="Female">Last 365 days</option>
                                                    </select>
                                                </div>

                                                <div class="col-xl-3 col-md-6 mb-4  font-weight-bold">
                                                    <label>Clinic</label>
                                                    <select id="age" name="age" class="form-control shadow" required>                        
                                                        <option selected disabled value="">Select clinic</option>
                                                        <option value="Male">Today</option>
                                                        <option value="Female">Yesterday</option>
                                                        <option value="Female">Last 7 days</option>
                                                        <option value="Female">Last 14 days</option>
                                                        <option value="Female">Last 30 days</option>
                                                        <option value="Female">Last 90 days</option>
                                                        <option value="Female">Last 365 days</option>
                                                    </select>
                                                </div>

                                                <div class="col-xl-3 col-md-6 mb-4  font-weight-bold">
                                                    <label>Age group</label>
                                                    <select id="age" name="age" class="form-control shadow" required>                        
                                                        <option selected disabled value="">Select age group</option>
                                                        <option value="Male">Today</option>
                                                        <option value="Female">Yesterday</option>
                                                        <option value="Female">Last 7 days</option>
                                                        <option value="Female">Last 14 days</option>
                                                        <option value="Female">Last 30 days</option>
                                                        <option value="Female">Last 90 days</option>
                                                        <option value="Female">Last 365 days</option>
                                                    </select>
                                                </div>

                                                <div class="col-xl-3 col-md-6 mb-4  font-weight-bold">
                                                    <label for="gender">Gender</label>
                                                    <input list="gender_list" name="gender" class="form-control shadow" id="gender"placeholder="Select or type in gender">
                                                    <datalist id="gender_list">
                                                        <option value="Male">
                                                        <option value="Female">
                                                        <option value="Prefer not to say">
                                                    </datalist>
                                                </div>
                                            
                                        </div>

                                        <div class="sidebar-dark hr-b "></div>

                                        <div id="exTab2" class="container1 ">	

                                            <ul class="nav nav-tabs ">
                                                <li class="active mr-5 ">
                                                <a  href="#1" data-toggle="tab" class="active">Telemedicine</a>
                                                </li>
                                                <li class = "mr-5 "><a href="#2" data-toggle="tab">In Person</a>
                                                </li>
                                                <li class = "mr-5 "><a href="#3" data-toggle="tab">All</a>
                                                </li>
                                            </ul>


                                            <!-- Telemedicine nav pill -->
                                            <div class="tab-content ">
                                                <div class="tab-pane active" id="1">

                                                    <div class="row">
                                                        <!-- column 1 -->
                                                        <div class = "col-xl-9">
                                                            <!-- Content Row -->
                                                            <div class="row">
                                                                <!-- Total appointments card -->
                                                                <div class="col-xl-3 col-md-6 mb-4">
                                                                    <div class="card shadow py-2 ">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">

                                                                                <div class="col-2 mr-3">
                                                                                    <i class=" align-top fas fa-calendar-check"></i>
                                                                                </div>
                                                                                <div class="col mr-2">
                                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">5000</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10 small">Total appointments</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--Appointments today card -->
                                                                <div class="col-xl-3 col-md-6 mb-4">
                                                                    <div class="card shadow py-2 ">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">

                                                                            <div class="col-2 mr-3">
                                                                                    <i class="align-top fas fa-calendar-check"></i>
                                                                                </div>
                                                                                <div class="col mr-2">
                                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">100</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10 small">Appointments booked today</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    
                                                            </div>
                                                            <!-- Area Chart -->
                                                            <div class="col-xl-12 p-0 col-lg-7">
                                                                <div class="card shadow mb-4">
                                                                    <!-- Card Header - Dropdown -->
                                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                                        <h6 class="m-0 font-weight-bold ">Booking trends</h6>
                                                                        <div class=" col-xl-4 col-md-6 mb-4  font-weight-bold">
                                                                <select id="service" name="gender" class="form-control shadow-none" required> 
                                                                    <option value="">Service</option>
                                                                    <option value="Male">Gender</option>
                                                                    <option value="Female">Age group</option>
                                                                    <option value="Female">Time</option>
                                                                
                                                                </select>
                                                            </div>
                                                                    </div>
                                                                    <!-- Card Body -->
                                                                    <div class="card-body">
                                                                        <div class="chart-area">
                                                                            <canvas id="myAreaChartTelemedicine"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        

                                                        </div>
                                                        <!-- Column 2 -->
                                                        <div class="col-xl-3 p-0">
                                                            <!-- Pie Chart -->
                                                            <div class="col-xl-12 col-lg-5">
                                                                <div class="card shadow mb-4 h-100">
                                                                    <!-- Card Header - Dropdown -->
                                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                                        <h6 class="m-0 font-weight-bold ">Medical conditions</h6>
                                                                        <div class="dropdown no-arrow">
                                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                                <div class="dropdown-header">Dropdown Header:</div>
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Card Body -->
                                                                    <div class="card-body">
                                                                    <div class = "mt-2" >
                                                                        <h6 class=" small">Total clinics available <span class = "h6 ml-5 font-weight-bold">8</span></h6>
                                                                        <h6 class=" small">Total appointments booked <span class = "h6 ml-3 font-weight-bold">5,000</span></h6>
                                                                    </div>
                                                                        <div class="chart-pie pt-4 pb-2">
                                                                            <canvas width="600" height="250" id="myPieChartTelemedicine"></canvas>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- In-person nav pill-->
                                                <div class="tab-pane" id="2">
                                                <div class="row">
                                                        <!-- column 1 -->
                                                        <div class = "col-xl-9">
                                                            <!-- Content Row -->
                                                            <div class="row">
                                                                <!-- Total appointments card -->
                                                                <div class="col-xl-3 col-md-6 mb-4">
                                                                    <div class="card shadow py-2 ">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">

                                                                                <div class="col-2 mr-3">
                                                                                    <i class=" align-top fas fa-calendar-check"></i>
                                                                                </div>
                                                                                <div class="col mr-2">
                                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">3000</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10 small">Total appointments</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--Appointments today card -->
                                                                <div class="col-xl-3 col-md-6 mb-4">
                                                                    <div class="card shadow py-2 ">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">

                                                                            <div class="col-2 mr-3">
                                                                                    <i class="align-top fas fa-calendar-check"></i>
                                                                                </div>
                                                                                <div class="col mr-2">
                                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">7600</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10 small">Appointments booked today</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    
                                                            </div>
                                                            <!-- Area Chart -->
                                                            <div class="col-xl-12 p-0 col-lg-7">
                                                                <div class="card shadow mb-4">
                                                                    <!-- Card Header - Dropdown -->
                                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                                        <h6 class="m-0 font-weight-bold ">Booking trends</h6>
                                                                        <div class=" col-xl-4 col-md-6 mb-4  font-weight-bold">
                                                                <select id="service" name="gender" class="form-control shadow-none" required> 
                                                                    <option value="">Service</option>
                                                                    <option value="Male">Gender</option>
                                                                    <option value="Female">Age group</option>
                                                                    <option value="Female">Time</option>
                                                                
                                                                </select>
                                                            </div>
                                                                    </div>
                                                                    <!-- Card Body -->
                                                                    <div class="card-body">
                                                                        <div class="chart-area">
                                                                            <canvas id="myAreaChartInPerson"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                                                
                                                        </div>
                                                        <!-- Column 2 -->
                                                        <div class="col-xl-3 p-0">
                                                            <!-- Pie Chart -->
                                                            <div class="col-xl-12 col-lg-5">
                                                                <div class="card shadow mb-4 h-100">
                                                                    <!-- Card Header - Dropdown -->
                                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                                        <h6 class="m-0 font-weight-bold ">Medical conditions</h6>
                                                                        <div class="dropdown no-arrow">
                                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                                <div class="dropdown-header">Dropdown Header:</div>
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Card Body -->
                                                                    <div class="card-body">
                                                                    <div class = "mt-2" >
                                                                        <h6 class=" small">Total clinics available <span class = "h6 ml-5 font-weight-bold">8</span></h6>
                                                                        <h6 class=" small">Total appointments booked <span class = "h6 ml-3 font-weight-bold">5,000</span></h6>
                                                                    </div>
                                                                        <div class="chart-pie pt-4 pb-2">
                                                                            <canvas width="600" height="250" id="myPieChartInPerson"></canvas>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- All nav pill -->
                                                <div class="tab-pane" id="3">
                                                <div class="row">
                                                        <!-- column 1 -->
                                                        <div class = "col-xl-9">
                                                            <!-- Content Row -->
                                                            <div class="row">
                                                                <!-- Total appointments card -->
                                                                <div class="col-xl-3 col-md-6 mb-4">
                                                                    <div class="card shadow py-2 ">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">

                                                                                <div class="col-2 mr-3">
                                                                                    <i class=" align-top fas fa-calendar-check"></i>
                                                                                </div>
                                                                                <div class="col mr-2">
                                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">5000</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10 small">Total appointments</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--Appointments today card -->
                                                                <div class="col-xl-3 col-md-6 mb-4">
                                                                    <div class="card shadow py-2 ">
                                                                        <div class="card-body">
                                                                            <div class="row no-gutters align-items-center">

                                                                            <div class="col-2 mr-3">
                                                                                    <i class="align-top fas fa-calendar-check"></i>
                                                                                </div>
                                                                                <div class="col mr-2">
                                                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-secondary">100</div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-10 small">Appointments booked today</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    
                                                            </div>
                                                            <!-- Area Chart -->
                                                            <div class="col-xl-12 p-0 col-lg-7">
                                                                <div class="card shadow mb-4">
                                                                    <!-- Card Header - Dropdown -->
                                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                                        <h6 class="m-0 font-weight-bold ">Booking trends</h6>
                                                                        <div class=" col-xl-4 col-md-6 mb-4  font-weight-bold">
                                                                <select id="service" name="gender" class="form-control shadow-none" required> 
                                                                    <option value="">Service</option>
                                                                    <option value="Male">Gender</option>
                                                                    <option value="Female">Age group</option>
                                                                    <option value="Female">Time</option>
                                                                
                                                                </select>
                                                            </div>
                                                                    </div>
                                                                    <!-- Card Body -->
                                                                    <div class="card-body">
                                                                        <div class="chart-area">
                                                                            <canvas id="myAreaChartAll"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                        <!-- Column 2 -->
                                                        <div class="col-xl-3 p-0">
                                                            <!-- Pie Chart -->
                                                            <div class="col-xl-12 col-lg-5">
                                                                <div class="card shadow mb-4 h-100">
                                                                    <!-- Card Header - Dropdown -->
                                                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                                        <h6 class="m-0 font-weight-bold ">Medical conditions</h6>
                                                                        <div class="dropdown no-arrow">
                                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                                <div class="dropdown-header">Dropdown Header:</div>
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Card Body -->
                                                                    <div class="card-body">
                                                                    <div class = "mt-2" >
                                                                        <h6 class=" small">Total clinics available <span class = "h6 ml-5 font-weight-bold">8</span></h6>
                                                                        <h6 class=" small">Total appointments booked <span class = "h6 ml-3 font-weight-bold">5,000</span></h6>
                                                                    </div>
                                                                        <div class="chart-pie pt-4 pb-2">
                                                                            <canvas width="600" height="250" id="myPieChartAll"></canvas>
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
    <a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>

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
    <script src="js/dataTables.responsive.min.js"></script>
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
    <script src="js/dataTables.responsive.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/index.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chartDash.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>