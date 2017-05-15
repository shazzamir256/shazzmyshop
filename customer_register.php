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
<b>Welcome Guest!</b>
<b style="color:yellow">Shopping Cart:</b>
<span>- Total Items: <?php items(); ?> - Total Price: <?php echo total_price(); ?>-<a href="cart.php" style="color:yellow;text-decoration:none;">Go to Cart
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



<form action="customer_register.php" method="post" enctype="multipart/form-data"/>
<table width="750" align="center">
<tr align="center">
<td colspan="8"><h2>Create an Account<br><br></h2></td>
</tr>

<tr>

<td align="right"><b>Customer Name:<br><br></b></td>
<td><input type="text" name="c_name" required/></td>
</tr>

<tr>
<td align="right"><b>Customer Email:<br><br></b></td>
<td><input type="text" name="c_email" required/></td>
</tr>

<tr>
<td align="right"><b>Customer Password:<br><br></b></td>
<td><input type="password" name="c_pass" required/></td>
</tr>

<tr>
<td align="right"><b>Customer Country:<br><br></b></td>
<td><select name="c_country">
<option>Select a Country</option>
<option>Australia</option>
<option>New Zealand</option>
<option>Sri Lanka</option>
<option>Pakistan</option>
<option>England</option>
<option>West Indies</option>
<option>South Africa</option>
<option>Zimbabwe</option>
<option>Canada</option>
</select>
</td>
</tr>

<tr>
<td align="right"><b>Customer City:<br><br></b></td>
<td><input type="text" name="c_city" required/></td>
</tr>

<tr>
<td align="right"><b>Customer Mobile No:<br><br></b></td>
<td><input type="text" name="c_contact" required/></td>
</tr>

<tr>
<td align="right"><b>Customer Address:<br><br></b></td>
<td><input type="text" name="c_address" required/></td>
</tr>

<tr>
<td align="right"><b>Customer Image:<br><br></b></td>
<td><input type="file" name="c_image" required/><br><br></td>
</tr>

<tr align="center">
<td colspan="8"><input type="submit" name="register" value="Submit"/></td>
</tr>

</table>
</form>



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

<?php

if(isset($_POST['register'])){
	
	$c_name       = $_POST['c_name'];
	
	$c_email      = $_POST['c_email'];
	
	$c_pass       = $_POST['c_pass'];
	
	$c_country    = $_POST['c_country'];
	
	$c_city       = $_POST['c_city'];
	
	$c_contact    = $_POST['c_contact'];
	
	$c_address    = $_POST['c_address'];
	
	$c_image      = $_FILES['c_image']['name'];
	
	$c_image_tmp  = $_FILES['c_image']['tmp_name'];
	
	$c_ip         = getRealIpAddr();
	
	
	$insert_customer = "INSERT INTO customers(customer_name,customer_email,customer_pass,customer_country,
	
	customer_city,customer_contact,customer_address,customer_image,customer_ip)VALUES('$c_name','$c_email','$c_pass','$c_country',
	
	'$c_city','$c_contact','$c_address','$c_image','$c_ip')";
	
	$run_customer = mysqli_query($con,$insert_customer);
	
	
	move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");         /* Function for uploading image*/
	
	$sel_cart       = "SELECT * FROM cart WHERE ip_add='$c_ip'";                 /* ip iddress would come only when if customer click on addcart button*/

    $run_cart       = mysqli_query($con,$sel_cart);

    $check_cart     = mysqli_num_rows($run_cart);
	
	if($check_cart>0) {                                                           /* if there is one value in cart*/
		
		$_SESSION['customer_email']= $c_email;
		
		echo "<script>alert('Account Created Successfully, Thank you !')</script>";   /*if customer selected item in cart and register and click submit button it would take him to payment page that is checkout.php*/
		
		echo "<script>window.open('checkout.php','_self')</script>";
	}
	
	else {                                                                         /* else means if customer are less then zero.means no customer*/
		
		$_SESSION['customer_email']= $c_email;                                       /* login button would change into logout.when user logged in.cos of this session*/
		
		echo "<script>alert('Account Created Successfully, Thank you !')</script>";      /* if customer hasnt selected any item in cart and register and click on submit button.it would redirect him to index.php*/
		
		echo "<script>window.open('index.php','_self')</script>";
	}
}

?>