<?php

require('/home/my_user/config/access.php');


//get my configurations
$encrypted_data = file_get_contents("/home/my_user/config/encrypted_config.bin");
$decrypted_data = openssl_decrypt($encrypted_data, "AES-256-CBC", $key, 0, substr($key, 0, 16));
$_ENV = parse_ini_string($decrypted_data);
extract($_ENV);

$tmdb_key = $_ENV['TMDB_KEY'];
$tmdb_api_movie_url = $_ENV['TMDB_API_MOVIE_URL'];
$tmdb_api_tv_url = $_ENV['TMDB_API_TV_URL'];
$tmdb_img_url = $_ENV['TMDB_IMG_URL'];

$data = array(
    'tmdb_key' => $tmdb_key,
    'tmdb_api_movie_url' => $tmdb_api_movie_url,
    'tmdb_api_tv_url' => $tmdb_api_tv_url,
    'tmdb_img_url' => $tmdb_img_url
);

$json_data = json_encode($data);

echo $json_data;

?>