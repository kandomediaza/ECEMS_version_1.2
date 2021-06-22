<?php
require_once 'connection.php';

session_start();

if(isset($_SESSION["admin_login"])) //check condition admin login not direct back to index.php page
{
 header("location: admindashboard.php"); 
}
if(isset($_SESSION["employee_login"])) //check condition employee login not direct back to index.php page
{
 header("location: employeedashboard.php"); 
}
if(isset($_SESSION["tech_login"])) //check condition user login not direct back to index.php page
{
 header("location: techdashboard.php");
}

if(isset($_REQUEST['btn_login'])) //login button name is "btn_login" and set this
{
 $username  =$_REQUEST["txt_username"]; //textbox name "txt_email"
 $password =$_REQUEST["txt_password"]; //textbox name "txt_password"
 
 $role  =$_REQUEST["txt_role"];  //select option name "txt_role"
  
 if(empty($username)){      
  $errorMsg[]="please enter your username"; //check email textbox not empty or null
 }
 else if(empty($password)){
  $errorMsg[]="please enter password"; //check passowrd textbox not empty or null
 }
 else if(empty($role)){
  $errorMsg[]="please select role"; //check select option not empty or null
 }
 else if($username AND $password AND $role)
 {
  try
  {
   $select_stmt=$db->prepare("SELECT username,password,role FROM masterlogin
          WHERE
          username=:uusername AND password=:upassword AND role=:urole"); //sql select query
   $select_stmt->bindParam(":uusername",$username);
   $select_stmt->bindParam(":upassword",$password); //bind all parameter
   $select_stmt->bindParam(":urole",$role);
   $select_stmt->execute(); //execute query
     
   while($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) //fetch record from MySQL database
   
   {
    $dbusername =$row["username"];
    $dbpassword =$row["password"];  //fetchable record store new variable they are "$dbemail","$dbpassword","$dbrole"
    $dbrole  =$row["role"];
   }
   if($username!=null AND $password!=null AND $role!=null) //check taken fields not null after countinue
   {
    if($select_stmt->rowCount()>0) //check row greater than "0" after continue
    {
     if($username==$dbusername AND $password==$dbpassword AND $role==$dbrole) //check type textbox email,password,role and fetchable record new variables are true after continue
     {
      switch($dbrole)  //role base user login start
      {
       case "admin":
        $_SESSION["admin_login"]=$username;   //session name is "admin_login" and store in "$email" variable
        $loginMsg="Welcome Admin! | Authentication Success! Wait 3 Seconds"; //admin login success message
        header("refresh:3;admindashboard.php"); //refresh 3 second after redirect to "admin_home.php" page
        break;
        
       case "employee":
        $_SESSION["employee_login"]=$username;    //session name is "employee_login" and store in "$email" variable
        $loginMsg="Welcome! | Authentication Success! Wait 3 Seconds";  //employee login success message
        header("refresh:3;employeedashboard.php"); //refresh 3 second after redirect to "employee_home.php" page
        break;
        
       case "tech":
        $_SESSION["tech_login"]=$username;    //session name is "user_login" and store in "$email" variable
        $loginMsg="Welcome Technician! | Authentication Success! Wait 3 Seconds"; //user login success message
        header("refresh:3;techdashboard.php");  //refresh 3 second after redirect to "user_home.php" page
        break;
        
       default:
        $errorMsg[]="wrong email or password or role";
      }
     }
     else
     {
      $errorMsg[]="wrong email or password or role";
     }
    }
    else
    {
     $errorMsg[]="wrong email or password or role";
    }
   }
   else
   {
    $errorMsg[]="wrong email or password or role";
   }
  }
  catch(PDOException $e)
  {
   $e->getMessage();
  }  
 }
 else
 {
  $errorMsg[]="wrong email or password or role";
 }
}
?>
 <?php
if(isset($errorMsg)){
?>
    <div class="alert alert-danger">
        <strong>ERROR!! Please make sure you have entered your username, password and role correctly. One of them were wrong during Authentication</strong>
    </div>
<?php
}
if(isset($loginMsg)){
?>
 <div class="alert alert-success">
  <h1><strong><?php echo $loginMsg; ?></strong></h1>
 </div>
<?php
}
?>