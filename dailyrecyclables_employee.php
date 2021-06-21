<?php

require_once "connection.php";

 session_start();

  if(!isset($_SESSION['employee_login'])) //check unauthorize user not direct access in "admindashboard.php" page
  {
   header("location: index.php");  
  }

  if(isset($_SESSION['admin_login'])) //check employee login user not access in "admin_home.php" page
  {
   header("location:admindashboard.php"); 
  }

  if(isset($_SESSION['tech_login'])) //check user login user not access in "admin_home.php" page
  {
   header("location: techdashboard.php");
  }
  
  if(isset($_SESSION['employee_login']))
  {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>ECEMS v1.2 - Waste Management System | Employee Dashboard</title>
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
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
              <a class="navbar-brand brand-logo" href="index.php">
                <img src="ecemslogo.png" alt="logo" />
                <span class="font-12 d-block font-weight-light">Version 1.2 Beta</span>
              </a>
              <a class="navbar-brand brand-logo-mini" href="index.php"><img src="ecemslogo.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                                </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                   
                    <div class="nav-profile-text">
                      <p class="text-black font-weight-semibold m-0"><?php
   echo $_SESSION['employee_login'];
  }
  ?></p>
                      <span class="font-13 online-color">Status: online</span>
                    </div>
                  </a>
                  
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
                <a class="nav-link" href="index.php">
                  <i class="mdi mdi-compass-outline menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
			 
             <!-- WASTE MANAGEMENT MENU -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title">Waste Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="dailyrecyclables_employee.php">Daily Recyclables</a>
                    </li>
                                    </ul>
                </div>
              </li>
             <!-- END WASTE MANAGEMENT MENU -->
              <!-- PROFILE SETTINGS MENU -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title"><?php
   echo $_SESSION['employee_login']
  ?> Settings</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                       <li class="nav-item">
                      <a class="nav-link" href="#">Manage Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                                     </ul>
                </div>
              </li>
             <!-- END PROFILE SETTINGS MENU -->
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
                
                <a href="adddailyrecyclables_employee.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">Add Recyclables</a>
              </div>
                      </div>
                      
			 <div class="row">
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                     
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                            <h3>Daily Recyclables</h3>
                       <p>Welcome to the recyclables section. The Stats shown below are based on the current month <b><?php echo date('F, Y'); ?></b>. To add new entries, simply click the ADD RECYCLABLES button.</p>
              </div>
            
            </div>
           
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    <div class="container-fluid">
  <section>
       <div class="row">
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                 <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3> <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(subgrade) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";


//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Subgrade Metals</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(castaluminium) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";
 
//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Cast Aluminium</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                 <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(copper) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Copper</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                 <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(stainlesssteel) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Stainless Steel</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <section>
       <div class="row">
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(brass) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Brass</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                 <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(lowgradePCB) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Low Grade PCB</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                  <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(mediumgradePCB) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Medium Grade PCB</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3><?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(highgradePCB) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">High Grade PCB</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>        
			<div class="container-fluid">
  <section>
       <div class="row">
      <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3> <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(plastic) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Plastic</p>
              </div>
            </div>
          </div>
        </div>
      </div>
 <div class="col-xl-3 col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
              <div class="align-self-center">
                <i class="fas fa-weight text-success fa-3x"></i>
              </div>
              <div class="text-end">
                <h3> <?php
$dbConnection = new PDO('mysql:dbname=ecemscoz_ecemsapp;host=127.0.0.1;charset=utf8', 'ecemscoz_ecemsapp', 'C3m3t3ry!@');
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//The COUNT SQL statement that we will use.
$sql = "SELECT SUM(cables) AS num FROM daily_recyclables WHERE date BETWEEN DATE_FORMAT(curdate() ,'%Y-%m-01') AND curdate()";

//Prepare the COUNT SQL statement.
$stmt = $dbConnection->prepare($sql);

//Execute the COUNT statement.
$stmt->execute();

//Fetch the row that MySQL returned.
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//The $row array will contain "num". Print it out.
echo $row['num'];
?> KG</h3>
                <p class="mb-0">Cables</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div> 
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 
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
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
     <script type="text/javascript">
        jQuery(document).ready(function($){
    $('#DataTable').DataTable();
} );
    </script>
  </body>
</html>