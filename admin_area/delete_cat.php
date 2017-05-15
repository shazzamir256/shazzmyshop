<?php

include("includes/db.php");

if(isset($_GET['delete_cat'])){                                   /*passing delete_cat value to $delete_id variable*/
	
$delete_id = $_GET['delete_cat'];	
	
	
$delete_cat ="DELETE FROM categories WHERE cat_id = '$delete_id' ";	
	
$run_delete = mysqli_query($con ,$delete_cat);
	
if($run_delete){
	
	echo "<script>alert('One Category Has Been Deleted!')</script>";
	
	echo "<script>window.open('index.php?view_cats.php','_self')</script>";

	
	}	
	
	}


?>