<?php session_start();

if (!isset($_SESSION['user_id'])) {
    // back to login if not logged in. page only accessible after login
    echo 'false';
} else {

    require('connect_db.php');


    $user_ID = $_SESSION['user_id'];
    $show_ID = $_POST['id'];
    $review = $_POST['txt'];
    $review = str_replace("'", "\'", $review); // sanitase the string againts use of apostrophe using an esc sequence
    $rat = $_POST['stars'];

    if ($review == '' || $rat == '') {
        echo 'null_rev';
        mysqli_close($link);
    } else {
        $q = "INSERT INTO webflix_series_review_dump 
    (series_ID, user_ID, review_text, rating) VALUES 
    ('$show_ID','$user_ID','$review', '$rat')";

        $stmt = $link->prepare($q);
        $stmt->execute();
        if ($stmt->affected_rows == 0) {
            echo 'false';
            mysqli_close($link);
        } else {
            echo 'true';
            mysqli_close($link);
        }
    }
}

?>