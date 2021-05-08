<?php
    require('connection.inc.php');
    require('functions.inc.php');
    // include('smtp/PHPMailerAutoload.php');

    $type=get_safe_value($con,$_POST['type']);

    if($type=='email'){    
        $email=get_safe_value($con,$_POST['email']);
        $otp=rand(111111,999999);
        $_SESSION['email_otp']=$otp;
        $html="$otp is your One Time Password";

        $mail=new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host="ssl://smtp.gmail.com";
        $mail->Port=465;
        $mail->SMTPSecure="tls";
        $mail->SMTPAuth=true;
        $mail->Username="patelshyamal016@gmail.com";
        $mail->Password="HtmlcsgoD";
        $mail->SetFrom("patelshyamal016@gmail.com");
        $mail->addAddress("$email");
        $mail->IsHTML(true);
        $mail->Subject="Your StoxAssist OTP";
        $mail->Body=$html;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if($mail->send()){
            echo "finished";
        }else{
            echo "failed";
        }
    }
    if($type=='forgot'){    
        $email=get_safe_value($con,$_POST['email']);
        $otp=rand(111111,999999);
        $_SESSION['forgot_pw']=$otp;
        $html="$otp is your One Time Password";

        $mail=new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host="ssl://smtp.gmail.com";
        $mail->Port=465;
        $mail->SMTPSecure="tls";
        $mail->SMTPAuth=true;
        $mail->Username="patelshyamal016@gmail.com";
        $mail->Password="HtmlcsgoD";
        $mail->SetFrom("patelshyamal016@gmail.com");
        $mail->addAddress("$email");
        $mail->IsHTML(true);
        $mail->Subject="Your StoxAssist OTP";
        $mail->Body=$html;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if($mail->send()){
            echo "finished";
        }else{
            echo "failed";
        }
    }

    if($type=='verified'){    
        $email=get_safe_value($con,$_POST['email']);
        $otp=rand(111111,999999);
        $_SESSION['forgot_pw']=$otp;
        
        $res = mysqli_query($con,"select password from users where email='$email'");
        $row=mysqli_fetch_assoc($res);
        $pw=$row['password'];
        $html="$pw is your Password";

        $mail=new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host="ssl://smtp.gmail.com";
        $mail->Port=465;
        $mail->SMTPSecure="tls";
        $mail->SMTPAuth=true;
        $mail->Username="patelshyamal016@gmail.com";
        $mail->Password="HtmlcsgoD";
        $mail->SetFrom("patelshyamal016@gmail.com");
        $mail->addAddress("$email");
        $mail->IsHTML(true);
        $mail->Subject="Your StoxAssist Password";
        $mail->Body=$html;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if($mail->send()){
            echo "finished";
        }else{
            echo "failed";
        }
    }
    
?>