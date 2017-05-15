<?php
$db = mysqli_connect("localhost","root","","myshop");
//function for getting the ip address

function getRealIpAddr()
{
if  (!empty($_SERVER['HTTP_CLIENT_IP']))

//CHECK IP FROM SHARE INTERNET

{
$ip=$_SERVER['HTTP_CLIENT_IP'];

}

else if  (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))

// to check if ip is pass from proxy

{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}

//Creating the script for cart

function cart(){                                                  /* adding ip address to add cart button*/
	if(isset($_GET['add_cart'])){
	global $db;	
	$p_id   = $_GET['add_cart'];
	$ip_add = getRealIpAddr();
	$check_pro = "SELECT * FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id'";         
	$run_check = mysqli_query($db,$check_pro);
	if(mysqli_num_rows($run_check)>0){
		
	echo "";	
		
	}
	
	else {
		
		
		$q="INSERT INTO cart(p_id,ip_add)VALUES ('$p_id','$ip_add') ";                    /*for testing.we are giving ip_add = 1*/
	
	    $run_q = mysqli_query($db,$q);
	    
		echo "<script>window.open('index.php','_self')</script>";                   /* refreshing the page by redirecting it to same page when add cart button is clicked*/           
	
	}
	}
	
	
}

// Getting number of items from the cart

     function items() {
	
     if(isset($_GET['add_cart'])){
	
	 global $db;
	 
	 $ip_add = getRealIpAddr();
	 
	 $get_items = "SELECT * FROM cart WHERE ip_add = '$ip_add' ";
	  
	  $run_items = mysqli_query($db,$get_items);

	  $count_items = mysqli_num_rows($run_items);                                /* Counting how many items user has added to cart*/
	  }	
	
	else 
	{
	  global $db;
	  
      $ip_add = getRealIpAddr();
	  
	  $get_items = "SELECT * FROM cart WHERE ip_add = '$ip_add' ";
	  
	  $run_items = mysqli_query($db,$get_items);

	  $count_items = mysqli_num_rows($run_items); 	 
		
		
	}

	  echo $count_items;
	}


	//Getting the total price of items from the cart
	
	function total_price(){
		
	   global $db;
	  
      $ip_add = getRealIpAddr();                                       /* saving ip address in local variable*/
	  
	 $total = 0;                                                       /*price should start from 0*/

	 $sel_price ="SELECT * FROM cart WHERE ip_add = '$ip_add'";         /* when user is online,detect its ip address by selecting it from cart table*/
		
	$run_price = mysqli_query($db,$sel_price);
	
	while($record=mysqli_fetch_array($run_price)) {
		
	$pro_id = $record['p_id'];	                                  /* We fetched  p_id from cart table in database with fetch array.fetchimg all ids that are selected bu user till now*/
	                                                                      /* relation between two tables.we are running another query cos price is not included in cart table.its in products table.so we are making relation between two tables to fetch price from another table*/
	$pro_price ="SELECT * FROM products WHERE product_id= '$pro_id'";     /* Now we are finding id in products table in database,those id that are present in cart table in database.only then we would able to get price of products*/
		
	$run_pro_price = mysqli_query($db,$pro_price);
	
	while($p_price=mysqli_fetch_array($run_pro_price)){
		
		
		$product_price = array($p_price['product_price']);               /* We need product_price from products table.we used array because we need multiple prices of products in array form like,500,400,300 and so on*/          
	
	    $values  = array_sum($product_price);                        /* we added prices of all products with the help of array_sum.its easy to add 2 things in php.but if things are more than 2 then arraysum is used to add sum of arrays.it will add price of records one by one as user click add cart button */
	
	    $total += $values;                                         /* we added values variable to total variable that was zero.if you delete products it will show 0*/
	
	}
	
	
	}
	
	   echo "$" . $total;                                          /* "$" currency*/
	}
	
	
	
