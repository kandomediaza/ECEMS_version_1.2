<?php
require_once 'connection.php';

  session_start();

  if(!isset($_SESSION['admin_login'])) //check unauthorize user not direct access in "admindashboard.php" page
  {
   header("location: index.php");  
  }

  if(isset($_SESSION['employee_login'])) //check employee login user not access in "admin_home.php" page
  {
   header("location: employeedashboard.php"); 
  }

  if(isset($_SESSION['tech_login'])) //check user login user not access in "admin_home.php" page
  {
   header("location: techdashboard.php");
  }
  
  if(isset($_SESSION['admin_login']))
  {
      $stmt = $db->prepare("SELECT MAX(job_number) AS max_id FROM repairs");
  $stmt -> execute();
  $job_number = $stmt -> fetch(PDO::FETCH_ASSOC);
  $max_id = $job_number['max_id'];
  ?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>ECEMS Management System | Dashboard</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
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
   echo $_SESSION['admin_login'];
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
                <a class="nav-link" href="index.php">
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
                      <a class="nav-link" href="addnewrepair.php">Add New Repairs</a>
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
                      <a class="nav-link" href="dailyrecyclables.php">Daily Recyclables</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Collections</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Drop Offs</a>
                    </li>
					 <li class="nav-item">
                      <a class="nav-link" href="#">Safe Disposal Cert.</a>
                    </li>
					
                  </ul>
                </div>
              </li>
             <!-- END WASTE MANAGEMENT MENU -->
			 <!-- VENDOR MANAGEMENT MENU -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title">Vendor Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="vendors.php">Vendor Registration</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="access-register.php">Access Register</a>
                    </li>
                   
					
                  </ul>
                </div>
              </li>
             <!-- END VENDOR MANAGEMENT MENU -->
			  <!-- SYSTEM SETTINGS MENU -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title">System Settings</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                  <ul class="submenu-item">
                    <li class="nav-item">
                      <a class="nav-link" href="viewusers.php">View System Users</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="addnewuser.php">Add New User</a>
                    </li>
                   
					
                  </ul>
                </div>
              </li>
             <!-- END SYSTEM SETTINGS MENU -->
             
             
             
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
                <a href="addnewrepairs.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">Add New Repairs</a>
               <a href="addnewrefurb.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">Add New Refurb</a>
                <a href="dailyrecyclables.php" class="btn btn-outline-primary mb-2 mb-md-0" role="button">Add Recyclables</a>
              </div>
                      </div>
			 <div class="row">
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                     
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                            <h3>Add New Repair to ECEMS</h3>
                       <p>Please use the form below to generate a Job Card for a customer. Please make sure to capture the customers email address correctly as an email will be sent automatically to the customer with his/her job card number and an online link to track the status of his/her repair.
              </div>
            
            </div>
           
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- first row starts here -->
            <div class="row table-responsive col-md-12">
               
            <form action="addnewrepairprocess.php" method="POST">
         
         
        <div class="form-group">
      <label for="job_number">Job Number</label>
      <input type="job_number" name="job_number" id="job_number" class="form-control" value="<?php echo $max_id+1;?>" readonly>
    </div> 
         
         
         
         
         
         <div class="form-group">
      <label for="date">Date</label>
      <input type="date" name="date" id="date" class="form-control" placeholder="Job Card Date">
    </div>


         <div class="form-group">
      <label for="client_full_name">Client Full Name</label>
      <input type="text" name="client_full_name" class="form-control" id="client_full_name" placeholder="Mr. Laptop Man">
    </div>
    
     <div class="form-group">
      <label for="client_email">Client Email Address</label>
      <input type="email" name="client_email" class="form-control" id="client_email" placeholder="example@live.co.za">
    </div>
    
    <div class="form-group">
      <label for="client_phone">Client Phone Number</label>
      <input type="text" name="client_phone" class="form-control" id="client_phone" placeholder="071 984 5522">
    </div>
    
     <div class="form-group">
     <label for="item_for_repair">Item For Repair</label>

<select class="form-select" aria-label="Default select example" name="item_for_repair">
  <option selected>Open this select menu</option>
  <option value="Laptop">Laptop</option>
  <option value="Desktop">Desktop</option>
  <option value="Television">Television</option>
    <option value="Washing Machine">Washing Machine</option>
      <option value="Tumble Dryer">Tumble Dryer</option>
        <option value="Dishwasher">Dishwasher</option>
          <option value="Microwave">Microwave</option>
            <option value="Fridge">Fridge</option>
            <option value="Printer">Printer</option>
            <option value="Other">Other</option>
</select>
    </div>
    
      <div class="form-group">
      <label for="repair_description">Repair Description</label>
      <input type="text" name="repair_description" class="form-control" id="repair_description" placeholder="Laptop is dead...">
    </div>
    
      <div class="form-group">
      <label for="hardware_details">Hardware Details</label>
      <input type="text" name="hardware_details" class="form-control" id="hardware_details" placeholder="Black Lenovo Laptop with Charger">
    </div>
    
      <div class="form-group">
      <label for="diagnostic_fee">Diagnostic Fee</label>
      <input type="text" name="diagnostic_fee" class="form-control" id="diagnostic_fee">
    </div>
    
     <div class="form-group">
     <label for="tech_assigned">Technician Assigned</label>

<select class="form-select" aria-label="Default select example" name="tech_assigned">
  <option selected>Open this select menu</option>
  <option value="Not Assigned Yet" name="Not Assigned Yet">Not Assigned Yet</option>
  <option value="Brendon" name="Brendon">Brendon</option>
  <option value="Gabriel" name="Gabriel">Gabriel</option>
    <option value="Jami" name="Jami">Jami</option>
      <option value="Lee-Roy" name="Lee-Roy">Lee-Roy</option>
        <option value="Conrad" name="Conrad">Conrad</option>
          <option value="Tapiwa" name="Tapiwa">Tapiwa</option>
          
</select>
    </div>
    
     <div class="form-group">
     <label for="current_status">Current Status</label>

<select class="form-select" aria-label="Default select example" name="current_status">
  <option selected>Open this select menu</option>
  <option value="Pending" name="Pending">Pending</option>
  <option value="In Progress" name="In Progress">In Progress</option>
  <option value="On Hold Spares Required" name="On Hold Spares Required">On Hold Spares Required</option>
    <option value="On Hold Other Fault" name="On Hold Other Fault">On Hold Other Fault</option>
      <option value="Repair Completed" name="Repair Completed">Repair Completed</option>
       </select>
    </div>
    
      <div class="form-group">
      <label for="technician_notes">Technician Notes</label>
      <input type="text" name="technician_notes" class="form-control" id="technician_notes">
    </div>
    
       <div class="form-group">
      <label for="admin_notes">Admin Notes</label>
      <input type="text" name="admin_notes" class="form-control" id="admin_notes">
          </div>
          
         <div class="form-group">
     <label for="invoice_status">Invoice Status</label>

<select class="form-select" aria-label="Default select example" name="invoice_status">
  <option selected>Open this select menu</option>
  <option value="Client Not Yet Invoiced" name="Client Not Yet Invoiced">Client Not Yet Invoiced</option>
  <option value="Client Invoiced" name="Client Invoiced">Client Invoiced</option>
        </select>
    </div>
    
     <div class="form-group">
      <label for="invoice_number">Invoice Number</label>
      <input type="text" name="invoice_number" class="form-control" id="invoice_number">
          </div>
<input type="submit" id="btn_create" name="btn_create" class="btn btn-primary" value="Create Job Card">

    </form>
            
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
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