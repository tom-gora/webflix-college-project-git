<?php
require "connect_db.php";

if (isset($_POST['query'])) {
  $search_term = mysqli_real_escape_string($link, $_POST['query']);
  $query = "(SELECT series_id AS id, title, 'show' AS type
      FROM webflix_series
      WHERE title LIKE '%$search_term%'
      LIMIT 5)
      UNION
      (SELECT movie_id AS id, title, 'movie' AS type
      FROM webflix_movies
      WHERE title LIKE '%$search_term%'
      LIMIT 5);";
  $result = mysqli_query($link, $query);
  if (mysqli_num_rows($result) > 0) {
    // if cound results build a table of suggested titles with a while loop
    echo '<ul class="list-group" id="suggestion-box">';
    while ($res = mysqli_fetch_array($result)) {
      $escaped_title = htmlspecialchars($res['title'], ENT_QUOTES, 'UTF-8');
      echo '<li class="list-group-item search-suggestion" resultid="' . $res['id'] . '" resulttype="' . $res['type'] . '" tabindex="0">' . $escaped_title . '</li>';
    }
    echo '</ul>';
  } else if (mysqli_num_rows($result) == 0) {
    // if no results send a 1 element list as an element prompting user there is no suggestions
    echo '<ul class="list-group" id="suggestion-box">
      <li class="list-group-item search-suggestion" id="search_null">No suggestions</li>';
  }
}
?>