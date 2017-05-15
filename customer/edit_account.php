<?php

@session_start();                                           /* @ is used if user is logged in another account it would hide this login*/

include("includes/db.php");

if(isset($_GET['edit_account'])){
	
	$customer_email = $_SESSION['customer_email'];
	
	$get_customer   = "SELECT * FROM customers WHERE customer_email='$customer_email'";

	$run_customer   = mysqli_query($con,$get_customer);
	
	$row            = mysqli_fetch_array($run_customer);
	
	
	$id             = $row['customer_id'];
	
	$name           = $row['customer_name'];
	
	$email          = $row['customer_email'];
	
	$pass           = $row['customer_pass'];
	
	$country        = $row['customer_country'];
	
	$city           = $row['customer_city'];
	
	$contact        = $row['customer_contact'];
	
	$address        = $row['customer_address'];
	
	$image          = $row['customer_image'];
	
}

?>

<form action="" method="post" enctype="multipart/form-data">                                      <!-- form action is nothing,becuase we are including this page with "include".we are not redirecting it any page-->
<table align="center" width="600">	

<tr>
<td colspan="8" align="center"><h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Your Account<br><br></h2></td>
</tr>

<tr>
<td align="right">Customer Name:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="c_name" value="<?php echo  $name; ?>"></td>       <!-- echo $name means ,customer can edit the name given when he registered earlier-->
</tr>

<tr>
<td align="right">Customer Email:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="c_email" value="<?php echo $email; ?>"></td>
</tr>

<tr>
<td align="right">Customer Password<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="c_pass" value="<?php echo $pass; ?>"></td>
</tr>

<tr>
<td align="right">Customer Country:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<select name="c_country" disabled>                                       <!-- disabled is attribute of html 5,which restricts cutomer to change his country-->

<option value="<?php echo $country; ?>"><?php echo $country; ?></option>

<option>Australia</option>
<option>New Zealand</option>
<option>Sri Lanka</option>
<option>Pakistan</option>
<option>South Africa</option>
<option>Zimbabwe</option>
<option>West Indies</option>
<option>England</option>
<option>Canada</option>

</select>
</td>
</tr>

<tr>
<td align="right">Customer City:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="c_city" value="<?php echo $city; ?>"></td>
</tr>

<tr>
<td align="right">Customer Contact:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="c_contact" value="<?php echo $contact; ?>"></td>
</tr>

<tr>
<td align="right">Customer Address:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<input type="text" name="c_address" size="40" value="<?php echo $address; ?>"></td>
</tr>

<tr>
<td align="right">Customer Image:<br><br></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="file" name="c_image" size="60">&nbsp;&nbsp;&nbsp;<img src="customer_photos/<?php echo $image; ?>"width="60" height="60"></td>
</tr>

<tr>
<td align="center" colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="update_account" value="Update Now"></td>
</tr>

</table>	
</form>	
	
<?php

if(isset($_POST['update_account'])){

 $update_id = $id;                                 /* We want to update only specific id on line no 18 that customer want to update.not all id*/
 
 $c_name        = $_POST['c_name'];
 $c_email       = $_POST['c_email'];
 $c_pass        = $_POST['c_pass'];
 $c_city        = $_POST['c_city'];
 $c_contact     = $_POST['c_contact'];
 $c_address     = $_POST['c_address'];
 $c_image       = $_FILES['c_image']['name'];
 $c_image_tmp   = $_FILES['c_image']['tmp_name'];
 
   move_uploaded_file($c_image_tmp,"customer_photos/$c_image");


 $update_c = "UPDATE customers SET customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',
 
              customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address',

			  customer_image='$c_image'WHERE customer_id='$update_id'";
 
 $run_c = mysqli_query($con,$update_c);
 
 if($run_c){
	 
	 echo "<script>alert('Your Account has been Updated')</script>";
	 
     echo "<script>window.open('my_account.php','_self')</script>";
 
 }
}
 
?>	
	
	
	
	
	
	
	
	