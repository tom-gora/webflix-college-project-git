<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    #connect to db
    require('connect_db.php');

    #connect tools
    require('login_tools.php');

    list($check, $data) = validate($link, $_POST['email'], $_POST['pass']);

    if ($check) {
        #Access session
        session_start();
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['reg_date'] = $data['reg_date'];
        $_SESSION['status'] = 1;
        echo 'true';
    } else {
        $errors = $data;
    }
    mysqli_close($link);
}

if (isset($errors) && !empty($errors)) {
    echo '<h5 class="alert-heading"><br>The following errors occured:<br></h5>';
    foreach ($errors as $msg) {
        print "• $msg<br>";
    }
    echo '<br><h5>Please try again or <br>
        <button type="button" class="btn btn-dark btn-lg btn-block modal-submit" onClick="window.location.replace(\'home.php#registerModal\')" 
        style="width: 100px; margin-top:20px; margin-left: -16px; background: none; box-shadow:none; border-color: #FF7315; color: #FF7315;">Register</button>';
}
?>