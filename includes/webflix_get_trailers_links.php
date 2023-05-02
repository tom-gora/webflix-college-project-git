<?php

require('connect_db.php');

$temp_arr1 = array();
$temp_arr2 = array();
$trailer_arr = array();

$q = "SELECT DISTINCT series_id, title, summary, series_link FROM `webflix_series` ORDER BY RAND() LIMIT 5";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
    $id = $row['series_id'];
    $title = $row['title'];
    $summary = $row['summary'];
    $vid_id = $row['series_link'];
    $trailer_info_obj = new stdClass();
    $trailer_info_obj->type = 'series';
    $trailer_info_obj->id = $id;
    $trailer_info_obj->title = $title;
    $trailer_info_obj->summary = $summary;
    $trailer_info_obj->vid_id = $vid_id;

    array_push($temp_arr1, $trailer_info_obj);
}

$q = "SELECT DISTINCT movie_id, title, summary, movie_link FROM `webflix_movies` ORDER BY RAND() LIMIT 5";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
    $id = $row['movie_id'];
    $title = $row['title'];
    $summary = $row['summary'];
    $vid_id = $row['movie_link'];
    $trailer_info_obj = new stdClass();
    $trailer_info_obj->type = 'movie';
    $trailer_info_obj->id = $id;
    $trailer_info_obj->title = $title;
    $trailer_info_obj->summary = $summary;
    $trailer_info_obj->vid_id = $vid_id;

    array_push($temp_arr2, $trailer_info_obj);
}

for ($i = 0; $i < 5; $i++) {
    array_push($trailer_arr, $temp_arr1[$i]);
    array_push($trailer_arr, $temp_arr2[$i]);
}

for ($j = 0; $j < sizeof($trailer_arr); $j++) {
    if ($trailer_arr[$j]->{'type'} == 'movie') {
        echo '<div class="item youtube"><button class="btn watch-btn-trailer" onClick="window.location.href=\'webflix_movie.php?id=';
        echo $trailer_arr[$j]->{'id'};
    } else if ($trailer_arr[$j]->{'type'} == 'series') {
        echo '<div class="item youtube"><button class="btn watch-btn-trailer" onClick="window.location.href=\'webflix_show.php?id=';
        echo $trailer_arr[$j]->{'id'};
    }
    echo '\'">WATCH NOW <i class="fa fa-play-circle" aria-hidden="true"></i>
    </button><iframe class="embed-player slide-media" width="100%" src="https://www.youtube-nocookie.com/embed/';
    echo $trailer_arr[$j]->{'vid_id'};
    echo '?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&start=1&mute=1" allow="autoplay" frameborder="0" id="player';
    echo $j + 1;
    echo '"></iframe>
    <p class="plot caption">';
    echo $trailer_arr[$j]->{'summary'};
    echo '</p><p class="title caption">';
    echo $trailer_arr[$j]->{'title'};
    echo '</p>
    <div class="decorations-cover"></div>
    </div>';

}



// $json = json_encode($trailer_arr, JSON_UNESCAPED_UNICODE);
// header('Content-Type: application/json; charset=utf-8');
// echo $json;

mysqli_close($link);
?>