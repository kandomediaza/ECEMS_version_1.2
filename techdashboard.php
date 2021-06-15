<?php
    
 session_start();

 if(!isset($_SESSION['tech_login'])) //check unauthorize user not direct access in "user_home.php" page
 {
  header("location: index.php");
 }

 if(isset($_SESSION['admin_login'])) //check admin login user not access in "user_home.php" page
 {
  header("location: admindashboard.php");
 }

 if(isset($_SESSION['employee_login'])) //check employee login user not access in "employee_home.php" page
 {
  header("location: employeedashboard.php");
 }

 if(isset($_SESSION['tech_login']))
 {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Plus Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_2/style.css" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_horizontal-navbar.html -->
      <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="#">
                <img src="ecemslogo.png" alt="logo" />
                <span class="font-12 d-block font-weight-light">Version 1.2 Beta</span>
              </a>
              <a class="navbar-brand brand-logo-mini" href="#"><img src="ecemslogo.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                  <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                      <span class="input-group-text" id="search">
                        <i class="mdi mdi-magnify"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" aria-label="search" aria-describedby="search" />
                  </div>
                </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                   
                    <div class="nav-profile-text">
                      <p class="text-black font-weight-semibold m-0"><?php
   echo $_SESSION['tech_login'];
  }
  ?></p>
                      <span class="font-13 online-color">online <i class="mdi mdi-chevron-down"></i></span>
                    </div>
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                      <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">
                      <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                  </div>
                </li>
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu"></span>
              </button>
            </div>
          </div>
        </nav>
        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="index.html">
                  <i class="mdi mdi-compass-outline menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
			  <!-- REPAIRS AND REFURBS MENU -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title">Repairs / Refurbs</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="repairs.php">View Repairs</a>
                    </li>
                     <li class="nav-item">
                      <a class="nav-link" href="viewarchivedrepairs.php">View Archived Repairs</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="addnewrepair.php">Add New Repair</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="refurbs.php">View Refurbs</a>
                    </li>
					 <li class="nav-item">
                      <a class="nav-link" href="addnewrefurb.php">Add Refurb</a>
                    </li>
					 <li class="nav-item">
                      <a class="nav-link" href="tapiwarefurbs.php">Tapiwa Refurbs</a>
                    </li>
                  </ul>
                </div>
              </li>
			  <!-- END REPAIRS AND REFURBS MENU -->
             
             
            </ul>
          </div>
        </nav>
      </div>
      <!-- TOP BODY -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
              <div class="header-left">
                  <a href="repairs.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">View All Repairs</a>
                <a href="addnewrepairs.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">Add New Repair</a>
               <a href="addnewrefurb.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">Add New Refurb</a>
               
              </div>
                      </div>
			 <div class="row">
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                     
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                       <p> Welcome to ECEMS v1.2 BETA, If you need help with navigating your way around ECEMS, please whatsapp Lee-Roy for assistance on 071 984 5522.
              </div>
            
            </div>
           
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- first row starts here -->
            <div class="row">
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                      <div>
                        <div class="card-title mb-0">Repairs Overview</div>
                       
                      </div>
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                        <div class="d-flex mr-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-social-icon btn-outline-sales">
                              <i class="mdi mdi-notification-clear-all"></i>
                            </button>
                            <div class="pl-2">
                              <h4 class="mb-0 font-weight-semibold head-count">  <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT COUNT(*) AS num FROM repairs WHERE current_status = 'Pending'";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> </h4>
                              <span class="font-10 font-weight-semibold text-muted">PENDING</span>
                            </div>
                          </div>
                          <div class="d-flex mr-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-social-icon btn-outline-sales profit">
                              <i class="mdi mdi-notification-clear-all"></i>
                            </button>
                            <div class="pl-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT COUNT(*) AS num FROM repairs WHERE current_status = 'In Progress'";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> </h4>
                              <span class="font-10 font-weight-semibold text-muted">IN PROGRESS</span>
                            </div>
                          </div>
						   <div class="d-flex mr-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-social-icon btn-outline-sales profit">
                              <i class="mdi mdi-notification-clear-all"></i>
                            </button>
                            <div class="pl-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT COUNT(*) AS num FROM repairs WHERE current_status = 'On Hold Spares Required'";
$sql = "SELECT COUNT(*) AS num FROM repairs WHERE current_status = 'On Hold Other Fault'";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> </h4>
                              <span class="font-10 font-weight-semibold text-muted">ON HOLD</span>
                            </div>
                          </div>
                           <div class="d-flex mr-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-social-icon btn-outline-sales profit">
                              <i class="mdi mdi-notification-clear-all"></i>
                            </button>
                            <div class="pl-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT COUNT(*) AS num FROM repairs WHERE current_status = 'Repair Completed'";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> </h4>
                              <span class="font-10 font-weight-semibold text-muted">COMPLETED</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
			 <!-- first row starts here -->
			 
           
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © EC E-Waste Management (Pty) Ltd 2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="https://www.kandomedia.co.za/" target="_blank">Developed by Lee-Roy from</a> Kando Media (Pty) Ltd</span>
              </div>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/flot/jquery.flot.js"></script>
    <script src="assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="assets/vendors/flot/jquery.flot.stack.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>