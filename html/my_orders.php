<?php
    require('top.php');
?>
<br>
	<!-- Content page -->
	<section class="bg0 p-t-62 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						<!-- item blog -->
                        <?php
						$count=0;
                        $uid=$_SESSION['USER_ID'];
                        // $res=mysqli_query($con,"select orders.*,product.name,product.image,product.price,product.id,order_detail.product_id from orders,product,order_detail where orders.user_id='$uid' and product.id=order_detail.product_id");
						$res=mysqli_query($con,"select orders.*,order_status.name as order_status_name,product.name,product.image,product.price,order_detail.product_id from orders,order_status,product,order_detail where orders.user_id='$uid' and product.id=order_detail.product_id and orders.id=order_detail.id and order_status.id=orders.order_status");
						// pr($res);
                        // $res=mysqli_query($con,"select * from orders where user_id='$uid'");
                        while($row=mysqli_fetch_assoc($res)){ 
								$count++;
							?>
						<div class="padbot">
							<div class="p-t-32">
								<hr>
                                <div class="flex-w flex-t bor12 p-b-13">
							        <div class="size-208 moimg">
								        <a href="order_details.php?id=<?php echo $row['id'] ?>"><img class="ch" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="IMG"></a>
							        </div>

							        <div class="size-290 txt-right">
								        <a class="ptag" href="order_details.php?id=<?php echo $row['id'] ?>"><strong><?php echo $row['name']?></strong></a><br>
								        $<?php echo $row['price']?>
							        </div>
						        </div>
								<div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">By</span> <?php echo $_SESSION['USER_NAME'] ?> 
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>
										<span>
											<?php echo $row['added_on'] ?>  
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>
										<span>
											<strong>Order ID:</strong> #<?php echo $row['id'] ?>
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>
										<span>
											<strong>Order Status:</strong>&nbsp;<?php echo $row['order_status_name'] ?>
										</span>
									</span>
									<a href="order_details.php?id=<?php echo $row['id'] ?>" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
										More Information
										<i class="fa fa-long-arrow-right m-l-9"></i>
									</a>
								</div>
							</div>
						</div>
						<!-- <?php 
						 	foreach ($row as $field => $value){
								 echo $value;
							 }
						?> -->
                        <?php } echo $count; ?>

						<!-- Pagination -->
						<!-- <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
							<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
								1
							</a>

							<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">
								2
							</a>
						</div> -->
					</div>
				</div>
            
				<!-- <div class="col-md-4 col-lg-3 p-b-80">
					<div class="side-menu">
		                <div class="bor17 of-hidden pos-relative">
							<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

							<button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
								<i class="zmdi zmdi-search"></i>
                        </button>
						</div>

						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-33">
								Your Orders
							</h4>

							<ul>
								<li class="bor18">
									<a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
										DIY & Crafts
									</a>
								</li>
							</ul>
						</div>

						<div class="p-t-65">
							<h4 class="mtext-112 cl2 p-b-33">
								Featured Products
							</h4>

							<ul>
								<li class="flex-w flex-t p-b-30">
									<a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
										<img src="images/product-min-01.jpg" alt="PRODUCT">
									</a>

									<div class="size-215 flex-col-t p-t-8">
										<a href="#" class="stext-116 cl8 hov-cl1 trans-04">
											White Shirt With Pleat Detail Back
										</a>

										<span class="stext-116 cl6 p-t-20">
											$19.00
										</span>
									</div>
								</li>
							</ul>
						</div>

						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-20">
								Archive
							</h4>

							<ul>
								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											July 2018
										</span>

										<span>
											(9)
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
			</div> 
		</div>
	</section>	
	
		
	<style>
		.ch {
			width: 100px;
			height: 100px;
			object-fit: contain;
		}

		.ptag {
			color: inherit;
		}

	</style>
<?php 
    require('footer.php');
?>