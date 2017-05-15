
<!DOCTYPE html>

<html>
<head>
<title>
</title>
</head>
<body>

<?php

include("includes/db.php");




?>
<div align="center">

<h2>Payments Options For You</h2><br><br>


<?php

$ip = getRealIpAddr();

$get_customer = "SELECT * FROM customers WHERE customer_ip = '$ip'";           /* ip address of customer selecting product would match this ip*/

$run_customer = mysqli_query($con,$get_customer);

$customer     = mysqli_fetch_array($run_customer);

$customer_id  = $customer['customer_id'];                                     /* we are fetching customer id from database and saving it in customer id variable*/

?>
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

Pay with&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.paypal.com/">

<img src="images/paypal-shazz.png" width="200" height="80"/></a><b>&nbsp;&nbsp;&nbsp;                                         <!-- ip of customer is already present in cart.when he registered.so we would get id of customer by matching his ip in cart-->

Or&nbsp;&nbsp;&nbsp;<a href="order.php?c_id=<?php echo $customer_id; ?>" style="text-decoration:none;">Pay Offline</a></b>   <!-- storing $customer_id above in c_id .gettin this id on order.php.in this way we would know which customer placed the order-->
                                                                                                                              <!-- we are sending c_id to order.php page-->
<br><br>

<b>Note:If you selected "Pay Offline" option then please check your email or account to find the Invoice No for your order</b>

</div>

</body>
</html>