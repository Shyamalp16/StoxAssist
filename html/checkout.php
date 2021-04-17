<?php
    require('top.php');

	if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
		?>
		<script>
			window.location.href="index.php";
		</script>
		<?php
	}
	if(!isset($_SESSION['USER_LOGIN'])){
		?>
		<script>
			window.location.href="index.php";
		</script>
		<?php
	}
	$shipping=0;
	$cart_total = 0;
	foreach($_SESSION['cart'] as $key=>$val){ 
		$productArr = get_product($con,'','',$key);
		$pprice=$productArr[0]['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($pprice*$qty);
		$final_total=$cart_total+$shipping;
	}

	if(isset($_POST['submit'])){
		$address=get_safe_value($con,$_POST['address']);
		$city=get_safe_value($con,$_POST['city']);
		$pincode=get_safe_value($con,$_POST['pincode']);
		$payment_type=get_safe_value($con,$_POST['payment_type']);
		$user_id=$_SESSION['USER_ID'];
		foreach($_SESSION['cart'] as $key=>$val){
			$productArr=get_product($con,'','',$key);
			$price=$productArr[0]['price'];
			$qty=$val['qty'];
			$cart_total=$cart_total+($price*$qty);
			
		}
		$total_price=$cart_total;
		$payment_status='pending';
		if($payment_type=='cod'){
			$payment_status='success';
		}
		$order_status='1';
		$added_on=date('Y-m-d h:i:s');
		
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

		mysqli_query($con,"insert into orders(user_id,address,city,pincode,payment_type,payment_status,order_status,added_on,total_price,txnid) values('$user_id','$address','$city','$pincode','$payment_type','$payment_status','$order_status','$added_on','$total_price','$txnid')");
		mysqli_query($con,"update product set qty = qty - '$qty'");

		$order_id=mysqli_insert_id($con);
		
		foreach($_SESSION['cart'] as $key=>$val){
			$productArr=get_product($con,'','',$key);
			$price=$productArr[0]['price'];
			$qty=$val['qty'];
			
			mysqli_query($con,"insert into order_detail(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')");
		}
		
		unset($_SESSION['cart']);
		
		if($payment_type=='payu'){
			$MERCHANT_KEY = "gtKFFx"; 
			$SALT = "eCwWELxi";
			$hash_string = '';
			//$PAYU_BASE_URL = "https://secure.payu.in";
			$PAYU_BASE_URL = "https://test.payu.in";
			$action = '';
			$posted = array();
			if(!empty($_POST)) {
			  foreach($_POST as $key => $value) {    
				$posted[$key] = $value; 
			  }
			}
			
			$userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));
			
			$formError = 0;
			$posted['txnid']=$txnid;
			$posted['amount']=$total_price;
			$posted['firstname']=$userArr['name'];
			$posted['email']=$userArr['email'];
			$posted['phone']=$userArr['mobile'];
			$posted['productinfo']="productinfo";
			$posted['key']=$MERCHANT_KEY ;
			$hash = '';
			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			if(empty($posted['hash']) && sizeof($posted) > 0) {
			  if(
					  empty($posted['key'])
					  || empty($posted['txnid'])
					  || empty($posted['amount'])
					  || empty($posted['firstname'])
					  || empty($posted['email'])
					  || empty($posted['phone'])
					  || empty($posted['productinfo'])
					 
			  ) {
				$formError = 1;
			  } else {    
				$hashVarsSeq = explode('|', $hashSequence);
				foreach($hashVarsSeq as $hash_var) {
				  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
				  $hash_string .= '|';
				}
				$hash_string .= $SALT;
				$hash = strtolower(hash('sha512', $hash_string));
				$action = $PAYU_BASE_URL . '/_payment';
			  }
			} elseif(!empty($posted['hash'])) {
			  $hash = $posted['hash'];
			  $action = $PAYU_BASE_URL . '/_payment';
			}
	
	
			$formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'"><input type="hidden" name="key" value="'.$MERCHANT_KEY.'" /><input type="hidden" name="hash" value="'.$hash.'"/><input type="hidden" name="txnid" value="'.$posted['txnid'].'" /><input name="amount" type="hidden" value="'.$posted['amount'].'" /><input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" /><input type="hidden" name="email" id="email" value="'.$posted['email'].'" /><input type="hidden" name="phone" value="'.$posted['phone'].'" /><textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="'.SITE_PATH.'/payment_complete.php" /><input type="hidden" name="furl" value="'.SITE_PATH.'/payment_fail.php"/><input type="submit" style="display:none;"/></form>';
			echo $formHtml;
			echo '<script>document.getElementById("payuForm").submit();</script>';
		}else{	
	
			?>
			<script>
				window.location.href='thank_you.php';
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
						<div id="address" class="w3-container checkout" >
							<h2>Enter Address Details</h2><br>
								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="address" name="address" placeholder="Street Address" required>
								</div>

								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="city" name="city" placeholder="City" required>
								</div>

								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="state" name="state" placeholder="State" required>
								</div>

								<div class="bor8 m-b-20 how-pos4-parent">
									<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" id="pincode" name="pincode" placeholder="Zipcode" required>
								</div>
						</div>

						<div id="payment" class="w3-container checkout" style="display:none"	>
							<h2>Select Your Payment Method</h2><br>	
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="payment_type" value="cod" required/>
  								<label class="form-check-label" for="cod">
    								Cash On Delivery
  								</label>
							</div>
							<div class="form-check">
  								<input class="form-check-input" type="radio" name="payment_type" value="payu" required/>
  								<label class="form-check-label" for="payu">
									PayU Gateway
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
						$subtotal=0;
						foreach($_SESSION['cart'] as $key=>$val){ 
							$productArr = get_product($con,'','',$key);
							$pname=$productArr[0]['name'];
							$pprice=$productArr[0]['price'];
							$pimage=$productArr[0]['image'];
							$qty=$val['qty'];
							$subtotal=$subtotal+($pprice*$qty);
						?>
						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<img class="ch" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$pimage?>" alt="IMG">
							</div>

							<div class="size-290">
								&nbsp; &nbsp; <strong><?php echo $pname?></strong><br>
								&nbsp; &nbsp; ₹<?php echo $pprice*$qty?>
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
								₹<?php echo $subtotal?>
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									INSERT DATA HERE LATER ON
								</p>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
								₹<?php echo $subtotal + $shipping?>
								</span>
							</div>
						</div>

						<input type="submit" name="submit" value="Place Order" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">

					</div>
				</div>
			</div>
		</div>
	<!-- </form> -->
	<?php
    require('footer.php');
    ?>
	<style>
		.ch {
			width: 100px;
			height: 100px;
			object-fit: contain;
		}
	</style>

<script>
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
</script>
