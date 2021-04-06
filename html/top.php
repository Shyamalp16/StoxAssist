<?php
    require('connection.inc.php');
	require('functions.inc.php');
	require('add_tocart.inc.php');
    $cat = mysqli_query($con,"select * from categories where status=1 order by categories asc");
    $cat_arr = array();
    while($row=mysqli_fetch_assoc($cat)){
        $cat_arr[] = $row;
    }

	$ob = new add_tocart();
	$total=$ob->total();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>StoxAssist</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
				</div>
					<div class="right-top-bar flex-w h-full">
						<!-- <a href="#" class="flex-c-m trans-04 p-lr-25">
							My Account
						</a> -->
						<?php if(isset($_SESSION['USER_LOGIN'])){ 
							echo '<a href="#" class="flex-c-m trans-04 p-lr-25">My Account</a>';
							echo '<a href="my_orders.php" class="flex-c-m trans-04 p-lr-25">My Orders</a>';
							echo '<a href="logout_submit.php" class="flex-c-m trans-04 p-lr-25">Logout</a>';
						}else{ 
							echo '<a href="login.php" class="flex-c-m trans-04 p-lr-25">Login</a>';
						}
						?>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.php">Home</a>
							</li>
                            <li>
								<a href="#">Categories</a>
								<ul class="sub-menu">
                                    <?php
                                    foreach($cat_arr as $list){
                                    ?>
                                        <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
                                    <?php }
                                    ?>
								</ul>
							</li>

							<!-- <li class="label1" data-label1="hot">
								<a href="cart.php">Features</a>
							</li> -->

							<li>
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $total?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header --> 
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo $total?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
					<ul class="sub-menu-m">
						<li><a href="index.php">Homepage 1</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.html">Shop</a>
				</li>

                <li>
					<a href="#">Categories</a>
					<ul class="sub-menu-m">
                        <?php
                            foreach($cat_arr as $list){
                        ?>
                        <li><a href="categpries.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
                        <?php }
                        ?>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="cart.php" class="label1 rs1" data-label1="hot">Features</a>
				</li>   

				<li>
					<a href="contact.html">Contact Us</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

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
			if(isset($_SESSION['cart'])) { 
					$cart_total=0;
					foreach($_SESSION['cart'] as $key=>$val){
					$productArr = get_product($con,'','',$key);
					$pname=$productArr[0]['name'];
					$pprice=$productArr[0]['price'];
					$pimage=$productArr[0]['image'];
					$qty=$val['qty'];
					$cart_total=$cart_total+($pprice*$qty);
					?>
					<ul class="header-cart-wrapitem w-full">
						<li class="header-cart-item flex-w flex-t m-b-12">
							<div class="header-cart-item-img">
								<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$pimage?>" alt="IMG">
							</div>
							<div class="header-cart-item-txt p-t-8">
								<a href="product-detail.php?id=<?php echo $key?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
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
						Total: $<?php echo $cart_total?> (<?php echo $total?> Items) <br>
						<!-- Total: <?php echo $total?> Items <br> -->
					</div>
					<?php }else{ 
						echo "Cart Empty"; 
					} ?>
					<?php if(isset($_SESSION['USER_LOGIN'])){ ?>
					<div class="header-cart-buttons flex-w w-full">
						<a href="cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>
						<a href="checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
					<?php }else{ ?>
						<div class="header-cart-buttons flex-w w-full">
							<a href="login.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
								Login First
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>