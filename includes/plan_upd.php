<?php

session_start();

#Check form submit

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    #connect to db
    require('connect_db.php');

    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $new_plan = $data['new_plan'];


    if ($new_plan != 'none') {
        $q = "UPDATE users SET subscription_status = '1', subscription_type = '$new_plan' WHERE user_id='$id'";
        $stmt = $link->prepare($q);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo 'true_updated';
            exit();
        }
    } else if ($new_plan == 'none') {
        $q = "UPDATE users SET subscription_status = '0', subscription_type = '$new_plan' WHERE user_id='$id'";
        $stmt = $link->prepare($q);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo 'true_cancelled';
            exit();
        }
    } else {
        echo "false";
    }
}
?>