<?php
if (basename($_SERVER['PHP_SELF']) == "account.php") {
    // echo only log out option on the user's account page
    echo '
<li>
<button type="button" class="btn btn-primary navbutton" onClick="window.location.replace(\'includes/logout.php\')" style="margin-right:40px; margin-top:15px; background:none; border:none; box-shadow:none; font-size: 28px;"><i class="fa fa-sign-out"></i><br>Log out</button>
</li>
';
} elseif (basename($_SERVER['PHP_SELF']) == "login.php") {
    // echo empty navigation content while on a login page.
    echo '
<li></li>
';
} elseif (isset($_SESSION['user_id'])) {
    // echo user account btn and logout btn in all other instances when session active
    require('/home/my_user/config/access.php');

    //get my configurations
    $encrypted_data = file_get_contents("/home/my_user/config/encrypted_config.bin");
    $decrypted_data = openssl_decrypt($encrypted_data, "AES-256-CBC", $key, 0, substr($key, 0, 16));
    $_ENV = parse_ini_string($decrypted_data);
    extract($_ENV);

    $user_ui_api_url = $_ENV['USER_UI_API_URL'];

    include('connect_db.php');
    $id = $_SESSION['user_id'];
    $q = "SELECT first_name, last_name FROM users WHERE user_id = '$id'";
    $stmt = $link->prepare($q);
    $stmt->execute();
    $res = $stmt->get_result();
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $icon_link = $user_ui_api_url . $fname . "+" . $lname . "&bold=true&rounded=true&background=00a2e2&format=png&size=100";
    }
    mysqli_close($link);
    echo '
<li>
<button type="button" class="btn btn-primary navbutton" onClick="window.location.replace(\'account.php\')" style="margin-right:40px; margin-top:15px; background:none; border:none; box-shadow:none; font-size: 28px;"><img src="';
    echo $icon_link;
    echo '" alt="Your Account" style="width: 28px; height: 28px;"><br>';
    echo $fname;
    echo '</button>
</li>
<li>
<button type="button" class="btn btn-primary navbutton" onClick="window.location.replace(\'includes/logout.php\')" style="margin-right:40px; margin-top:15px; background:none; border:none; box-shadow:none; font-size: 28px;"><i class="fa fa-sign-out"></i><br>Log out</button>
</li>
';
} else {
    // otherwise echo sign in and registration btns when session not active.
    echo '    
<li>
<button type="button" class="btn btn-primary navbutton" onClick="window.location.replace(\'login.php\')" style="margin-right:40px; margin-top:15px; background:none; border:none; box-shadow:none; font-size: 28px;"><i class="fa fa-user"></i><br>Your account</button>
</li>
<li>
<button type="button" class="btn btn-primary navbutton" data-toggle="modal" data-target="#registerModal" style="margin-right:40px; margin-top:15px; background:none; border:none; box-shadow:none; font-size: 28px;"><i class="fa fa-pencil"></i><br>Sign up</button>
</li>';
}
?>