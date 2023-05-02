<?php


# load default url
function load($page = 'login.php')
{
    # Begin URL with protocol, domain, and current directory.
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    # Remove trailing slashes then append page name to URL.
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    # Execute redirect then quit.
    header("Location: $url");
    exit();
}

# Function to check email address and password.
function validate($link, $email = '', $pwd = '')
{

    # Initialize errors array.
    $errors = array();

    # Check email field.
    if (empty($email)) {
        $errors[] = 'Enter your email address.';
    } else {
        $e = mysqli_real_escape_string($link, trim($email));
    }

    # Check password field.
    if (empty($pwd)) {
        $errors[] = 'Enter your password.';
    } else {
        $p = mysqli_real_escape_string($link, trim($pwd));
    }

    # On success retrieve user_id, first_name, and last name from 'users' database.
    if (empty($errors)) {
        $q = "SELECT user_id, first_name, last_name, email, reg_date FROM users WHERE email='$e' AND
pass=SHA2('$p',256)";
        $stmt = $link->prepare($q);
        $stmt->execute();
        $res = $stmt->get_result();
        if (@mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            return array(true, $row);
        } else {
            $errors[] = 'Email address and/or password not found.';
        }
    }
    # On failure retrieve error message/s.
    return array(false, $errors);
}
?>