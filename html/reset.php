<?php 
$con=mysqli_connect("localhost","root","","stoxassist");
?>
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
    <title>Login</title>
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
                  <h3>Sign In to <strong>StoxAssist</strong></h3>
                </div>
                <form method="post">
                  <div class="form-group first">
                    <input placeholder="Email" type="email" class="form-control" id="login_email">
                  </div>
                  <div class="form-group last mb-4">
                    <input placeholder="Password" type="password" class="form-control" id="login_password">
                  </div>
                  <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                      <input type="checkbox" checked="checked"/>
                      <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="forgot.php" class="forgot-pass">Forgot Password</a></span> 
                  </div>
                  <input type="button" onclick="user_login()" value="Log In" class="btn btn-pill text-white btn-block btn-primary">
                  <span class="d-block text-center my-4 text-muted"> or Register <a href="register.php">Here</a></span>
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
  </body>
</html>