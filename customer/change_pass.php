<form action="" method="post">                           <!-- action nothing cos page is included in another page-->

<table width="500" align="center">
<tr align="center">
<td colspan="4"><h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Change Your Password<br><br></h2></td>

</tr>

<tr>
<td align="right"><b>Enter Current Password:</b><br><br></td>
<td>&nbsp;<input type="password" name="old_pass" placeholder="&nbsp;&nbsp;&nbsp;Enter Current Password" required/></td>
</tr>

<tr>
<td align="right"><b>Enter New Password:</b><br><br></td>
<td>&nbsp;<input type="password" name="new_pass" placeholder="&nbsp;&nbsp;&nbsp;Enter New Password" required/></td>
</tr>

<tr>
<td align="right"><b>Enter New Password Again:</b><br><br></td>
<td>&nbsp;<input type="password" name="new_pass_again" placeholder="&nbsp;Enter New Password Again" required/></td>
</tr>

<tr align="center">

<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="change_pass" value="Change Password" title="Change Password"/></td>
</tr>
</table>
</form>

<?php

include("includes/db.php");

$c = $_SESSION['customer_email'];                         /*user email is stored with the help of session means when user is "logged in" in $c*/

if(isset($_POST['change_pass'])){
	
	$old_pass       = $_POST['old_pass'];
	
	$new_pass       = $_POST['new_pass'];
	
	$new_pass_again = $_POST['new_pass_again'];
	
	
	$get_real_pass  = "SELECT * FROM customers WHERE customer_pass='$old_pass'";
	
	$run_real_pass  = mysqli_query($con,$get_real_pass);
	
    if(mysqli_num_rows($run_real_pass)==0){                                     /*0 means if we dont know this password*/
		
	echo "<script>alert('Your Current Password is not Valid, Please Try Again!')</script>";
	
    exit();	
		
	}
	
	if($new_pass!=$new_pass_again){
		
	echo "<script>alert('New Password does not match, Please Try Again!')</script>";
	
	exit();	
	
	}
	
	else{
		
		$update_pass = "UPDATE customers SET customer_pass='$new_pass' WHERE customer_email='$c'";    /*Update that password that is equal to $c,only update secific person password,not all passwords*/
		
		$run_pass    = mysqli_query($con,$update_pass);
		
		echo "<script>alert('Your Password has been Successfully Changed!')</script>";
	
        echo "<script>window.open('my_account.php',' _self')</script>";	
	}
	
	}	
	
	
	



?>