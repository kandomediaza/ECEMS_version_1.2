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
<?php
require_once 'connection.php';
if(isset($_REQUEST['update_id']))
{
 try
 {
  $job_number = $_REQUEST['update_id']; 
  $select_stmt = $db->prepare('SELECT * FROM repairs WHERE job_number =:job_number'); 
  $select_stmt->bindParam(':job_number',$job_number,PDO::PARAM_STR);
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
 
                $job_number = $_REQUEST['job_number'];
                $date = $_REQUEST['date'];
                $client_full_name = filter_var($_REQUEST['client_full_name'], FILTER_SANITIZE_STRING);
                $client_email = filter_var($_REQUEST['client_email'], FILTER_SANITIZE_EMAIL);
               $client_phone = filter_var($_REQUEST['client_phone'], FILTER_SANITIZE_STRING);
                $item_for_repair = filter_var($_REQUEST['item_for_repair'], FILTER_SANITIZE_STRING);
                $repair_description = filter_var($_REQUEST['repair_description'], FILTER_SANITIZE_STRING);
                $hardware_details = filter_var($_REQUEST['hardware_details'], FILTER_SANITIZE_STRING);
                $diagnostic_fee = filter_var($_REQUEST['diagnostic_fee'], FILTER_SANITIZE_STRING);
                $tech_assigned = filter_var($_REQUEST['tech_assigned'], FILTER_SANITIZE_STRING);
                $current_status = filter_var($_REQUEST['current_status'], FILTER_SANITIZE_STRING);
                $technician_notes = filter_var($_REQUEST['technician_notes'], FILTER_SANITIZE_STRING);
                $admin_notes = filter_var($_REQUEST['admin_notes'], FILTER_SANITIZE_STRING);
                $invoice_status = filter_var($_REQUEST['invoice_status'], FILTER_SANITIZE_STRING);
                $invoice_number = filter_var($_REQUEST['invoice_number'], FILTER_SANITIZE_STRING);
  
  {
  try
  {
      
   if(!isset($errorMsg))
   {
       $update_stmt=$db->prepare('UPDATE repairs SET job_number=:job_number, date=:date, client_full_name=:client_full_name, client_email=:client_email, client_phone=:client_phone, item_for_repair=:item_for_repair, repair_description=:repair_description, hardware_details=:hardware_details, diagnostic_fee=:diagnostic_fee, tech_assigned=:tech_assigned, current_status=:current_status, technician_notes=:technician_notes, admin_notes=:admin_notes, invoice_status=:invoice_status, invoice_number=:invoice_number WHERE job_number=:job_number'); 

                $update_stmt->bindParam(':job_number', $job_number, PDO::PARAM_INT);
                $update_stmt->bindParam(':date', $date);
                $update_stmt->bindParam(':client_full_name', $client_full_name, PDO::PARAM_STR);
                $update_stmt->bindParam(':client_email', $client_email, PDO::PARAM_STR);
                $update_stmt->bindParam(':client_phone', $client_phone, PDO::PARAM_STR);
                $update_stmt->bindParam(':item_for_repair', $item_for_repair, PDO::PARAM_STR);
                $update_stmt->bindParam(':repair_description',$repair_description, PDO::PARAM_STR);
                $update_stmt->bindParam(':hardware_details', $hardware_details, PDO::PARAM_STR);
                $update_stmt->bindParam(':diagnostic_fee', $diagnostic_fee, PDO::PARAM_STR);
                $update_stmt->bindParam(':tech_assigned', $tech_assigned, PDO::PARAM_STR);
                $update_stmt->bindParam(':current_status', $current_status, PDO::PARAM_STR);
                $update_stmt->bindParam(':technician_notes', $technician_notes, PDO::PARAM_STR);
                $update_stmt->bindParam(':admin_notes', $admin_notes, PDO::PARAM_STR);
                $update_stmt->bindParam(':invoice_status', $invoice_status, PDO::PARAM_STR);
                $update_stmt->bindParam(':invoice_number', $invoice_number, PDO::PARAM_STR);   
     
    if($update_stmt->execute())
    {
     $updateMsg="Record Update Successfully. Refreshing in 3 seconds."; 
     header("refresh:3;repairs.php"); 
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
                         <?php
if(isset($errorMsg)){
?>
    <div class="alert alert-danger">
        <strong>ERROR ! <?php echo $errorMsg; ?></strong>
    </div>
<?php
}
if(isset($updateMsg)){
?>
 <div class="alert alert-success">
  <strong>UPDATED ! <?php echo $updateMsg; ?></strong>
 </div>
<?php
}
?> 
<form method="post" class="form-horizontal" action="">
     
 <div class="form-group">
 <label class="col-sm-3 control-label">Job Number</label>
 <div class="col-sm-12">
 <input type="text" name="job_number" class="form-control" value="<?php echo $job_number; ?>" readonly>
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Date Repair Booked in</label>
 <div class="col-sm-12">
 <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" readonly>
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
 <?php
       //databse connection Sting
  
   

    //insertion function
    $smt = $db->prepare('select DISTINCT item_for_repair From repairs WHERE job_number=:job_number');
      $smt->bindParam(':job_number',$job_number,PDO::PARAM_STR);
$smt->execute();
$data = $smt->fetchAll();
?>
  <div class="form-group">
     <label class="col-sm-3 control-label">Item For Repair</label>
<div class="col-sm-12">
<select name="item_for_repair" id="item_for_repair">
<?php foreach ($data as $row): ?>
    <option><?=$row["item_for_repair"]?></option>
    
<?php endforeach ?>
</select>

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
<?php
       //databse connection Sting
   $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
   

    //insertion function
    $smt = $db->prepare('select DISTINCT tech_assigned From repairs WHERE job_number=:job_number');
      $smt->bindParam(':job_number',$job_number,PDO::PARAM_STR);
$smt->execute();
$data = $smt->fetchAll();
?>
  <div class="form-group">
     <label class="col-sm-3 control-label">Technician Assigned</label>
<div class="col-sm-12">
<select name="tech_assigned" id="tech_assigned">
<?php foreach ($data as $row): ?>
    <option><?=$row["tech_assigned"]?></option>
<?php endforeach ?>
</select>

    </div>
    </div>
<?php
       //databse connection Sting
   $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
   

    //insertion function
    $smt = $db->prepare('select DISTINCT current_status From repairs WHERE job_number=:job_number');
      $smt->bindParam(':job_number',$job_number,PDO::PARAM_STR);
$smt->execute();
$data = $smt->fetchAll();
?>
  <div class="form-group">
     <label class="col-sm-3 control-label">Current Status</label>
<div class="col-sm-12">
<select name="current_status" id="current_status">
<?php foreach ($data as $row): ?>
    <option><?=$row["current_status"]?></option>
<?php endforeach ?>
</select>

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
 <?php
       //databse connection Sting
   $db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
   

    //insertion function
    $smt = $db->prepare('select DISTINCT invoice_status From repairs WHERE job_number=:job_number');
      $smt->bindParam(':job_number',$job_number,PDO::PARAM_STR);
$smt->execute();
$data = $smt->fetchAll();
?>
  <div class="form-group">
     <label class="col-sm-3 control-label">Current Status</label>
<div class="col-sm-12">
<select name="invoice_status" id="invoice_status">
<?php foreach ($data as $row): ?>
    <option><?=$row["invoice_status"]?></option>
<?php endforeach ?>
</select>

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