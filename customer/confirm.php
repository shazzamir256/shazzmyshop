<?php

session_start();
include("includes/db.php");

if(isset($_GET['order_id'])){
	
	$order_id = $_GET['order_id'];

	}


?>

<!DOCTYPE HTML>

<html>
<head>
<title>
</title>
</head>
<body bgcolor="#FFCCCC">

<form action="confirm.php?update_id=<?php echo $order_id;  ?>" method="post">

<br><br><br><br><br><br>
<table width="500" align="center" border="2" bgcolor="#3781C2">

<tr align="center">

<td colspan="5"><h2 style="color:white;">Please Confirm your Payment</h2></td>

</tr>

<tr style="color:white;">

<td align="right">Invoice No:</td>
<td><input type="text" name="invoice_no"/></td>

</tr>

<tr style="color:white;">

<td align="right">Amount Sent:</td>
<td><input type="text" name="amount"/></td>

</tr>



<tr style="color:white;">

<td align="right">Select Payment Mode:</td>
<td>
<select name="payment_method">
<option>Select Payment</option>
<option>Bank Transfer</option>
<option>Easypaisa/UBL Omni</option>
<option>Western Union</option>
<option>Paypal</option>

</select>
</td>

</tr>

<tr style="color:white;">

<td align="right">Transaction/Reference ID:</td>
<td><input type="text" name="tr"/></td>

</tr>

<tr style="color:white;">

<td align="right">Easypaisa/UBLOMNI code:</td>
<td><input type="text" name="code"/></td>

</tr>


<tr style="color:white;">

<td align="right">Payment Date:</td>
<td><input type="text" name="date"/></td>

</tr>

<tr align="center">


<td colspan="5"><input type="submit" name="confirm" value="Confirm Payment" /></td>

</tr>


</table>
</form>




</body>
</html>

<?php

if(isset($_POST['confirm'])){
	
$update_id = $_GET['update_id'];
	
$invoice = $_POST['invoice_no'];

$amount = $_POST['amount'];

$payment_method = $_POST['payment_method'];

$ref_no = $_POST['tr'];
	
$code = $_POST['code'];
	
$date = $_POST['date'];
	
$complete = 'Complete';
	
	$insert_payment = "INSERT INTO payments (invoice_no,amount,payment_mode,ref_no,code,payment_date)
	                   
					   VALUES('$invoice','$amount','$payment_method','$ref_no','$code','$date')";
	
	
	$run_payment   = mysqli_query($con,$insert_payment);
	
	$update_order = "UPDATE customer_orders SET order_status = 'Complete' WHERE order_id ='$update_id'";                    /* change pending staus in database to complete*/
	                                                                                                                       /*order_id means change only those that contain order_id not all */
	$run_order   = mysqli_query($con,$update_order);
	
	
	$update_pending_orders="UPDATE pending_orders SET order_status='$complete' WHERE order_id='$update_id'";
	
	$run_pending_orders=mysqli_query($con, $update_pending_orders);
	
	if($run_payment){
		
		
		  echo "<h2 style='text-align:center; color:black;'><br><br><br><br> Payment receieved,your order will be received within 24 hours</h2>";
	}
	
	
	

	
	}


?>