<?php
    require('connection.inc.php');
    require('functions.inc.php');

    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $state = get_safe_value($con, $_POST['state']);
    $pin = get_safe_value($con, $_POST['pin']);
    $userID = get_safe_value($con, $_POST['uid']);

    $check = mysqli_num_rows(mysqli_query($con, "select * from users where id='$userID'"));
    if($check > 0){
        mysqli_query($con, "update users set address='$address', city='$city', state='$state', pin='$pin'");
        echo "valid";
    }else{
        echo "failed";
    }
?>