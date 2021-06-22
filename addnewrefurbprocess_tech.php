<?php

require_once "connection.php";

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
     $insertMsg="Created Successfully........Taking you back to refurbs page in 3 seconds"; 
     
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
    $to = "hello@kandomedia.co.za"; // this is your Email address
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
        header("refresh:3;refurbs_tech.php"); 
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

