$(document).ready(function () {
  $.ajax({
    url: "includes/get_tmdb_data.php",
    dataType: "json",
    success: function (data) {
      $tmdbKey = data.tmdb_key;
      $tmdbApiMovieUrl = data.tmdb_api_movie_url;
      $tmdbApiTvUrl = data.tmdb_api_tv_url;
      $tmdbImgUrl = data.tmdb_img_url;

      // carousel initialization for  posted reviews
      $(".overlay-carousel").slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
        variableWidth: true,
        adaptiveHeight: true,
        arrows: false,
        cssEase: "ease-out",
      });

      // handling overlays and their elements

      // vars for the added overlay
      $playButton = $(".overlay-play-btn");
      $subButton = $(".overlay-sub-btn");
      $revButton = $(".overlay-review-btn");
      $overlayRight = $(".overlay-info");
      $overlayLeft = $(".overlay-poster");
      $expandButton = $(".expand-button");
      $player = $(".vid-section video");
      $placeholder = $(".placeholder-info");
      $rating = $(".text-block .product-rating").attr("value");
      // $rating = 4.5;
      $fraction = (5 - $rating) / 5;
      $hideRight = $(".rating-cover");
      $starsWidth = $(".product-rating").width();
      $widthToHide = $starsWidth * $fraction + 2;
      // console.log($rating);
      $hideRight.css("width", $widthToHide);

      $.ajax({
        url: "./includes/get_user_data.php",
        dataType: "text",
        contentType: "application/json; charset=utf-8",
        success: function (response) {
          // function that replaces content with a youtube trailer
          function cut_shows_off() {
            $(".vid-section").hide();
            $(".vid-section-yt").show();
            $(".content-overlay").show();
            $(".episode_picker").hide();
            $subButton.show();
            $playButton.text("Watch trailer");
            $revButton.hide();

            $link_data = $(".content-overlay").attr("trailer-data");
            $trailer_link =
              "https://www.youtube-nocookie.com/embed/" +
              $link_data +
              "?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&start=1&mute=0";
            $("#youtube-video").attr("src", $trailer_link);

            $playButton.on("click", function () {
              $overlayLeft.animate({ left: "200%" }, 500, function () {
                // Slide bottom overlay behind top overlay
                $overlayRight.animate({ left: "200%" }, 500);

                setTimeout(function () {
                  $("#youtube-video")[0].contentWindow.postMessage(
                    '{"event":"command","func":"' +
                      "playVideo" +
                      '","args":""}',
                    "*"
                  );
                }, 500);
                $expandButton.delay(500).fadeIn();
              });
            });

            $expandButton.on("click", function () {
              $("#youtube-video")[0].contentWindow.postMessage(
                '{"event":"command","func":"' + "pauseVideo" + '","args":""}',
                "*"
              );
              $overlayRight.animate({ left: "29%" }, 500, function () {
                // Slide bottom overlay behind top overlay
                $overlayLeft.animate({ left: 0 }, 500);
                $expandButton.delay(500).fadeOut();
                $playButton.text("RESUME");
              });
            });
          }

          // if not logged in
          if (response == "no-login") {
            cut_shows_off();
            $subButton.on("click", function () {
              $("#registerModal").modal("show");
            });
          } else {
            //if logged in == received user json data
            $user = JSON.parse(response);

            //if user subscribed to TV plan cut off movies
            if ($user.sub_type == "m2" || $user.sub_type == "y2") {
              cut_shows_off();
              $subButton.text("Change your plan");
              $subButton.on("click", function () {
                window.location.href = "subscribe.php";
              });
            } else {
              // on other plans allow shows
              $(".vid-section-yt").hide();
              $playButton.text("WATCH NOW");

              $playButton.on("click", function () {
                $overlayLeft.animate({ left: "200%" }, 500, function () {
                  // Slide bottom overlay behind top overlay
                  $overlayRight.animate({ left: "200%" }, 500);

                  setTimeout(function () {
                    $player.trigger("play");
                  }, 500);
                  $expandButton.delay(500).fadeIn();
                  $placeholder.delay(500).fadeIn();
                });
              });

              $expandButton.on("click", function () {
                $player.trigger("pause");
                $placeholder.fadeOut();
                $overlayRight.animate({ left: "29%" }, 500, function () {
                  // Slide bottom overlay behind top overlay
                  $overlayLeft.animate({ left: 0 }, 500);
                  $expandButton.delay(500).fadeOut();
                  $playButton.text("RESUME");
                });
              });

              // handling the player for the main video
              const container = document.querySelector(".movie-container"),
                blurvid = document.querySelector("video"),
                mainVideo = container.querySelector("video"),
                videoTimeline = container.querySelector(".video-timeline"),
                progressBar = container.querySelector(".progress-bar"),
                volumeBtn = container.querySelector(".volume i"),
                volumeSlider = container.querySelector(".left input");
              (currentVidTime = container.querySelector(".current-time")),
                (videoDuration = container.querySelector(".video-duration")),
                (skipBackward = container.querySelector(".skip-backward i")),
                (skipForward = container.querySelector(".skip-forward i")),
                (playPauseBtn = container.querySelector(".play-pause i")),
                (fullScreenBtn = container.querySelector(".fullscreen i"));
              let timer;

              const hideControls = () => {
                if (mainVideo.paused) return;
                timer = setTimeout(() => {
                  container.classList.remove("show-controls");
                }, 3000);
              };
              hideControls();
              blurvid.volume = 0;
              container.addEventListener("mousemove", () => {
                container.classList.add("show-controls");
                clearTimeout(timer);
                hideControls();
              });

              const formatTime = (time) => {
                let seconds = Math.floor(time % 60),
                  minutes = Math.floor(time / 60) % 60,
                  hours = Math.floor(time / 3600);

                seconds = seconds < 10 ? `0${seconds}` : seconds;
                minutes = minutes < 10 ? `0${minutes}` : minutes;
                hours = hours < 10 ? `0${hours}` : hours;

                if (hours == 0) {
                  return `${minutes}:${seconds}`;
                }
                return `${hours}:${minutes}:${seconds}`;
              };

              videoTimeline.addEventListener("mousemove", (e) => {
                let timelineWidth = videoTimeline.clientWidth;
                let offsetX = e.offsetX;
                let percent = Math.floor(
                  (offsetX / timelineWidth) * mainVideo.duration
                );
                const progressTime = videoTimeline.querySelector("span");
                offsetX =
                  offsetX < 20
                    ? 20
                    : offsetX > timelineWidth - 20
                    ? timelineWidth - 20
                    : offsetX;
                progressTime.style.left = `${offsetX}px`;
                progressTime.innerText = formatTime(percent);
              });

              videoTimeline.addEventListener("click", (e) => {
                let timelineWidth = videoTimeline.clientWidth;
                mainVideo.currentTime =
                  (e.offsetX / timelineWidth) * mainVideo.duration;
                blurvid.currentTime =
                  (e.offsetX / timelineWidth) * mainVideo.duration;
              });

              mainVideo.addEventListener("timeupdate", (e) => {
                let { currentTime, duration } = e.target;
                let percent = (currentTime / duration) * 100;
                progressBar.style.width = `${percent}%`;
                currentVidTime.innerText = formatTime(currentTime);
              });

              mainVideo.addEventListener("loadeddata", () => {
                videoDuration.innerText = formatTime(mainVideo.duration);
              });

              const draggableProgressBar = (e) => {
                let timelineWidth = videoTimeline.clientWidth;
                progressBar.style.width = `${e.offsetX}px`;
                mainVideo.currentTime =
                  (e.offsetX / timelineWidth) * mainVideo.duration;
                blurvid.currentTime =
                  (e.offsetX / timelineWidth) * mainVideo.duration;
                currentVidTime.innerText = formatTime(mainVideo.currentTime);
              };

              volumeBtn.addEventListener("click", () => {
                if (!volumeBtn.classList.contains("fa-volume-high")) {
                  mainVideo.volume = 0.5;
                  volumeBtn.classList.replace(
                    "fa-volume-xmark",
                    "fa-volume-high"
                  );
                } else {
                  mainVideo.volume = 0.0;
                  volumeBtn.classList.replace(
                    "fa-volume-high",
                    "fa-volume-xmark"
                  );
                }
                volumeSlider.value = mainVideo.volume;
              });

              volumeSlider.addEventListener("input", (e) => {
                mainVideo.volume = e.target.value;
                if (e.target.value == 0) {
                  return volumeBtn.classList.replace(
                    "fa-volume-high",
                    "fa-volume-xmark"
                  );
                }
                volumeBtn.classList.replace(
                  "fa-volume-xmark",
                  "fa-volume-high"
                );
              });
              fullScreenBtn.addEventListener("click", () => {
                container.classList.toggle("fullscreen");
                if (document.fullscreenElement) {
                  fullScreenBtn.classList.replace("fa-compress", "fa-expand");
                  return document.exitFullscreen();
                }
                fullScreenBtn.classList.replace("fa-expand", "fa-compress");
                container.requestFullscreen();
              });

              skipBackward.addEventListener("click", () => {
                mainVideo.currentTime -= 5;
                blurvid.currentTime -= 5;
              });
              skipForward.addEventListener("click", () => {
                mainVideo.currentTime += 5;
                blurvid.currentTime += 5;
              });
              mainVideo.addEventListener("play", () =>
                playPauseBtn.classList.replace("fa-play", "fa-pause")
              );
              mainVideo.addEventListener("pause", () =>
                playPauseBtn.classList.replace("fa-pause", "fa-play")
              );
              playPauseBtn.addEventListener("click", () => {
                mainVideo.paused ? mainVideo.play() : mainVideo.pause();
                blurvid.paused ? blurvid.play() : blurvid.pause();
              });
              videoTimeline.addEventListener("mousedown", () =>
                videoTimeline.addEventListener(
                  "mousemove",
                  draggableProgressBar
                )
              );
              document.addEventListener("mouseup", () =>
                videoTimeline.removeEventListener(
                  "mousemove",
                  draggableProgressBar
                )
              );
            }
          }

          //getting posters and backdrop
          function getTVPaths(title, s_title, callback) {
            var posterPath;
            var backdropPath;
            var suggestionPath;
            $.getJSON(
              $tmdbApiTvUrl + $tmdbKey + "a&query=" + title + "&callback=?",
              function (json) {
                posterPath = $tmdbImgUrl + json.results[0].poster_path;
                backdropPath = $tmdbImgUrl + json.results[0].backdrop_path;
                callback(posterPath, backdropPath, suggestionPath);
              }
            );
            $.getJSON(
              $tmdbApiTvUrl + $tmdbKey + "a&query=" + s_title + "&callback=?",
              function (json) {
                suggestionPath = $tmdbImgUrl + json.results[0].poster_path;
                callback(posterPath, backdropPath, suggestionPath);
              }
            );
          }
          // and putting them in place
          $mainTitle = $(".title").text();
          $suggestionTitle = $(".suggestion").attr("title");
          getTVPaths(
            $mainTitle,
            $suggestionTitle,
            function (posterPath, backdropPath, suggestionPath) {
              $(".overlay-img").attr("src", posterPath);
              $(".overlay-background").attr("src", posterPath);
              $(".suggestion").attr("src", suggestionPath);
              $("video").attr("poster", backdropPath);
            }.bind(this)
          );

          // handling rating and reviews
          var selected_value;
          $(".btnrating").on("click", function (e) {
            var previous_value = $("#selected_rating").val();

            selected_value = $(this).attr("data-attr");
            $("#selected_rating").val(selected_value);

            $(".selected-rating").empty();
            $(".selected-rating").html(selected_value);

            for (i = 1; i <= selected_value; ++i) {
              $("#rating-star-" + i).toggleClass("btn-warning");
              $("#rating-star-" + i).toggleClass("btn-default");
            }

            for (ix = 1; ix <= previous_value; ++ix) {
              $("#rating-star-" + ix).toggleClass("btn-warning");
              $("#rating-star-" + ix).toggleClass("btn-default");
            }
          });

          $("#reviewModal").on("hidden.bs.modal", function () {
            $(".reviewPrompt").hide();
          });

          $("#reviewSubmit").click(function (event) {
            event.preventDefault();

            urlParams = new URLSearchParams(window.location.search);
            movie_id = urlParams.get("id");

            rev_txt = $("#reviewTextArea").val();

            // ajax  request handling passing the data to php script
            request = $.ajax({
              url: "./includes/webflix_store_show_review.php",
              type: "POST",
              dataType: "text",
              data: { id: movie_id, txt: rev_txt, stars: selected_value },

              success: function (response) {
                // if php successfully stored into db and returned 'true'
                if ($.trim(response) == "true") {
                  //print alert to the console
                  console.log("Success!");
                  $("#reviewModal").modal("hide");
                  window.location.reload();

                  // handling if php says it hasn't reveived ratinjg score and/or review text.
                  // reveal prompt make submit unclickable for the time until ajax receives a 'true' response from php script
                } else if ($.trim(response) == "null_rev") {
                  $(".reviewPrompt").fadeIn(500);
                  $("#reviewSubmit").click(function (event) {
                    event.stopPropagation();
                    console.log(response);
                  });
                  // if enything else goes wrong redirect and err out in console
                } else {
                  $(".reviewPrompt").text(
                    "You need to be logged in to do that!"
                  );
                  $(".reviewPrompt").fadeIn(500);

                  // window.location.href='login.php';
                  console.log(response);
                  console.log("Could not complete review writing process!");
                }
              },
              error: function () {
                console.log('Fail"!');
              },
            });
            // }
          });

          // handle episode picker

          urlParams = new URLSearchParams(window.location.search);
          showId = urlParams.get("id");

          // Make the AJAX request
          $.ajax({
            type: "GET",
            url: "includes/webflix_show_seasons.php",
            data: { id: showId },
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (response) {
              data = jQuery.parseJSON(response);

              var episodesBySeason = [];

              for (var season in data) {
                var seasonEpisodes = [];

                for (var i = 1; i <= data[season]; i++) {
                  seasonEpisodes.push("E 0" + i);
                }

                episodesBySeason.push([season].concat(seasonEpisodes));
              }

              // console.log(episodesBySeason);

              function generateSeasons(seasons) {
                var optionsHtml = "";
                for (var i = 0; i < seasons.length; i++) {
                  optionsHtml += '<label class="option_field">';
                  optionsHtml +=
                    '<input class="list_option season-option" type="radio" name="list" title="' +
                    seasons[i][0] +
                    '">' +
                    seasons[i][0];
                  optionsHtml += "</label>";
                }
                return optionsHtml;
              }

              function generateEpisodes(seasons) {
                var selectedSeason = parseInt(
                  $(".list_option:checked").attr("title").split(" ")[1]
                );
                var episodes = seasons[selectedSeason - 1].slice(1);
                var optionsHtml = "";
                for (var i = 0; i < episodes.length; i++) {
                  optionsHtml += '<label class="option_field">';
                  optionsHtml +=
                    '<input class="list_option episode-option" type="radio" name="list" title="' +
                    episodes[i] +
                    '">' +
                    episodes[i];
                  optionsHtml += "</label>";
                }
                return optionsHtml;
              }

              var dropdownPicker = document.querySelector(
                ".episode_picker .option_container"
              );
              dropdownPicker.innerHTML = generateSeasons(episodesBySeason);

              $listBtn = $(".list_btn");
              $seasonsItems = $(".season-option");
              $greatReset = $(".reset-seasons");

              $(document).on("click", ".season-option", function () {
                var $selectedOption = $(this);
                var $selectedSeason = $selectedOption.attr("title");

                $greatReset.fadeIn(500);
                $listBtn.text("Choose episode:");
                dropdownPicker.innerHTML = generateEpisodes(episodesBySeason);

                $episodeItems = $(".episode-option"); // albo tu albo w poprzednim kliku

                $episodeItems.on("click", function () {
                  var $selectedOption = $(this);
                  var $selectedTitle = $selectedOption.attr("title");
                  $playButton.text("WATCH");
                  // console.log($selectedTitle);

                  $listBtn.text($selectedSeason + ": " + $selectedTitle);
                });
              });

              $(document).on("click", ".reset-seasons", function () {
                $listBtn.text("Choose season:");
                dropdownPicker.innerHTML = generateSeasons(episodesBySeason);
                $greatReset.fadeOut(500);
              });
            },
            error: function (req, err) {
              console.log(err);
            },
          });
        },
        error: function (response) {
          console.log(response);
        },
      });
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log("Error: " + textStatus + " - " + errorThrown);
    },
  });
});
