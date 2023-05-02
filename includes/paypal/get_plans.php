<?php
require('../connect_db.php');
require('config.php');
$q = "SELECT * FROM plans";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $rows[] = $row;
}
array_push($rows, PAYPAL_URL);
array_push($rows, PAYPAL_ID);
array_push($rows, CURRENCY);
array_push($rows, PAYPAL_CANCEL_URL);
array_push($rows, PAYPAL_RETURN_URL);

echo json_encode($rows);
mysqli_close($link);
?>