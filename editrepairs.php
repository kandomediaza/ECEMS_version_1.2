<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
 try
 {
  $job_number = $_REQUEST['update_id']; 
  $select_stmt = $db->prepare('SELECT * FROM repairs WHERE job_number =:job_number'); 
  $select_stmt->bindParam(':job_number',$job_number);
  $select_stmt->execute(); 
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
  extract($row);
 }
 catch(PDOException $e)
 {
  $e->getMessage();
 }
 
}

if(isset($_REQUEST['btn_update']))
{
 
 $job_number_up = $_REQUEST['job_number'];
 $client_full_name_up = $_REQUEST['client_full_name'];
  
 if(empty($firstname_up)){
  $errorMsg="Please Enter Firstname";
 }
 else if(empty($lastname_up)){
  $errorMsg="Please Enter Lastname";
 } 
 else
 {
  try
  {
   if(!isset($errorMsg))
   {
    $update_stmt=$db->prepare('UPDATE repairs SET firstname=:fname_up, lastname=:lname_up WHERE id=:id'); 
    $update_stmt->bindParam(':fname_up',$firstname_up);
    $update_stmt->bindParam(':lname_up',$lastname_up); 
    $update_stmt->bindParam(':id',$id);
     
    if($update_stmt->execute())
    {
     $updateMsg="Record Update Successfully......."; 
     header("refresh:3;index.php"); 
    }
   } 
  }
  catch(PDOException $e)
  {
   echo $e->getMessage();
  } 
 } 
}
?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    
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
                            <h3>View | Edit Repair <b>JC<?php echo $row['job_number']; ?></b> for <b><?php echo $row['client_full_name']; ?></b></h3>
                       <p>This section allows you to view and update repair details for <b>JC<?php echo $row['job_number']; ?> </b> for client  <b><?php echo $row['client_full_name']; ?></b>. Please note that you cannot change the job number as this is automatically assigned during the add new repair function. Once you have updated the details you need to update, please press the <b>UPDATE</b> button once to update the record into the ECEMS database. If you want to go back to the repairs page, simply press the <b>CANCEL</b> button below.
              </div>
            
            </div>
           
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- first row starts here -->
            <div class="row table-responsive col-md-12">
                
           <?php
if(isset($errorMsg)){
?>
    <div class="alert alert-danger">
        <strong>WRONG ! <?php echo $errorMsg; ?></strong>
    </div>
<?php
}
if(isset($updateMsg)){
?>
 <div class="alert alert-success">
  <strong>UPDATE ! <?php echo $updateMsg; ?></strong>
 </div>
<?php
}
?>
<form method="post" class="form-horizontal">
     
 <div class="form-group">
 <label class="col-sm-3 control-label">Job Number</label>
 <div class="col-sm-12">
 <input type="text" name="job_number" class="form-control" value="<?php echo $job_number; ?>" readonly>
 </div>
 </div>
     
 <div class="form-group">
 <label class="col-sm-3 control-label">Client Full Name</label>
 <div class="col-sm-12">
 <input type="text" name="client_full_name" class="form-control" value="<?php echo $client_full_name; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Client Email</label>
 <div class="col-sm-12">
 <input type="text" name="client_email" class="form-control" value="<?php echo $client_email; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Client Phone Number</label>
 <div class="col-sm-12">
 <input type="text" name="client_phone" class="form-control" value="<?php echo $client_phone; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Item For Repair</label>
 <div class="col-sm-12">
 <input type="text" name="item_for_repair" class="form-control" value="<?php echo $item_for_repair; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Repair Description</label>
 <div class="col-sm-12">
 <input type="text" name="repair_description" class="form-control" value="<?php echo $repair_description; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Hardware Details</label>
 <div class="col-sm-12">
 <input type="text" name="hardware_details" class="form-control" value="<?php echo $hardware_details; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Diagnostic Fee</label>
 <div class="col-sm-12">
 <input type="text" name="diagnostic_fee" class="form-control" value="<?php echo $diagnostic_fee; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Assigned Technician</label>
 <div class="col-sm-12">
 <input type="text" name="tech_assigned" class="form-control" value="<?php echo $tech_assigned; ?>" readonly>
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Current Status</label>
 <div class="col-sm-12">
 <input type="text" name="current_status" class="form-control" value="<?php echo $current_status; ?>" >
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Technician Notes</label>
 <div class="col-sm-12">
 <input type="text" name="technician_notes" class="form-control" value="<?php echo $technician_notes; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Admin Notes</label>
 <div class="col-sm-12">
 <input type="text" name="admin_notes" class="form-control" value="<?php echo $admin_notes; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Invoice Status</label>
 <div class="col-sm-12">
 <input type="text" name="invoice_status" class="form-control" value="<?php echo $invoice_status; ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Invoice Number</label>
 <div class="col-sm-12">
 <input type="text" name="invoice_number" class="form-control" value="<?php echo $invoice_number; ?>">
 </div>
 </div>
      
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit" name="btn_update" class="btn btn-primary" value="Update">
  <a href="repairs.php" class="btn btn-danger">Cancel</a>
 </div>
 </div>
   
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>
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