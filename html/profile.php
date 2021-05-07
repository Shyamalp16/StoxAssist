<?php
require('top.php');
// prx($_SESSION);
if(!isset($_SESSION['USER_LOGIN'])){
    ?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
}
?>

<div class="containerPr">
    <div class="back" style="background-image: url('images/stock/8.jpg');">
        <h1 class="name"> <?php echo strtoupper($_SESSION['USER_NAME']); ?> </h1>
        <p class="lower">India</p>
    </div>
</div>


<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<div class="container" style="padding-bottom:30px;">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                <div class="list-group">
                    <!-- <a href="#" class="list-group-item  text-center">
                        <p style="padding-bottom: 5px;">Profile</p>
                    </a> -->
                    <a href="#" class="list-group-item active text-center">
                        <p style="padding-bottom: 5px;">Password</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- <div class="bhoechie-tab-content active">
                    <center>
                        <h1 class="glyphicon glyphicon-road" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Train Reservation</h3>
                    </center>
                </div> -->
                <div class="bhoechie-tab-content active" style="padding:30px 0px;">
                    <center>
                        <form method="post">
                            <div class="form-group first">
                                <input placeholder="New Password" type="password" class="form-control" id="password1" required>
                            </div>
                            <div class="form-group last mb-4">
                                <input placeholder="Re-enter Password" type="password" class="form-control" id="password2" required>
                                <?php $email = $_SESSION['USER_EMAIL']; ?>
                                <input type="hidden" id="email" value="<?php echo $email; ?> ">
                            </div>
                            <input type="button" onclick="change_password()" value="Change Password" class="btn btn-pill text-white btn-block btn-primary">
                            <span class="d-block text-center my-4 text-muted msg" style="color:red;"> </span>
                        </form>
                    </center>
                </div>

                
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<br>


<?php
require('footer.php');
?>


<script>
    $(document).ready(function() {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    });
</script>