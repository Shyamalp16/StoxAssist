<?php
    require('top.php');
	$cat_id=mysqli_real_escape_string($con,$_GET['id']);
	if($cat_id>0){
		$get_product=get_product($con,'',$cat_id,'');
	}else{
	?> 
	<script>
		window.location.href='index.php';
	</script>
	<?php
	}
?>

<?php

?>
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			<div class="header-cart-content flex-w js-pscroll">
				<?php
				foreach($_SESSION['cart'] as $key=>$val){
				$productArr = get_product($con,'','',$key);
				$pname=$productArr[0]['name'];
				$pprice=$productArr[0]['price'];
				$pimage=$productArr[0]['image'];
				$qty=$val['qty'];
				?>
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$pimage?>" alt="IMG">
						</div>
						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?php echo $pname?>
							</a>
							<span class="header-cart-item-info">
							<?php echo $qty?> x $<?php echo $pprice?>
							</span>
						</div>
					</li>
				</ul>
				<?php } ?>
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: <?php echo $total?> Items
					</div>
					<div class="header-cart-buttons flex-w w-full">
						<a href="cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>
						<a href="cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140 marg">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>
				</div>
			</div>
			<?php if(count($get_product)>0) { ?>
			<div class="row isotope-grid">
				<?php
    				foreach($get_product as $list){
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic v-img0">
							<a href="product-detail.php?id=<?php echo $list['id']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 ">
								<img class="prodimg" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="IMG-PRODUCT">
							</a>
					</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.php?id=<?php echo $list['id'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $list['name'] ?>
								</a>
								<span class="stext-105 cl3">
								$<?php echo $list['price'] ?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php }else {
				echo "No Products For Specified Category";
			}?>

		</div>
	</section>
<?php
    require('footer.php');
?>