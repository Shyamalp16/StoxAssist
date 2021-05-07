<?php
    require('top.php');
	if(isset($_GET['id'])){
		$cat_id=mysqli_real_escape_string($con,$_GET['id']);
		$cat_id = preg_replace("/[^0-9]/", "", $cat_id );
		echo $cat_id;
		if($cat_id>0){
			$get_product=get_product($con,'',$cat_id,'');
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
?>
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
								₹<?php echo $list['price'] ?>
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