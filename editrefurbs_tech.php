<?php
require_once 'connection.php';

  session_start();

  if(!isset($_SESSION['tech_login'])) //check unauthorize user not direct access in "admindashboard.php" page
  {
   header("location: index.php");  
  }

  if(isset($_SESSION['employee_login'])) //check employee login user not access in "admin_home.php" page
  {
   header("location: employeedashboard.php"); 
  }

  if(isset($_SESSION['admin_login'])) //check user login user not access in "admin_home.php" page
  {
   header("location: admindashboard.php");
  }
  
  if(isset($_SESSION['tech_login']))
  {
?>
<?php
if(isset($_REQUEST['update_id']))
{
 try
 {
  $job_number = $_REQUEST['update_id']; 
  $select_stmt = $db->prepare('SELECT * FROM refurbs WHERE job_number =:job_number'); 
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
                $Refurb_Type = filter_var($_REQUEST['Refurb_Type']);
                $Tech_Assigned = filter_var($_REQUEST['Tech_Assigned'], FILTER_SANITIZE_STRING);
                $Operating_System = filter_var($_REQUEST['Operating_System'], FILTER_SANITIZE_STRING);
                $Processor = filter_var($_REQUEST['Processor'], FILTER_SANITIZE_STRING);
                $RAM = filter_var($_REQUEST['RAM'], FILTER_SANITIZE_STRING);
                $HDD_Size = filter_var($_REQUEST['HDD_Size'], FILTER_SANITIZE_STRING);
                $HD_Type = filter_var($_REQUEST['HD_Type'], FILTER_SANITIZE_STRING);
                $Technician_Notes = filter_var($_REQUEST['Technician_Notes'], FILTER_SANITIZE_STRING);
      
  
  {
  try
  {
      
   if(!isset($errorMsg))
   {
       $update_stmt=$db->prepare('UPDATE refurbs SET job_number=:job_number, date=:date, Refurb_Type=:Refurb_Type, Tech_Assigned=:Tech_Assigned, Operating_System=:Operating_System, Processor=:Processor, RAM=:RAM, HDD_Size=:HDD_Size, HD_Type=:HD_Type, Technician_Notes=:Technician_Notes WHERE job_number=:job_number'); 

                $update_stmt->bindParam(':job_number', $job_number, PDO::PARAM_INT);
                $update_stmt->bindParam(':date', $date);
                $update_stmt->bindParam(':Refurb_Type', $Refurb_Type);
                $update_stmt->bindParam(':Tech_Assigned', $Tech_Assigned, PDO::PARAM_STR);
                $update_stmt->bindParam(':Operating_System',$Operating_System, PDO::PARAM_STR);
                $update_stmt->bindParam(':Processor', $Processor, PDO::PARAM_STR);
                $update_stmt->bindParam(':RAM', $RAM, PDO::PARAM_STR);
                $update_stmt->bindParam(':HDD_Size', $HDD_Size, PDO::PARAM_STR);
                $update_stmt->bindParam(':HD_Type', $HD_Type, PDO::PARAM_STR);
                $update_stmt->bindParam(':Technician_Notes', $Technician_Notes, PDO::PARAM_STR);
                
    if($update_stmt->execute())
    {
     $updateMsg="Record Update Successful. Refreshing in 3 seconds."; 
     header("refresh:3;refurbs_tech.php"); 
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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
             
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                   
                    <div class="nav-profile-text">
                      <p class="text-black font-weight-semibold m-0"><?php
   echo $_SESSION['tech_login'];
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
                      <a class="nav-link" href="repairs_tech.php">View Repairs</a>
                    </li>
                   <li class="nav-item">
                      <a class="nav-link" href="refurbs_tech.php">View Refurbs</a>
                    </li>
					 <li class="nav-item">
                      <a class="nav-link" href="addnewrefurb_tech.php">Add Refurb</a>
                    </li>
				                  </ul>
                </div>
              </li>
			  <!-- END REPAIRS AND REFURBS MENU -->
              <!-- PROFILE SETTINGS MENU -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                  <span class="menu-title">Settings</span>
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
                 
              </div>
                      </div>
			 <div class="row">
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                     
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                            <h3>View | Edit Refurb <b>JC<?php echo $row['job_number']; ?></b></h3>
                       <p>This section allows you to view and update refurb details for <b>JC<?php echo $row['job_number']; ?> </b>  Please note that you cannot change the job number as this is automatically assigned during the adding of this refurb. You cannot edit the date either.. Once you have updated the details you need to update, please press the <b>UPDATE</b> button once to update the record into the ECEMS database. If you want to go back to the refurbs page without making changes, simply press the <b>CANCEL</b> button below, otherwise you will be redirected after pressing the update button.
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
 <input type="text" name="job_number" class="form-control" value="<?php echo htmlspecialchars($job_number, ENT_QUOTES); ?>" readonly>
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Date</label>
 <div class="col-sm-12">
 <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($date, ENT_QUOTES); ?>" readonly>
 </div>
 </div>
<div class="form-group">
     <label class="col-sm-3 control-label">Refurb Type</label>
<div class="col-sm-12">
<select name="Refurb_Type" id="Refurb_Type">
    <option value="Laptop" <?= $Refurb_Type === 'Laptop' ? 'selected' : '' ?>>Laptop</option>
    <option value="Desktop PC" <?= $Refurb_Type === 'Desktop PC' ? 'selected' : '' ?>>Desktop PC</option>
    <option value="Other" <?= $Refurb_Type === 'Other' ? 'selected' : '' ?>>Other</option>
    </select>
    </div>
    </div>
<div class="form-group">
     <label class="col-sm-3 control-label">Technician Assigned</label>
<div class="col-sm-12">
<select name="Tech_Assigned" id="Tech_Assigned">
    <option value="Not Assigned Yet" <?= $Tech_Assigned === 'Not Assigned Yet' ? 'selected' : '' ?>>Not Assigned Yet</option>
    <option value="Brendon" <?= $Tech_Assigned === 'Brendon' ? 'selected' : '' ?>>Brendon</option>
    <option value="Gabriel" <?= $Tech_Assigned === 'Gabriel' ? 'selected' : '' ?>>Gabriel</option>
    </select>
    </div>
    </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">Operating System</label>
 <div class="col-sm-12">
 <input type="text" name="Operating_System" class="form-control" value="<?php echo htmlspecialchars($Operating_System, ENT_QUOTES); ?>">
 </div>
 </div>
   <div class="form-group">
 <label class="col-sm-3 control-label">Processor</label>
 <div class="col-sm-12">
 <input type="text" name="Processor" class="form-control" value="<?php echo htmlspecialchars($Processor, ENT_QUOTES); ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">RAM</label>
 <div class="col-sm-12">
 <input type="text" name="RAM" class="form-control" value="<?php echo htmlspecialchars($RAM, ENT_QUOTES); ?>">
 </div>
 </div>
  <div class="form-group">
 <label class="col-sm-3 control-label">HDD_Size</label>
 <div class="col-sm-12">
 <input type="text" name="HDD_Size" class="form-control" value="<?php echo htmlspecialchars($HDD_Size, ENT_QUOTES); ?>">
 </div>
 </div>
  <div class="form-group">
     <label class="col-sm-3 control-label">Hard Drive Type</label>
<div class="col-sm-12">
<select name="HD_Type" id="HD_Type">
    <option value="Normal HDD" <?= $HD_Type === 'Normal HDD' ? 'selected' : '' ?>>Normal HDD</option>
    <option value="SSD" <?= $HD_Type === 'SSD' ? 'selected' : '' ?>>SSD</option>
        <option value="NVME" <?= $HD_Type === 'NVME' ? 'selected' : '' ?>>NVME</option>
            <option value="M.2" <?= $HD_Type === 'M.2' ? 'selected' : '' ?>>M.2</option>
                <option value="MLC SATA Module" <?= $HD_Type === 'MLC SATA Module' ? 'selected' : '' ?>>MLC SATA Module</option>
    </select>
    </div>
    </div>
     <div class="form-group">
 <label class="col-sm-3 control-label">Technician Notes</label>
 <div class="col-sm-12">
 <input type="text" name="technician_notes" class="form-control" value="<?php echo htmlspecialchars($technician_notes, ENT_QUOTES); ?>">
 </div>
 </div>
  <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit" name="btn_update" class="btn btn-primary" value="Update">
  <a href="repairs_tech.php" class="btn btn-danger">Cancel</a>
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