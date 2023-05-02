<?php session_start();

require "connect_db.php";

$series_arr = array();

$q = "SELECT series_id, title, summary FROM webflix_series";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $id = $row['series_id'];
    $title = $row['title'];
    $summary = $row['summary'];
    $movie_obj = new stdClass();
    $movie_obj->id = $id;
    $movie_obj->title = $title;
    $movie_obj->summary = $summary;

    array_push($series_arr, $movie_obj);
}
mysqli_close($link);

echo json_encode($series_arr);
exit();
?>