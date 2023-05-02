$(document).ready(function () {
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

    // console.log(movie_id);
    // console.log(rev_txt);
    // console.log(selected_value);

    // ajax  request handling passing the data to php script
    request = $.ajax({
      url: "./includes/sql_store_review.php",
      type: "POST",
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
          $(".reviewPrompt").css("display", "inline");
          $("#reviewSubmit").click(function (event) {
            event.stopPropagation();
          });
          // if enything else goes wrong redirect and err out in console
        } else {
          // window.location.href='login.php';
          console.log(response);
          console.log(rev_txt);
          console.log("Could not complete review writing process!");
        }
      },
      error: function () {
        console.log('Fail"!');
      },
    });
    // }
  });
});
