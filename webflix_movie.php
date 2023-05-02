<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>WebFlix-
    <?php require('includes/connect_db.php');
    $movie_id = $_GET['id'];
    $qtitle = "SELECT title from webflix_movies WHERE movie_id = $movie_id";
    $stmt = $link->prepare($qtitle);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = mysqli_fetch_array($res);
    echo $row['title'];
    mysqli_close($link); ?>
  </title>
  <link rel="icon" type="image/x-icon" href="resources/favicon.png">
  <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, shrink-to-fit=no"
    charset="utf-8">

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
    integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
    crossorigin="anonymous"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script src="https://www.youtube.com/iframe_api"></script>

  <script type="text/javascript" src="js/webflix_movie_page_handler.js"></script>

  <!--CSS -->
  <link href="css/StyleSheet.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- additional external font libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">

</head>

<body style="overflow: hidden !important;">

  <?php include 'includes/top_bar.php' ?>
  <?php include 'includes/bottom_bar.html' ?>

  <?php include 'includes/common_modals.php' ?>

  <div class="container" style="max-width: 1440px; position: relative;">
    <!-- src https://codepen.io/vaibhav-khating/pen/Vwdqzbm -->
    <section class="vid-section">
      <video src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4" poster=""
        id="blurred"></video>
      <div class="movie-container container show-controls">
        <div class="placeholder-info">
          <h2>THIS IS A PLACEHOLDER VIDEO STANDING IN FOR REAL CONTENT</h2><br>
          <p style="font-size: 12px;">Tears of Steel was realized with crowd-funding by users of the open source 3D
            creation tool Blender.</p>
        </div>
        <div class="wrapper">
          <div class="video-timeline">
            <div class="progress-area">
              <span>00:00</span>
              <div class="progress-bar"></div>
            </div>
          </div>
          <ul class="video-controls">
            <li class="options left">
              <button class="volume"><i class="fa-solid fa-volume-high"></i></button>
              <input type="range" min="0" max="1" step="any">
              <div class="video-timer">
                <p class="current-time">00:00</p>
                <p class="separator"> / </p>
                <p class="video-duration">00:00</p>
              </div>
            </li>
            <li class="options center">
              <button class="skip-backward"><i class="fas fa-backward"></i></button>
              <button class="play-pause"><i class="fas fa-play"></i></button>
              <button class="skip-forward"><i class="fas fa-forward"></i></button>
            </li>
            <li class="options right">

              <button class="fullscreen"><i class="fa-solid fa-expand"></i></button>
            </li>
          </ul>
        </div>
        <video src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4"
          poster=""></video>
      </div>
    </section>
    <section class="vid-section-yt">
      <div class="movie-container">
        <iframe class="embed-player" style src="" allow="autoplay" frameborder="0" id="youtube-video"></iframe>
      </div>
    </section>
    <?php include('includes/webflix_movie_data.php'); ?>
  </div>
  <button class="expand-button"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button>

  <!-- Review modal -->
  <div class="modal" id="reviewModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" class="mr-auto">Leave a review</h2>
        </div>
        <div class="modal-body" style="padding-bottom: 0 !important;">

          <!-- source for a template https://bootsnipp.com/snippets/WaXlr -->
          <div class="form-group" id="rating-ability-wrapper">
            <label class="control-label" for="rating">
              <span class="field-label-info"></span>
              <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
            </label>
            <h2 class="bold rating-header" style="">
              <span class="selected-rating">0</span><small> / 5</small>
            </h2>
            <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
              <i class="fa fa-star" aria-hidden="true"></i>
            </button>
            <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
              <i class="fa fa-star" aria-hidden="true"></i>
            </button>
            <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
              <i class="fa fa-star" aria-hidden="true"></i>
            </button>
            <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
              <i class="fa fa-star" aria-hidden="true"></i>
            </button>
            <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
              <i class="fa fa-star" aria-hidden="true"></i>
            </button>
          </div>

          <div class="form-group">
            <label for="reviewTextArea">
              <?php require('includes/connect_db.php');
              $movie_id = $_GET['id'];
              $qtitle = "SELECT title from webflix_movies WHERE movie_id = $movie_id";
              $stmt = $link->prepare($qtitle);
              $stmt->execute();
              $res = $stmt->get_result();
              $row = mysqli_fetch_array($res);
              echo 'Your opinion on ' . $row['title'] . ':';
              mysqli_close($link); ?>
            </label>
            <textarea class="form-control" id="reviewTextArea" rows="4" maxlength="250"
              style=" width: 300px; margin: auto;"></textarea>

            <p><small class="form-text reviewPrompt" style="display:none; color:#FF6464"> Rating and review text
                required.</small></p><br>

            <button type="submit" class="btn btn-dark btn-lg btn-block modal-submit" id="reviewSubmit"
              style="margin-top: 20px;">Submit your review</button>
          </div>
        </div>
        <div class="modal-footer" style="padding-top: 0 !important;">
          <button type="submit" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>