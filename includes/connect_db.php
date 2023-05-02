<?php
require_once('/home/my_user/config/access.php');

$encrypted_data = file_get_contents("/home/my_user/config/encrypted_config.bin");
$decrypted_data = openssl_decrypt($encrypted_data, "AES-256-CBC", $key, 0, substr($key, 0, 16));
$config_array = parse_ini_string($decrypted_data);
extract($config_array);


$db_user = $config_array['DB_USER'];
$db_pass = $config_array['DB_PASS'];
$db_name = $config_array['DB_NAME'];

$link = mysqli_connect(
    'localhost',
    $db_user,
    $db_pass,
    $db_name
);

if (!$link) {
    # Otherwise fail gracefully and explain the error.
    die('Could not connect to MySQL: ' . mysqli_error($link));
}

if (!mysqli_set_charset($link, 'utf8mb4')) {
    die('Error loading charset utf8mb4: ' . mysqli_error($link));
}
?>