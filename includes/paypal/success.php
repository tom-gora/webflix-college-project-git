<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // back to homepage if no session. page only accessible after login
    header("Location: ../../index.php");
}

// following the official docs @ https://github.com/paypal/pdt-code-samples/blob/master/paypal_pdt.php

require('config.php');

include('../connect_db.php');

$pp_hostname = PAYPAL_HOSTNAME;
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];
$auth_token = PAYPAL_TOKEN;

$req .= "&tx=$tx_token&at=$auth_token";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, PAYPAL_URL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
//if your server does not bundled with default verisign certificates.
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
$res = curl_exec($ch);
curl_close($ch);

if (!$res) {
    //HTTP ERROR
} else {
    // echo $res;
    // parse the data
    $lines = explode("\n", trim($res));
    $keyarray = array();

    // print_r($res);
    if (strcmp($lines[0], "SUCCESS") == 0) {
        for ($i = 1; $i < count($lines); $i++) {
            $temp = explode("=", $lines[$i], 2);
            $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
        }
        // check the payment_status is Completed
        // check that txn_id has not been previously processed
        // check that receiver_email is your Primary PayPal email
        // check that payment_amount/payment_currency are correct
        // process payment

        //payment vars:
        $payer_firstname = $keyarray['first_name'];
        $payer_lastname = $keyarray['last_name'];
        $payer_full_name = $payer_firstname . ' ' . $payer_lastname;
        $payer_email = $keyarray['payer_email'];
        $txn_id = $keyarray['txn_id'];
        $purchase_date_data = $keyarray['payment_date'];
        $subscription_id = $keyarray['subscr_id'];
        $payment_status = $keyarray['payment_status'];

        //subscription vars:
        $item_number = $keyarray['item_number'];
        $item_name_data = $keyarray['item_name'];
        $plan_temp = explode(' ', $item_name_data);
        $item_name = $plan_temp[0];
        $billing_period = $plan_temp[1];

        $amount = $keyarray['mc_gross'];
        $currency = $keyarray['mc_currency'];
        $wf_user_id = $keyarray['custom'];

        // print_r($keyarray);

        $q = "SELECT first_name, last_name, country FROM users WHERE user_id = '$wf_user_id'";
        $stmt = $link->prepare($q);
        $stmt->execute();
        $wfuser = $stmt->get_result();
        if (mysqli_num_rows($wfuser) > 0) {
            $row = mysqli_fetch_array($wfuser);
            $wf_user_fname = $row['first_name'];
            $wf_user_lname = $row['last_name'];
            $wf_user_country_code = $row['country'];
            $zone_arr = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $wf_user_country_code);
            $rand_zone = array_rand($zone_arr);
            $wf_user_timezone = $zone_arr[$rand_zone];
        }
        $original_timezone = new DateTimeZone('America/Los_Angeles');
        $target_timezone = new DateTimeZone($wf_user_timezone);
        $purchase_date = DateTime::createFromFormat('H:i:s M d, Y T', $purchase_date_data, $original_timezone);
        $purchase_date->setTimezone($target_timezone);
        $formatted_purchase_date = $purchase_date->format('Y-m-d H:i:s');
        $valid_until_date = DateTime::createFromFormat('Y-m-d H:i:s', $formatted_purchase_date);
        $valid_until_date->modify('+48 months');
        $formatted_valid_until_date = $valid_until_date->format('Y-m-d H:i:s');

        $qplan = "SELECT users_cross_code, `interval`, interval_count FROM plans WHERE plan_id = $item_number";
        $stmt = $link->prepare($qplan);
        $stmt->execute();
        $plan_data = $stmt->get_result();
        if (mysqli_num_rows($plan_data) > 0) {
            $row = mysqli_fetch_array($plan_data);
            $plan_interval = $row['interval'];
            $plan_interval_count = $row['interval_count'];
            $cross_ref_code = $row['users_cross_code'];
        }

    } else if (strcmp($lines[0], "FAIL") == 0) {
        // TODO: log for manual investigation
    }
}
$quser = "UPDATE users 
SET subscription_status = 1, subscription_type = '$cross_ref_code' WHERE user_id = '$wf_user_id'";
$stmt = $link->prepare($quser);
$stmt->execute();

$qsub = "INSERT INTO user_subscriptions 
(user_id, plan_id, paypal_subscr_id, txn_id, subscr_interval, subscr_interval_count, 
valid_from, valid_to, paid_amount, currency_code, payer_name, payer_email, payment_status)
values ('$wf_user_id', '$item_number', '$subscription_id', '$txn_id', '$plan_interval', 
'$plan_interval_count', '$formatted_purchase_date', '$formatted_valid_until_date', '$amount', '$currency', 
'$payer_full_name', '$payer_email', '$payment_status')";

$stmt = $link->prepare($qsub);


try {
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        header("Refresh: 5; URL=../../index.php#subscribed");
        echo 'Error: subscription already processed. Redirecting in 5 seconds.';
        exit;
    }
}

mysqli_close($link);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Webflix - Processing subscription</title>
    <link rel="icon" type="image/x-icon" href="../../resources/favicon.png">
    <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, shrink-to-fit=no"
        charset="utf-8">

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
        integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .bg {
            background-image: url("https://unsplash.com/photos/EOQhsfFBhRk/download?ixid=MnwxMjA3fDB8MXxzZWFyY2h8NXx8dGVsZXZpc2lvbnxlbnwwfDB8fHwxNjgwOTkwMjUy&force=true&w=640");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        div>#overlay-header {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .center {
            min-height: 100%;
            /* Fallback for browsers do NOT support vh unit */
            min-height: 100vh;
            /* These two lines are counted as one :-)       */
            margin: 0;
            display: flex;
            align-items: center;
        }

        .spinner-border {
            width: 5rem;
            height: 5rem;
        }

        .foot-message {
            position: fixed;
            left: 50%;
            bottom: 20px;
            transform: translate(-50%, -50%);
            margin: 0 auto;
        }

        #link {
            color: #ff5800;
        }

        .logo {
            width: 200px;
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-40%)
        }
    </style>
</head>

<body>

    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                window.location.href = "../../account.php#subscribed";
            }, 10000);
        });
    </script>

    <!-- src https://codepen.io/Carleslc/pen/WBaEYQ -->

    <div class="bg">
        <div id="overlay-header">
            <div class="text-center center">
                <div class="container">
                    <div class="image-container">
                        <img class="logo" src="https://webflix-demo.site/resources/wf.png" alt="logo">
                    </div>
                    <div class="row spinner-border text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="foot-message">
            <p class="text-white">WebFlix is storing your information. If you are not redirected in 10 seconds, please
                click <a id="link" href="../../index.php#subscribed">HERE</p>
        </div>
    </div>

</body>

</html>