$(document).ready(function ($) {
  $.ajax({
    url: "includes/get_tmdb_data.php",
    dataType: "json",
    success: function (data) {
      $tmdbKey = data.tmdb_key;
      $tmdbApiMovieUrl = data.tmdb_api_movie_url;
      $tmdbApiTvUrl = data.tmdb_api_tv_url;
      $tmdbImgUrl = data.tmdb_img_url;

      // functions getting poster links adapted from https://codepen.io/pixelnik/pen/pgWQBZ
      function getMoviePath(title, callback) {
        var path;
        $.getJSON(
          $tmdbApiMovieUrl + $tmdbKey + "a&query=" + title + "&callback=?",
          function (json) {
            path = $tmdbImgUrl + json.results[0].poster_path;
            callback(path);
          }
        );
      }
      function getTVPath(title, callback) {
        var path;
        $.getJSON(
          $tmdbApiTvUrl + $tmdbKey + "a&query=" + title + "&callback=?",
          function (json) {
            path = $tmdbImgUrl + json.results[0].poster_path;
            callback(path);
          }
        );
      }

      // initialize the slider plus config
      $(".card-slider").slick({
        dots: false,
        infinite: true,
        speed: 800,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        responsive: [
          {
            breakpoint: 1500,
            settings: {
              slidesToShow: 4,
            },
          },
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 700,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });

      // ajax call for 2 arrays of 8 random movies and 8 random shows from the DB
      $.ajax({
        type: "POST",
        url: "includes/webflix_get_data_for_sliders.php",
        dataType: "text",
        contentType: "application/json; charset=utf-8",
        success: function (response) {
          //parse my text string as json encoded by php script. not sure why dataType json is not working here ?
          data = jQuery.parseJSON(response);
          movies = data.m_arr;
          shows = data.s_arr;
          // write content into each card based on its index attribute
          $(".movie-card").each(function () {
            cardIndex = $(this).attr("card-index");
            cardTile = movies[cardIndex].title;
            cardSummary = movies[cardIndex].summary;
            cardButtonLink =
              "window.location.href='webflix_movie.php?id=" +
              movies[cardIndex].id +
              "'";
            cardLink = "webflix_movie.php?id=" + movies[cardIndex].id;
            $(this).find(".card-title-movie").text(cardTile);
            $(this).find(".card-text").text(cardSummary);
            $(this).find(".watch-btn-card").attr("onclick", cardButtonLink);
            $(this).find(".card-link").attr("href", cardLink);
            getMoviePath(
              cardTile,
              function (path) {
                $(this).find(".card-img-top").attr("src", path);
              }.bind(this)
            );
          });
          // write content into each card based on its index attribute
          $(".show-card").each(function () {
            cardIndex = $(this).attr("card-index");
            cardTile = shows[cardIndex].title;
            cardSummary = shows[cardIndex].summary;
            cardButtonLink =
              "window.location.href='webflix_show.php?id=" +
              shows[cardIndex].id +
              "'";
            cardLink = "webflix_show.php?id=" + shows[cardIndex].id;
            $(this).find(".card-title-movie").text(cardTile);
            $(this).find(".card-text").text(cardSummary);
            $(this).find(".watch-btn-card").attr("onclick", cardButtonLink);
            $(this).find(".card-link").attr("href", cardLink);
            getTVPath(
              cardTile,
              function (path) {
                $(this).find(".card-img-top").attr("src", path);
              }.bind(this)
            );
          });
        },
        error: function (req, err) {
          console.log(err);
        },
      });
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("Error: " + textStatus + " - " + errorThrown);
    },
  });
});
