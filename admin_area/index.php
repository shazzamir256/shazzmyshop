<?php

session_start();
if(!isset($_SESSION['admin_email'])){                               /*Restricting anybody to go to admin panel without visiting log in page*/
	
	echo "<script>window.open('login.php','_self')</script>";
			
}
    else {

?>


<!DOCTYPE HTML>
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
<div class="wrapper">

<a href="index.php"><div class="header"></div></a>

</div>



<div class="right" style="margin-right:131px;">
<h2>Manage Content</h2>
<a href="index.php?insert_product" style="text-decoration:none;">Insert New Product</a>
<a href="index.php?view_products" style="text-decoration:none;">View All Products</a>
<a href="index.php?insert_cat" style="text-decoration:none;">Insert New Category</a>
<a href="index.php?view_cats" style="text-decoration:none;">View All Categories</a>
<a href="index.php?insert_brand" style="text-decoration:none;">Insert New Brand</a>
<a href="index.php?view_brands" style="text-decoration:none;">View All Brands</a>
<a href="index.php?view_customers" style="text-decoration:none;">View Customers</a>
<a href="index.php?view_orders" style="text-decoration:none;">View Orders</a>
<a href="index.php?view_payments" style="text-decoration:none;">View Payments</a>
<a href="logout.php" style="text-decoration:none;">Admin Logout</a>
</div>

<div class="left" style="margin-left:132px;">


<h2 style="color:red ;text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>             <!-- showing you succesfully logged in statement..see in login.php on line 75-->
<?php

include("includes/db.php");

if(isset($_GET['insert_product'])){
include("insert_product.php");

}

if(isset($_GET['view_products'])){
include("view_products.php");

}

if(isset($_GET['edit_pro'])){
include("edit_pro.php");

}

if(isset($_GET['insert_cat'])){
include("insert_cat.php");
}


if(isset($_GET['view_cats'])){
include("view_cats.php");
}


if(isset($_GET['edit_cat'])){
include("edit_cat.php");
}

if(isset($_GET['insert_brand'])){
include("insert_brand.php");
}

if(isset($_GET['view_brands'])){
include("view_brands.php");
}

if(isset($_GET['edit_brand'])){
include("edit_brand.php");
}

if(isset($_GET['view_customers'])){
include("view_customers.php");
}

if(isset($_GET['view_orders'])){
include("view_orders.php");
}

if(isset($_GET['view_payments'])){
include("view_payments.php");
}


?>

</div>
<!-- Footer Starts From Here-->
<div class="footer" style="margin:131px;">
<h1 style="padding-top:30px; text-align:center;">&copy; 2017 - By www.shoponline.com</h1>

</div>
<!-- footer Ends Here-->
</body>
</html>

	<?php } ?>                                                         <!-- else bracket of SESSION closed */