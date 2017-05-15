<?php

@session_start();                                               /* @ used cos if another session is active,this session remain inactive*/
include("includes/db.php");


?>

<html>
<head>
<title>
</title>
<body>
<div>

<h2>Login or Register</h2><br><br>

<form action="checkout.php"  method="post">

 


<b>Your Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="c_email" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Your Email" required/><br><br>

<b>Your Password:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="c_pass" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Your Password" required/><br><br>

<a href="checkout.php?forgot_pass" style="text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forgot Password</a><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="c_login" value="Login"/>

</form>

<?php

if(isset($_GET['forgot_pass'])){
	
echo "<br>
      <div align='center'>
      
	  <b>Enter Your Email below, We will send your Password to your Email</b><br><br>

	  <form action='' method='POST'>
	  
	  <input type='text' name='c_email' placeholder='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Your Email' required/><br><br>
	  
	  <input type='submit' name='forgot_pass' value='Send Password'/>

	  </form>
	  
	  </div>"	;
	
	
	if(isset($_POST['forgot_pass'])){
		
	$c_email=$_POST['c_email'];	
	
	$sel_c="SELECT * FROM customers WHERE customer_email='$c_email'";
	
	$run_c=mysqli_query($con, $sel_c);
	
	$check_c = mysqli_num_rows($run_c);                                  /* counting no of emails in database*/
	
	$row_c = mysqli_fetch_array($run_c);
	
	$c_name=$row_c['customer_name'];
	
	$c_pass=$row_c['customer_pass'];
	
	if($check_c==0){
		
		echo "<script>alert('Sorry!This Email does not Exist in our Database')</script>";
		
	   exit();
	
	}
	else {
		
		$from = "admin@mysite.com";
		
		$subject = "Your Password";
	
	    $message = "
	
	               <html>
	                
					<h3>Dear $c_name;</h3>
	                 
					 <p>You requested for your password at www.mysite.com</p>

					 <b>Your Password is</b/><span style='color:red;'>$c_pass</span>

				     <h3>Thank you for using our Website</h3>

				  </html> ";
	
	    mail($c_email,$subject,$message,$from);
	
	    echo"<script>alert('Password was sent to your email,Please check your Email!')</script>";
	
	    echo"<script>window.open('checkout.php','_self')</script>";                       /*page refresh*/
	
	}
	}
}



?>


<br><br>
<h2 style="float:right;padding:10px;"><a href="customer_register.php" style="text-decoration:none;">New Customer Register Here</a></h2>

</div>

<?php                                                         /* we are checking login of customer and cart with help of ip address.we are checking if there is something in cartor not*/

if(isset($_POST['c_login'])){
	
$customer_email = $_POST['c_email'];	
$customer_pass  = $_POST['c_pass'];

$sel_customer   = "SELECT * FROM customers WHERE customer_email='$customer_email' AND customer_pass='$customer_pass'";

$run_customer   = mysqli_query($con,$sel_customer);

$check_customer = mysqli_num_rows($run_customer);                  /* to check or count how many record are present */

$get_ip         = getRealIpAddr();

$sel_cart       = "SELECT * FROM cart WHERE ip_add='$get_ip'";

$run_cart       = mysqli_query($con,$sel_cart);

$check_cart     = mysqli_num_rows($run_cart);

if($check_customer==0){                                          /* if no customer is selected*/
	
	echo "<script>alert('Password or Email address is incorrect,please try again')<script>";
	
	exit();
} 

if($check_customer==1 AND $check_cart ==0){                     /* 1 means if customer is logged in and 0 means he hasnt selected any item in cart then take him to my_account.php*/
	
	$_SESSION['customer_email']= $customer_email;
	
	echo "<script>window.open('customer/my_account.php','_self')</script>";
	
}

    else {
   
   $_SESSION['customer_email']= $customer_email;                  /* session means user is active or logged on*/
   
   echo "<script>alert('You have successfully logged in, you can order now!')</script>";
   
   include("payment_options.php");
	
	}
}
?>
</body>
</html>