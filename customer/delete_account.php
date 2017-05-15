<form action="" method="post">

<table align="center" width="600">

<tr align="center">
<td colspan="2"><h2>Do You Really Want to Delete Your Account?</h2></td>
</tr>

<tr align="center">
<td><input type="submit" name="yes" value="Yes,I Want to Delete" title="I Want to Delete"/>
    <input type="submit" name="no" value= " No, I Dont Want to Delete" title="I Do Not Want to Delete"/></td>
</tr>


</table>
</form>

<?php                                              /*We dont need to start session cos it is already started in my_account.php*/


include("includes/db.php");

$c = $_SESSION['customer_email'];

if(isset($_POST['yes'])){
	
	$delete_customer = "DELETE FROM customers WHERE customer_email = '$c'";
	
	$run_delete      = mysqli_query($con,$delete_customer);
	
	if($run_delete){
		
		session_destroy();
		
		echo"<script>alert('Your Account has been Deleted, Good Bye!')</script>";
		
	    echo"<script>window.open('../index.php','_self')</script>";
	
	}
}

if(isset($_POST['no'])){

      echo"<script>window.open('my_account.php','_self')</script>";



}
?>