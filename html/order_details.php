<?php
    require('top.php');
    $order_id=get_safe_value($con,$_GET['id']);
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
				Order Details
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
									<th class="column-1"></th>
                                    <th class="column-2">Name</th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
                                <?php 
                                    $uid=$_SESSION['USER_ID'];
                                    $res=mysqli_query($con,"select distinct(order_detail.id), order_detail.*,product.name,product.image from order_detail,product,orders where order_detail.order_id='$order_id' and orders.user_id='$uid' and product.id=order_detail.product_id");
                                    $total_price=0;
                                    while($row=mysqli_fetch_array($res)){
                                        $total_price=$total_price+($row['qty']*$row['price']);
                                ?>  
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<a class="ptag" href="product-detail.php?id=<?php echo $row['product_id']?>"> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="IMG"> </a>
										</div>
									</td>
									<td class="column-2"><a class="ptag" href="product-detail.php?id=<?php echo $row['product_id']?>"> <?php echo $row['name']?></td> </a>
									<td class="column-3"><?php echo $row['price']?></td>
                                    <td class="column-4"><?php echo $row['qty']?></td>
									<td class="column-5"><?php echo $row['qty']*$row['price']?></td>
								</tr>
                                <?php } ?>
                                <tr class="table_row">
                                    <td class="column-1">  </td>
                                    <td class="column-2">  </td>
                                    <!-- <td class="column-3">  </td> -->
                                    <td class="column-3"> <strong> TOTAL PRICE </strong> </td>
                                    <td class="column-4" style="text-align:center"> ₹<?php echo $total_price ?> </td>
									<td class="column-5" style="text-align:right"><span style="padding-right:2px">Download Invoice:</span></td>
									<td class="column-5">
									<a href="pdf.php?id=<?php echo $order_id ?>" class="ptag"><svg width="30px" height="30px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
  										<path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
  										<path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
										</svg></i></a>
									</td>
                                </tr>
							</table>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
	</form>
	<?php
    require('footer.php');
    ?>

    <style>
        .ptag {
			color: inherit;
		}
    </style>
    