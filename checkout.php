<?php
session_start();
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
<?php  cart();                               // calling ip of cart as function


?>                          


<div id="headline" style="background:#000; color: #FFF; height:50px; ">

<div id="headline_content" style="float:right; margin:15px;">

<?php

if(!isset($_SESSION['customer_email'])){                                 /* If Session is not active, means if customer is not  logged in.show Welcome Gurset*/
	
echo "<b>Welcome Guest!</b> <b style='color:yellow'>Shopping Cart - </b>";	
	
	
}

else {
	
	echo "<b>Welcome :"  . "&nbsp;" . "<span style='color:#FFCCCC'>" . $_SESSION['customer_email'] . "</span>" . "</b>" .  "&nbsp;" . "<b style='color:yellow'>Your Shopping Cart - </b>";         /* if session is active ,  means if cutomer is logged in show welcome customer_email */      
}
?>
<span>Total Items: <?php items(); ?> - Total Price: <?php echo total_price(); ?> - <a href="cart.php" style="color:yellow;text-decoration:none;">Go to Cart
</a>
<?php

if(!isset($_SESSION['customer_email'])){                                    /* means if customer is not logged in*/

echo "<a href='checkout.php' style='color:white; text-decoration:none;'>Login</a>";

}

else {
	
	echo "<a href='logout.php' style='color:white; text-decoration:none;'>Log Out</a>";
}
?>


</span>                   <!-- calling function items() and total_price-->
</div>
</div>




<div id="products_box" style="width:280px;display:inline; padding:10px; margin-left:30px;margin-bottom:10px;text-align:center;">

<?php

if(!isset($_SESSION['customer_email'])){                      /* if customer is not logged in execute the code*/
	
	include("customer/customer_login.php");
	
}
    else {
		
    include("payment_options.php");
		
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