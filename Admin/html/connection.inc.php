<?php
session_start();
$con=mysqli_connect("localhost","root","","stoxassist");

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/StoxAssist');
define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'/docs/pimage/');

define('SITE_PATH','http://localhost/StoxAssist');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'/docs/pimage/');
?>