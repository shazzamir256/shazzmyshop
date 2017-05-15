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
<span>- Total Items: <?php items(); ?> - Total Price: <?php echo total_price(); ?>&nbsp;-&nbsp;<a href="index.php" style="color:yellow;text-decoration:none;">Back to Shopping</a>&nbsp;

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

<form action="cart.php"  method="POST"  enctype="multipart/form-data" />
<table width="749" align="center" bgcolor="#0099CC">
<tr align="center">
<td><b>Remove</b></td>
<td><b>Product</b></td>
<td><b>Quantity</b></td>
<td><b>Total Price</b></td>
</tr>
<?php

	  
      $ip_add = getRealIpAddr();                                       /* saving ip address in local variable*/
	  
	 $total = 0;                                                       /*price should start from 0*/

	 $sel_price ="SELECT * FROM cart WHERE ip_add = '$ip_add'";         /* when user is online,detect its ip address by selecting it from cart table*/
		
	$run_price = mysqli_query($con,$sel_price);
	
	while($record=mysqli_fetch_array($run_price)) {
		
	$pro_id = $record['p_id'];	                                  /* We fetched  p_id from cart table in database with fetch array.fetchimg all ids that are selected bu user till now*/
	                                                                      /* relation between two tables.we are running another query cos price is not included in cart table.its in products table.so we are making relation between two tables to fetch price from another table*/
	$pro_price ="SELECT * FROM products WHERE product_id= '$pro_id'";     /* Now we are finding id in products table in database,those id that are present in cart table in database.only then we would able to get price of products*/
		
	$run_pro_price = mysqli_query($con,$pro_price);
	
	while($p_price=mysqli_fetch_array($run_pro_price)){
		
		
		$product_price = array($p_price['product_price']);               /* We need product_price from products table.we used array because we need multiple prices of products in array form like,500,400,300 and so on*/          
	
	    $product_title=$p_price['product_title'];
		
		$product_image=$p_price['product_img1'];
		
		$values  = array_sum($product_price);                        /* we added prices of all products with the help of array_sum.its easy to add 2 things in php.but if things are more than 2 then arraysum is used to add sum of arrays.it will add price of records one by one as user click add cart button */
	
	    $only_price= $p_price['product_price'];                     /* show each product price seperately*/
		
		$total += $values;                                         /* we added values variable to total variable that was zero.if you delete products it will show 0*/
	
	
	   
	
	?>
<tr align="center">
<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>     <!-- "[]" used to check multiple items-->
<td><?php echo $product_title;?><br><img src="admin_area/product_images/<?php echo $product_image;?>" height="80" width="80"></td>
<td><input type="text" name="qty" value="1" size="1"/></td>

<?php
if(isset($_POST['update'])){                                     /* on clicking update button.we saved quantity selected by user into local variable $qty and updated the default qty with $qty*/ 

$qty = $_POST['qty'];                                           /* the incoming quantity fro user*/

$insert_qty="UPDATE cart SET qty ='$qty WHERE ip_add = '$ip_add'";                     /*  update the default quantity with above quantity $qty.if customer selected 2 items and its price is 400 .it would become 800*/   

$run_qty = mysqli_query($con,$insert_qty);                                         /* only update those quantity that are equal to number 97 ip_add.dont update all*/

$total = $total * $qty;
?>

<td><?php echo "$" .$only_price; ?></td>
</tr>

	<?php }}} ?>                                                  <!-- brackets closed here cos we want to keep script in while loop,so that value can be repeated selected by user again and again,records in above <tr> should repeat again and again.all 2 while loops closing.and if closing.-->
	
	  <tr>
	  <td colspan="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub Total:</b></td>
	  <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$". $total; ?></b></td>
	  </tr>                                                           <!--"name=remove" it will show the number of checkboxes according to the products selected by user on page-->
	
	<tr></tr> <tr></tr> <tr></tr> <tr></tr>  <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr>  <tr></tr> <tr></tr> <tr></tr> <tr></tr>
     <tr></tr> <tr></tr> <tr></tr> <tr></tr>  <tr></tr> <tr></tr> <tr></tr> <tr></tr><tr></tr> <tr></tr> <tr></tr> <tr></tr>  <tr></tr> <tr></tr> <tr></tr> <tr></tr>
	 <tr></tr> <tr></tr> <tr></tr> <tr></tr>                       <!-- blank <tr> is used to create space-->
	<tr align="center">
<td><input type="submit" name="update" value="Update Cart"/></td>
<td><input type="submit" name="continue" value="Continue Shopping"/></td>
<td><button><a href="checkout.php" style="text-decoration:none;color:#000;">Check Out</button></a></td>
</tr>
</table>
</form>

<?php                                                                        /* we are adding it to a function cos foreach loop wont work until checkbox is clicked.without click it would give an error*/
                                                                    
function updatecart(){																	/* what we are doing is we are saving name="remove[] on line 133 into $remove_id.cos we cant delete items from cart until we make it an id*/
 
 global $con;                                                        /* variable will work in function only when its defined as global*/
 
 if(isset($_POST['update'])){
	 
	 foreach($_POST['remove'] as $remove_id){                       /* taking remove as post method and saving it as $remove_id variable .making it a local variable.so that we can remove all fields as id*/
		 
		 $delete_products = "DELETE FROM cart WHERE p_id='$remove_id'";
	 
	     $run_delete      =  mysqli_query($con,$delete_products);
		 
		 if($run_delete) {
			 
			echo "<script>window.open('cart.php','_self')</script>"; 
			 
		 }
	 }

 
 }

 if(isset($_POST['continue'])){

          echo "<script>window.open('index.php','_self')</script>"; 
	 }
 
}
 echo @$up_cart= updatecart();                                     /* @ used to keep function inactive .we used up_cart cos we cant use it directly.if its inactive it doesnt generate error.on active it would work.the checkbox*/
 
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