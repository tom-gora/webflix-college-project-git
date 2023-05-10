<?php

$show_id = $_GET['id'];

class Review
{
  public $txt;
  public $rat;
  public $name;
}

$title;
$created_by;
$genre;
$release_date;
$language;
$summary;
$suggestion;
$review_text;
$rating;
$first_name;

$seasons_arr = array();
$reviews_arr = array();

require('connect_db.php');
$q1 = "SELECT title, created_by, genre, release_date, language, summary, series_link, (SELECT CONCAT_WS('|', series_id, title) FROM webflix_series WHERE series_id != $show_id ORDER BY RAND() LIMIT 1) AS suggestion FROM webflix_series WHERE series_id = $show_id;";
$stmt = $link->prepare($q1);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
  $title = $row['title'];
  $created_by = $row['created_by'];
  $genre = $row['genre'];
  $date_format_str = date_create_immutable_from_format('Y-m-d', $row['release_date']);
  $release_date = date_format($date_format_str, 'j F Y');
  $language = $row['language'];
  $summary = $row['summary'];
  $trailer_link = $row['series_link'];
  $suggestion_str = $row['suggestion'];
  $suggestion_parts = explode('|', $suggestion_str);
  $suggestion_id = $suggestion_parts[0];
  $suggestion = $suggestion_parts[1];

}

$q2 = "SELECT AVG(rating) AS average FROM `webflix_series_review_dump` WHERE series_id = $show_id";
$stmt = $link->prepare($q2);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
  $average = number_format($row['average'], 2);
}

$q3 = "SELECT r.review_text, r.rating, COALESCE(u.first_name, 'Deleted User') as first_name 
FROM webflix_series_review_dump r 
LEFT JOIN users u ON r.user_id = u.user_id 
WHERE r.series_id = $show_id";
$stmt = $link->prepare($q3);
$stmt->execute();
$res = $stmt->get_result();

while ($row = mysqli_fetch_array($res)) {
  $review_text = $row['review_text'];
  $rating = (int) $row['rating'];
  $first_name = $row['first_name'];

  $review_obj = new Review();
  $review_obj->txt = $review_text;
  $review_obj->rat = $rating;
  $review_obj->name = $first_name;

  array_push($reviews_arr, $review_obj);
}

echo '<section class="content-overlay" trailer-data="';
echo $trailer_link;
echo '">
        <div class="overlay-poster" >
        <img class="overlay-img" src="">
        </div>
        <div class="overlay-info">
            <!-- src https://codepen.io/aris_k/pen/eYLVOeq -->
            <div id="card-container" data-offset="2">
           <div class="text-block">
           <h1 class="title">';
echo $title;
echo '</h1>
           <h4 class="director"><small><strong>';
echo $created_by;
echo '</strong></small></h5>
           <h6 class="language">Language: ';
echo $language;
echo '</h6>
           <h6 class="release"><small>Released: ';
echo $release_date;
echo '</small></h6>
           <h6 class="genre">';
echo $genre;
echo '</h6>
           <span class="product-rating" value="';
echo $average;
echo '">
            <div class="rating-cover"></div>
           <i class="fa fa-star" aria-hidden="true"></i>
           <i class="fa fa-star" aria-hidden="true"></i>
           <i class="fa fa-star" aria-hidden="true"></i>
           <i class="fa fa-star" aria-hidden="true"></i>
           <i class="fa fa-star" aria-hidden="true"></i>
           </span><br>
          <p class="summary">';
echo $summary;
echo '</p>
          <button class="btn movieCardButton overlay-play-btn">WATCH</button>
          <button class="btn movieCardButton overlay-sub-btn" style="display:none;">Subscribe for access</button>
          <br>
          <!-- src https://codepen.io/scriptax/pen/WNyJGqM -->
          <div class="episode_picker">
          
            <button class="list_btn">Choose season: </button>
            <span class="button_arrow"></span>
            <button class="reset-seasons"><i class="fa fa-times" aria-hidden="true"></i></button>
            <div class="option_container">
              <label class="option_field">
                <input class="list_option" type="radio" name="list" title="1">1</label>
              <label class="option_field">
                <input class="list_option" type="radio" name="list" title="2">2</label>
              <label class="option_field">
                <input class="list_option" type="radio" name="list" title="3">3</label>
              <label class="option_field">
                <input class="list_option" type="radio" name="list" title="4">4</label>
              <label class="option_field">
                <input class="list_option" type="radio" name="list" title="5">5</label>
              <label class="option_field">
                <input class="list_option" type="radio" name="list" title="6">6</label>
            </div>
          </div>
        </div>
        </div>
        <img class="overlay-background" src="">   
        <div class="watch-next">
        <h5>You might like:</h5><a href="webflix_show.php?id=';
echo $suggestion_id;
echo '"><img class="suggestion" src="" title="';
echo $suggestion;
echo '"></a></div>
        <div class="reviews">
        <h5>Reviews:</h5>
        <div class="overlay-carousel">';
if (count($reviews_arr) > 0) {
  foreach ($reviews_arr as $review) {
    echo '<div class="review-slide-wrapper"><p><strong>';
    echo $review->name;
    echo '</strong></p>
                          <span class="product-rating">';
    for ($r = 0; $r < $review->rat; $r++) {
      echo '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    echo '</span><br><p>';
    echo $review->txt;
    echo '</p></div>';
  }
} else {
  echo '<div class="review-slide-wrapper"><p><strong>No reviews yet...</strong></p></div>';
}
echo '</div></div><br>
        <a class="btn movieCardButton overlay-review-btn" onClick="$(\'#reviewModal\').modal(\'show\');">LEAVE A REVIEW</a>
        </div></div></section>';

mysqli_close($link);

?>