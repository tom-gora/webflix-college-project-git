<?php

session_start();

#Check form submit

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    #connect to db
    require('connect_db.php');

    #init an error array
    $errors = array();

    #check PW and if matching PW entries
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Passwords do not match.';
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'Password was not provided.';
    }



    #On successful update card data iserted into db
    if (empty($errors)) {
        $id = $_SESSION['user_id'];
        $q = "UPDATE users SET pass = SHA2('$p',256) WHERE user_id='$id'";
        $stmt = $link->prepare($q);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo 'true';
        }
        #Close database connection
        mysqli_close($link);
        exit();
    } else {

        foreach ($errors as $msg) {
            print "• $msg<br>";
        }

        #Close database connection. 
        mysqli_close($link);
    }

}
?>