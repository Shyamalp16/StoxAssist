<?php
    require('top.php');
?>
	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<!-- <div class="item-slick1" style="background-image: url(images/slide-01.jpg);"> -->
				<div class="item-slick1" style="background-image: url(images/stock/8.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2" style="background-color:#FF5666; color:white;">
									One Place For All Your AutoParts Needs  
								</span>
							</div>	
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1" style="color:#F7F9F7">
									StoxAssist
								</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/stock/1.jpg" class="disp" alt="IMG-BANNER">
						<a href="" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3 disabled">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									
								</span>
								<span class="block1-info stext-102 trans-04">
									
								</span>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/stock/4.jpg" alt="IMG-BANNER">
						<a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3 disabled">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									
								</span>
								<span class="block1-info stext-102 trans-04">
									
								</span>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="images/stock/3.jpg" alt="IMG-BANNER">
						<a href="#" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3 disabled">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									
								</span>
								<span class="block1-info stext-102 trans-04">
									
								</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Product Overview
				</h3>
			</div>
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All Products
					</button>
				</div>
			</div>

			<div class="row isotope-grid">
				<?php
    				$get_product=get_product($con,'','','');
    				foreach($get_product as $list){
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
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
								₹<?php echo $list['price'] ?>
								<?php
								$pid=$list['id'];
								$sql=mysqli_query($con,"select qty from product where id='$pid'");
								$row=mysqli_fetch_assoc($sql);
								$q=$row['qty'];
								?>
								</span>
								<span style="padding-top:15px;">
									<?php if($q<5){ ?> <p class="sell">Selling Out Fast!</p> <?php } ?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php
    require('footer.php');
?>

<style>
a.disabled {
  cursor: default;
}

img.disp {
	object-fit:contain;
}

.sell {
  text-indent: 5px;
  text-align: justify;
  letter-spacing: 3px;

  background-color: black;
  color:white;
  margin-right:10px;
}
</style>
