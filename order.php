<?php
include("includes/db.php");
include("functions/functions.php");




//Getting Customer Id

if(isset($_GET['c_id'])){                                  /* getting customer_id that we stored in line 43 in payment_options.php page order.php?c_id.we are receiving c_id that was sent from payment_option page*/

$customer_id = $_GET['c_id'];

$c_email     = "SELECT * FROM customers WHERE customer_id='$customer_id'";

$run_email   = mysqli_query($con ,$c_email);

$row_email   =mysqli_fetch_array($run_email);

$customer_email=$row_email['customer_email'];

$customer_name= $row_email['customer_name'];
}


// Getting products price and number of items

 
	  
      $ip_add = getRealIpAddr();                                       /* saving ip address in local variable*/
	  
	 $total = 0;                                                       /*price should start from 0*/

	 $sel_price ="SELECT * FROM cart WHERE ip_add = '$ip_add'";         /* when user is online,detect its ip address by selecting it from cart table*/
		
	$run_price = mysqli_query($db,$sel_price);
	
	$status    = 'Pending';
	
	$invoice_no = mt_rand();                                          /* you can insert any random number in table*/
	
	$i=0;
	
	$count_pro  = mysqli_num_rows($run_price);                       /*Products user selected would be presnt here*/
	
	while($record=mysqli_fetch_array($run_price)) {
		
	$pro_id = $record['p_id'];	                                  /* We fetched  p_id from cart table in database with fetch array.fetchimg all ids that are selected bu user till now*/
	                                                                      /* relation between two tables.we are running another query cos price is not included in cart table.its in products table.so we are making relation between two tables to fetch price from another table*/
	$pro_price ="SELECT * FROM products WHERE product_id= '$pro_id'";     /* Now we are finding id in products table in database,those id that are present in cart table in database.only then we would able to get price of products*/
		
	$run_pro_price = mysqli_query($db,$pro_price);
	
	while($p_price=mysqli_fetch_array($run_pro_price)){
		
		$product_name = $p_price['product_title'];
		
		$product_price = array($p_price['product_price']);               /* We need product_price from products table.we used array because we need multiple prices of products in array form like,500,400,300 and so on*/          
	
	    $values  = array_sum($product_price);                        /* we added prices of all products with the help of array_sum.its easy to add 2 things in php.but if things are more than 2 then arraysum is used to add sum of arrays.it will add price of records one by one as user click add cart button */
	
	    $total += $values;                                         /* we added values variable to total variable that was zero.if you delete products it will show 0*/
	
	     $i++;
	
	}
	
	
	}
	
	// Getting Quantity from Cart

   $get_cart = "SELECT * FROM cart";	

   $run_cart = mysqli_query($con,$get_cart);
   
   $get_qty  = mysqli_fetch_array($run_cart);
   
   $qty      = $get_qty['qty'];                                    /* fetching qty field from cart */
   
   if($qty==0){
	   
	  $qty=1;

      $sub_total = $total;
     	   
   }
   
   else {                                                       /* means if quantity is other than 0*/
	   
	   
	   $qty = $qty;
   
       $sub_total = $total*$qty;
   }
   
   $insert_order = "INSERT INTO customer_orders(customer_id,due_amount,invoice_no,total_products,
   order_date,order_status) VALUES('$customer_id','$sub_total','$invoice_no','$count_pro',NOW(),'$status') ";
   
   $run_order = mysqli_query($con,$insert_order);                                  /*$product name in line 151 taken from $product name in line 53*/
                                                                                   /* $customer name in line 128 taken from $customer name in line 18*/
   
   
	   
	   
	   echo "<script>alert('Order Successfully Submitted, Thanks!')</script>";
  
       echo "<script>window.open('customer/my_account.php','_self')</script>";
 
       
 
       $insert_to_pending_orders = "INSERT INTO pending_orders(customer_id,invoice_no,product_id,qty,order_status)
	   VALUES('$customer_id','$invoice_no','$pro_id','$qty','$status')";
 
       $run_pending_order = mysqli_query($con,$insert_to_pending_orders);
 
       $empty_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";                         /*empty cart when no product is there*/
	   
	   $run_empty  = mysqli_query($con,$empty_cart);
   
       $from = "mysite@academy.com";
   
       $subject = "Order Details";
   
       $message="
	   
	   <html>
	   
	   <p>Hello dear<b style='color:blue;'>$customer_name;</b> You have ordered some products from our website mysite.com, please find your order 
      details below and pay the dues as soon as possible so we can proceed your orders, thankyou!</p>
	   
	   <table width='600' align='center' bgcolor='#FFCC99' border='2'>
	   
	   <tr>
	   
	   <td><h2>Your Order Details from mysite.com</h2></td>
	   
	   </tr>
	   
	   <tr>
	   
	   <th><b>S.No</b></th>
	   
	   <th><b>Product Name</b></th>
	   
	   <th><b>Quantity</b></th>
	   
	   <th><b>Total Price</b></th>
	   
	   <th><b>Invoice No</b></th>
	   
	   </tr>
	   
	   <tr>
	   
	   <td>$i</td>
	   
	   <td>$product_name</td>                                             
	   
	   <td>$qty</td>
	   
	   <td>$sub_total</td>
	   
	   <td>$invoice_no</td>
	   
	   </tr>
	   
	   
	   
	   </table>
	   
	   <h3>Please go to your account and pay the dues</h3>
	   
	   <h2><a href='mysite.com'>Click Here</a> to Login to Your Account</h2>
	   
	   <h3>Thank you for order on - www.mysite.com</h3>
	   
	   </html>
	   
	   
	   ";
   
      mail($customer_email,$subject,$message,$from);

  ?>                                                                   