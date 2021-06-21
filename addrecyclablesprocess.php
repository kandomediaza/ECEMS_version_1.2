<?php

require_once "connection.php";

if(isset($_REQUEST['btn_create']))
{
    $recID = $_REQUEST['recID'];
    $date = $_REQUEST['date'];
    $subgrade = $_REQUEST['subgrade'];
    $castaluminium = $_REQUEST['castaluminium'];
    $copper = $_REQUEST['copper'];
    $stainlesssteel = $_REQUEST['stainlesssteel'];
    $plastic = $_REQUEST['plastic'];
    $batteries = $_REQUEST['batteries'];
    $brass = $_REQUEST['brass'];
     $cables = $_REQUEST['cables'];
    $lowgradePCB = $_REQUEST['lowgradePCB'];
    $mediumgradePCB = $_REQUEST['mediumgradePCB'];
    $highgradePCB = $_REQUEST['highgradePCB'];
   
 if(empty($recID)){
  $errorMsg="Entry Identifier Could Not Be Generated. Please contact Master of Matrix to fix this...";
 }
 else if(empty($date)){
  $errorMsg="You forgot to add a date, please press the back button to rectify this.";
 }
 
 else
 {
  try
  {
   if(!isset($errorMsg))
   {
    $insert_stmt=$db->prepare('INSERT INTO daily_recyclables(recID,date,subgrade,castaluminium,copper,stainlesssteel,plastic,batteries,brass,cables,lowgradePCB,mediumgradePCB,highgradePCB) VALUES(:recID,:date,:subgrade,:castaluminium,:copper,:stainlesssteel,:plastic,:batteries,:brass,:cables,:lowgradePCB,:mediumgradePCB,:highgradePCB)');    
    
                $insert_stmt->bindParam(':recID', $recID, PDO::PARAM_INT);
                $insert_stmt->bindParam(':date', $date);
                $insert_stmt->bindParam(':subgrade', $subgrade, PDO::PARAM_STR);
                $insert_stmt->bindParam(':castaluminium', $castaluminium, PDO::PARAM_STR);
                $insert_stmt->bindParam(':copper', $copper, PDO::PARAM_STR);
                $insert_stmt->bindParam(':stainlesssteel', $stainlesssteel, PDO::PARAM_STR);
                $insert_stmt->bindParam(':plastic',$plastic, PDO::PARAM_STR);
                $insert_stmt->bindParam(':batteries', $batteries, PDO::PARAM_STR);
                $insert_stmt->bindParam(':brass', $brass, PDO::PARAM_STR);
                $insert_stmt->bindParam(':cables', $cables, PDO::PARAM_STR);
                $insert_stmt->bindParam(':lowgradePCB', $lowgradePCB, PDO::PARAM_STR);
                $insert_stmt->bindParam(':mediumgradePCB', $mediumgradePCB, PDO::PARAM_STR);
                $insert_stmt->bindParam(':highgradePCB', $highgradePCB, PDO::PARAM_STR);

    if($insert_stmt->execute())
    {
     $insertMsg="Recyclables for $date Added Successfully! ECEMS will take you back to Recyclables page in 3 seconds (DO NOT EXIT THIS PAGE)"; 
     
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
    $to = "info@electronic-cemetery.com"; // this is your Email address
    $from_mail = "notifications@ecems.co.za"; // this is the sender's Email address 
    $from_name = "ECEMS System"; // this is the sender's Name
   $recID = $_POST['recID'];
    $date = $_POST['date'];
    $subgrade = $_POST['subgrade'];
    $castaluminium = $_POST['castaluminium'];
    $copper = $_POST['copper'];
    $stainlesssteel = $_POST['stainlesssteel']; 
    $plastic = $_POST['plastic'];
    $batteries = $_POST['batteries'];
    $brass = $_POST['brass'];
    $lowgradePCB = $_POST['lowgradePCB'];
    $mediumgradePCB = $_POST['mediumgradePCB'];
    $highgradePCB = $_POST['highgradePCB'];
    $subject = "New Daily Recyclables have been recorded into ECEMS";
    $message = "Hi Jami, Natalie and Lee-Roy. New recyclables have been added into ECEMS on the $date by the floor staff. a total of $subgrade(KG) of Subgrade, $castaluminium(KG) of Cast Aluminium, $copper(KG) of Copper,$stainlesssteel(KG) of Stainless Steel, $plastic(KG) of Plastic, $batteries(KG) of Batteries, $brass(KG) of Brass, $lowgradePCB(KG) of Low Grade PCB, $mediumgradePCB(KG) of Medium Grade PCB and $highgradePCB(KG) of High Grade PCB. Please click this link to login and check values - http://ecems.co.za/dailyrecyclables.php";
   $headers .= "From: ".$from_name." <".$from_mail."> \r\n";
   $headers .= 'Cc: admin@ecems.co.za' . "\r\n";
    mail($to,$subject,$message,$headers);
   
    header("refresh:3;dailyrecyclables.php"); 
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
if(isset($insertMsg)){
?>
 <div class="alert alert-success">
  <strong>DONE!! <?php echo $insertMsg; ?></strong>
 </div>
<?php
}
?>