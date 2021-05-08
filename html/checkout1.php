<?php
require('top.php');
// prx($_SESSION['cart']);

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
	<script>
		window.location.href = "index.php";
	</script>
<?php
}
if (!isset($_SESSION['USER_LOGIN'])) {
?>
	<script>
		window.location.href = "index.php";
	</script>
	<?php
}
$shipping = 0;
$cart_total = 0;

if (isset($_POST['submit'])) {
	$address = get_safe_value($con, $_POST['address']);
	$city = get_safe_value($con, $_POST['city']);
	$state = get_safe_value($con, $_POST['state']);
	$pincode = get_safe_value($con, $_POST['pincode']);
	
	$payment_type = get_safe_value($con, $_POST['payment_type']);
	$user_id = $_SESSION['USER_ID'];



	foreach ($_SESSION['cart'] as $key => $val) {
		$productArr = get_product($con, '', '', $key);
		$productID = $productArr[0]['id'];
		$price = $productArr[0]['price'];
		$qty = $val['qty'];
		$cart_total = $cart_total + ($price * $qty);
	}
	$total_price = $cart_total;
	$payment_status = 'pending';
	if ($payment_type == 'cod') {
		$payment_status = 'success';
	}
	$order_status = '1';
	$added_on = date('Y-m-d h:i:s');

	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

	if(isset($_SESSION['COUPON_ID'])){
		$id = $_SESSION['COUPON_ID'];
        $coupon_value = $_SESSION['COUPON_VALUE'];
        $coupon = $_SESSION['COUPON_CODE'];
		$total_price = $total_price - $coupon_value;

		unset($_SESSION['COUPON_ID']);
		unset($_SESSION['COUPON_VALUE']);
		unset($_SESSION['COUPON_CODE']);
	}else{
		$id ='';
        $coupon_value ='';
        $coupon ='';
	}

	mysqli_query($con, "insert into orders(user_id,address,city,state,pincode,payment_type,payment_status,order_status,added_on,total_price,txnid,coupon_id,coupon_value,coupon_code) values('$user_id','$address','$city','$state','$pincode','$payment_type','$payment_status','$order_status','$added_on','$total_price','$txnid','$id','$coupon_value','$coupon')");
	$order_id = mysqli_insert_id($con);

	mysqli_query($con, "update product set qty = qty - '$qty' where id='$productID'");


	foreach ($_SESSION['cart'] as $key => $val) {
		$productArr = get_product($con, '', '', $key);
		$price = $productArr[0]['price'];
		$qty = $val['qty'];

		mysqli_query($con, "insert into order_detail(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
	}

	// if($coupon_value == ''){
	// 	unset($_SESSION['cart']);
	// }

	if ($payment_type == 'cod') {
		unset($_SESSION['cart']);
		sendInvoice($con, $order_id);
	}

	if ($payment_type == 'insta') {

		$userArr = mysqli_fetch_assoc(mysqli_query($con, "select * from users where id='$user_id'"));

		$formError = 0;
		$posted['txnid'] = $txnid;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
			array("X-Api-Key:test_88d8e1eba8fb209017fd154c5f5",
				"X-Auth-Token:test_e76dceda408cb010621016d2b65"));

		$payload = Array(
			'purpose' => "Product From StoxAssist",
			'amount' => $total_price,
			'phone' => $userArr['mobile'],
			'buyer_name' => $userArr['name'],
			'redirect_url' => 'http://localhost/StoxAssist/payment_complete1.php',
			'send_email' => true,
			'send_sms' => true,
			'email' => $userArr['email'],
			'allow_repeated_payments' => false
		);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 
		$response = json_decode($response);
		$_SESSION['TID']=$response->payment_request->id;
		mysqli_query($con, "update orders set txnid='".$response->payment_request->id."' where id='$order_id'");
		?>
		<script> 
			window.location.href = '<?php echo $response->payment_request->longurl; ?>';
		</script>
		<?php
		die();
	} else {
		// sendInvoice($con, $user_id);
	?>
		<script>
			window.location.href = 'thank_you.php';
		</script>
		
<?php
	}
}

