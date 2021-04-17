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
    <title>Forgot Password</title>
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
                  <h3>Password Assistant of <strong>StoxAssist</strong></h3>
                </div>
                <form method="post">
                  <div class="form-group first">
                    <input placeholder="Enter Registered Email" id="email" type="email" class="form-control" id="login_email">
                  </div>
                  <div class='form-group text-right'>
                    <input placeholder="Enter OTP" type="text" style="display:none;" class="form-control ver" name="verifyOTPtxt" id="verifyOTPtxt"><br>
                  </div>
                  <div class='form-group text-right'>
                    <button type="button" onclick="emailverify()" class="ver btn btn-pill text-white btn-primary" style="width:35%; display:none" style="margin-top:auto;">Verify OTP</button>
                    <span><p id="email_res"></p></span>
                  </div>
                  <input type="button" onclick="emailotp()" value="Get OTP" class="emailotp btn btn-pill text-white btn-block btn-primary">
                  <span class="d-block text-center my-4 text-muted" id="msg"></span>
                  <div class='form-group text-right'>  
                    <button onclick="redirect()" type="reset" style="display:none;" class="done btn btn-pill text-white btn-block btn-primary"> Go To Login Page </button>
                  </div>
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

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>

    function emailotp(){
        jQuery("#msg").html('');
        var email = jQuery('#email').val();
        if(email==''){
          jQuery("#msg").html('Please Enter Email Address');
        }else{
          jQuery('.emailotp').html('Please Wait');
          jQuery('.emailotp').attr('disabled',true);
          jQuery.ajax({
            url:'otp.php',
            type:'post',
            data:'email='+email+'&type=forgot',
            success: function(result){
              if(result=='finished'){  
                jQuery("#email").attr('disabled',true);
                jQuery(".emailotp").hide();
                jQuery(".ver").show();
                jQuery("#msg").html('OTP has been sent, check your mailbox');
                
              }else{
                jQuery("#msg").html('Technical Error Occured, Try again later');
                jQuery('.emailotp').attr('disabled',true);
              }
            }
          });

        }
      }


      function emailverify(){
        var email = jQuery('#email').val();
        jQuery("#msg").html('');
        var email_otp = jQuery('#verifyOTPtxt').val();
        if(email_otp==''){
          jQuery("#msg").html('Please Enter OTP');
        }else{
          jQuery.ajax({
            url:'verify.php',
            type:'post',
            data:'otp='+email_otp+'&type=forgot',
            success: function(result){
              if(result=='success'){  
                jQuery("#email").attr('disabled',true);
                jQuery(".ver").hide();
                jQuery.ajax({
                  url:'otp.php',
                  type:'post',
                  data:'email='+email+'&type=verified',
                  success: function(result){
                    if(result=='finished'){
                      jQuery("#msg").html('Password Has Been Sent On Your Email Address');
                      jQuery(".done").show();
                    }else{
                      jQuery("#msg").html('Technical Error Occured, Try again later');
                    }
                  }
                });
              }else{
                jQuery("#msg").html('Please Check And Enter Valid OTP');
              }
            }
          });
        }
      }

      function redirect(){
        window.location.href = "login.php";
      }
    </script>
  </body>
</html>