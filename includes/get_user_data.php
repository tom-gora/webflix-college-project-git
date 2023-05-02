<?php session_start();
require('/home/my_user/config/access.php');
require('connect_db.php');


//get my configurations
$encrypted_data = file_get_contents("/home/my_user/config/encrypted_config.bin");
$decrypted_data = openssl_decrypt($encrypted_data, "AES-256-CBC", $key, 0, substr($key, 0, 16));
$config_array = parse_ini_string($decrypted_data);
extract($config_array);

if (!isset($_SESSION['user_id'])) {
    // back to homepage if no session. page only accessible after login
    echo 'no-login';
} else {



    $id = $_SESSION['user_id'];
    $user_ui_api_url = $config_array['USER_UI_API_URL'];
    $country_io_url = $config_array['COUNTRYIO_URL'];
    $oxr_app_id = $config_array['OXR_APP_ID'];
    $oxr_url = $config_array['OXR_URL'];



    $q = "SELECT * FROM users WHERE user_id = '$id'";
    $stmt = $link->prepare($q);
    $stmt->execute();
    $res = $stmt->get_result();
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $dob = $row['date_of_birth'];
        $country_code = $row['country'];
        // getting external resource to translate country code into country name
        //src https://stackoverflow.com/questions/46369045/mapping-country-code-to-country-name-php
        $countries = json_decode(file_get_contents($country_io_url));
        $country = $countries->$country_code;
        $regdate = $row['reg_date'];
        $sub_status = $row['subscription_status'];
        $sub_type = $row['subscription_type'];

        $user_obj = new stdClass();
        $user_obj->id = $row['user_id'];
        $user_obj->fname = $fname;
        $user_obj->lname = $lname;
        $user_obj->email = $email;
        $user_obj->phone = $phone;
        $user_obj->dob = $dob;
        $user_obj->country_code = $country_code;
        $user_obj->country = $country;
        $user_obj->reg_date = $regdate;
        $user_obj->sub_status = $sub_status;
        $user_obj->sub_type = $sub_type;
        $user_obj->oxr_app_id = $oxr_app_id;
        $user_obj->oxr_url = $oxr_url;
        $user_obj->user_ui_api_url = $user_ui_api_url;

        $json = json_encode($user_obj);
        header('Content-Type: application/json');
        echo $json;

        mysqli_close($link);
    }
}

?>