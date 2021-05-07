<?php

require('connection.inc.php');
require('functions.inc.php');

$coupon = get_safe_value($con, $_POST['code']);
$res = mysqli_query($con, "select * from coupon where code='$coupon' and status='1'");
$count = mysqli_num_rows($res);
$jsonArr = array();

$cart_total = 0;

if(isset($_SESSION['COUPON_ID'])){
	unset($_SESSION['COUPON_ID']);
	unset($_SESSION['COUPON_VALUE']);
	unset($_SESSION['COUPON_CODE']);
}

foreach ($_SESSION['cart'] as $key => $val) {
    $productArr = get_product($con, '', '', $key);
    $pprice = $productArr[0]['price'];
    $qty = $val['qty'];
    $cart_total = $cart_total + ($pprice * $qty);
}

if ($count > 0) {
    $coupon_details = mysqli_fetch_assoc($res);
    // prx($coupon_details);
    $coupon_value = $coupon_details['coupon_value'];
    $coupon_type = $coupon_details['coupon_type'];
    $id = $coupon_details['id'];
    $min_value = $coupon_details['min_value'];

    if ($cart_total < $min_value) {
        $jsonArr = array('is_error' => 'yes', 'result' => 'Cart Value Must Be Greater Than ' . $min_value, 'card_total'=>$cart_total);
    } else {
        if ($coupon_type == 'rupee') {
            $final_total = $cart_total - $coupon_value;
        } elseif ($coupon_type == 'percentage') {
            $final_total = $cart_total - ($cart_total * $coupon_value) / 100;
        }
        $_SESSION['COUPON_ID'] = $id;
        $_SESSION['FINAL_TOTAL'] = $final_total;
        $_SESSION['COUPON_VALUE'] = $coupon_value;
        $_SESSION['COUPON_CODE'] = $coupon;

        $discount = $cart_total - $final_total;
        $jsonArr = array('is_error' => 'no', 'result' => $final_total, 'result1' => $discount, 'card_total'=>$cart_total);
    }
} else {
    $jsonArr = array('is_error' => 'yes', 'result' => 'Invalid Coupon Code', 'card_total'=>$cart_total);
}
echo json_encode($jsonArr);

?>