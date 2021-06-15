<?php

require_once "connection.php";
 
if(isset($_REQUEST['delete_id']))
{
 // select record from db to delete
 $job_number=$_REQUEST['delete_id']; //get delete_id and store in $id variable
  
 $select_stmt= $db->prepare('SELECT * FROM repairs WHERE job_number =:job_number'); //sql select query
 $select_stmt->bindParam(':job_number',$job_number);
 $select_stmt->execute();
 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
  
 //delete an orignal record from db
 $delete_stmt = $db->prepare('DELETE FROM repairs WHERE job_number =:job_number');
 $delete_stmt->bindParam(':job_number',$job_number);
 $delete_stmt->execute();
  
 header("Location:repairs.php");
}
 
?>