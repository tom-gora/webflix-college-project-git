$(document).ready(function () {
  $searchbar = $("#bottomnav");

  // tutorial used as basis for my code https://www.youtube.com/watch?v=8uaKa8M3bOg&t=650s

  function toggleSearchbar() {
    $($searchbar).slideToggle(500);
    $("#live_search").val("").focus();
    $("#search_result").css("display", "none");
  }

  $("#mainSearch").on("click", function () {
    toggleSearchbar();
  });

  $(".close-search").click(function (event) {
    event.preventDefault(); // prevent default event and exec own function
    $($searchbar).slideUp(500);
  });

  $("#live_search").keyup(function () {
    // function triggered as input being typed in

    var query = $(this).val(); // whatever in the input field gets stored as var, inf not empty trigger ajax call
    console.log(query);

    if (query != "") {
      $.ajax({
        url: "./includes/webflix_live_search.php",
        method: "POST",
        data: { query: query },
        success: function (data) {
          // if we receive results (id is not named null) print a resulting list returned from php
          // and show
          $("#search_result").html(data);
          $("#search_result").css("display", "block");

          // every time user refocuses in search box clear suggestions box
          // and set input box value to empty for user to start over
          $("#live_search").focusin(function () {
            $("#search_result").css("display", "none");
            this.value = "";
          });

          // handling clicking on any of the suggestions presented below box
          // any time a list element with class suggestion returned from php is clicked
          $(".search-suggestion").click(function () {
            var id = $(this).attr("resultid");
            var type = $(this).attr("resulttype");

            console.log(id);
            console.log(type);

            // only do something with the button if input field populated and stores the movie ID
            if (id != "" && type === "show") {
              // if ID could be extracted stick the number into href and open it
              // and movie.php will open corresponding movie based on url parameter
              window.location.replace("webflix_show.php?id=" + id);
            } else if (id != "" && type === "movie") {
              // if ID could be extracted stick the number into href and open it
              // and movie.php will open corresponding movie based on url parameter
              window.location.replace("webflix_movie.php?id=" + id);
            } else {
              $("#search_result").slideUp(500);
              $("#live_search").val("").focus();
            }
          });

          let $active = -1;
          $dropdownList = $("#suggestion-box");
          $dropdownItems = $dropdownList.children();

          $(document).on("keydown", function (e) {
            $dropdownItems = $dropdownList.children(); // tooki like way tooooooo long to figure out that children list needs refreshing on each keystroke
            console.log(e.key);
            if (e.keyCode == 40) {
              // down
              e.preventDefault(); // stop scrolling!
              if ($active < $dropdownList.children().length - 1) {
                $active++;
                highlightDropdownItem($active);
              }
            } else if (e.keyCode == 38) {
              // up
              e.preventDefault(); // stop scrolling!
              if ($active > 0) {
                $active--;
                highlightDropdownItem($active);
              }
            } else if (e.keyCode == 13) {
              // enter
              if ($active >= 0 && $active < $dropdownList.children().length) {
                $dropdownItems.eq($active).trigger("click");
              }
            } else if (e.keyCode == 27) {
              //f
              $("#live_search").val("").focus();
              $("#search_result").css("display", "none");
            } else if (e.keyCode == 8) {
              //f
              $("#live_search").focus();
            }
          });

          function highlightDropdownItem(index) {
            $dropdownItems.removeClass("active");
            $dropdownItems.eq(index).addClass("active").focus();
          }
        },
      });
    } else {
      $("#search_result").css("display", "none");
    }
  });
});
