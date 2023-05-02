<?php

require('../../../includes/connect_db.php');

$json_data = file_get_contents("php://input");

$data = json_decode($json_data, true);

$title = addslashes($data['title']);
$director = addslashes($data['director']);
$genre = addslashes($data['genre']);
$release_date = $data['release_date'];
$language = addslashes($data['language']);
$duration = $data['duration'];
$summary = addslashes($data['summary']);
$ytlink = $data['link'];


$q = "INSERT INTO webflix_movies (title, director, genre, release_date, `language`, movie_duration, summary, movie_link) 
VALUES ('$title', '$director', '$genre', '$release_date', '$language', '$duration', '$summary', '$ytlink')";

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