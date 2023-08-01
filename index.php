<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>WebFlix - Watch anything!</title>
  <link rel="icon" type="image/x-icon" href="resources/favicon.png">
  <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

  <script type="text/javascript" src="js/logged_out.js"></script>
  <script type="text/javascript" src="js/deleted.js"></script>
  <script type="text/javascript" src="js/trailer_slider.js"></script>
  <script type="text/javascript" src="js/webflix_get_sliders_data.js"></script>
  <script src="https://www.youtube.com/iframe_api"></script>


  <!--CSS -->
  <link href="css/StyleSheet.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- additional external font libraries -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">

</head>

<body>

  <?php include 'includes/top_bar.php' ?>

  <?php include 'includes/bottom_bar.html' ?>

  <?php include 'includes/common_modals.php' ?>

  <!-- Deleted modal -->
  <div class="modal" id="goodbyeModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" class="mr-auto">Your account has been deleted.</h2>
        </div>
        <div class="modal-body">
          <p>Goodbye!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn movieCardButton overlay-play-btn" class="close" data-dismiss="modal" aria-label="Close" ">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- trailer slider adapted from this public code https://codepen.io/digistate/pen/MvapbE -->
  <div class=" main-slider">
            <?php require_once 'includes/webflix_get_trailers_links.php' ?>
        </div>

        <!-- print card sliders with a script -->
        <div class="sliders-container">
          <?php require_once 'includes/webflix_print_sliders.php' ?>
        </div>
        <?php include 'includes/footer.html' ?>

</body>

</html>
