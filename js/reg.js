$(document).ready(function () {
  $registerForm = $("#regForm");

  $(".bfh-countries option:first-child")
    .attr("disabled", true)
    .attr("selected", true);
  $(".bfh-countries").change(function () {
    $(".country-star").css("display", "none");
  });

  $("#switchRegistrationModals").click(function (e) {
    e.preventDefault();
    $("#firstFormWrapper").hide();
    $("#secondFormWrapper").slideDown(500);
    $("#switchRegistrationModals").hide();
    $("#signUp").slideDown(500);
    $("#goBackRegisterModals").slideDown(500);
  });

  $("#goBackRegisterModals").click(function (e) {
    e.preventDefault();
    $("#firstFormWrapper").slideDown(500);
    $("#secondFormWrapper").hide();
    $("#signUp").hide();
    $("#switchRegistrationModals").slideDown(500);
    $("#goBackRegisterModals").hide();
  });

  function resetForm($form) {
    console.log("resetForm called with form:", $form);
    $form
      .find('input:text, input:password, input[type="email"], select')
      .val("");
  }

  $("#registerModal").on("hidden.bs.modal", function () {
    $("#switchRegistrationModals").show();
    $("#firstFormWrapper").show();
    $("#signUp").hide();
    $("#secondFormWrapper").hide();
    resetForm($registerForm);
  });

  if (window.location.href.indexOf("#registerModal") !== -1) {
    $("#regErrModal").modal("hide");
    $("#registerModal").modal("show");
    console.log("huh?");
  }

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

  $registerForm.on("submit", function (event) {
    event.preventDefault();

    // ajax  request handling the modal based on response from register script
    request = $.ajax({
      url: "./includes/register.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response) == "true") {
          //print alert to the console
          console.log("Success! " + response);

          // swap for confirmation modal when signed up successfully
          $("#registerModal").modal("hide");
          $("#regOKModal").modal("show");
        } else {
          //print issues to the console
          console.log("Errors! " + response);

          //show error modal
          $("#registerModal").modal("hide");
          $("#regErrModal").modal("show");
          $("#errMsg").html(response);
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
