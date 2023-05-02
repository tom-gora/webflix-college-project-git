$(document).ready(function () {
  $original_card1_text =
    "Looking for the ultimate way to binge-watch your favorite TV shows? Look no further than our Bingemaster! subscription plan! With this plan, you'll get access to an extensive library of top-rated TV series, from classic sitcoms to the latest dramas.<br><br>No more scrolling through endless titles to find the perfect show to watch our curated selection makes it easy to find your next obsession. Plus, with new episodes and seasons added regularly, you'll always have something new to discover.<br><br>Sign up now and start streaming your favorite TV series today.";
  $original_card2_text =
    "Get ready for movie night like never before with our Film buff! subscription plan! With this plan, you'll get access to a massive library of blockbuster hits, indie favorites, and everything in between.<br><br>From the latest releases to classic favorites, our curated selection of movies has something for everyone. And with new titles added regularly, you'll always have something new to watch.<br><br>Sign up now and start streaming your favorite movies today.";
  $original_card3_text =
    "Looking for the ultimate streaming experience? Our all-inclusive subscription plan for cinematic omnivores has got you covered! With the Omnivore! you'll get access to our entire library of top-rated TV series and movies, all in one place.<br><br>From classic sitcoms to the latest blockbusters, our curated selection of titles makes it easy to find your next favorite show or movie. And with new titles added regularly, there's always something new to discover.<br><br>Sign up now and start streaming your favorite TV series and movies today.";

  $("#card-1-col .card-text").html($original_card1_text);
  $("#card-2-col .card-text").html($original_card2_text);
  $("#card-3-col .card-text").html($original_card3_text);

  $header_top = $("#header-line1");
  $header_bottom = $("#header-line2");
  $choice_buttons = $(".choice-btn");

  $.ajax({
    url: "./includes/get_user_data.php",
    dataType: "text",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      if (response != "no-login") {
        $user = JSON.parse(response);

        // using free openexchange rates api to display customer's local price based off selected country of residence
        //free tier only allows setting USD as base currency, but rate to dollar can be retrieved for both GBP and user's country
        //then recalculated and return a rough price estimate sufficient for this project

        //currency api endpoint config vars
        $app_id = $user.oxr_app_id;
        $oxr_url = $user.oxr_url;

        function getLocalPrice() {
          $gbp_prices_divs = $(".card-title");
          $gbp_prices_divs.each(function () {
            var $cardTitle = $(this); // Store a reference to the current .card-title element

            var $priceString = $cardTitle.text();
            var $stringArray = $priceString.split("/");
            var $priceArray = $stringArray[0].trim().split(" ");
            var $gbp_price = $priceArray[0].trim();

            $.getJSON($oxr_url, {
              app_id: $app_id,
              base: "USD",
            })
              .done(function (data) {
                var $usd_to_gbp_rate = data.rates["GBP"];
                var $usd_to_user_rate = data.rates[$user_currency_code];

                var $converted_price =
                  ($gbp_price / $usd_to_gbp_rate) * $usd_to_user_rate;

                $cardTitle
                  .siblings(".local-price")
                  .css("font-weight", "bold")
                  .text(
                    $converted_price.toFixed(2) +
                      " " +
                      $user_currency_code +
                      " / " +
                      $stringArray[1]
                  );
              })
              .fail(function (textStatus, error) {
                var $err = textStatus + ", " + error;
                console.log("Request Failed: " + $err);
              });
          });
        }

        // get user data as vars

        $user_id = $user.id;
        $user_fname = $user.fname;
        $user_sub_status = $user.sub_status;
        $user_sub_type = $user.sub_type;
        $user_country_code = $user.country_code;
        // src https://www.npmjs.com/package/country-to-currency
        $user_currency_code = countryToCurrency[$user_country_code];
        if ($user_currency_code == "GBP") {
          $(".local-price-descriptor").css("display", "none");
          $(".local-price").css("display", "none");
        }
        $("#nosub-wrapper").css("display", "none");
        $("#sub-wrapper").css("display", "block");

        $toggler = $('.switch input[type="checkbox"]');
        $prices = $(".yearly-price");

        drawHeaders();
        redrawCards(checkToggler($toggler));
        getLocalPrice();

        function swapToggler(toggle) {
          $status = checkToggler(toggle);
          if ($(toggle).is(":checked")) {
            $("#toggle-yearly").animate({ opacity: 1 }, 500);
            $("#toggle-monthly").animate({ opacity: 0 }, 500);
            $prices.toggleClass("monthly-price");
            $prices.toggleClass("yearly-price");
            $(".all-price").html("129.99 GBP / year");
            $(".movie-price").html("69.99 GBP / year");
            $(".tv-price").html("69.99 GBP / year");
            redrawCards($status);
            getLocalPrice();
          } else {
            $("#toggle-yearly").animate({ opacity: 0 }, 500);
            $("#toggle-monthly").animate({ opacity: 1 }, 500);
            $(".all-price").html("12.99 GBP / month");
            $(".movie-price").html("6.99 GBP / month");
            $(".tv-price").html("6.99 GBP / month");
            $prices.toggleClass("yearly-price");
            $prices.toggleClass("monthly-price");
            redrawCards($status);
            getLocalPrice();
          }
        }

        function checkToggler(toggle) {
          if ($(toggle).is(":checked")) {
            return false;
          } else {
            return true;
          }
        }

        // NOTE TO SELF: monthly = true | yearly = false

        $toggler.on("change", function () {
          swapToggler(this);
        });

        //update header once based on user's currently returned plan
        function drawHeaders() {
          switch (true) {
            case $user_sub_status == 1 && $user_sub_type === "m1":
              $header_top.text(
                "Your current monthly subscription is Bingemaster!"
              );
              $header_bottom.text(
                "You can choose to change your subscription here:"
              );
              break;
            case $user_sub_status == 1 && $user_sub_type === "m2":
              $header_top.text(
                "Your current monthly subscription is Film Buff!"
              );
              $header_bottom.text(
                "You can choose to change your subscription here:"
              );
              break;
            case $user_sub_status == 1 && $user_sub_type === "m3":
              $header_top.text(
                "Your current monthly subscription is Omnivore!"
              );
              $header_bottom.text(
                "You can choose to change your subscription here:"
              );
              break;
            case $user_sub_status == 1 && $user_sub_type === "y1":
              $header_top.text(
                "Your current yearly subscription is Bingemaster!"
              );
              $header_bottom.text(
                "You can choose to change your subscription here:"
              );
              break;
            case $user_sub_status == 1 && $user_sub_type === "y2":
              $header_top.text(
                "Your current yearly subscription is Film Buff!"
              );
              $header_bottom.text(
                "You can choose to change your subscription here:"
              );
              break;
            case $user_sub_status == 1 && $user_sub_type === "y3":
              $header_top.text("Your current yearly subscription is Omnivore!");
              $header_bottom.text(
                "You can choose to change your subscription here:"
              );
              break;
            case $user_sub_status == 0 && $user_sub_type === "none":
              // Default text for logged in users unsubscribed. Cads left as default
              $header_top.text("Join WebFlix Today");
              $header_bottom.text(
                "Get access to a vast collection of great shows and movies. Sign up today!"
              );
              break;
            default:
              //safeguard case for unaccounted call results
              $header_top.text("Join WebFlix Today");
              $header_bottom.text(
                "Get access to a vast collection of great shows and movies. Sign up today!"
              );
              break;
          }
        }

        // update the cards dynamically based on user's subscription status AND state of the toggle
        function redrawCards(status) {
          switch (true) {
            // cases for monthly plans (3 plans x 2 possible states of toggle)
            case $user_sub_status === 1 &&
              $user_sub_type === "m1" &&
              status === true:
              $("#card-1-col .card-text").html(
                "This is your current subscription plan."
              );
              $("#choice-btn1").css("display", "none");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "m2" &&
              status === true:
              $("#card-2-col .card-text").html(
                "This is your current subscription plan."
              );
              $("#choice-btn2").css("display", "none");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "m3" &&
              status === true:
              $("#card-3-col .card-text").html(
                "This is your current subscription plan."
              );
              $("#choice-btn3").css("display", "none");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "m1" &&
              status === false:
              $("#card-1-col .card-text").html($original_card1_text);
              $("#choice-btn1").css("display", "inline-block");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "m2" &&
              status === false:
              $("#card-2-col .card-text").html($original_card2_text);
              $("#choice-btn2").css("display", "inline-block");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "m3" &&
              status === false:
              $("#card-3-col .card-text").html($original_card3_text);
              $("#choice-btn3").css("display", "inline-block");
              break;

            // cases for yearly plans (3 plans x 2 possible states of toggle)
            case $user_sub_status === 1 &&
              $user_sub_type === "y1" &&
              status === false:
              $("#card-1-col .card-text").html(
                "This is your current subscription plan."
              );
              $("#choice-btn1").css("display", "none");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "y2" &&
              status === false:
              $("#card-2-col .card-text").html(
                "This is your current subscription plan."
              );
              $("#choice-btn2").css("display", "none");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "y3" &&
              status === false:
              $("#card-3-col .card-text").html(
                "This is your current subscription plan."
              );
              $("#choice-btn3").css("display", "none");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "y1" &&
              status === true:
              $("#card-1-col .card-text").html($original_card1_text);
              $("#choice-btn1").css("display", "inline-block");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "y2" &&
              status === true:
              $("#card-2-col .card-text").html($original_card2_text);
              $("#choice-btn2").css("display", "inline-block");
              break;
            case $user_sub_status === 1 &&
              $user_sub_type === "y3" &&
              status === true:
              $("#card-3-col .card-text").html($original_card3_text);
              $("#choice-btn3").css("display", "inline-block");
              break;

            // Default text for logged in users unsubscribed
            case $user_sub_status === 0 && $user_sub_type === "none":
              $("#card-1-col .card-text").html($original_card1_text);
              $("#card-2-col .card-text").html($original_card2_text);
              $("#card-3-col .card-text").html($original_card3_text);
              $sub_warning = $("#subConfirmModal").find("#sub-warning");
              $sub_warning.css("display", "none");
              break;
          }
        }

        // still inside 'if logged in' block.
        // TODO: function on choice-btn to bring up #subConfirmModal and go from there
        $choice_buttons.on("click", function (e) {
          e.preventDefault();

          $clicked_button = $(this);
          $paypal_form = $("#paypal_form");
          $input_business = $("#business");
          $input_item_name = $("#item_name");
          $input_item_number = $("#item_number");
          $input_currency_code = $("#currency_code");
          $input_item_price = $("#item_price");
          $input_interval_count = $("#interval_count");
          $input_interval = $("#interval");
          $input_duration = $("#plan_duration");
          $input_user_id = $("#user_id_for_paypal");
          $input_cancel = $("#cancel_url");
          $input_return = $("#return_url");

          $.ajax({
            url: "./includes/paypal/get_plans.php",
            dataType: "text",
            contentType: "application/json; charset=utf-8",
            success: function (response) {
              $plans_data = JSON.parse(response);
              // console.log($plans_data);

              $paypal_form.attr("action", $plans_data[6]);
              $input_business.val($plans_data[7]);
              $input_currency_code.val($plans_data[8]);
              $input_user_id.val($user_id);
              $input_cancel.val($plans_data[9]);
              $input_return.val($plans_data[10]);

              $selected_plan = $clicked_button
                .closest(".card")
                .find(".plan-name")
                .text();
              $selected_price = $clicked_button
                .closest(".card")
                .find(".card-title")
                .text();
              if ($selected_price.indexOf("month") != -1) {
                $period_msg = "You will be billed monthly at a rate:";
              } else if ($selected_price.indexOf("year") != -1) {
                $period_msg = "You will be billed yearly at a rate:";
              }
              switch (true) {
                case $selected_price.indexOf("month") != -1 &&
                  $selected_plan === "Bingemaster!":
                  $new_plan = "m1";
                  $input_item_name.val($plans_data[0].name);
                  $input_item_number.val($plans_data[0].plan_id);
                  $input_item_price.val($plans_data[0].price);
                  $input_interval_count.val($plans_data[0].interval_count);
                  $input_interval.val($plans_data[0].interval);
                  $input_duration.val("48");
                  break;
                case $selected_price.indexOf("month") != -1 &&
                  $selected_plan === "Film buff!":
                  $new_plan = "m2";
                  $input_item_name.val($plans_data[1].name);
                  $input_item_number.val($plans_data[1].plan_id);
                  $input_item_price.val($plans_data[1].price);
                  $input_interval_count.val($plans_data[1].interval_count);
                  $input_interval.val($plans_data[1].interval);
                  $input_duration.val("48");
                  break;
                case $selected_price.indexOf("month") != -1 &&
                  $selected_plan === "Omnivore!":
                  $new_plan = "m3";
                  $input_item_name.val($plans_data[2].name);
                  $input_item_number.val($plans_data[2].plan_id);
                  $input_item_price.val($plans_data[2].price);
                  $input_interval_count.val($plans_data[2].interval_count);
                  $input_interval.val($plans_data[2].interval);
                  $input_duration.val("48");
                  break;
                case $selected_price.indexOf("year") != -1 &&
                  $selected_plan === "Bingemaster!":
                  $new_plan = "y1";
                  $input_item_name.val($plans_data[3].name);
                  $input_item_number.val($plans_data[3].plan_id);
                  $input_item_price.val($plans_data[3].price);
                  $input_interval_count.val($plans_data[3].interval_count);
                  $input_interval.val($plans_data[3].interval);
                  $input_duration.val("4");
                  break;
                case $selected_price.indexOf("year") != -1 &&
                  $selected_plan === "Film buff!":
                  $new_plan = "y2";
                  $input_item_name.val($plans_data[4].name);
                  $input_item_number.val($plans_data[4].plan_id);
                  $input_item_price.val($plans_data[4].price);
                  $input_interval_count.val($plans_data[4].interval_count);
                  $input_interval.val($plans_data[4].interval);
                  $input_duration.val("4");
                  break;
                case $selected_price.indexOf("year") != -1 &&
                  $selected_plan === "Omnivore!":
                  $new_plan = "y3";
                  $input_item_name.val($plans_data[5].name);
                  $input_item_number.val($plans_data[5].plan_id);
                  $input_item_price.val($plans_data[5].price);
                  $input_interval_count.val($plans_data[5].interval_count);
                  $input_interval.val($plans_data[5].interval);
                  $input_duration.val("4");
                  break;
              }
              $("#subConfirmModal .modal-title").text($selected_plan);
              $("#sub-summary-line1").text($period_msg);
              $("#sub-summary-line2")
                .text($selected_price)
                .css("font-weight", "bold");
              $("#subConfirmModal").modal("show");
              // ! This is where action starts for paypal integration. Nest another ajax in here that will
              // ! pass data to php IF user plan is NOT 'none'. Else prevent and do cancel/confirm/buy new
              $accept_btn = $("#accept-btn");

              if ($user_sub_status === 1) {
                $accept_btn.on("click", function (e) {
                  e.preventDefault();
                  //prevent default pass data instead to my script
                  // that will request cancellation of old first

                  $.ajax({
                    url: "./includes/paypal/paypal_cancel.php",
                    method: "POST",
                    success: function (response) {
                      if (response == "successfully_cancelled") {
                        console.log(response);
                        $paypal_form[0].submit();
                      }
                    },
                    error: function (xhr, status, error) {
                      $err_msg = "An unexpected error occurred.";
                      console.log($err_msg);
                    },
                  });
                });
              }
            },
            error: function () {
              // TODO: handle error from server php script. Not relevant for the prototype yet.
              console.log('Fail"!');
            },
          });
        });
      } else {
        // handle pricing display and other stuff when not logged in
        // function slightly different as it doesn't mod the cards' text on toggle
        $toggler = $('.switch input[type="checkbox"]');
        $prices = $(".yearly-price");
        $(".local-price-descriptor").css("display", "none");

        function swapToggler(toggle) {
          $status = checkToggler(toggle);
          if ($(toggle).is(":checked")) {
            $("#toggle-yearly").animate({ opacity: 1 }, 500);
            $("#toggle-monthly").animate({ opacity: 0 }, 500);
            $prices.toggleClass("monthly-price");
            $prices.toggleClass("yearly-price");
            $(".all-price").html("129.99 GBP / year");
            $(".movie-price").html("69.99 GBP / year");
            $(".tv-price").html("69.99 GBP / year");
          } else {
            $("#toggle-yearly").animate({ opacity: 0 }, 500);
            $("#toggle-monthly").animate({ opacity: 1 }, 500);
            $(".all-price").html("12.99 GBP / month");
            $(".movie-price").html("6.99 GBP / month");
            $(".tv-price").html("6.99 GBP / month");
            $prices.toggleClass("yearly-price");
            $prices.toggleClass("monthly-price");
          }
        }

        function checkToggler(toggle) {
          if ($(toggle).is(":checked")) {
            return false;
          } else {
            return true;
          }
        }

        // NOTE TO SELF: monthly = true | yearly = false

        $toggler.on("change", function () {
          swapToggler(this);
        });
        console.log("User not logged in");
        // default actions for unlogged user
        $header_top.text("Join WebFlix Today");
        $header_bottom.text(
          "Get access to a vast collection of great shows and movies. Sign up today!"
        );

        // mod buttons so they offer registration
        $choice_buttons.text("Register to Subscribe").attr("href", "disabled");
        $choice_buttons.on("click", function (e) {
          e.preventDefault();
          $("#registerModal").modal("show");
        });
      }
    },
    error: function () {
      // TODO: handle error from server php script. Not relevant for the prototype yet.
      console.log('Fail"!');
    },
  });
});
