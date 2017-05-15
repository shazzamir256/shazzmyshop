
<?php
include("includes/db.php");
if(isset($_GET['cat'])){
$cat_id = $_GET['cat'];

$get_cat_pro = "SELECT * FROM products where cat_id='$cat_id'";
$run_cat_pro= mysqli_query($con, $get_cat_pro);
$count = mysqli_num_rows($run_cat_pro);
if($count==0){
	
	echo "<h2>No Products found in this category!</h2>";
	
}

while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	
	$pro_id    = $row_cat_pro['product_id'];
    $pro_title = $row_cat_pro['product_title'];
	$pro_desc  = $row_cat_pro['product_desc'];
	$pro_price = $row_cat_pro['product_price'];
	$pro_image = $row_cat_pro['product_img1'];
	
	 
	   echo "<div id='single_product' style='float:left; padding:10px; margin-left:20px;'>
	        
			<h3>$pro_title</h3> <br>
	        
			<div id='single_product img' style='border:2px solid #333;'>
			
			<img src='admin_area/product_images/$pro_image' width='180' height='180' /></div><br>
	        
			<p><b>Price: $ $pro_price </b></p>
			
			<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
			
			<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
			
			</div>";
		
	}
}
                                                            
                                                           /*cat isset bracket closed*/


?>
