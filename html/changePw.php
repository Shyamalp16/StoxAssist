<?php
require('connection.inc.php');
require('functions.inc.php');

$password = get_safe_value($con, $_POST['password']);
$email = get_safe_value($con, $_POST['email']);

mysqli_query($con, "update users set password='$password' where email='$email'");
echo 'done';
?>