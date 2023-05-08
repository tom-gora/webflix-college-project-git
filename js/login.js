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

  $("#forgotPassForm").on("submit", function (event) {
    event.preventDefault();

    // ajax  request handling the modal based on response from register script
    request = $.ajax({
      url: "./includes/forgot_password.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response).includes("success")) {
          //print alert to the console
          // console.log("Success! " + response);
          $id = response.split(" ")[1];
          $("#passUpdModal").find("input[name=id]").val($id);
          // swap for confirmation modal when signed up successfully
          $(".modal").modal("hide");
          $("#passUpdModal").modal("show");
        } else {
          //print issues to the console
          console.log("Errors! " + response);

          //show error modal
          $(".modal").modal("hide");
          $("#forgotPassModal").find("input").val("");
          $("#forgotResponse").modal("show");
          $("#forgotRes").html(response);
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
