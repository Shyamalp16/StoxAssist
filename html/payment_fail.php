<?php
require('html/connection.inc.php');
require('html/functions.inc.php');

echo '<pre>';
print_r($_POST);
$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$txnid=$_POST["txnid"];

mysqli_query($con,"update orders set payment_status='$status', mihpayid='$pay_id' where txnid='$txnid'");	
?>

<p> Payment Failed, Use following button to go back to webpage </p>
<a href="html/index.php"> HOMEPAGE </button>
