<?php


#Check form submit

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    #connect to db
    require('connect_db.php');

    #init an error array
    $errors = array();


    #check 1st name
    if (empty($_POST['first_name'])) {
        $errors[] = 'First name was not provided.';
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
    }


    #check last name
    if (empty($_POST['last_name'])) {
        $errors[] = 'Last name was not provided.';
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
    }


    #check email
    if (empty($_POST['email'])) {
        $errors[] = 'Email address was not provided.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }


    #check PW and if matching PW entries
    if (!empty($_POST['pass1'])) { // if input not empty
        if ($_POST['pass1'] != $_POST['pass2']) { // and passwords don't match
            $errors[] = 'Passwords do not match.'; // push error into array
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1'])); // else good to write into db
        }
    } else {
        $errors[] = 'Password was not provided.'; // else if input IS empty write error into array
    }

    #check email
    if (empty($_POST['dob'])) {
        $errors[] = 'Date of birth was not provided.';
    } else {
        $bstring = mysqli_real_escape_string($link, trim($_POST['dob']));
        $explodedDate = explode("/", $bstring);
        $b = date("Y-m-d", strtotime($explodedDate[2] . "-" . $explodedDate[1] . "-" . $explodedDate[0]));
    }

    #check email
    if (empty($_POST['phone'])) {
        $errors[] = 'Phone number was not provided.';
    } else {
        $n = mysqli_real_escape_string($link, trim($_POST['phone']));
    }

    #check email
    if (empty($_POST['country'])) {
        $errors[] = 'Country was not selected.';
    } else {
        $c = mysqli_real_escape_string($link, trim($_POST['country']));
    }


    #check if email is regged
    if (empty($errors)) {
        $q = "SELECT user_id FROM users WHERE email = '$e'";
        $stmt = $link->prepare($q);
        $stmt->execute();
        $res = $stmt->get_result();
        if (mysqli_num_rows($res) != 0) {
            $errors[] = 'Email address  already registered.';
        }
    }

    #On success registration user data iserted into db
    if (empty($errors)) {
        $q = "INSERT INTO users 
    (first_name, last_name, email, phone, date_of_birth, country, pass, reg_date) 
    VALUES ('$fn','$ln','$e', '$n', '$b', '$c', SHA2('$p',256), NOW())";
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