<?php

$show_id = $_GET['id'];

$seasons;

require('connect_db.php');

$q1 = "SELECT seasons FROM webflix_series WHERE series_id = $show_id;";
$stmt = $link->prepare($q1);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
    $seasons = $row['seasons'];
}
echo json_encode($seasons);

mysqli_close($link);

?>