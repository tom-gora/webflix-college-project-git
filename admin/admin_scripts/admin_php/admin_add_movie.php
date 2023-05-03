<?php

// get DB connection config
require('../../../includes/connect_db.php');

// Get the raw input data from the request
$json_data = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$data = json_decode($json_data, true);

// Assign variables to the data array values
$title = addslashes($data['title']);
$director = addslashes($data['director']);
$genre = addslashes($data['genre']);
$release_date = $data['release_date'];
$language = addslashes($data['language']);
$duration = $data['duration'];
$summary = addslashes($data['summary']);
$ytlink = $data['link'];

// Prepare an insert statement for the database
$q = "INSERT INTO webflix_movies (title, director, genre, release_date, language, movie_duration, summary, movie_link)
VALUES ('$title', '$director', '$genre', '$release_date', '$language', '$duration', '$summary', '$ytlink')";

// Execute the insert statement
$stmt = $link->prepare($q);
$stmt->execute();

// Check if the insert was successful and show an appropriate message
if ($stmt->affected_rows > 0) {
    echo "success";
    mysqli_close($link);
} else {
    echo "error";
    mysqli_close($link);
}

?>