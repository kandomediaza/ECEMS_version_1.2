<?php

require_once "connection.php";

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
  
  {
  try
  {
      
   if(!isset($errorMsg))
   {
       $update_stmt=$db->prepare('UPDATE repairs SET job_number=:job_number, date=:date, client_full_name=:client_full_name, client_email=:client_email, client_phone=:client_phone, item_for_repair=:item_for_repair, repair_description=:repair_description, hardware_details=:hardware_details, diagnostic_fee=:diagnostic_fee, tech_assigned=:tech_assigned, current_status=:current_status, technician_notes=:technician_notes, admin_notes=:admin_notes, invoice_status=:invoice_status, invoice_number=:invoice_number WHERE job_number=:job_number'); 

                $update_stmt->bindParam(':job_number', $job_number);
                $update_stmt->bindParam(':date', $date);
                $update_stmt->bindParam(':client_full_name', $client_full_name);
                $update_stmt->bindParam(':client_email', $client_email);
                $update_stmt->bindParam(':client_phone', $client_phone);
                $update_stmt->bindParam(':item_for_repair', $item_for_repair);
                $update_stmt->bindParam(':repair_description',$repair_description);
                $update_stmt->bindParam(':hardware_details', $hardware_details);
                $update_stmt->bindParam(':diagnostic_fee', $diagnostic_fee);
                $update_stmt->bindParam(':tech_assigned', $tech_assigned);
                $update_stmt->bindParam(':current_status', $current_status);
                $update_stmt->bindParam(':technician_notes', $technician_notes);
                $update_stmt->bindParam(':admin_notes', $admin_notes);
                $update_stmt->bindParam(':invoice_status', $invoice_status);
                $update_stmt->bindParam(':invoice_number', $invoice_number);   
     
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