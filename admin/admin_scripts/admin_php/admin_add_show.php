<?php

require('../../../includes/connect_db.php');

$json_data = file_get_contents("php://input");

$data = json_decode($json_data, true);

$title = addslashes($data['title']);
$creator = addslashes($data['creator']);
$genre = addslashes($data['genre']);
$release_date = $data['release_date'];
$language = addslashes($data['language']);
$seasons_json = $data['seasons_json'];
$summary = addslashes($data['summary']);
$ytlink = $data['link'];


$q = "INSERT INTO webflix_series (title, created_by, genre, release_date, `language`, seasons, summary, series_link) 
VALUES ('$title', '$creator', '$genre', '$release_date', '$language', '$seasons_json', '$summary', '$ytlink')";

// echo $q;

$stmt = $link->prepare($q);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    echo "success";
    mysqli_close($link);
} else {
    echo "error";
    mysqli_close($link);
}

?>