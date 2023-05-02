<?php

require('../includes/connect_db.php');

$movies = array();

$q = "SELECT * FROM webflix_movies;";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $movie_obj = new stdClass();
    $movie_obj->id = $row['movie_id'];
    $movie_obj->title = $row['title'];
    $movie_obj->director = $row['director'];
    $movie_obj->genre = $row['genre'];
    $movie_obj->released = $row['release_date'];
    $movie_obj->language = $row['language'];
    $movie_obj->duration = $row['movie_duration'];
    $movie_obj->summary = $row['summary'];
    $movie_obj->movie_link = $row['movie_link'];
    array_push($movies, $movie_obj);
}

foreach ($movies as $movie) {
    echo "<tr class=\"expandable-table-row\">
<td>{$movie->id}</td>
<td>{$movie->title}</td>
<td>{$movie->released}</td>
</tr>
<tr class=\"expandable-table-extra\">
<td colspan=\"3\">
    <div class=\"details-container\">
        <div class=\"details\">
            <table class=\"table details-table\">
                <tbody>
                    <tr>
                        <td><strong>Director</strong></td>
                        <td class=\"field-director\">{$movie->director}</td>
                    </tr>
                    <tr>
                        <td><strong>Genre</strong></td>
                        <td class=\"field-genre\">{$movie->genre}</td>
                    </tr>
                    <tr>
                        <td><strong>Language</strong></td>
                        <td class=\"field-language\">{$movie->language}</td>
                    </tr>
                    <tr>
                        <td><strong>Duration</strong></td>
                        <td class=\"field-duration\">{$movie->duration}</td>
                    </tr>
                    <tr>
                        <td><strong>Summary</strong></td>
                        <td style=\"white-space: normal; max-width: 90%;\" class=\"field-summary\">{$movie->summary}</td>
                    </tr>
                    <tr>
                        <td><strong>YouTube ID</strong></td>
                        <td class=\"field-link\">{$movie->movie_link}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <button type=\"button\" class=\"btn btn-info admin-edit\" id-data=\"movie-{$movie->id}\" item-data=\"{$movie->title}\">Edit</button>
                        </td>
                        <td>
                            <button type=\"button\" class=\"btn btn-danger admin-delete\" id-data=\"movie-{$movie->id}\" item-data=\"{$movie->title}\">Delete</button>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</td>
</tr>";
}

?>