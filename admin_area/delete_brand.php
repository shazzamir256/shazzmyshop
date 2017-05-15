<?php

include("includes/db.php");

if(isset($_GET['delete_brand'])){                                   /*passing delete_brand value to $delete_id variable*/
	
$delete_id = $_GET['delete_brand'];	
	
	
$delete_brand ="DELETE FROM brands WHERE brand_id = '$delete_id' ";	
	
$run_delete = mysqli_query($con ,$delete_brand);
	
if($run_delete){
	
	echo "<script>alert('One Brand Has Been Deleted!')</script>";
	
	echo "<script>window.open('index.php?view_brands.php','_self')</script>";

	
	}	
	
	}


?>