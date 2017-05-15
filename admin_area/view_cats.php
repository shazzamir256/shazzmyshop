
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
<title>View Categories</title>

<style type="text/css">

tr,th{
	
border : 2px groove #000;	
	
}

</style>
</head>
<body>

<table width="794" align="center" bgcolor="#FFC99"/>

<tr align="center">


<td colspan="3"><h2>View All Categories<br><br></h2></td>

</tr>


<tr>

<th>Category Id</th>

<th>Category Title</th>

<th>Delete</th>

<th>Edit</th>

</tr>



<?php

include("includes/db.php");

$get_cats = "SELECT * FROM categories";

$run_cats = mysqli_query($con, $get_cats);

while($row_cats=mysqli_fetch_array($run_cats)){
	
	$cat_id = $row_cats['cat_id'];
	
	$cat_title = $row_cats['cat_title'];
	
     
	
?>


<tr align="center">

<td><?php echo $cat_id; ?></td>

<td><?php echo $cat_title; ?></td>

<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>"style="text-decoration:none;">Edit</a></td>
 
<td><a href="delete_cat.php?delete_cat=<?php echo $cat_id;?>"style="text-decoration:none;">Delete</a></td>

</tr>

<?php } ?>                                                          <!-- while loop bracket closed-->

</table>
</body>
</html>

	<?php } ?>                                                     <!-- session bracket closed-->