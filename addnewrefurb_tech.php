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
      $stmt = $db->prepare("SELECT MAX(job_number) AS max_id FROM refurbs");
  $stmt -> execute();
  $job_number = $stmt -> fetch(PDO::FETCH_ASSOC);
  $max_id = $job_number['max_id'];
  ?>
<?php

if(isset($_REQUEST['btn_create']))
{
    $job_number = filter_var($_REQUEST['job_number'], FILTER_SANITIZE_STRING);
    $date = $_REQUEST['date'];
    $Refurb_Type = filter_var($_REQUEST['Refurb_Type'], FILTER_SANITIZE_STRING);
    $Tech_Assigned = filter_var($_REQUEST['Tech_Assigned'], FILTER_SANITIZE_EMAIL);
    $Operating_System = filter_var($_REQUEST['Operating_System'], FILTER_SANITIZE_STRING);
    $Processor = filter_var($_REQUEST['Processor'], FILTER_SANITIZE_STRING);
    $RAM = filter_var($_REQUEST['RAM'], FILTER_SANITIZE_STRING);
    $HDD_Size = filter_var($_REQUEST['HDD_Size'], FILTER_SANITIZE_STRING);
    $HD_Type = filter_var($_REQUEST['HD_Type'], FILTER_SANITIZE_STRING);
    $Technician_Notes = filter_var($_REQUEST['Technician_Notes'], FILTER_SANITIZE_STRING);
   
 if(empty($job_number)){
  $errorMsg="Job Number Could Not Be Generated. Please contact Master of Matrix to fix this...";
 }
 if(empty($date)){
  $errorMsg="Date cannot be empty";
 }
 else if(empty($Refurb_Type)){
  $errorMsg="Please select a refurb type";
 }
 
 else
 {
  try
  {
   if(!isset($errorMsg))
   {
    $insert_stmt=$db->prepare('INSERT INTO refurbs(job_number,date,Refurb_Type,Tech_Assigned,Operating_System,Processor,RAM,HDD_Size,HD_Type,Technician_Notes) VALUES(:job_number,:date,:Refurb_Type,:Tech_Assigned,:Operating_System,:Processor,:RAM,:HDD_Size,:HD_Type,:Technician_Notes)');    
    
                $insert_stmt->bindParam(':job_number', $job_number, PDO::PARAM_INT);
                $insert_stmt->bindParam(':date', $date);
                $insert_stmt->bindParam(':Refurb_Type', $Refurb_Type, PDO::PARAM_STR);
                $insert_stmt->bindParam(':Tech_Assigned', $Tech_Assigned, PDO::PARAM_STR);
                $insert_stmt->bindParam(':Operating_System', $Operating_System, PDO::PARAM_STR);
                $insert_stmt->bindParam(':Processor', $Processor, PDO::PARAM_STR);
                $insert_stmt->bindParam(':RAM',$RAM, PDO::PARAM_STR);
                $insert_stmt->bindParam(':HDD_Size', $HDD_Size, PDO::PARAM_STR);
                $insert_stmt->bindParam(':HD_Type', $HD_Type, PDO::PARAM_STR);
                $insert_stmt->bindParam(':Technician_Notes', $Technician_Notes, PDO::PARAM_STR);
                
    if($insert_stmt->execute())
    {
     $insertMsg="What a champ! Refurb Created Successfully........This form will refresh in 3 seconds."; 
     header( "refresh:3;url=addnewrefurb_tech.php" ); 
    }
   }
  }
  catch(Exception $e)
  {
   echo "An error has occured on ECEMS. Please Contact System Admin, Lee-Roy - Master of Matrix";
   }
 }
}
?>
<?php 
if(isset($_REQUEST['btn_create'])){
    $to = "info@refurbsa.com"; // this is your Email address
    $from = "notifications@ecems.co.za"; // this is the sender's Email address
     $from_mail = "notifications@ecems.co.za"; // this is the sender's Email address 
    $from_name = "ECEMS System"; // this is the sender's Name
   $job_number = $_POST['job_number'];
    $date = $_POST['date'];
    $Tech_Assigned = $_POST['Tech_Assigned'];
    $Refurb_Type = $_POST['Refurb_Type'];
    $Processor = $_POST['Processor'];
     $subject = "$Tech_Assigned has added a new refurbed $Refurb_Type to ECEMS";
       $message = "Hi Admin. $Tech_Assigned has just added a refurbed $Processor $Refurb_Type to ECEMS on $date. Please Quality Check this $Refurb_Type, and add it to SAGE Inventory before placing this item in reception to be sold.";
      $headers .= "From: ".$from_name." <".$from_mail."> \r\n";
       $headers .= 'Cc: admin@ecems.co.za' . "\r\n";
    mail($to,$subject,$message,$headers);
        
    }
