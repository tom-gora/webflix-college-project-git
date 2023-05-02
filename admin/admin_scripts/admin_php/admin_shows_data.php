<?php

require('../includes/connect_db.php');

$shows = array();

$q = "SELECT * FROM webflix_series;";
$stmt = $link->prepare($q);
$stmt->execute();
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $show_obj = new stdClass();
    $show_obj->id = $row['series_id'];
    $show_obj->title = $row['title'];
    $show_obj->creator = $row['created_by'];
    $show_obj->genre = $row['genre'];
    $show_obj->released = $row['release_date'];
    $show_obj->language = $row['language'];
    $show_obj->seasons = $row['seasons'];
    $show_obj->summary = $row['summary'];
    $show_obj->show_link = $row['series_link'];
    array_push($shows, $show_obj);
}

foreach ($shows as $show) {
    echo "<tr class=\"expandable-table-row\">
<td>{$show->id}</td>
<td>{$show->title}</td>
<td>{$show->released}</td>
</tr>
<tr class=\"expandable-table-extra\">
<td colspan=\"3\">
    <div class=\"details-container\">
        <div class=\"details\">
            <table class=\"table details-table\">
                <tbody>
                    <tr>
                        <td><strong>Created by</strong></td>
                        <td class=\"field-creator\">{$show->creator}</td>
                    </tr>
                    <tr>
                        <td><strong>Genre</strong></td>
                        <td class=\"field-genre\">{$show->genre}</td>
                    </tr>
                    <tr>
                        <td><strong>Language</strong></td>
                        <td class=\"field-language\">{$show->language}</td>
                    </tr>
                    <tr>
                        <td><strong>Seasons data string</strong></td>
                        <td style=\"white-space: normal; max-width: 90%;\" class=\"field-seasons\">{$show->seasons}</td>
                    </tr>
                    <tr>
                        <td><strong>Summary</strong></td>
                        <td style=\"white-space: normal; max-width: 90%;\" class=\"field-summary\">{$show->summary}</td>
                    </tr>
                    <tr>
                        <td><strong>YouTube ID</strong></td>
                        <td class=\"field-link\">{$show->show_link}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <button type=\"button\" class=\"btn btn-info admin-edit\" id-data=\"show-{$show->id}\" item-data=\"{$show->title}\">Edit</button>
                        </td>
                        <td>
                            <button type=\"button\" class=\"btn btn-danger admin-delete\" id-data=\"show-{$show->id}\" item-data=\"{$show->title}\">Delete</button>
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