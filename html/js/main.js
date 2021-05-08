
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
    
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });
        
    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });
    
    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });





})(jQuery);

function send_message(){
    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
    var message=jQuery("#msg").val();

    if(name==""){
        jQuery('.validation').html('Please Enter Name.');
    }else if(email==""){
        jQuery('.validation').html('Please Enter Email Address.');
    }else if(mobile==""){
        jQuery('.validation').html('Please Enter Mobile No.');
    }else if(message==""){
        jQuery('.validation').html('Please Enter Your Query In Detail');
    }else{
        jQuery.ajax({
            url:'send_message.php',
            type:'post',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
            success:function(result){
                jQuery('.validation').hide();
                jQuery('.done').html('Your Message Has Been Sent, Please Wait Until Someone Reaches Out To You!');
            }
        })
    }
}

function user_reg(){
    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
    var password=jQuery("#password").val();

    if(name==""){
        jQuery('.msg').html('Please Enter Username');
    }else if(email==""){
        jQuery('.msg').html('Enter Email Please');
    }else if(mobile==""){
        jQuery('.msg').html('Enter Mobile Number Please');

    }else if(password==""){
        jQuery('.msg').html('Enter New Password');
    }else if(password.length <= 8){
        jQuery('.msg').html('Password Must Be At Least 8 Characters Long');
    }else{
        jQuery.ajax({
            url:'reg_submit.php',
            type:'post',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success:function(result){
                if(result=='exists'){
                    jQuery('.reg_error p').html('Email Already Exists');
                }
                if(result=='insert'){
                    jQuery('.reg_error p').html('User Registered Successfully');
                    window.location.href='index.php';
                }
            }
        })
    }
}

function user_login(){
    var login_email=jQuery("#login_email").val();
    var login_password=jQuery("#login_password").val();

    if(login_email==""){
        // alert("Enter Email Please");
        jQuery('.msg').html('Please Enter Email Address');
    }else if(login_password==""){
        jQuery('.msg').html('Please Enter Your Password');
    }else{
        jQuery.ajax({
            url:'login_submit.php',
            type:'post',
            data:'login_email='+login_email+'&login_password='+login_password,
            success:function(result){
                if(result=='invalid'){
                    jQuery('.msg').html('Please Enter Valid Login Details');
                }
                if(result=='valid'){
                    window.location.href='index.php';
                }
            }
        })
    }
}

function manageCart(pid,type,is_checkout){
    if(type=='update'){
        var qty=jQuery("#"+pid+"qty").val();    
    }else{
        var qty=jQuery("#qty").val();
    }
        jQuery.ajax({
            url:'manageCart.php',
            type:'post',
            data:'pid='+pid+'&qty='+qty+'&type='+type,
            success:function(result){
                if(type=='update' || type=='delete'){
                    window.location.reload();    
                }
                if(result=='Unavailable'){
                    alert('Requested Amount Of Items Not Available');
                }else{
                    if(is_checkout=='yes'){
                        window.location.href = 'checkout1.php';
                    }
                    
                }
                window.location.reload();  
            }
        });
}


function change_password(){
    let pw1 = document.getElementById('password1').value;
    let pw2 = document.getElementById('password2').value;
    let email = document.getElementById('email').value;

    if(pw1 === pw2){
        if(pw1.length < 8){
            jQuery('.msg').html("Password must be at least 8 characters");
        }else{
            jQuery.ajax({
                url:'changePw.php',
                type:'post',
                data:'password='+pw1+'&email='+email,
                success:function(result){
                    if(result=='done'){
                        jQuery('.msg').html("Password Has Been Modified");
                    }else{
                        jQuery('.msg').html("Technical Error, Please Try Again");
                    }
                }
            })
            jQuery('.msg').html("");
        }
    }else{
        jQuery('.msg').html("Two Passwords Dont Match");
    }
}

function coupon(){
    let code = document.getElementById('coup').value;
    if(code != ''){
       jQuery.ajax({
        url:'coupon.php',
        type:'post',
        data:'code='+code,
        success:function(result){
            let data=jQuery.parseJSON(result);
            if(data.is_error=='yes'){
                jQuery('.couponBOX').hide();
                jQuery('.total').html("₹ "+data.card_total);
                jQuery('.msg').html(data.result);
            }if(data.is_error=='no'){
                jQuery('.couponBOX').show();
                jQuery('.msg').html('');
                jQuery('.discountPrice').html("₹ "+data.result1);
                jQuery('.total').html("₹ "+data.result);
            }
        }
       });
    }else{
        jQuery('.msg').html("ENTER COUPON CODE");
    }

}