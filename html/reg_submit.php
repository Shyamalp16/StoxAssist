<?php
    require('connection.inc.php');
    require('functions.inc.php');

    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $mobile=get_safe_value($con,$_POST['mobile']);
    $password=get_safe_value($con,$_POST['password']);

    $check=mysqli_num_rows(mysqli_query($con,"select * from users where email='$email'"));
    if($check>0){
        echo "exists";
    }else{
        $date=date('Y-m-d H:i:s');
        mysqli_query($con,"insert into users(name,email,mobile,password,date) values('$name','$email','$mobile','$password','$date')");
        echo "insert";
    }
?>