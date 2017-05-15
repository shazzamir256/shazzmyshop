<?php
include("includes/db.php");



if(!isset($_SESSION['admin_email'])){                               /*Restricting anybody to go to admin panel without visiting log in page*/
	
	echo "<script>window.open('login.php','_self')</script>";
			
}
    else {

?>



<!DOCTYPE HTML>
<html>
<head>
<title>View Customers</title>
<style type="text/css">
th,tr {
	
border:3px groove #333;	
	
}

</style>
</head>

<body>

<table width="794" align="center" bgcolor="#FFC990"/>

<tr align="center">
<td colspan="6"><h2>View All Customers</h2></td>
</tr>

<tr align="center">

<th>S.No</th>
<th>Name</th>
<th>Email</th>
<th>Image</th>
<th>Country</th>
<th>Delete</th>

</tr>

<?php

include("includes/db.php");

$get_c = "SELECT * FROM customers";

$run_c=mysqli_query($con ,$get_c);

$i=0;

while($row_c=mysqli_fetch_array($run_c)){
	
$c_id = $row_c['customer_id'];	
	
$c_name = $row_c['customer_name'];

$c_email = $row_c['customer_email'];

$c_image = $row_c['customer_image'];

$c_country = $row_c['customer_country'];

$i++;



?>
<tr align="center">

<td><?php echo $i; ?></td>
<td><?php echo $c_name; ?></td>
<td><?php echo $c_email; ?></td>
<td><img src="../customer/customer_photos/<?php echo $c_image; ?>" width="60" height="60"/></td>
<td><?php echo $c_country; ?></td>
<td><a href="delete_c.php?delete_c=<?php echo $c_id; ?>" style="text-decoration:none;">Delete</a></td>



</tr>

<?php } ?>                                 <!-- while bracket closed-->
</table>
</body>
</html>

	<?php  } ?>                             <!-- session bracket closed-->