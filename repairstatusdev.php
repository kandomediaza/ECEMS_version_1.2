<!DOCTYPE html>
<html lang="en">
<head>
<title>Refurb.SA Repair Status Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">    
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://www.markuptag.com/bootstrap/5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="text-center">
<div class="col-md-12">
<div class="login-form bg-light mt-4 p-4">
<div class="text-center">
<img src="http://refurbsa.com/images/logocs-1.png" width="300" height="auto"><br><br>
<h4>Check Your Repair Status</h4>
</div>
<br>
<form action="" method="POST" class="row g-3">
<div class="col-12">
<label>Job Card Number</label>
<br><br>
<input type="text" name="job_number" class="form-control" required="required" oninvalid="this.setCustomValidity('Please Enter Your Job Number')"
 oninput="setCustomValidity('')">
</div>
<div class="col-md-12">
<button type="submit" name="btn_get_status" id="btn_get_status" class="btn btn-dark float-end">Check Status</button>
</div>
</form>
<hr class="mt-4">
<div class="col-12">
   
  <?php
  if(isset($_POST['btn_get_status']))

{
 // Connection code. 
$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new \PDO('mysql:host=localhost;port=3306;dbname=ecemscoz_ecemsapp;charset=utf8mb4', 'ecemscoz_ecemsapp', 'C3m3t3ry!@', $options);

// Prepared statement
$stmt = $pdo->prepare('SELECT * FROM repairs WHERE job_number=?');
$stmt->execute([$_POST['job_number']]);
$exists = $stmt->fetch();

if ($exists) {
    
  
      
echo "<html>\n";
echo "<head></head>\n";
echo "<body>\n";
echo "Hello {$exists['client_full_name']}, <br>Your <b>{$exists['item_for_repair']}</b> with job card number <b>JC{$exists['job_number']}</b> has a current status of:<br> <h4><b>{$exists['current_status']}</h4></b><br>Technician assigned to your repair:<br> <b>{$exists['tech_assigned']}</b>\n";
echo "</body>\n";
// some PHP code here …
echo "</html>\n";
echo "\n";

} else {
   echo 'No Record Found';
}
}
?>
                    </div>
</div>

                 </div>
            </div>

        </div>
    </div>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
    <!-- Bootstrap JS -->
    <script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>
</html>