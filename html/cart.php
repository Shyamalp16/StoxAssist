<?php
    require('top.php');
	// prx($_SESSION['cart']);
?>
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
				Shoping Cart
			</span>
		</div>
	</div>
		
	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
                                    <th class="column-5">Del</th>
								</tr>
                                <?php
								if(isset($_SESSION['cart'])){
									$cart_total = 0;
									$shipping=0;
									foreach($_SESSION['cart'] as $key=>$val){
									$productArr = get_product($con,'','',$key);
									$pname=$productArr[0]['name'];
									$pprice=$productArr[0]['price'];
									$pimage=$productArr[0]['image'];
									$qty=$val['qty'];
									$cart_total=$cart_total+($pprice*$qty);
                                ?>    
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$pimage?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?php echo $pname?></td>
									<td class="column-3">₹<?php echo $pprice?></td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <input class="txt-center" type="text" name="num-product1" id="<?php echo $key?>qty" value="<?php echo $qty?>" onblur="manageCart('<?php echo $key?>','update')" >
                                        </div>
                                    </td>
									<td class="column-5"><?php echo $qty*$pprice ?></td>
                                    <td class="column-6 txt-center"><a href="javascript:void(0)" onclick="manageCart('<?php echo $key?>','remove')"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg></a></td>
								</tr>
                                <?php } ?>
								<?php } ?>
							</table>
						</div>
						<br>
						
						<a href="index.php" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Continue Shopping
						</a>


					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Total
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Total:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									<?php if(isset($_SESSION['cart'])){ ?>
										₹<?php echo $cart_total?>
									<?php }else{ ?>
										<?php echo "Cart Empty"?>
										<?php } ?>
								</span>
							</div>							
						</div>



						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<!-- <div class="size-208 w-full-ssm">
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
								$<?php echo $cart_subtotal + $shipping?>
								</span>
							</div> -->
						</div>

						<?php if(isset($_SESSION['USER_LOGIN'])){ ?>
						<a href="checkout1.php" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</a>
						<?php }else{ ?>
						<a href="login.php" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Please Login First
						</a>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</form>
	<?php
    require('footer.php');
    ?>