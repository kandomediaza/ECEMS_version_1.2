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
       $stmt = $db->prepare("SELECT MAX(recID) AS max_id FROM daily_recyclables");
  $stmt -> execute();
  $recID = $stmt -> fetch(PDO::FETCH_ASSOC);
  $max_id = $recID['max_id'];
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
                 <a href="dailyrecyclables_employee.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">View Recyclables for <?php echo date('F, Y'); ?></a>
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
                            <h3>Add Daily Recyclables</h3>
                       <p><b>IMPORTANT NOTICE:</b> If not capturing a specific material, please enter "<b>0</b>". <b>DO NOT LEAVE THE FIELD BLANK</b>. Simply choose the date below, and enter the values omitting the KG symbols. Just enter a number for example: copper: 100.</p>
                       </div>
            
            </div>
               <!-- first row starts here -->
            <div class="row table-responsive col-md-12">
               
            <form action="addrecyclablesprocess.php" method="POST">
         
         
        <div class="form-group">
      <label for="recID">Entry ID (AUTO)</label>
      <input type="recID" name="recID" id="recID" class="form-control" value="<?php echo $max_id+1;?>" readonly>
    </div> 
         
      <div class="form-group">
      <label for="date">Date</label>
      <input type="date" name="date" id="date" class="form-control" placeholder="Enters Todays Date">
    </div>


         <div class="form-group">
      <label for="subgrade">Subgrade</label>
      <input type="text" name="subgrade" class="form-control" id="subgrade" placeholder="Example 100">
    </div>
    
     <div class="form-group">
      <label for="castaluminium">Cast Aluminium</label>
      <input type="text" name="castaluminium" class="form-control" id="castaluminium" placeholder="Example 100">
    </div>
    
    <div class="form-group">
      <label for="copper">Copper</label>
      <input type="text" name="copper" class="form-control" id="copper" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="stainlesssteel">Stainless Steel</label>
      <input type="text" name="stainlesssteel" class="form-control" id="stainlesssteel" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="plastic">Plastic</label>
      <input type="text" name="plastic" class="form-control" id="plastic" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="batteries">Batteries</label>
      <input type="text" name="batteries" class="form-control" id="batteries" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="brass">Brass</label>
      <input type="text" name="brass" class="form-control" id="brass" placeholder="Example 100">
    </div>
     <div class="form-group">
      <label for="cables">Cables</label>
      <input type="text" name="cables" class="form-control" id="cables" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="lowgradePCB">Low Grade PCB</label>
      <input type="text" name="lowgradePCB" class="form-control" id="lowgradePCB" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="mediumgradePCB">Medium Grade PCB</label>
      <input type="text" name="mediumgradePCB" class="form-control" id="mediumgradePCB" placeholder="Example 100">
    </div>
      <div class="form-group">
      <label for="highgradePCB">High Grade PCB</label>
      <input type="text" name="highgradePCB" class="form-control" id="highgradePCB" placeholder="Example 100">
    </div>
    
<input type="submit" id="btn_create" name="btn_create" class="btn btn-primary" value="Submit Values">

    </form>
            
            </div>
                      </div>
                    </div>
                  </div>
                </div>
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