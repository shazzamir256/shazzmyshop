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
<title>View Brands</title>

<style type="text/css">

tr,th{
	
border : 2px groove #000;	
	
}

</style>
</head>
<body>

<table width="794" align="center" bgcolor="#FFC99"/>

<tr align="center">


<td colspan="3"><h2>View All Brands<br><br></h2></td>

</tr>


<tr>

<th>Brand Id</th>

<th>Brand Title</th>

<th>Delete</th>

<th>Edit</th>

</tr>



<?php

include("includes/db.php");

$get_brands = "SELECT * FROM brands";

$run_brands = mysqli_query($con, $get_brands);

while($row_brands=mysqli_fetch_array($run_brands)){
	
	$brand_id = $row_brands['brand_id'];
	
	$brand_title = $row_brands['brand_title'];
	
     
	
?>


<tr align="center">

<td><?php echo $brand_id; ?></td>

<td><?php echo $brand_title; ?></td>

<td><a href="index.php?edit_brand=<?php echo $brand_id; ?>"style="text-decoration:none;">Edit</a></td>
 
<td><a href="delete_brand.php?delete_brand=<?php echo $brand_id;?>"style="text-decoration:none;">Delete</a></td>

</tr>

<?php } ?>                                                          <!-- while loop bracket closed-->

</table>
</body>
</html>

	<?php } ?>                                                     <!-- session bracket closed-->