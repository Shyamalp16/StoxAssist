<?php
echo '<b>Transaction In Process, Please do not reload</b>';

require('html/connection.inc.php');
require('html/functions.inc.php');

if(isset($_GET['payment_status']) && isset($_GET['payment_id']) && isset($_GET['payment_request_id'])){

	$payment_id=$_GET['payment_id'];
	$payment_status=$_GET['payment_status'];
	$payment_request_id=$_GET['payment_request_id'];
	
	$res = mysqli_query($con,"select orders.*, users.name,users.email from orders,users where orders.txnid='$payment_request_id' and orders.user_id=users.id");

	if(mysqli_num_rows($res) > 0){
		$row = mysqli_fetch_assoc($res);
		$oid = $row['id'];
		$user_id==$row['user_id'];

		$_SESSION['USER_LOGIN'] = 'yes';
		$_SESSION['USER_EMAIL'] = $row['email'];
		$_SESSION['USER_ID'] = $user_id;
		$_SESSION['USER_NAME'] = $row['name'];

		if($payment_status == 'credit'){
			mysqli_query($con,"update orders set payment_status='complete', mihpayid='$payment_id' where txnid='$payment_request_id'");	
			?>
			<script>
				window.location.href="thank_you.php";
			</script>
			<?php
		}else{
			mysqli_query($con,"update orders set payment_status='$status', mihpayid='$payment_id' where txnid='$payment_request_id'");	
			?>
			<script>
				window.location.href="payment_fail.php";
			</script>
			<?php
		}
	}else{
		?>
		<script> window.location.href="payment_fail.php"; </script>
		<?php
	}

	
}
?>