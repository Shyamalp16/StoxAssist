<?php
	require('top.php');
	if(isset($_GET['id'])){
		$product_id=mysqli_real_escape_string($con,$_GET['id']);
		$product_id = preg_replace("/[^0-9]/", "", $product_id );
		if($product_id>0){
			$get_product=get_product($con,'','',$product_id);
		}else{
			?>
			<script>
			window.location.href='index.php';
			</script>
			<?php
		}
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}


	if(isset($_POST['rev'])){
		$product_id;
		$user_id = $_SESSION['USER_ID'];
		$rating = get_safe_value($con,$_POST['rating']);
		$review = get_safe_value($con,$_POST['review']);
		$added_on=date("Y-m-d H:i:s");
		

		mysqli_query($con,"insert into review(product_id,user_id,rating,review,added_on) values('$product_id','$user_id','$rating','$review','$added_on')");
		?>
		<script>
			window.location.href = window.location.href;
		</script>
		<?php
	}


	$review_sql = mysqli_query($con, "select users.name,review.id,review.rating,review.review from users,review where review.user_id=users.id and review.product_id='$product_id' order by review.added_on desc");
	?>

	<!-- breadcrumb -->
	<?php if(count($get_product)>0){ ?>
	<div class="container marg">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="categories.php?id=<?php echo $get_product['0']['categories_id']?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo $get_product['0']['categories']?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
			<?php echo $get_product['0']['name']?>
			</span>
		</div>
	</div>
	<?php } ?>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60 marg" >
		<?php if(count($get_product)>0) { ?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>"">
									<div class="wrap-pic-w pos-relative">
										<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<!-- <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
									<div class="wrap-pic-w pos-relative">
										<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
									<div class="wrap-pic-w pos-relative">
										<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
						<?php echo $get_product['0']['name']?>
						</h4>

						<span class="mtext-106 cl2">
						₹<?php echo $get_product['0']['price']?>
						</span>

						<p class="stext-102 cl3 p-t-23">
							<!-- Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. -->
							<?php echo $get_product['0']['description']?>
						</p>

						<?php 
							$sql=mysqli_query($con,"select qty from product where id='$product_id'");
							$row=mysqli_fetch_assoc($sql);
							$q=$row['qty'];
							if($q==0){ 
							?>
							<h2 style="padding-top:20px;"> OUT OF STOCK </h2>
							<?php
							}else{

							}
						?>
						
						<!-- <div class="p-t-33">
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6">
									Size
								</div>

								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="time">
											<option>Choose an option</option>
											<option>Size S</option>
											<option>Size M</option>
											<option>Size L</option>
											<option>Size XL</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div> -->

							<!-- <div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6">
									Color
								</div>

								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="time">
											<option>Choose an option</option>
											<option>Red</option>
											<option>Blue</option>
											<option>White</option>
											<option>Grey</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div> 
							</div> -->
							<br>

							<div class="flex-w flex-r-m p-b-10" style="display:flex; flex-direction:column;">
								<div class="size-204 flex-w flex-m respon6-next">
									<span>Quantity:</span>&nbsp;&nbsp;
									<div>
										<input type="number" id="qty" class="form-control" name="num-product" min="1" max="<?php echo $q ?>" value="1" <?php if($q<=0){ echo "disabled"; } ?> />
									</div>
								</div>
								<br>
								<div class="size-204 flex-w flex-m respon6-next" style="display:flex; flex-wrap:nowrap;">
									<button <?php if($q<=0){ echo "disabled"; } ?> class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" href="javascript:void(0)" onclick="manageCart('<?php echo $get_product['0']['id'] ?>','add','no')">
										Add to cart
									</button>
									<!-- <button <?php if($q<=0){ echo "disabled"; } ?> class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 " href="javascript:void(0)" onclick="manageCart('<?php echo $get_product['0']['id'] ?>','add','yes')">
										Buy Now
									</button> -->
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
						</li>

							<li class="nav-item p-b-10">
								<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (<?php echo mysqli_num_rows($review_sql) ?>)</a>
							</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<!-- Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc. -->
									<?php echo $get_product['0']['short_desc']?>
								</p>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="information" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<ul class="p-lr-28 p-lr-15-sm">
										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Weight
											</span>

											<span class="stext-102 cl6 size-206">
												0.79 kg
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>

											<span class="stext-102 cl6 size-206">
												110 x 33 x 100 cm
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>

											<span class="stext-102 cl6 size-206">
												Black, Blue
											</span>
										</li>

										<li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>

											<span class="stext-102 cl6 size-206">
												Refer to Dimensions Above 
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<?php 
										if(mysqli_num_rows($review_sql)>0){
											while($review_row=mysqli_fetch_assoc($review_sql)){
												$rating = $review_row['rating'];
												$i = 0;
										?>
										<div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="images/icons/usericon.png" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														<?php echo $review_row['name']; ?>
													</span>

													<span class="fs-18 cl11">
													<?php while($i<$rating){ ?>
														<i class="zmdi zmdi-star"></i>
														<?php $i++ ?>
													<?php } ?>
													</span>
												</div>

												<p class="stext-102 cl6">
												<?php echo $review_row['review']; ?>
												</p>
											</div>
										</div>
										<?php
										} }else{
											echo "No Previous Reviews, Enter One";
											echo "<br>";
											echo "<br>";
										}
										?>
										
										<!-- Add review -->
										<?php 
											if(isset($_SESSION['USER_LOGIN'])){
										?>
										<form method="post" class="w-full">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<!-- <div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div> -->
											</div>
											<span class="d-block text-center my-4 text-muted msg">  </span>
											<button name="rev" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
										<?php
											}else{
												echo "Please Login To Insert Your Review";
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				Categories: <?php echo $get_product['0']['categories']?>
			</span>
		</div>
	</section>

	<?php } else { ?>
			<br>
			<br>
			<br>
			<br>
			<p class="cl5 ltext-101 txt-center"> <?php echo "No Products Found"; ?> </p>
	<?php } ?>


	<!-- Related Products -->
	<!-- <section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

			Slide2
			<div class="wrap-slick2">
				<div class="slick2">
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						Block2
						<div class="block2">
							<div class="block2-pic hov-img0">
								<img src="images/product-01.jpg" alt="IMG-PRODUCT">
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										Esprit Ruffle Shirt
									</a>

									<span class="stext-105 cl3">
										$16.64
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->



<?php
require('footer.php');
?>

<style>
	.msg {
		font-weight: 900;
	}
</style>

<script>

</script>
