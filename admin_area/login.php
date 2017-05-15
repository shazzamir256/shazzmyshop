<?php

session_start();
include("includes/db.php");
?>
<!DOCTYPE HTML>

<html>
<head>
<title>Admin Login</title>
<style type="text/css" media="all"/>
.login{
	
	position:absolute;
	top:50%;
	left:50%;
	margin:-150px 0 0 -150px;
	width:300px;
	height:300px;
    
	
	}

.login h1 {
	
	text-shadow: 0 0 10px rgb%(0,0,0,0,3);
    letter-spacing:1px;
	text-align:center;
	
	}

	.input{
		
		width:100%;
		margin-bottom:10px;
	}

	
	
	
	</style>
</head>
<body bgcolor="#FFCCCC">

<h1 align="center" >Welcome To Admin Panel of My Shop</h1>
		
		<div class="login">
		
		<h1>Admin Login</h1>
		
		<form method="post" align="center">
	   
	   <input type="text" name="admin_email" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email" required="required"/><br><br>
	    
		<input type="password" name="admin_name" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password" required="required"/><br><br>
		
		<button type="submit" class="btn btn-primary btn-block btn-large" name="login">Admin Login </button>
		
		</form>


		</div>

		<h2 style="color:red ;text-align:center;"><?php echo '<br>'.@$_GET['log_out']; ?></h2>   <!-- showing you succesfully logged out statement..see in logout.php on line 7-->
</body>
</html>

<?php
if(isset($_POST['login'])){
	
	$user_email=$_POST['admin_email'];
	
	$user_pass=$_POST['admin_name'];

	$sel_admin="SELECT * FROM admins WHERE admin_email='$user_email' AND admin_pass='$user_pass'";
	
	$run_admin=mysqli_query($con , $sel_admin);
	
	$check_admin=mysqli_num_rows($run_admin);                                  /* counting number of admins*/
	
	if($check_admin==1){
		
		$_SESSION['admin_email']=$user_email;                                 /*activate seesion on 1*/
	
	    echo "<script>window.open('index.php?logged_in=You Successfully Logged in!','_self')</script>";
	
	}
	
	else {
		
		echo "<script>alert('Admin Email or Password is Incorrect,Please Try Again!')</script>";
		
	}
	}


?>