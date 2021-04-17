<?php
    require('connection.inc.php');
	require('functions.inc.php');
    include('vendor/autoload.php');
    $order_id=get_safe_value($con,$_GET['id']);

    if(!isset($_SESSION['USER_ID'])){
        die();
    }

    $head='<img src="images/icons/Screenshot-.png" class="icon" alt="IMG-LOGO">';
    $html='
    <h1 style="text-align:center"> STOX ASSIST- INVOICE </h1>
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
								</tr>';
    $uid=$_SESSION['USER_ID'];
    $res=mysqli_query($con,"select distinct(order_detail.id), order_detail.*,product.name,product.image from order_detail,product,orders where order_detail.order_id='$order_id' and orders.user_id='$uid' and product.id=order_detail.product_id");
    $total_price=0;
    if(mysqli_num_rows($res)==0){
        die();
    }
    while($row=mysqli_fetch_array($res)){
        $total_price=$total_price+($row['qty']*$row['price']);                               
    $html.='<tr class="table_row">
            <td class="column-1">
                <div class="how-itemcart1">
                    <img class="dimg" src="'.PRODUCT_IMAGE_SITE_PATH.$row['image'].'" alt="IMG">
                </div>
            </td>
                <td class="column-2" style="text-align:center">'.$row['name'].'</td>
                <td class="column-3" style="text-align:center">'.$row['price'].'</td>
                <td class="column-4">'.$row['qty'].'</td>
                <td class="column-5">'.$row['qty']*$row['price'].'</td>
            </tr>';
    }
    $html.='<tr class="table_row">
    <td class="column-1">  </td>
    <td class="column-2">  </td>
    <td class="column-3">  </td>
    <td class="column-4"> <strong> TOTAL PRICE </strong> </td>
    <td class="column-5 txt-right"> ₹'.$total_price.'</td>
    </tr>
    </table>
    </div>
    <br>
    </div>
    </div>
    </div>
    </div>
	</form>';

    $html.='
    <style>
    .ptag {
        color: inherit;
    }

    .icon {
        display: flex;
        align-items: center;
        margin:auto;
        padding-top:60px;
    }

    .form {
        display: flex;
        justify-content:center;
    }
    .p-b-85, .p-tb-85, .p-all-85 {padding-bottom: 85px;}

    .p-t-75, .p-tb-75, .p-all-75 {padding-top: 75px;}

    .m-lr-auto {margin-left: auto; margin-right: auto;}

    .m-b-50, .m-tb-50, .m-all-50 {margin-bottom: 50px;}

    .m-r--38, .m-lr--38, .m-all--38 {margin-right: -38px;}

    .m-l-25, .m-lr-25, .m-all-25 {margin-left: 25px;}

    .container {max-width: 1380px;}

    .wrap-table-shopping-cart {
        overflow: auto;
        border-left: 1px solid #e6e6e6;
        border-right: 1px solid #e6e6e6;
    }

    .table-shopping-cart {
        border-collapse: collapse;
        width: 100%;
        min-width: 680px;
    }

    .table-shopping-cart tr {
        border-top: 1px solid #e6e6e6;
        border-bottom: 1px solid #e6e6e6;
    }

    .table-shopping-cart .column-1 {
        width: 133px;
        padding-left: 50px;
    }

    .table-shopping-cart .column-2 {
        width: 220px;
        font-size:15px;
    }

    .table-shopping-cart .column-3 {
        width: 120px;
        font-size:16px;
    }

    .table-shopping-cart .column-4 {
        width: 145px;
        text-align: right;
    }

    .table-shopping-cart .column-5 {
    width: 172px;
    padding-right: 50px;
    text-align: right;
    font-size: 16px;
    }

    .how-itemcart1 img {
        width: 100%;
    }

    .how-itemcart1 {
        width: 60px;
        position: relative;
        margin-right: 20px;
        cursor: pointer;
    }

    .table-shopping-cart .table_head th {
        font-family: Poppins-Bold;
        font-size: 13px;
        color: #555;
        text-transform: uppercase;
        line-height: 1.6;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .table-shopping-cart .table_row td.column-1 {
        padding-bottom: 30px;
    }

    .table-shopping-cart .table_row {
        height: 185px;
    }

    .table-shopping-cart td {
        font-family: Poppins-Regular;
        color: #555;
        line-height: 1.6;
    }

    .dimg {
        max-width:100px;
        height:auto;
        object-fit:contain;
    }
    </style>';

    $pdf=new \Mpdf\Mpdf();
    $pdf->WriteHTML($head);
    $pdf->WriteHTML($html,0);
    $file='order_#'.$order_id.'_'.rand(1111,9999).'.pdf';
    $pdf->Output($file, 'D');
    
?>
    <!-- <link rel="icon" type="image/png" href="images/icons/favicon.png"/> -->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/pdf.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
	
     <!-- <img src="images/icons/Screenshot-.png" class="icon" alt="IMG-LOGO"> -->
	<!--<form class="bg0 p-t-75 p-b-85 form">
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
											<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?php echo $row['name']?></td>
									<td class="column-3"><?php echo $row['price']?></td>
                                    <td class="column-4"><?php echo $row['qty']?></td>
									<td class="column-5"><?php echo $row['qty']*$row['price']?></td>
								</tr>
                                <?php } ?>
                                <tr class="table_row">
                                    <td class="column-1">  </td>
                                    <td class="column-2">  </td>
                                    <td class="column-3">  </td>
                                    <td class="column-4"> <strong> TOTAL PRICE </strong> </td>
                                    <td class="column-5 txt-right"> ₹<?php echo $total_price ?> </td>
                                </tr>
							</table>
						</div>
						<br>
					</div>
				</div>
			</div>
		</div>
	</form>
 

    <style>
        .ptag {
			color: inherit;
		}

        .icon {
            display: flex;
            align-items: center;
            margin:auto;
            padding-top:60px;
        }

        .form {
            display: flex;
            justify-content:center;
        }
        .p-b-85, .p-tb-85, .p-all-85 {padding-bottom: 85px;}

        .p-t-75, .p-tb-75, .p-all-75 {padding-top: 75px;}

        .m-lr-auto {margin-left: auto; margin-right: auto;}

        .m-b-50, .m-tb-50, .m-all-50 {margin-bottom: 50px;}

        .m-r--38, .m-lr--38, .m-all--38 {margin-right: -38px;}

        .m-l-25, .m-lr-25, .m-all-25 {margin-left: 25px;}

        .container {max-width: 1380px;}

        .wrap-table-shopping-cart {
            overflow: auto;
            border-left: 1px solid #e6e6e6;
            border-right: 1px solid #e6e6e6;
        }

        .table-shopping-cart {
            border-collapse: collapse;
            width: 100%;
            min-width: 680px;
        }

        .table-shopping-cart tr {
            border-top: 1px solid #e6e6e6;
            border-bottom: 1px solid #e6e6e6;
        }

        .table-shopping-cart .column-1 {
            width: 133px;
            padding-left: 50px;
        }

        .table-shopping-cart .column-2 {
            width: 220px;
            font-size:15px;
        }

        .table-shopping-cart .column-3 {
            width: 120px;
            font-size:16px;
        }

        .table-shopping-cart .column-4 {
            width: 145px;
            text-align: right;
        }

        .table-shopping-cart .column-5 {
        width: 172px;
        padding-right: 50px;
        text-align: right;
        font-size: 16px;
        }

        .how-itemcart1 img {
            width: 100%;
        }

        .how-itemcart1 {
            width: 60px;
            position: relative;
            margin-right: 20px;
            cursor: pointer;
        }

        .table-shopping-cart .table_head th {
            font-family: Poppins-Bold;
            font-size: 13px;
            color: #555;
            text-transform: uppercase;
            line-height: 1.6;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .table-shopping-cart .table_row td.column-1 {
            padding-bottom: 30px;
        }

        .table-shopping-cart .table_row {
            height: 185px;
        }

        .table-shopping-cart td {
            font-family: Poppins-Regular;
            color: #555;
            line-height: 1.6;
        }
    </style>
     -->