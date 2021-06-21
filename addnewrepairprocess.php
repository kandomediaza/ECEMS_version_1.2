<?php

require_once "connection.php";

if(isset($_REQUEST['btn_create']))
{
    $job_number = filter_var($_REQUEST['job_number'], FILTER_SANITIZE_STRING);
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
  
 if(empty($job_number)){
  $errorMsg="Job Number Could Not Be Generated. Please contact Master of Matrix to fix this...";
 }
 if(empty($date)){
  $errorMsg="Date cannot be empty";
 }
 else if(empty($client_email)){
  $errorMsg="Please Enter Email Address";
 }
 
 else
 {
  try
  {
   if(!isset($errorMsg))
   {
    $insert_stmt=$db->prepare('INSERT INTO repairs(job_number,date,client_full_name,client_email,client_phone,item_for_repair,repair_description,hardware_details,diagnostic_fee,tech_assigned,current_status,technician_notes,admin_notes,invoice_status,invoice_number) VALUES(:job_number,:date,:client_full_name,:client_email,:client_phone,:item_for_repair,:repair_description,:hardware_details,:diagnostic_fee,:tech_assigned,:current_status,:technician_notes,:admin_notes,:invoice_status,:invoice_number)');    
    
                $insert_stmt->bindParam(':job_number', $job_number, PDO::PARAM_INT);
                $insert_stmt->bindParam(':date', $date);
                $insert_stmt->bindParam(':client_full_name', $client_full_name, PDO::PARAM_STR);
                $insert_stmt->bindParam(':client_email', $client_email, PDO::PARAM_STR);
                $insert_stmt->bindParam(':client_phone', $client_phone, PDO::PARAM_STR);
                $insert_stmt->bindParam(':item_for_repair', $item_for_repair, PDO::PARAM_STR);
                $insert_stmt->bindParam(':repair_description',$repair_description, PDO::PARAM_STR);
                $insert_stmt->bindParam(':hardware_details', $hardware_details, PDO::PARAM_STR);
                $insert_stmt->bindParam(':diagnostic_fee', $diagnostic_fee, PDO::PARAM_STR);
                $insert_stmt->bindParam(':tech_assigned', $tech_assigned, PDO::PARAM_STR);
                $insert_stmt->bindParam(':current_status', $current_status, PDO::PARAM_STR);
                $insert_stmt->bindParam(':technician_notes', $technician_notes, PDO::PARAM_STR);
                $insert_stmt->bindParam(':admin_notes', $admin_notes, PDO::PARAM_STR);
                $insert_stmt->bindParam(':invoice_status', $invoice_status, PDO::PARAM_STR);
                $insert_stmt->bindParam(':invoice_number', $invoice_number, PDO::PARAM_STR);   
     
    if($insert_stmt->execute())
    {
     $insertMsg="Created Successfully........sending email now"; 
     
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
if(isset($_POST['btn_create'])){
    $to = "info@refurbsa.com"; // this is your Email address
    $from = $_POST['client_email']; // this is the sender's Email address
     $from_mail = "notifications@ecems.co.za"; // this is the sender's Email address 
    $from_name = "ECEMS System"; // this is the sender's Name
   $job_number = $_POST['job_number'];
    $date = $_POST['date'];
    $client_full_name = $_POST['client_full_name'];
    $item_for_repair = $_POST['item_for_repair'];
     $subject = "New Repair Job Card JC$job_number has been added to ECEMS";
    $subject2 = "REFURB SA - Your Repair has been lodged | JC$job_number ";
   $message = "Hi Admin. A new job card has been added to ECEMS on the $date for $client_full_name. The Job Card Number for this repair is JC$job_number. The item for repair is a $item_for_repair. The Repair description is $repair_description. Please inform the technicians and let them start diagnostics immediatley for this item so we can send $client_full_name a quote for the repair.";
    $message2 = "Hi $client_full_name. A new job card has been added to our system on the $date for your $item_for_repair repair. The Job Card Number for this repair is JC$job_number. To track your repair status, please visit https://www.ecems.co.za/repairstatus.php. Thank you for putting your trust in REFURB SA for the repair of your $item_for_repair. You can also contact us on our Whatsapp Support number: 079 347 7063 or email info@refurbsa.com.";
   $headers .= "From: ".$from_name." <".$from_mail."> \r\n";
    $headers2 .= "From: ".$from_name." <".$from_mail."> \r\n";
    $headers .= 'Cc: admin@ecems.co.za' . "\r\n";
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        header("refresh:1;repairs.php"); 
    }
?>
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

