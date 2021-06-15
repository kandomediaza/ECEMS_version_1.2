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
        $loginMsg="Admin... Successfully Login..."; //admin login success message
        header("refresh:1;admindashboard.php"); //refresh 3 second after redirect to "admin_home.php" page
        break;
        
       case "employee":
        $_SESSION["employee_login"]=$username;    //session name is "employee_login" and store in "$email" variable
        $loginMsg="Employee... Successfully Login...";  //employee login success message
        header("refresh:1;employeedashboard.php"); //refresh 3 second after redirect to "employee_home.php" page
        break;
        
       case "tech":
        $_SESSION["tech_login"]=$username;    //session name is "user_login" and store in "$email" variable
        $loginMsg="User... Successfully Login..."; //user login success message
        header("refresh:1;techdashboard.php");  //refresh 3 second after redirect to "user_home.php" page
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kando Media">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>ECEMS Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
	html,body {
	height: 100%;
}

body.my-login-page {
	background-color: #f7f9fb;
	font-size: 14px;
}

.my-login-page .brand {
	width: 200px;
	height: auto;
	overflow: hidden;
	
	margin: 40px auto;
	box-shadow: 0 4px 8px rgba(0,0,0,.05);
	position: relative;
	z-index: 1;
}

.my-login-page .brand img {
	width: 100%;
}

.my-login-page .card-wrapper {
	width: 400px;
}

.my-login-page .card {
	border-color: transparent;
	box-shadow: 0 4px 8px rgba(0,0,0,.05);
}

.my-login-page .card.fat {
	padding: 10px;
}

.my-login-page .card .card-title {
	margin-bottom: 30px;
}

.my-login-page .form-control {
	border-width: 2.3px;
}

.my-login-page .form-group label {
	width: 100%;
}

.my-login-page .btn.btn-block {
	padding: 12px 10px;
}

.my-login-page .footer {
	margin: 40px 0;
	color: #888;
	text-align: center;
}

@media screen and (max-width: 425px) {
	.my-login-page .card-wrapper {
		width: 90%;
		margin: 0 auto;
	}
}

@media screen and (max-width: 320px) {
	.my-login-page .card.fat {
		padding: 0;
	}

	.my-login-page .card.fat .card-body {
		padding: 15px;
	}
}

	</style>
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="http://www.ecems.co.za/ecemslogo.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">ECEMS LOGIN PAGE</h4>
							<form method="POST" action="" class="my-login-validation" novalidate="">
							<div class="form-group">
 <label class="col-sm-6 control-label">Username</label>

 <input type="text" name="txt_username" class="form-control" placeholder="enter username" value="" required autofocus />
<div class="invalid-feedback">
										Username is Required!
									</div>
 </div>
								

								 <div class="form-group">
 <label class="col-sm-6 control-label">Password</label>

 <input type="password" name="txt_password" class="form-control" placeholder="enter passowrd" value="" required />
<div class="invalid-feedback">
										Password is Required!
									</div>
 </div>
 <div class="form-group">
 <label class="col-sm-6 control-label">Select Role</label>

  <select class="form-control" name="txt_role" required>
   <option value="" selected="selected"> - select role - </option>
   <option value="admin">Admin</option>
   <option value="employee">Employee</option>
   <option value="tech">Technician</option>
  </select>
<div class="invalid-feedback">
										User Role is Required!
									</div>
 </div>
								

																 <div class="form-group">
 <div class="col-sm-9">
 <input type="submit" name="btn_login" class="btn btn-success" value="Login">
 </div>
 </div>
								
							</form>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>
	/******************************************
 * My Login
 *
 * Bootstrap 4 Login Page
 *
 * @author          Muhamad Nauval Azhar
 * @uri 			https://nauval.in
 * @copyright       Copyright (c) 2018 Muhamad Nauval Azhar
 * @license         My Login is licensed under the MIT license.
 * @github          https://github.com/nauvalazhar/my-login
 * @version         1.2.0
 *
 * Help me to keep this project alive
 * https://www.buymeacoffee.com/mhdnauvalazhar
 * 
 ******************************************/

'use strict';

$(function() {

	// author badge :)
	var author = '<div style="position: fixed;bottom: 0;right: 20px;background-color: #fff;box-shadow: 0 4px 8px rgba(0,0,0,.05);border-radius: 3px 3px 0 0;font-size: 12px;padding: 5px 10px;">Developed By <a href="#">Kando Media (Pty) Ltd</a></div>';
	$("body").append(author);

	$("input[type='password'][data-eye]").each(function(i) {
		var $this = $(this),
			id = 'eye-password-' + i,
			el = $('#' + id);

		$this.wrap($("<div/>", {
			style: 'position:relative',
			id: id
		}));

		$this.css({
			paddingRight: 60
		});
		$this.after($("<div/>", {
			html: 'Show',
			class: 'btn btn-primary btn-sm',
			id: 'passeye-toggle-'+i,
		}).css({
				position: 'absolute',
				right: 10,
				top: ($this.outerHeight() / 2) - 12,
				padding: '2px 7px',
				fontSize: 12,
				cursor: 'pointer',
		}));

		$this.after($("<input/>", {
			type: 'hidden',
			id: 'passeye-' + i
		}));

		var invalid_feedback = $this.parent().parent().find('.invalid-feedback');

		if(invalid_feedback.length) {
			$this.after(invalid_feedback.clone());
		}

		$this.on("keyup paste", function() {
			$("#passeye-"+i).val($(this).val());
		});
		$("#passeye-toggle-"+i).on("click", function() {
			if($this.hasClass("show")) {
				$this.attr('type', 'password');
				$this.removeClass("show");
				$(this).removeClass("btn-outline-primary");
			}else{
				$this.attr('type', 'text');
				$this.val($("#passeye-"+i).val());				
				$this.addClass("show");
				$(this).addClass("btn-outline-primary");
			}
		});
	});

	$(".my-login-validation").submit(function() {
		var form = $(this);
        if (form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
		form.addClass('was-validated');
	});
});
</script>
</body>
</html>
