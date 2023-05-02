<?php

// TODO: Implement admin table and admin login to use//for now just content data

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     // back to homepage if no session. page only accessible after login
//     echo 'no-login';
// } else {
//     $id = $_SESSION['user_id'];
// }
require('../includes/connect_db.php');

$recent_users = array();
$qrecentu = "SELECT 
first_name, last_name, email, reg_date 
FROM users ORDER BY reg_date DESC LIMIT 4;";
$stmt = $link->prepare($qrecentu);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $recent_user_obj = new stdClass();
    $recent_user_obj->name = $row['first_name'] . ' ' . $row['last_name'];
    $recent_user_obj->email = $row['email'];
    $recent_user_obj->reg_date = $row['reg_date'];

    array_push($recent_users, $recent_user_obj);
}

$qnumbers = "SELECT
(SELECT COUNT(*) FROM users) as user_count ,
(SELECT COUNT(*) FROM webflix_movies) as movie_count,
(SELECT COUNT(*) FROM webflix_series) as show_count,
(SELECT (SELECT COUNT(*) FROM webflix_movies_review_dump) + (SELECT COUNT(*) FROM webflix_series_review_dump)) AS review_count;";
$stmt = $link->prepare($qnumbers);
$stmt->execute();
$res = $stmt->get_result();
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_array($res);
    $user_count = $row['user_count'];
    $movie_count = $row['movie_count'];
    $show_count = $row['show_count'];
    $review_count = $row['review_count'];
}

$movies_stats = array();
$qtopmovies = "SELECT 
webflix_movies_review_dump.movie_id, 
AVG(webflix_movies_review_dump.rating) AS average_rating, 
webflix_movies.title, 
webflix_movies.genre,
COUNT(*) AS review_count
FROM webflix_movies_review_dump 
JOIN webflix_movies 
ON webflix_movies.movie_id=webflix_movies_review_dump.movie_id 
GROUP BY movie_id 
ORDER BY average_rating DESC 
LIMIT 4;
";
$stmt = $link->prepare($qtopmovies);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $movie_stat_obj = new stdClass();
    $movie_stat_obj->id = $row['movie_id'];
    $movie_stat_obj->average_rating = number_format($row['average_rating'], 2);
    $movie_stat_obj->title = $row['title'];
    $movie_stat_obj->genre = $row['genre'];
    $movie_stat_obj->count = $row['review_count'];

    array_push($movies_stats, $movie_stat_obj);
}

$shows_stats = array();
$qtopshows = "SELECT 
webflix_series_review_dump.series_id, 
AVG(webflix_series_review_dump.rating) AS average_rating, 
webflix_series.title, 
webflix_series.genre,
COUNT(*) AS review_count
FROM webflix_series_review_dump 
JOIN webflix_series 
ON webflix_series.series_id=webflix_series_review_dump.series_id 
GROUP BY series_id 
ORDER BY average_rating DESC 
LIMIT 4;";
$stmt = $link->prepare($qtopshows);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $show_stat_obj = new stdClass();
    $show_stat_obj->id = $row['series_id'];
    $show_stat_obj->average_rating = number_format($row['average_rating'], 2);
    $show_stat_obj->title = $row['title'];
    $show_stat_obj->genre = $row['genre'];
    $show_stat_obj->count = $row['review_count'];

    array_push($shows_stats, $show_stat_obj);
}
mysqli_close($link);
?>