<?php
require_once('/home/my_user/config/access.php');

//get my configurations
$encrypted_data = file_get_contents("/home/my_user/config/encrypted_config.bin");
$decrypted_data = openssl_decrypt($encrypted_data, "AES-256-CBC", $key, 0, substr($key, 0, 16));
$config_array = parse_ini_string($decrypted_data);
extract($config_array);


//  paypal id config 
define('PAYPAL_ID', $config_array['PAYPAL_ID']);

// general configuration
define('PAYPAL_SANDBOX', true);
define('CURRENCY', 'GBP');

// paypal api configuration
define('PAYPAL_CLIENT_ID', $config_array['PAYPAL_CLIENT_ID']);
define('PAYPAL_SECRET', $config_array['PAYPAL_SECRET']);
define('PAYPAL_TOKEN', $config_array['PAYPAL_TOKEN']);

// paypal url 
define('PAYPAL_URL', $config_array['PAYPAL_URL']);
define('PAYPAL_HOSTNAME', $config_array['PAYPAL_HOSTNAME']);
define('PAYPAL_SUBSCRIPTIONS_URL', $config_array['PAYPAL_SUBSCRIPTIONS_URL']);
define('PAYPAL_RETURN_URL', $config_array['PAYPAL_RETURN_URL']);
define('PAYPAL_CANCEL_URL', $config_array['PAYPAL_CANCEL_URL']);
?>