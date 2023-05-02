<?php

require('../../../includes/connect_db.php');


// print_r($link);

$json_data = file_get_contents("php://input");

$data = json_decode($json_data, true);

$type = $data['edited-type'];

switch ($type) {

    case "user":
        $id = $data['id'];
        $email = addslashes($data['email']);
        $first_name = addslashes($data['first_name']);
        $last_name = addslashes($data['last_name']);
        $phone = addslashes($data['phone']);
        $country_code = $data['country'];
        $plan_status = $data['plan-status'];
        $plan_type = $data['plan-type'];

        $q = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', country = '$country_code', subscription_status = '$plan_status', subscription_type = '$plan_type' WHERE user_id = '$id'";

        // echo $q;
        $stmt = $link->prepare($q);
        $stmt->execute();

        if ($stmt->errno === 0) {
            if ($stmt->affected_rows > 0) {
                echo "success";
                mysqli_close($link);
            } else {
                echo "success";
                mysqli_close($link);
            }
        } else {
            echo "error";
            mysqli_close($link);
        }

        break;
    case "movie":
        $id = $data['id'];
        $title = addslashes($data['title']);
        $director = addslashes($data['director']);
        $genre = addslashes($data['genre']);
        $release_date = $data['release_date'];
        $language = addslashes($data['language']);
        $duration = $data['duration'];
        $summary = addslashes($data['summary']);
        $ytlink = addslashes($data['link']);

        $q = "UPDATE webflix_movies 
        SET title = '$title', director = '$director', genre = '$genre', release_date = '$release_date', 
        `language` = '$language', movie_duration = '$duration', summary = '$summary', movie_link = '$ytlink'
        WHERE movie_id = '$id'";

        // echo $q;
        $stmt = $link->prepare($q);
        $stmt->execute();
        if ($stmt->errno === 0) {
            if ($stmt->affected_rows > 0) {
                echo "success";
                mysqli_close($link);
            } else {
                echo "success";
                mysqli_close($link);
            }
        } else {
            echo "error";
            mysqli_close($link);
        }
        break;
    case "show":
        $id = $data['id'];
        $title = addslashes($data['title']);
        $creator = addslashes($data['creator']);
        $genre = addslashes($data['genre']);
        $release_date = $data['release_date'];
        $language = addslashes($data['language']);
        $seasons_json = $data['seasons_json'];
        $summary = addslashes($data['summary']);
        $ytlink = addslashes($data['link']);

        $q = "UPDATE webflix_series 
            SET title = '$title', created_by = '$creator', genre = '$genre', release_date = '$release_date', 
            `language` = '$language', seasons = '$seasons_json', summary = '$summary', series_link = '$ytlink'
            WHERE series_id = '$id'";

        // echo $q;
        $stmt = $link->prepare($q);
        $stmt->execute();
        if ($stmt->errno === 0) {
            if ($stmt->affected_rows > 0) {
                echo "success";
                mysqli_close($link);
            } else {
                echo "success";
                mysqli_close($link);
            }
        } else {
            echo "error";
            mysqli_close($link);
        }
        break;

}







?>