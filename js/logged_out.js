/* script to pull up home page logged out prompt  */

$(document).ready(function () {
  if (window.location.href.indexOf("#logoutModal") != -1) {
    $(".modal").modal("hide");
    $("#logoutModal").modal("show");
    console.log("huh?");
  }
});
