<?php

include("includes/db.php");

if(isset($_GET['delete_pro'])){                                   /*passing delete_pro value to $delete_id variable*/
	
$delete_id = $_GET['delete_pro'];	
	
	
$delete_pro ="DELETE FROM products WHERE product_id = '$delete_id' ";	
	
$run_delete = mysqli_query($con ,$delete_pro);
	
if($run_delete){
	
	echo "<script>alert('One Product Has Been Deleted!')</script>";
	
	echo "<script>window.open('index.php?view_products.php','_self')</script>";

	
	}	
	
	}


?>