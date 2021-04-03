<?php
    require('connection.inc.php');
    require('functions.inc.php');

    $login_email=get_safe_value($con,$_POST['login_email']);
    $login_password=get_safe_value($con,$_POST['login_password']);

    $res=mysqli_query($con,"select * from users where email='$login_email' and password='$login_password'");
    $check=mysqli_num_rows($res);

    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN']='yes';
        $_SESSION['USER_ID']=$row['id'];
        $_SESSION['USER_NAME']=$row['name'];
        echo 'valid';
    }else{
        echo 'invalid';
    }
?>