<?php

include('connect_db.php');

$series_arr = array();
$movies_arr = array();

$q = "SELECT DISTINCT series_id, title, summary FROM `webflix_series` ORDER BY RAND() LIMIT 8";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
    $id = $row['series_id'];
    $title = $row['title'];
    $summary = $row['summary'];
    $series_obj = new stdClass();
    $series_obj->id = $id;
    $series_obj->title = $title;
    $series_obj->summary = $summary;

    array_push($series_arr, $series_obj);
}

$q = "SELECT DISTINCT movie_id, title, summary FROM `webflix_movies` ORDER BY RAND() LIMIT 8";
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

$data = array();
$data['s_arr'] = $series_arr;
$data['m_arr'] = $movies_arr;
echo json_encode($data);
exit();
?>