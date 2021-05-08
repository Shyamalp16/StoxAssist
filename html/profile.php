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
                    <a href="#" class="list-group-item active text-center">
                        <p style="padding-bottom: 5px;">Address</p>
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <p style="padding-bottom: 5px;">Password</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <div class="bhoechie-tab-content active">
                    <center>
                    <form method="post">
						<div id="address" class="w3-container checkout">
							<h2>Enter Default Address</h2><br>
							<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 addr"  type="text" id="address" name="address" placeholder="Street Address" >
							</div>

							<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30"  type="text" id="city" name="city" placeholder="City" >
							</div>

							<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30"  type="text" id="state" name="state" placeholder="State" >
							</div>

							<div class="bor8 m-b-20 how-pos4-parent">
								<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30"  type="text" id="pincode" name="pincode" placeholder="Zipcode" >
							</div>
						</div>
                        <span class="d-block text-center my-4 text-muted msg">   </span>
                        <input type="hidden" id="uid" name="user id" value="<?php echo $_SESSION['USER_ID'];?>" />
                        <input type="button" id="vali" onclick="validate();" href="#" name="submit" value="Save Address" class="flex-c-m stext-101 cl0 size-101 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" style="margin-bottom:10px;"/>
                    </form>
                    </center>
                </div>
                <div class="bhoechie-tab-content" style="padding:30px 0px;">
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


<style>
	.msg {
		font-weight: 900;
	}
</style>



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

    function validate(){
        var address = jQuery('.addr').val();
        var city = jQuery('#city').val();
        var state = jQuery('#state').val();
        var pin = jQuery('#pincode').val();
        var userID = jQuery('#uid').val();

        if (address == "" || city== "" || state== "" || pin== "") {
			jQuery(".msg").html('Please Fill All The Details');
			jQuery(".msg").show();
		}else if (pin.length != 6){
            jQuery(".msg").html('PIN Code Must be 6 characters long');
            jQuery(".msg").show();
        }else if ((/[a-zA-Z]/).test(pin)){
            jQuery(".msg").html('PIN Code Must be Numeric');
            jQuery(".msg").show();
        }else {
			jQuery(".msg").hide();
            jQuery.ajax({
                url:'address_submit.php',
                type:'post',
                data:'address='+address+'&city='+city+'&state='+state+'&pin='+pin+'&uid='+userID,
                success: function(result){
                    if(result=='valid'){
                        jQuery(".msg").html('Address Has Been Stored');
                    }else{
                        jQuery(".msg").html('Technical Error, Please Try Again Later');
                    }
                }
            })
		}

        document.getElementById('vali').addEventListener("click", function(e){
            e.preventDefault();
        });
    }

</script>

