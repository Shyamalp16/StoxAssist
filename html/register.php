<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Register</title>
  </head>
  <body>

  <div class="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="form-block">
                <div class="mb-4">
                  <h3>Register to <strong>StoxAssist</strong></h3>
                </div>
                <form action="#" method="post" id="login-form">
                  <div class="form-group first">
                    <input placeholder="Username" type="text" class="form-control" name="name" id="name">
                  </div>
                  <div class="form-group first">
                    <input placeholder="Email ID" type="email" class="form-control" name="email" id="email">
                  </div>
                  <div class='form-group text-right'>
                      <button type="button" onclick="emailotp()" class="emailotp btn btn-pill text-white btn-primary" style="width:35%;">Send OTP</button>
                  </div>
                  <div class='form-group text-right'>
                    <input placeholder="Enter OTP" type="text" class="form-control ver" name="verifyOTPtxt" id="verifyOTPtxt"><br>
                  </div>
                  <div class='form-group text-right'>
                    <button type="button" onclick="emailverify()" class="ver btn btn-pill text-white btn-primary" style="width:35%;" style="margin-top:auto;">Verify OTP</button>
                    <span><p id="email_res"></p></span>
                  </div>
                  <div class="form-group first">
                    <input placeholder="Mobile" type="text" class="form-control" name="mobile" id="mobile">
                  </div>
                  <div class="form-group last mb-4">
                    <input placeholder="Password" type="password" class="form-control" name="password" id="password">
                  </div>
                  <input type="button" onclick="user_reg()" value="Sign Up" class="btn btn-pill text-white btn-block btn-primary">
                </form>
                <br>
                <div class="mb-4 reg_error" id="">
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script> 
      function emailotp(){
        jQuery("#email_res").html('');
        var email = jQuery('#email').val();
        if(email==''){
          jQuery("#email_res").html('Please Enter Email Address');
        }else{
          jQuery('.emailotp').html('Please Wait');
          jQuery('.emailotp').attr('disabled',true);
          jQuery.ajax({
            url:'otp.php',
            type:'post',
            data:'email='+email+'&type=email',
            success: function(result){
              if(result=='finished'){  
                jQuery("#email").attr('disabled',true);
                jQuery(".ver").show();
                jQuery(".emailotp").hide();
                jQuery("#email_res").html('OTP has been sent, check your mailbox');
              }else{
                jQuery("#email_res").html('Technical Error Occured, Try again later');
                jQuery('.emailotp').attr('disabled',true);
              }
            }
          });

        }
      }

      function emailverify(){
        var everified=0;
        jQuery("#email_res").html('');
        var email_otp = jQuery('#verifyOTPtxt').val();
        if(email_otp==''){
          jQuery("#email_res").html('Please Enter OTP');
        }else{
          jQuery.ajax({
            url:'verify.php',
            type:'post',
            data:'otp='+email_otp+'&type=email',
            success: function(result){
              if(result=='success'){  
                jQuery("#email").attr('disabled',true);
                jQuery(".ver").hide();
                jQuery("#email_res").html('Email ID Successfully Verified');
              }else{
                jQuery("#email_res").html('Please Check And Enter Valid OTP');
              }
            }
          });
        }
      }
    </script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <style> 
      .ver {
        display: none;
      }
    </style>
  </body>
</html>