$(document).ready(function () {
  $.ajax({
    url: "./includes/get_user_data.php",
    dataType: "text",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      // get user data as vars
      $user = JSON.parse(response);
      // console.log($user);
      $user_id = $user.user_id;
      $user_fname = $user.fname;
      $user_lname = $user.lname;
      $user_email = $user.email;
      $user_phone = $user.phone;
      $user_country = $user.country;

      $user_country_code = $user.country_code;
      // src https://www.npmjs.com/package/country-to-currency
      $user_currency_code = countryToCurrency[$user_country_code];

      // using free openexchange rates api to display customer's local price based off selected country of residence
      //free tier only allows setting USD as base currency, but rate to dollar can be retrieved for both GBP and user's country
      //then recalculated and return a rough price estimate sufficient for this project

      //currency api endpoint config vars
      $app_id = $user.oxr_app_id;
      $oxr_url = $user.oxr_url;
      $user_ui_api_url = $user.user_ui_api_url;

      if ($("#costmsg").text().trim() === "") {
      } else {
        $priceString = $("#costmsg").text();
        $stringArray = $priceString.split("/");
        $priceArray = $stringArray[0].trim().split(" ");
        $gbp_price = $priceArray[0].trim();
        $gbp_currencyCode = $priceArray[1].trim();

        $.getJSON($oxr_url, {
          app_id: $app_id,
          base: "USD",
        })
          .done(function (data) {
            $usd_to_gbp_rate = data.rates["GBP"];
            $usd_to_user_rate = data.rates[$user_currency_code];

            $converted_price =
              ($gbp_price / $usd_to_gbp_rate) * $usd_to_user_rate;

            $("#converted-price")
              .css("font-weight", "bold")
              .text(
                $converted_price.toFixed(2) +
                  " " +
                  $user_currency_code +
                  " / " +
                  $stringArray[1]
              );
          })
          .fail(function (jqxhr, textStatus, error) {
            $err = textStatus + ", " + error;
            console.log("Request Failed: " + $err);
          });
      }

      $user_dob = moment($user.dob).format("DD MMM YYYY");
      $user_reg = moment($user.reg_date).format("YYYY-MM-DD HH:mm:ss");
      $user_reg_formatted = moment($user_reg).format("DD MMMM YYYY HH:mm");
      $user_sub_status = $user.sub_status;
      $user_sub_type = $user.sub_type;

      $sub_type_msg = "";
      $cost_msg = "";
      $plan = "";
      //	update the page content

      $("#first_name").text($user_fname);
      $("#last_name").text($user_lname);
      $("#email").text($user_email);
      $("#phone").text($user_phone);
      $("#dob").text($user_dob);
      $("#country").text($user_country);
      $("#reg_date").text($user_reg_formatted);
      $greeting = "Hi, " + $user_fname + "!";
      $icon_link =
        $user_ui_api_url +
        $user_fname +
        "+" +
        $user_lname +
        "&bold=true&rounded=true&background=00a2e2&format=png&size=100";
      $("#greeting").text($greeting);
      $("#profile-icon").attr("src", $icon_link);

      if ($user_sub_type == "y1" || $user_sub_type == "m1") {
        $new_plan = "Bingemaster!";
      } else if ($user_sub_type == "y2" || $user_sub_type == "m2") {
        $new_plan = "Film Buff!";
      } else if ($user_sub_type == "y3" || $user_sub_type == "m3") {
        $new_plan = "Omnivore!";
      }

      if (window.location.href.indexOf("cancelled") != -1) {
        $("#subCancelledModal").modal("show");
      }

      if (window.location.href.indexOf("#subscribed") != -1) {
        $("#new-plan-title").text($new_plan);
        $("#subOKModal").modal("show");
      }

      // $(".modal-close").on("click", function () {
      //   $(".modal").modal("hide");
      // });

      if ($user_sub_status == 1) {
        if ($user_currency_code == "GBP") {
          $("#converted-price-info-helper").css("display", "none");
          $("#converted-price").css("display", "none");
        }
        $("#nosub-wrapper").css("display", "none");
        $("#sub-wrapper").css("display", "block");

        switch ($user_sub_type) {
          case "y1":
            $sub_type_msg =
              "<br>You are subscribed to the Bingemaster! plan.<br>You can watch our TV shows and you are being billed yearly.";
            $plan = "Bingemaster!";
            break;
          case "y2":
            $sub_type_msg =
              "<br>You are subscribed to the Film Buff! plan.<br>You can watch our movies and you are being billed yearly.";
            $plan = "Film Buff!";
            break;
          case "y3":
            $sub_type_msg =
              "<br>You are subscribed to the Omnivore! plan.<br>You can watch anything you wish and you are being billed yearly.";
            $plan = "Omnivore!";
            break;
          case "m1":
            $sub_type_msg =
              "<br>You are subscribed to the Bingemaster! plan.<br>You can watch our TV shows and you are being billed monthly.";
            $plan = "Bingemaster!";
            break;
          case "m2":
            $sub_type_msg =
              "<br>You are subscribed to the Film Buff! plan.<br>You can watch our movies and you are being billed monthly.";
            $plan = "Film Buff!";
            break;
          case "m3":
            $sub_type_msg =
              "<br>You are subscribed to the Omnivore! plan.<br>You can watch anything you wish and you are being billed monthly.";
            $plan = "Omnivore!";
            break;
        }
        $(".submsg").html($sub_type_msg).css("font-size", "0.8rem");
        $(".sub-card .plan-name").text($plan);

        $cancel_sub_btn = $("#cancel-sub-btn");
        $cancel_sub_btn.on("click", function (e) {
          e.preventDefault();
          $.ajax({
            url: "./includes/paypal/paypal_cancel.php",
            method: "POST",
            success: function (response) {
              if (response == "successfully_cancelled") {
                console.log(response);
                location.reload();
              }
            },
            error: function (xhr, status, error) {
              $err_msg = "An unexpected error occurred.";
              console.log($err_msg);
              location.reload();
            },
          });
        });
      } else {
        $("#nosub-wrapper").css("display", "block");
        $("#sub-wrapper").css("display", "none");
        $(".submsg").html(
          "You currently do not have an active subscription for WebFlix content."
        );
        $("#costmsg").text("");
      }
    },
    error: function () {
      console.log('Fail"!');
    },
  });

  $password_btn = $("#change-pass-btn");
  $delete_btn = $("#delete-account");

  $password_btn.on("click", function () {
    $("#passUpdModal").modal("show");
  });
  $delete_btn.on("click", function () {
    $("#deletionModal").modal("show");
  });

  // allow only numeric input in text fields
  function restrictKeydown(event) {
    var allowedKeyCodes = [
      9, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102,
      103, 104, 105, 8, 46, 37, 39,
    ];
    return allowedKeyCodes.includes(event.keyCode);
  }
  $restrictedFields = $(".restrict-to-nums");
  $restrictedFields.on("keydown", restrictKeydown);

  $details_btn = $("#change-details-btn");
  $edit_buttons = $(".btn-edit");
  $details_btn.on("click", function () {
    $edit_buttons.toggleClass("btn-edit-active");
  });

  $edit_buttons.on("click", function () {
    $buttonId = $(this).attr("id");

    switch ($buttonId) {
      case "edit-fname":
        $("#editFirstNameModal").modal("show");
        $("#editFirstNameModal").find('input[name="first_name"]').focus();
        break;
      case "edit-lname":
        $("#editLastNameModal").modal("show");
        $("#editLastNameModal").find('input[name="last_name"]').focus();
        break;
      case "edit-email":
        $("#editEmailModal").modal("show");
        $("#editEmailModal").find('input[name="email"]').focus();
        break;
      case "edit-phone":
        $("#editPhoneModal").modal("show");
        $("#editPhoneModal").find('input[name="phone"]').focus();
        break;
      case "edit-country":
        $("#editCountryModal").modal("show");
        $("#editCountryModal").find('select[name="country"]').focus();
        break;
    }
  });

  $(".bfh-countries option:first-child")
    .attr("disabled", true)
    .attr("selected", true);
  $(".bfh-countries").change(function () {
    $(".country-star").css("display", "none");
  });

  $(".edit-details-form").on("submit", function (event) {
    event.preventDefault();
    $form = $(this);
    $parent_modal = $(this).closest(".modal");
    $("#try_again_btn").on("click", function () {
      $("#editErrModal").modal("hide");
      $parent_modal.modal("show");
    });

    $.ajax({
      url: "./includes/edit-details.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response) == "true") {
          //print alert to the console
          console.log("Success! " + response);

          // swap for confirmation modal when logged in
          $parent_modal.modal("hide");
          $("#editOKModal").modal("show");
        } else {
          //print issues to the console
          console.log("Errors! " + response);
          $parent_modal.modal("hide");
          $("#editErrModal").modal("show");
          $("#editErrMsg").html(response);
        }
      },
      error: function (response, textStatus, errorThrown) {
        console.log("Failure! " + textStatus, errorThrown + " " + response);
        window.location.reload();
      },
    });
  });

  $("#passUpdForm").on("submit", function (event) {
    event.preventDefault();

    // ajax  request handling the modal based on response from register.php
    $.ajax({
      url: "./includes/pass_upd.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response) == "true") {
          //print alert to the console
          console.log("Success! " + response);

          // swap for confirmation modal when logged in
          $("#passUpdModal").modal("hide");
          $("#passUpdOKModal").modal("show");
        } else {
          //print issues to the console
          console.log("Errors! " + response);

          //show error modal
          $("#passUpdModal").modal("hide");
          $("#pupdErrModal").modal("show");
          $("#errMsgPass").html(response);
        }
      },
      error: function (response, textStatus, errorThrown) {
        //work in progress
        //if server response fail, for now no user facing errors. console log to be checked for details
        //simply reloads current page
        console.log("Failure! " + textStatus, errorThrown + " " + response);
        window.location.reload();
      },
    });
  });
});
