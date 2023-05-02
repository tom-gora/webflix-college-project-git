<?php

require('../../../includes/connect_db.php');

$json_data = file_get_contents("php://input");

// Decode the JSON payload
$data = json_decode($json_data, true);


// Extract the values
$item_to_delete = $data['item-to-delete'];
$item_id = $data['item-id'];

// test print:
// echo "data received." . "\n" . "Item: " . $item_to_delete . "\n" . "Item ID: " . $item_id;

switch ($item_to_delete) {

    case "user":
        $q = "DELETE FROM users WHERE user_id = {$item_id}";
        break;
    case "movie":
        $q = "DELETE FROM webflix_movies WHERE movie_id = {$item_id}";
        break;
    case "show":
        $q = "DELETE FROM webflix_series WHERE show_id = {$item_id}";
        break;
}


$stmt = $link->prepare($q);
$stmt->execute();
if (mysqli_affected_rows($link) > 0) {
    echo "success";
} else {
    echo "error";
}
;
mysqli_close($link);

?>