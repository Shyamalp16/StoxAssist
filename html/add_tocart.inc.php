<?php 
 class add_tocart{
    function addProduct($pid,$qty){
        $_SESSION['cart'][$pid]['qty']=$qty;
    }

    function updateProduct($pid,$qty){
        if(isset($_SESSION['cart'][$pid])){
            $_SESSION['cart'][$pid]['qty']=$qty;
        }
    }

    function removeProduct($pid){
        if(isset($_SESSION['cart'][$pid])){
            unset($_SESSION['cart'][$pid]);
        }
    }

    function emptyCart($pid,$qty){
        unset($_SESSION['cart']);
    }

    function total(){
        if(isset($_SESSION['cart'])){
            return count($_SESSION['cart']);
        }else{
            return 0;
        }
    }
 }
?>