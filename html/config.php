<?php
    require('stripe-php-master/init.php');
    // require('connection.inc.php');
	// require('functions.inc.php');

    $publishable_key="pk_test_51HPvaRKr1KfjZzvTZgRFy7nA7ZMGyE2dw7kAsdhbZXqgchHxPovMOOaDBGg2KgrLJh6FZpc77XN8NVP4GGm0d0K600gy7AyH7n";
    $secret_key="sk_test_51HPvaRKr1KfjZzvTmp7WJhQBzQMwNPphBuNWPEcLOShz6uKb9cpYMo0OMxsgHeJO1yRmcQTrBprRytI1nikisIsT00RCb8qxoS";

    \Stripe\Stripe::setApiKey($secret_key);
?>