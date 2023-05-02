<?php session_start();

require "connect_db.php";

$movies_arr = array();

$q = "SELECT movie_id, title, summary FROM webflix_movies";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $id = $row['movie_id'];
    $title = $row['title'];
    $summary = $row['summary'];
    $movie_obj = new stdClass();
    $movie_obj->id = $id;
    $movie_obj->title = $title;
    $movie_obj->summary = $summary;

    array_push($movies_arr, $movie_obj);
}
mysqli_close($link);

echo json_encode($movies_arr);
exit();
?>