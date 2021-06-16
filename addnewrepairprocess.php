<?php

require_once "connection.php";

if(isset($_REQUEST['btn_create']))
{
    $job_number = $_REQUEST['job_number'];
    $date = $_REQUEST['date'];
    $client_full_name = $_REQUEST['client_full_name'];
    $client_email = $_REQUEST['client_email'];
    $client_phone = $_REQUEST['client_phone'];
    $item_for_repair = $_REQUEST['item_for_repair'];
    $repair_description = $_REQUEST['repair_description'];
    $hardware_details = $_REQUEST['hardware_details'];
    $diagnostic_fee = $_REQUEST['diagnostic_fee'];
    $tech_assigned = $_REQUEST['tech_assigned'];
    $current_status = $_REQUEST['current_status'];
    $technician_notes = $_REQUEST['technician_notes'];
    $admin_notes = $_REQUEST['admin_notes'];
    $invoice_status = $_REQUEST['invoice_status'];
    $invoice_number = $_REQUEST['invoice_number'];
  
 if(empty($job_number)){
  $errorMsg="Job Number Could Not Be Generated. Please contact Master of Matrix to fix this...";
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
   $job_number = $_POST['job_number'];
    $date = $_POST['date'];
    $client_full_name = $_POST['client_full_name'];
    $item_for_repair = $_POST['item_for_repair'];
     $subject = "New Repair Job Card JC$job_number has been added to ECEMS";
    $subject2 = "REFURB SA - Your Repair has been lodged | JC$job_number ";
   $message = "Hi Admin. A new job card has been added to ECEMS on the $date for $client_full_name. The Job Card Number for this repair is JC$job_number. The item for repair is a $item_for_repair. The Repair description is $repair_description. Please inform the technicians and let them start diagnostics immediatley for this item so we can send $client_full_name a quote for the repair.";
    $message2 = "Hi $client_full_name. A new job card has been added to our system on the $date for your $item_for_repair repair. The Job Card Number for this repair is JC$job_number. To track your repair status, please visit https://www.ecems.co.za/repairstatus.php. Thank you for putting your trust in REFURB SA for the repair of your $item_for_repair. You can also contact us on our Whatsapp Support number: 079 347 7063 or email info@refurbsa.com.";

    $headers = "From:" . "notifications@ecems.co.za";
    $headers2 = "From:" . "notifications@ecems.co.za";
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        header("refresh:1;repairs.php"); 
    }
?>
