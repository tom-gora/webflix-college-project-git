<?php session_start();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    #connect to db
    require('connect_db.php');

    #init an error array
    $errors = array();
    $fname;
    $lname;
    $email;
    $phone;
    $country;

    #check data name
    if (empty($_POST['form_id'])) {
        $errors[] = 'There was an unexpected error. Please try again.';
    } else {
        $formId = mysqli_real_escape_string($link, trim($_POST['form_id']));
        switch ($formId) {
            case 'first_name':
                if (empty($_POST['first_name'])) {
                    $errors[] = 'Please enter your first name.';
                } else {
                    $fname = trim($_POST['first_name']);
                }

                if (empty($errors)) {
                    $q = "UPDATE users SET first_name='$fname' WHERE user_id = '$user_id'";
                    $stmt = $link->prepare($q);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo 'true';
                    }
                    mysqli_close($link);
                } else {
                    foreach ($errors as $msg) {
                        print "• $msg<br>";
                    }
                    mysqli_close($link);
                }

                break;
            case 'last_name':
                if (empty($_POST['last_name'])) {
                    $errors[] = 'Please enter your last name.';
                } else {
                    $lname = trim($_POST['last_name']);
                }
                if (empty($errors)) {
                    $q = "UPDATE users SET last_name='$lname' WHERE user_id='$user_id'";
                    $stmt = $link->prepare($q);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo 'true';
                    }
                    mysqli_close($link);
                } else {
                    foreach ($errors as $msg) {
                        print "• $msg<br>";
                    }
                    mysqli_close($link);
                }
                break;
            case 'email':
                if (empty($_POST['email'])) {
                    $errors[] = 'Please enter your email.';
                } else {
                    $email = trim($_POST['email']);
                }
                if (empty($errors)) {
                    $q = "UPDATE users SET email='$email' WHERE user_id='$user_id'";
                    $stmt = $link->prepare($q);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo 'true';
                    }
                    mysqli_close($link);
                } else {
                    foreach ($errors as $msg) {
                        print "• $msg<br>";
                    }
                    mysqli_close($link);
                }
                break;
            case 'phone':
                if (empty($_POST['phone'])) {
                    $errors[] = 'Please enter your phone.';
                } else {
                    $phone = trim($_POST['phone']);
                }
                if (empty($errors)) {
                    $q = "UPDATE users SET phone='$phone' WHERE user_id='$user_id'";
                    $stmt = $link->prepare($q);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo 'true';
                    }
                    mysqli_close($link);
                } else {
                    foreach ($errors as $msg) {
                        print "• $msg<br>";
                    }
                    mysqli_close($link);
                }
                break;
            case 'country':
                if (empty($_POST['country'])) {
                    $errors[] = 'Please select your country.';
                } else {
                    $country = trim($_POST['country']);
                }
                if (empty($errors)) {
                    $q = "UPDATE users SET country='$country' WHERE user_id='$user_id'";
                    $stmt = $link->prepare($q);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo 'true';
                    }
                    mysqli_close($link);
                } else {
                    foreach ($errors as $msg) {
                        echo '•' . $msg . '<br>';
                    }
                    mysqli_close($link);
                }
                break;
        }
    }

}

?>