?>
 <!DOCTYPE html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>ECEMS Management System | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
                            <h3>Add New Refurb to ECEMS (Computers)</h3>
                       <p>Whats up <b><?php echo $_SESSION['tech_login'] ?></b>! Please use the form below to record your new refurb. Please only press the <b>CREATE REFURB</b> buttone ONCE. Pressing it more than once will create multiple entries of the same refurb. If you have done this by mistake, please contact your General Manager Lee-Roy for assistance.</p>
              </div>
            
            </div>
           <?php 
            if(isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <strong><?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php 
            if(isset($insertMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $insertMsg; ?></strong>
            </div>
        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- first row starts here -->
            <div class="row table-responsive col-md-12">
               
            <form action="" method="POST">
         
         
        <div class="form-group">
      <label for="job_number">Job Number</label>
      <input type="text" name="job_number" id="job_number" class="form-control" value="<?php echo $max_id+1;?>" readonly>
    </div> 
                 <div class="form-group">
      <label for="date">Date</label>
      <input type="date" name="date" id="date" class="form-control" placeholder="Job Card Date">
    </div>
<div class="form-group">
     <label for="item_for_repair">Refurb Type</label>

<select class="form-select" aria-label="Refurb_Type" name="Refurb_Type">
  <option selected>Open this select menu</option>
  <option value="Laptop">Laptop</option>
  <option value="Desktop PC">Desktop PC</option>
  <option value="Other">Other</option>
</select>
    </div>
    <div class="form-group">
     <label for="item_for_repair">Technician Name</label>

<select class="form-select" aria-label="Tech_Assigned" name="Tech_Assigned">
  <option selected>Open this select menu</option>
  <option value="Brendon">Brendon</option>
  <option value="Gabriel">Gabriel</option>
</select>
    </div>
     <div class="form-group">
      <label for="Operating_System">Operating System</label>
      <input type="text" name="Operating_System" id="Operating_System" class="form-control">
    </div> 
       <div class="form-group">
      <label for="Processor">Processor</label>
      <input type="text" name="Processor" id="Processor" class="form-control">
    </div> 
       <div class="form-group">
      <label for="RAM">RAM</label>
      <input type="text" name="RAM" id="RAM" class="form-control">
    </div> 
       <div class="form-group">
      <label for="HDD_Size">Hard Drive Size</label>
      <input type="text" name="HDD_Size" id="HDD_Size" class="form-control">
    </div> 
    <div class="form-group">
     <label for="HD_Type">Hard Drive Type</label>

<select class="form-select" aria-label="HD_Type" name="HD_Type">
  <option selected>Open this select menu</option>
  <option value="Normal HDD">Normal HDD</option>
  <option value="SSD">SSD</option>
  <option value="NVME">NVME</option>
  <option value="M.2">M.2</option>
  <option value="MLC SATA Module">MLC SATA Module</option>
</select>
    </div>
    
      <div class="form-group">
      <label for="Technician_Notes">Technician Notes</label>
      <input type="text" name="Technician_Notes" class="form-control" id="Technician_Notes">
    </div>
 
  
<input type="submit" id="btn_create" name="btn_create" class="btn btn-primary" value="Create Refurb">

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