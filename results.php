<?php
include("includes/db.php");
include("functions/functions.php");

?>

<html>
<head>
<title>
My Shop
</title>
<link rel="stylesheet" href="styles/style.css" media="all">                <!-- Media="all" means it will be responsive on all media i.e tablet,iphone-->
</head>
<body>

<!-- Main Container Starts-->
<div class="main_wrapper">

<!-- Header Starts From Here-->
<div class="header_wrapper">
<a href="index.php"><img src="images/shoplogo.jpg" style="float:left" height="100" width="500"></a>
<a href="index.php"><img src="images/mobile.jpg"   style="float:right"height="100" width="500"></a>


</div>
<!-- Header Ends Here-->

<!-- Navigation Starts From Here-->

<div id="navbar">
<ul id="menu">
<li><a href="index.php">Home</a></li>
<li><a href="all_products.php">All Products</a></li>
<li><a href="my_account.php">My Account</a></li>
<li><a href="user_register.php">Sign Up</a></li>
<li><a href="cart.php">Shopping Cart</a></li>
<li><a href="contact.php">Contact Us</a></li>
</ul>
<div id="form">                                                                           <!-- Search bar-->
<form method="get" action="results.php" enctype="multipart/form-data">                       
<input type="text" name="user_query" placeholder="Search a Product Here"/>
<input type="submit" name="search" value="Search"/>
</form>
</div>
</div>
<!-- Navigation Ends Here-->

<!-- Contents Starts From Here-->
<div class="content_wrapper">
<div id="left_sidebar">
<div id="sidebar_title"><center>Categories</center></div>
<ul id="cats">
<?php  getCats();   ?>
</ul> 

<div id="sidebar_title"><center>Brands</center></div>
<ul id="cats">
<?php getBrands(); ?>
</ul> 

</div>



<div id="right_content">

<div id="headline" style="background:#000; color: #FFF; height:50px; ">

<div id="headline_content" style="float:right; margin:15px;">
<b>Welcome Guest!</b>
<b style="color:yellow">Shopping Cart:</b>
<span>- Items: - Price:</span>
</div>
</div>

<div id="products_box" style="width:280px;display:inline; padding:10px; margin-left:30px;margin-bottom:10px;text-align:center;">


<?php
 if (isset($_GET['search'])){
 $user_keyword = $_GET['user_query'];
 $get_products = "SELECT * FROM products where product_keywords like '%%user_keyword%'";
$run_products = mysqli_query($con, $get_products);
while ($row_products=mysqli_fetch_array($run_products)){
	
	$pro_id    = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_desc  = $row_products['product_desc'];
	$pro_price = $row_products['product_price'];
	$pro_image = $row_products['product_img1'];
	
	 
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
 ?>

</div>
</div>



</div>



<!-- Contents End Here-->
<!-- Footer Starts From Here-->
<div class="footer">
<h1 style="padding-top:30px; text-align:center;">&copy; 2017 - By www.shoponline.com</h1>

</div>
<!-- footer Ends Here-->
<div>
</div>
<!-- Main Container Ends-->
</body>
</html>