?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<br>
<br>
<br>
<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>
		<span class="stext-109 cl4">
			Checkout
		</span>
	</div>
</div>

<!-- Shoping Cart -->
<!-- <form class="bg0 p-t-75 p-b-85"> -->
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
			<div class="m-l-25 m-r--38 m-lr-0-xl">
				<div class="w3-container">
					<h2>Checkout Process</h2>
					<br>
					<div class="w3-row">
						<a href="javascript:void(0)" onclick="openTab(event, 'address');">
							<div class="w3-third tablink w3-border-red w3-bottombar w3-hover-light-grey w3-padding">Address Information</div>
						</a>
						<a href="javascript:void(0)" onclick="openTab(event, 'payment');">
							<div class="w3-third tablink  w3-bottombar w3-hover-light-grey w3-padding">Payment Methods</div>
						</a>
					</div>

					<form method="post">
						<div id="address" class="w3-container checkout appendMe"> 
						<!-- HERE -->
							<?php
								$uid = $_SESSION['USER_ID'];
								$res = mysqli_query($con, "select address,city,state,pin from users where id='$uid'");
								$row = mysqli_fetch_assoc($res);
							?>
							<div class="card" id="addressCard" style="margin:35px 0px;">
								<div class="card-header">
									Saved Address
								</div>
								<div class="card-body">
									<p class="card-text"> Address: <?php echo $row['address'] ?> </p>
									<p class="card-text"> City: <?php echo $row['city'] ?> </p>
									<p class="card-text"> State: <?php echo $row['state'] ?> </p>
									<p class="card-text"> Pincode: <?php echo $row['pin'] ?> </p>
									<input type="hidden" name="address" id="address" value="<?php echo $row['address'] ?>" />
									<input type="hidden" name="city" id="city" value="<?php echo $row['city'] ?>" />
									<input type="hidden" name="state" id="state" value="<?php echo $row['state'] ?>" />
									<input type="hidden" name="pincode" id="pincode" value="<?php echo $row['pin'] ?>" />
									<input type="button" style="margin-top:15px; cursor:pointer;" value="Select This" class="btn btn-primary">
									<input type="button" onclick="setValue();" style="margin-top:15px; cursor:pointer;" value="Enter New Address" class="btn btn-primary">
								</div>
							</div>
						</div>
						<div id="payment" class="w3-container checkout" style="display:none">
							<h2>Select Your Payment Method</h2><br>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="payment_type" value="cod" required />
								<label class="form-check-label" for="cod">
									Cash On Delivery
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="payment_type" value="insta" required />
								<label class="form-check-label" for="insta">
									Instamojo Gateway
								</label>
							</div><br>
						</div>
						<input type="submit" href="#" name="submit" value="Place Order" class="flex-c-m stext-101 cl0 size-101 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" />
					</form>
				</div>
			</div><br><br>
		</div>

		<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
			<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
				<h4 class="mtext-109 cl2 p-b-30">
					Final Review OF Order
				</h4>

				<?php
				$subtotal = 0;
				foreach ($_SESSION['cart'] as $key => $val) {
					$productArr = get_product($con, '', '', $key);
					$pname = $productArr[0]['name'];
					$pprice = $productArr[0]['price'];
					$pimage = $productArr[0]['image'];
					$qty = $val['qty'];
					$subtotal = $subtotal + ($pprice * $qty);
				?>
					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<img class="ch" src="<?php echo PRODUCT_IMAGE_SITE_PATH . $pimage ?>" alt="IMG">
						</div>

						<div class="size-290">
							&nbsp; &nbsp; <strong><?php echo $pname ?></strong><br>
							&nbsp; &nbsp; ₹<?php echo $pprice * $qty ?>
						</div>
					</div>
				<?php }
				?>
				<br>

				<div class="flex-w flex-t bor12 p-b-13">
					<div class="size-208">
						<span class="stext-110 cl2">
							Subtotal:
						</span>
					</div>
					<div class="size-209">
						<span class="mtext-110 cl2">
							₹<?php echo $subtotal ?>
						</span>
					</div>
				</div>

				<div class="flex-w flex-sb-m  p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
					<div class="flex-w flex-m m-r-20 m-tb-5">
						<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" id="coup" type="text" name="coupon" placeholder="Coupon Code">
						<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
							<input type="button" onclick="coupon()" value="Apply Coupon" />
						</div>
					</div>
				</div>
				<span class="d-block text-center my-4 text-muted msg" style="color:red;font-size:15px;"> </span>


				<div class="flex-w flex-t p-t-27 p-b-33 couponBOX">
					<div class="div" style="display:flex">
						<div class="size-208">
							<span class="mtext-101 cl2">
								Discount:
							</span>
						</div>
						<div class="size-209 p-t-1" style="display:flex;">
							<span class="mtext-110 cl2 discountPrice">
								
							</span>
						</div>
					</div>
				</div>

				<div class="flex-w flex-t p-t-27 p-b-33">
					<div class="size-208">
						<span class="mtext-101 cl2">
							Total:
						</span>
					</div>

					<div class="size-209 p-t-1">
						<span class="mtext-110 cl2 total">
							₹<?php echo $subtotal + $shipping ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- </form> -->

