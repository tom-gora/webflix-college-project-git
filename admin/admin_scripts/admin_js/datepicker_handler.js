$(document).ready(function () {
  $("#dateOfBirth").datepicker({
    clearBtn: false,
    format: "dd/mm/yyyy",
    autoclose: true,
    startDate: "01/01/1900",
    endDate: "today",
    todayHighlight: true,
    startView: "years",
    weekStart: "1",
  });
  $("#dateOfBirth").on("change", function () {
    var pickedDate = $(this).datepicker("getFormattedDate");
    $("#pickedDate").html(pickedDate);
    console.log(pickedDate);
  });
});
