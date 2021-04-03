<?php
    require('connection.inc.php');
    require('add_tocart.inc.php');
    require('functions.inc.php');

    $pid=get_safe_value($con,$_POST['pid']);
    $qty=get_safe_value($con,$_POST['qty']);
    $type=get_safe_value($con,$_POST['type']);

    $ob = new add_tocart();
    if($type=='add'){
        $ob->addProduct($pid,$qty);
    }

    if($type=='remove'){
        $ob->removeProduct($pid);
    }

    if($type=='update'){
        $ob->updateProduct($pid,$qty);
    }


    echo $ob->total();
?>