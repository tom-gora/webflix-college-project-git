<?php


#Check form submit

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    #connect to db
    require('connect_db.php');

    #init an error array
    $errors = array();

    #check email
    if (empty($_POST['email'])) {
        $errors[] = 'Email address was not provided.';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    #check dob
    if (empty($_POST['dob'])) {
        $errors[] = 'Date of birth was not provided.';
    } else {
        $bstring = mysqli_real_escape_string($link, trim($_POST['dob']));
        $explodedDate = explode("/", $bstring);
        $b = date("Y-m-d", strtotime($explodedDate[2] . "-" . $explodedDate[1] . "-" . $explodedDate[0]));
    }

    #check phone
    if (empty($_POST['phone'])) {
        $errors[] = 'Phone number was not provided.';
    } else {
        $n = mysqli_real_escape_string($link, trim($_POST['phone']));
    }

    #check if data correct
    if (empty($errors)) {
        $q = "SELECT user_id FROM users 
        WHERE email = '$e' && 
         phone = '$n' && 
         date_of_birth = '$b'";
        $stmt = $link->prepare($q);
        $stmt->execute();
        $res = $stmt->get_result();
        if (mysqli_num_rows($res) != 1) {
            $errors[] = 'Some of the data is incorrect.';
            foreach ($errors as $msg) {
                print "• $msg<br>";
            }
        } else {
            $user_id = $res->fetch_assoc()['user_id'];
            echo "success " . $user_id;
        }
    } else {

        foreach ($errors as $msg) {
            print "• $msg<br>";
        }

        #Close database connection. 
        mysqli_close($link);
    }

}

?>