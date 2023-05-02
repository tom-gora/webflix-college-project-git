$(document).ready(function () {
  $.ajax({
    url: "includes/get_movies.php",
    type: "POST",
    dataType: "text",
    success: function (data) {
      $.ajax({
        url: "includes/get_tmdb_data.php",
        dataType: "json",
        success: function (tmdb_data) {
          $tmdbKey = tmdb_data.tmdb_key;
          $tmdbApiMovieUrl = tmdb_data.tmdb_api_movie_url;
          $tmdbApiTvUrl = tmdb_data.tmdb_api_tv_url;
          $tmdbImgUrl = tmdb_data.tmdb_img_url;

          function getMoviePath(title, callback) {
            $.getJSON(
              $tmdbApiMovieUrl + $tmdbKey + "a&query=" + title + "&callback=?",
              function (json) {
                var path = $tmdbImgUrl + json.results[0].poster_path;
                callback(title, path);
              }
            );
            // return path;
          }
          $moviesContainer = $("#movies-container");
          $json = JSON.parse(data);
          for (var $i = 0; $i < $json.length; $i++) {
            (function () {
              var $id = $json[$i].id;
              var $title = $json[$i].title;
              var $summary = $json[$i].summary;
              var $movie_page = "webflix_movie.php?id=" + $id;
              getMoviePath($title, function (title, path) {
                var $cardHtml =
                  '<div class="col-md-3"><div class="card show-card" style = "width: 16rem !important; overflow: hidden !important;" ><a class="card-link" href="' +
                  $movie_page +
                  '"><img src="' +
                  path +
                  '" class="card-img-top"></a><button class="btn btn-dark watch-btn-card" onClick="window.location.href=\'' +
                  $movie_page +
                  '\'">WATCH NOW <i class="fa fa-play-circle" aria-hidden="true"></i></button><div class="card-body"><a class="card-link" href="' +
                  $movie_page +
                  '"><h4 class="card-title-movie" style="margin-top: 35px;">' +
                  title +
                  '</h4></a><p class="card-text">' +
                  $summary +
                  "</p></div></div></div>";
                $moviesContainer.append($cardHtml);
              });
            })();
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error: " + textStatus + " - " + errorThrown);
        },
      });
    },
  });
});
