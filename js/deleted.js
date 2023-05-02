/* script to pull up home page logged out prompt  */

$(document).ready(function () {
  if (window.location.href.indexOf("#goodbyeModal") != -1) {
    $(".modal").modal("hide");
    $("#goodbyeModal").modal("show");
    console.log("huh?");
  }
});
