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
<div class="main_wrapper" style="background:#FCC;">

<!-- Header Starts From Here-->
<div class="header_wrapper">
<a href="../index.php"><img src="../images/shoplogo.jpg" style="float:left" height="100" width="500"></a>
<a href="../index.php"><img src="../images/mobile.jpg"   style="float:right"height="100" width="500"></a>


</div>
<!-- Header Ends Here-->

<!-- Navigation Starts From Here-->

<div id="navbar">
<ul id="menu">
<li><a href="../index.php">Home</a></li>
<li><a href="../all_products.php">All Products</a></li>
<li><a href="/customer/my_account.php">My Account</a></li>

<?php

if(isset($_SESSION['customer_email'])){
	
echo "<span style='display:none;'><li><a href='../user_register.php'>Sign Up</a></li></span>";          /* we want to vanish sign up link when customer is logged in */
}

else {
	
	echo "<li><a href='../user_register.php'>Sign Up</a></li>";                                       /* we want to show sign up link when user logs out*/
}
?>

<li><a href="../cart.php">Shopping Cart</a></li>
<li><a href="../contact.php">Contact Us</a></li>
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
<div id="left_sidebar" style="float:right;border-left:2px solid #FFF;width:190px;">
<div id="sidebar_title"><center>Manage Account</center></div>
<ul id="cats" style="text-align:left;">

<?php                                                                        /* Displaying Picture of Customer in admin panel*/


	
	$customer_session =  $_SESSION['customer_email'];
	
	$get_customer_pic = "SELECT * FROM customers WHERE customer_email = '$customer_session'";

	$run_customer     =  mysqli_query($con,$get_customer_pic);
	
	$row_customer     =  mysqli_fetch_array($run_customer);
	
	$customer_pic     =  $row_customer['customer_image'];
	
	echo "<div id='cats_img' style='border:2px solid #FFF;'><img src='customer_photos/$customer_pic' width='166' height='150'></div>";
	


?>
<li><a href="my_account.php?my_orders">My Orders</a></li>
<li><a href="my_account.php?edit_account">Edit Account</a></li>
<li><a href="my_account.php?change_pass">Change Password</a></li>
<li><a href="my_account.php?delete_account">Delete Account</a></li>
<li><a href="logout.php">Log Out</a></li>




</ul> 


</div>



<div id="right_content" style="float:left">
<?php  cart();                               // calling ip of cart as function


?>                          


<div id="headline" style="background:#000; color: #FFF; height:50px; ">

<div id="headline_content" style="float:right; margin:15px;">

<?php

if(isset($_SESSION['customer_email'])){
	
	echo "<b>Welcome:" . "</b>" . "&nbsp;" . "<b style='color:#FFCCCC'>" . $_SESSION['customer_email'] . "</b>";
	
}

?>


&nbsp;<?php

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




<div>

<h2 style="background:#999999; color:white; padding:20px;text-align:center;border-top:2px solid #FFF;">Manage Your Account Here</h2>

<?php


	
	$c     = $_SESSION['customer_email'];                             /* if customer is logged in,its session get store here*/
	
	$get_c = "SELECT * FROM customers WHERE customer_email= '$c'";
	
	$run_c = mysqli_query($con,$get_c);

    $row_c = mysqli_fetch_array($run_c);
		
	$customer_id  = $row_c['customer_id'];	
		
	if(!isset($_GET['my_orders'])){
		
	if(!isset($_GET['edit_account'])){

    if(!isset($_GET['change_pass'])){	
		
	if(!isset($_GET['delete_account'])){
	
	
	$get_orders = "SELECT * FROM customer_orders WHERE customer_id = '$customer_id' AND order_status = 'pending'";

	$run_orders = mysqli_query($con,$get_orders);
	
	$count_orders = mysqli_num_rows($run_orders);
	
	if($count_orders>0){                                                   /*if customer got any orders*/
		
	echo "<div style='padding:10px;'><h1 style='color:red;text-decoration:underline;'>Important!</h1><br>
	      
		   <h2>You have ($count_orders) pending orders</h2><br>
		   
		   <h3>Please see your order details by clicking this <a href='my_account.php?my_orders'style='text-decoration:none;'>LINK</a><br>
		   
		   <br>Or you can <a href='pay_offline.php;' style='text-decoration:none;'>Pay Offline Now</a></h3></div>";
		
		   
		
	}
	
	else {
		
		echo "<div style='padding:10px;'><h1 style='color:red;text-decoration:underline;'>Important!</h1><br>
	      
		   <h2>You have no pending orders!</h2><br>
		   
		   <h3>You can see your order's history details by clicking this <a href='my_account.php?my_orders'
		   
		   style='text-decoration:none;'>LINK</a></h3></div>";
		
		
	}
	
	}
	}
    }
	}
    	
		
	
	


?>
<br>
<?php                                                         /*displaying orders by clicking my orders link*/

if(isset($_GET['my_orders'])){
	
	include("my_orders.php");
	
}

if(isset($_GET['edit_account'])){                           /*displaying edit account by clicking edit account link*/
	
	include("edit_account.php");
	
}

if(isset($_GET['change_pass'])){                           /*displaying change password account by clicking change password link*/
	
	include("change_pass.php");
	
}

if(isset($_GET['delete_account'])){                           /*displaying delete account by clicking delete account link*/
	
	include("delete_account.php");
	
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