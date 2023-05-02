<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // back to homepage if no session. page only accessible after login
    header("Location: index.php");
}
require('config.php');

// Set API credentials
$clientId = PAYPAL_CLIENT_ID;
$clientSecret = PAYPAL_SECRET;
;

// get the subscription ID
include('../connect_db.php');
$user_id = $_SESSION['user_id'];

$q = "SELECT paypal_subscr_id FROM user_subscriptions WHERE user_id = '$user_id'";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_array($res);
    $subscriptionId = $row['paypal_subscr_id'];
} else {
    echo "error_subscription_not_found";
}

// Set API endpoints
$url = PAYPAL_SUBSCRIPTIONS_URL . $subscriptionId;
$cancelUrl = $url . '/cancel';

// Set request headers
$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret)
);

// Send request to check if subscription is active
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Process response
$jsonResponse = json_decode($response, true);
if ($jsonResponse && $jsonResponse['status'] == 'ACTIVE') {
    // Send request to cancel active subscription
    $curl = curl_init($cancelUrl);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $cancelResponse = curl_exec($curl);
    curl_close($curl);
} else {
    echo "An error occurred. Your plan is not active.";
}

// Send secondary  check if subscription successfully cancelled as api doesnt return cancellation confirmation
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Process response
$jsonResponse = json_decode($response, true);
if ($jsonResponse && $jsonResponse['status'] == 'CANCELLED') {
    // update users table to reflect cancelled
    $q1 = "UPDATE users SET subscription_status = 0, subscription_type = 'none' WHERE user_id = '$user_id'";
    $stmt = $link->prepare($q1);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $q1_status = 'ok';
    }

    $q2 = "DELETE FROM user_subscriptions WHERE user_id = '$user_id'";
    $stmt = $link->prepare($q2);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $q2_status = 'ok';
    }

    if ($q1_status == 'ok' && $q2_status == 'ok') { // return a msg that will allow submit event to fire
        echo "successfully_cancelled";
    }
} else {
    $errorMessage = json_last_error_msg();
    echo "An error occurred. Subscription could not be cancelled.";
}

?>