<?php
    require('connection.inc.php');
    require('functions.inc.php');
    // include('smtp/PHPMailerAutoload.php');

    $type=get_safe_value($con,$_POST['type']);
    $otp=get_safe_value($con,$_POST['otp']);

    if($type=='email'){    
        if($otp==$_SESSION['email_otp']){
            echo 'success';
        }else{
            echo 'invalid';
        }
    }

    if($type=='forgot'){    
        if($otp==$_SESSION['forgot_pw']){
            echo 'success';
        }else{
            echo 'invalid';
        }
    }
    
?>