<?php 
if(isset($_POST['btn_create'])){
    $to = "hello@kandomedia.co.za"; // this is your Email address
    $from = "notifications@ecems.co.za"; // this is the sender's Email address
    $job_number = $_POST['job_number'];
    $date = $_POST['date'];
    $client_full_name = $_POST['client_full_name'];
    $item_for_repair = $_POST['item_for_repair'];
    $subject = "JC$job_number has been added to ECEMS";
   $message = "Hi Admin<br><br>A new job card has been added to ECEMS on the $date for $client_full_name. The item for repair is a $item_for_repair. Please start diagnostics immediatley for this item.";
       $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
        header('Location: repairs.php');
    }
?>