<?php
	if(isset($_SESSION['COUPON_ID'])){
		$id = $_SESSION['COUPON_ID'];
        $coupon_value = $_SESSION['COUPON_VALUE'];
        $coupon = $_SESSION['COUPON_CODE'];
		
		unset($_SESSION['COUPON_ID']);
		unset($_SESSION['COUPON_VALUE']);
		unset($_SESSION['COUPON_CODE']);
	}
require('footer.php');
?>
<style>
	.ch {
		width: 100px;
		height: 100px;
		object-fit: contain;
	}

	.msg {
		font-weight: 900;
	}

	.couponBOX {
		display: none;
		/* display:flex; */
	}
</style>

<script type="text/html" id="appendTemplate">
	<div class="container" id="inputContainer">
		<h2>Enter Address Details</h2><br>
		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 addr" onblur="validateA();" type="text" class="ipnutID" id="address" name="address" placeholder="Street Address" required>
		</div>

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" onblur="validateC();" type="text" class="ipnutID" id="city" name="city" placeholder="City" required>
		</div>

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" onblur="validateS();" type="text" class="ipnutID" id="state" name="state" placeholder="State" required>
		</div>

		<div class="bor8 m-b-20 how-pos4-parent">
			<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" onblur="validateP();" type="text" class="ipnutID" id="pincode" name="pincode" placeholder="Zipcode" required>
		</div>
		<span class="msg" style="display:none"> </span>
	</div>
</script>

<script>
	function setValue(){
		var template = $('#appendTemplate').html();
		var remove = $('#addressCard').remove();
		$('.appendMe').append(template);
	}

	function openTab(evt, tabName) {
		var i, x, tablinks;
		x = document.getElementsByClassName("checkout");
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < x.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
		}
		document.getElementById(tabName).style.display = "block";
		evt.currentTarget.firstElementChild.className += " w3-border-red";
	}


	function validateA() {
		var address = jQuery('.addr').val();

		if (address == "") {
			jQuery("#errA").html('Enter Address Please');
			jQuery("#errA").show();
		} else {
			jQuery("#errA").hide();
		}
	}

	function validateC() {
		var city = jQuery('#city').val();

		if (city == "") {
			jQuery("#errC").html('Enter City Please');
			jQuery("#errC").show();
		} else {
			jQuery("#errC").hide();
		}
	}

	function validateS() {
		var state = jQuery('#state').val();

		if (state == "") {
			jQuery("#errS").html('Enter State Please');
			jQuery("#errS").show();
		} else {
			jQuery("#errS").hide();
		}
	}

	function validateP() {
		var pin = jQuery('#pincode').val();

		if (pin == "") {
			jQuery("#errP").html('Enter Pincode Please');
			jQuery("#errP").show();
		} else {
			jQuery("#errP").hide();
		}
	}
</script>