function getPro(){
global $db;	

if (!isset($_GET['cat'])){

if (!isset($_GET['brand'])){

$get_products = "SELECT * FROM products order by rand()LIMIT 0,6";
$run_products = mysqli_query($db, $get_products);
while ($row_products=mysqli_fetch_array($run_products)){
	
	$pro_id    = $row_products['product_id'];
    $pro_title = $row_products['product_title'];
    $pro_desc  = $row_products['product_desc'];
	$pro_price = $row_products['product_price'];
	$pro_image = $row_products['product_img1'];
	
	 
	   echo "<div id='single_product' style='float:left; padding:10px; margin-left:20px;'>
	        
			<h3>$pro_title</h3> <br>
	        
			<div id='single_product img' style='border:2px solid #333;'>
			
			<img src='admin_area/product_images/$pro_image' width='180' height='118' /></div><br>
	        
			<p><b>Price: $ $pro_price </b></p>
			
			<a href='details.php?pro_id=$pro_id'><button style='float:left;'>Details</button></a>
			
			<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
			
			</div>";
		
	}
}
}                                                             /*brand isset bracket closed*/
}                                                            /*cat isset bracket closed*/



function getCatPro(){
global $db;	

if(isset($_GET['cat'])){
$cat_id = $_GET['cat'];

$get_cat_pro = "SELECT * FROM products WHERE cat_id='$cat_id'";
$run_cat_pro= mysqli_query($db, $get_cat_pro);
$count = mysqli_num_rows($run_cat_pro);
if($count==0){
	
	echo "<h2>No Products found in this category!</h2>";
	
}

while ($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	
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
			
			<a href='details.php?pro_id=$pro_id'><button style='float:left;'>Details</a></button>
			
			<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
			
			</div>";
		
	}
}
                                                            
}                                                            /*cat isset bracket closed*/







function getBrandPro(){
global $db;	

if(isset($_GET['brand'])){
$brand_id = $_GET['brand'];

$get_brand_pro = "SELECT * FROM products WHERE brand_id='$brand_id'";
$run_brand_pro= mysqli_query($db, $get_brand_pro);
$count = mysqli_num_rows($run_brand_pro);
if ($count==0){
	
	echo "<h2>No Products found in this brand!</h2>";
	
}

while ($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
	
	$pro_id    = $row_brand_pro['product_id'];
    $pro_title = $row_brand_pro['product_title'];
	$pro_desc  = $row_brand_pro['product_desc'];
	$pro_price = $row_brand_pro['product_price'];
	$pro_image = $row_brand_pro['product_img1'];
	
	 
	   echo "<div id='single_product' style='float:left; padding:10px; margin-left:20px;'>
	        
			<h3>$pro_title</h3> <br>
	        
			<div id='single_product img' style='border:2px solid #333;'>
			
			<img src='admin_area/product_images/$pro_image' width='180' height='180' /></div><br>
	        
			<p><b>Price: $ $pro_price </b></p>
			
			<a href='details.php?pro_id=$pro_id'><button style='float:left;'>Details</button></a>
			
			<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
			
			</div>";
		
	}
}
                                                            
}                                                            /*cat isset bracket closed*/









function getBrands(){
global $db;
$get_brands = "SELECT * FROM brands";                                                          /* selecting categories from database*/
$run_brands = mysqli_query($db,$get_brands);
while ($row_brands=mysqli_fetch_array($run_brands)){
$brand_id    = $row_brands['brand_id'];
$brand_title = $row_brands['brand_title'];

echo "<li><a href='index.php?>brand=$brand_id'>$brand_title</a></li>";                           /* Displaying Brand Titles*/
}

	
	
	
	
}


function getCats(){
global $db;	                                                                                /* selecting categories from database*/
$get_cats = "SELECT * FROM categories"; 
$run_cats = mysqli_query($db,$get_cats);
while ($row_cats=mysqli_fetch_array($run_cats)){
$cat_id    = $row_cats['cat_id'];
$cat_title = $row_cats['cat_title'];

echo "<li><a href='index.php?>cat=$cat_id'>$cat_title</a></li>";                              /* Displaying Category Titles*/
}	
	
	
	
}




?> 