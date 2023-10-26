<?php
require_once('/home/my_user/config/access.php');

//get my configurations
$encrypted_data = file_get_contents("/home/my_user/config/encrypted_config.bin");
$decrypted_data = openssl_decrypt($encrypted_data, "AES-256-CBC", $key, 0, substr($key, 0, 16));
$_ENV = parse_ini_string($decrypted_data);
extract($_ENV);


//  paypal id config 
define('PAYPAL_ID', $_ENV['PAYPAL_ID']);

// general configuration
define('PAYPAL_SANDBOX', true);
define('CURRENCY', 'GBP');

// paypal api configuration
define('PAYPAL_CLIENT_ID', $_ENV['PAYPAL_CLIENT_ID']);
define('PAYPAL_SECRET', $_ENV['PAYPAL_SECRET']);
define('PAYPAL_TOKEN', $_ENV['PAYPAL_TOKEN']);

// paypal url 
define('PAYPAL_URL', $_ENV['PAYPAL_URL']);
define('PAYPAL_HOSTNAME', $_ENV['PAYPAL_HOSTNAME']);
define('PAYPAL_SUBSCRIPTIONS_URL', $_ENV['PAYPAL_SUBSCRIPTIONS_URL']);
define('PAYPAL_RETURN_URL', $_ENV['PAYPAL_RETURN_URL']);
define('PAYPAL_CANCEL_URL', $_ENV['PAYPAL_CANCEL_URL']);
?>