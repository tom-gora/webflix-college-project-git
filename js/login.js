$(document).ready(function () {
  $.getJSON("./includes/konami.php", function (data) {
    // Handle the response data
    var arrowKeys = [];
    var konamiCode = data;
    $(document).keydown(function (e) {
      arrowKeys.push(e.keyCode);
      arrowKeys.splice(
        -konamiCode.length - 1,
        arrowKeys.length - konamiCode.length
      );

      if (arrowKeys.join("") === konamiCode.join("")) {
        window.location.href = "./admin/admin.php";
      }
    });
  });

  $("#loginForm").on("submit", function (event) {
    event.preventDefault();

    // ajax  request handling the modal based on response from login_action.php
    request = $.ajax({
      url: "./includes/login_action.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response) == "true") {
          //print alert to the console
          console.log("Success! " + response);
          window.location.replace("account.php");
        } else {
          // window.location.reload();
          //print issues to the console
          console.log("Errors! " + response);
          //show error html
          $("#jumboContainer").html(response);
        }
      },
      error: function (response, textStatus, errorThrown) {
        //work in progress
        //if server response fail, for now no user facing errors. console log to be checked for details
        console.log("Failure! " + textStatus, errorThrown + " " + response);
      },
    });
  });
});
$(document).ready(function () {
  $("#loginForm").on("submit", function (event) {
    event.preventDefault();

    // ajax  request handling the modal based on response from login_action.php
    request = $.ajax({
      url: "./includes/login_action.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response) == "true") {
          //print alert to the console
          console.log("Success! " + response);
          window.location.replace("account.php");
        } else {
          // window.location.reload();
          //print issues to the console
          console.log("Errors! " + response);
          //show error html
          $("#jumboContainer").html(response);
        }
      },
      error: function (response, textStatus, errorThrown) {
        //work in progress
        //if server response fail, for now no user facing errors. console log to be checked for details
        console.log("Failure! " + textStatus, errorThrown + " " + response);
      },
    });
  });
});
