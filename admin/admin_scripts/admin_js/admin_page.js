$(document).ready(function () {
  $(".expandable-table-row").click(function () {
    // Check if the clicked row already has the active class
    var isActive = $(this).hasClass("clicked");

    // Remove the active class from all rows
    $(".expandable-table-row").removeClass("clicked");

    // Collapse all content
    $(".expandable-table-extra").hide();

    // If the clicked row was not active, highlight it and expand the content
    if (!isActive) {
      $(this).addClass("clicked").css("background-color", "#ccc");
      $(this).next(".expandable-table-extra").show();
    }
    // If the clicked row was active, remove the highlight and collapse the content
    else {
      $(this).removeClass("clicked").css("background-color", "#fff");
    }
  });

  $("#nav-dashboard").click(function (e) {
    e.preventDefault();
    $("section").css("display", "none");
    $("#main").css("display", "block");

    $(this).siblings().removeClass("clicked");
  });

  $("#nav-users").click(function (e) {
    e.preventDefault();
    $("section").css("display", "none");
    $("#users").css("display", "block");

    $(this).addClass("clicked").siblings().removeClass("clicked");
  });

  $("#nav-movies").click(function (e) {
    e.preventDefault();
    $("section").css("display", "none");
    $("#movies").css("display", "block");

    $(this).addClass("clicked").siblings().removeClass("clicked");
  });

  $("#nav-shows").click(function (e) {
    e.preventDefault();
    $("section").css("display", "none");
    $("#shows").css("display", "block");

    $(this).addClass("clicked").siblings().removeClass("clicked");
  });

  $(".bfh-countries option:first-child")
    .attr("disabled", true)
    .attr("selected", true);
  $(".bfh-countries").change(function () {
    $(".country-star").css("display", "none");
  });

  $("input[type='date']").change(function () {
    $(".country-star").css("display", "none");
    $(this).css("padding-left", "5px");
  });

  $("#userAddForm").on("submit", function (event) {
    event.preventDefault();

    // ajax  request handling the modal based on response from register script
    request = $.ajax({
      url: "../includes/register.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "text",
      success: function (response) {
        if ($.trim(response) == "true") {
          //print alert to the console
          console.log("Success! " + response);

          // swap for confirmation modal when signed up successfully
          $("#addUserModal").modal("hide");
          $("#addUserModalOK").modal("show");
        } else {
          //print issues to the console
          console.log("Errors! " + response);

          //show error modal
          $("#addUserModal").modal("hide");
          $("#addUserModalErr").modal("show");
          $("#errMsg").html(response);
        }
      },
      error: function (response, textStatus, errorThrown) {
        //work in progress
        //if server response fail, for now no user facing errors. console log to be checked for details
        //simply reloads current page
        console.log("Failure! " + textStatus, errorThrown + " " + response);
        // window.location.reload();
      },
    });
  });

  $(".admin-delete").on("click", function (e) {
    e.preventDefault();
    $delete_form = $("#deleteForm");
    $delete_name = $(this).attr("item-data");
    $delete_data = $(this).attr("id-data");
    $id_to_delete = $delete_data.split("-")[1];
    $type_to_delete = $delete_data.split("-")[0];
    // console.log("id to del: " + $id_to_delete);
    // console.log("type to del: " + $type_to_delete);
    $delete_form.find("#item-to-delete").val($type_to_delete);
    $delete_form.find("#item-id").val($id_to_delete);
    $("#thingToDelete").text($delete_name).css("font-weight", "600");
    $("#idToDelete").text($id_to_delete).css("font-weight", "600");

    $("#deleteModal").modal("show");
  });

  $("#deleteForm").on("submit", function (e) {
    e.preventDefault();

    $formData = $(this).serializeArray();
    $jsonData = {};
    $.each($formData, function () {
      $jsonData[this.name] = this.value;
    });
    $jsonString = JSON.stringify($jsonData);
    $.ajax({
      url: "./admin_scripts/admin_php/admin_delete.php",
      type: "POST",
      data: $jsonString,

      success: function (response) {
        console.log(response);
        if (response === "success") {
          $("#deleteModal").modal("hide");
          $("#deleteSuccessModal").modal("show");
        } else {
          console.log("Errors in database update occurred!");
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });

  $("#movieAddForm").on("submit", function (e) {
    e.preventDefault();

    $formData = $(this).serializeArray();
    $jsonData = {};
    $.each($formData, function () {
      $jsonData[this.name] = this.value;
    });
    $jsonString = JSON.stringify($jsonData);
    // console.log($jsonString);
    $.ajax({
      url: "./admin_scripts/admin_php/admin_add_movie.php",
      type: "POST",
      data: $jsonString,

      success: function (response) {
        console.log(response);
        if (response === "success") {
          $("#addMovieModal").modal("hide");
          $("#addMovieModalOK").modal("show");
        } else {
          console.log("Errors in database update occurred!");
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });

  $addform = $("#movieAddForm");
  $timeyButtons = $addform.find(".bfh-timepicker-popover .bfh-number-btn");
  $time_input = $addform.find(".bfh-timepicker input").eq(0).toArray();
  $target_input = $addform.find(".durationInput");

  $timeyButtons.on("click", function () {
    writeDurationIntoDOM($time_input, $target_input);
  });

  function writeDurationIntoDOM($input, $target) {
    console.log($input);

    $duration = $input[0].value + ":00";
    $target.attr("value", $duration);
    // console.log($duration);
  }

  function restrictKeydown(event) {
    var allowedKeyCodes = [
      9, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102,
      103, 104, 105, 8, 46, 37, 39,
    ];
    return allowedKeyCodes.includes(event.keyCode);
  }

  $("#showAddForm").on("submit", function (e) {
    e.preventDefault();

    $formData = $(this).serializeArray();
    $jsonData = {};
    $.each($formData, function () {
      $jsonData[this.name] = this.value;
    });
    $jsonString = JSON.stringify($jsonData);
    // console.log($jsonString);
    $.ajax({
      url: "./admin_scripts/admin_php/admin_add_show.php",
      type: "POST",
      data: $jsonString,

      success: function (response) {
        console.log(response);
        if (response === "success") {
          $("#addShowModal").modal("hide");
          $("#addShowModalOK").modal("show");
        } else {
          console.log("Errors in database update occurred!");
        }
      },
      error: function (response) {
        console.log(response);
      },
    });
  });

  function addSeasonInputs(numSeasons) {
    var $seasonInputs = $("#season-inputs");
    $seasonInputs.empty(); // clear any existing inputs
    // console.log($seasonInputs);
    for (var i = 1; i <= numSeasons; i++) {
      var $seasonInput = $(
        '<input type="text" class="form-control restrict-to-nums" name="season-' +
          i +
          '" data-min="1" data-max="30">'
      );
      var $seasonLabel = $(
        '<label for="season-' + i + '">Season ' + i + ":</label>"
      );
      $seasonInputs.append($seasonLabel).append($seasonInput);
      $restrictedFields = $(".restrict-to-nums");
      $restrictedFields.on("keydown", restrictKeydown);
    }
  }
  addSeasonInputs(1);

  function updateSeasonsJson() {
    var seasons = {};
    $('input[name^="season-"]').each(function () {
      var seasonNum = $(this).attr("name").replace("season-", "");
      var episodesArr = $(this).eq(0).toArray();
      numEpisodes = parseInt(episodesArr[0].value);
      seasons["Season " + seasonNum] = numEpisodes;
    });
    var jsonStr = JSON.stringify(seasons).replace(/\"(\d+)\"/g, "$1");
    $("#seasons-json").val(jsonStr);
    console.log(jsonStr);
  }

  $("#seasonsInput").on("change", function () {
    var $seasonsArr = $("#seasonsInput").eq(0).toArray();
    $numSeasons = $seasonsArr[0].value;
    console.log($numSeasons);
    addSeasonInputs($numSeasons);
    updateSeasonsJson();
  });

  $(document).on("change", "#season-inputs input", function () {
    console.log(this);
    updateSeasonsJson();
  });

  $(".admin-edit").on("click", function (e) {
    e.preventDefault();

    $edit_data = $(this).attr("id-data");
    $id_to_edit = $edit_data.split("-")[1];
    $type_to_edit = $edit_data.split("-")[0];

    switch ($type_to_edit) {
      case "user":
        //target elements
        $edit_form = $("#userEditForm");
        $edit_modal = $("#editUserModal");
        $edit_button = $edit_form.find(".edit-button");

        //extract data from the page
        $this_row = $(this).closest(".expandable-table-extra");
        $parent_row = $(this).closest(".expandable-table-extra").prev();
        $name = $parent_row.children().eq(1).text();
        $first_name = $name.split(" ")[0];
        $last_name = $name.split(" ")[1];
        $email = $parent_row.children().eq(2).text();
        $phone = $this_row.find(".field-phone").text();
        $country_code = $this_row.find(".field-country").text();
        $plan_status = $this_row.find(".field-plan-status").text();
        $plan_type = $this_row.find(".field-plan-type").text();

        // inject data into the form
        $edit_modal.find('input[type="email"]').val($email);
        $edit_modal.find('input[name="first_name"]').val($first_name);
        $edit_modal.find('input[name="last_name"]').val($last_name);
        $edit_modal.find("#edited-type").val($type_to_edit);
        $edit_modal.find("#plan-status").val($plan_status);
        $edit_modal.find("#plan-type").val($plan_type);
        $edit_modal.find('input[name="phone"]').val($phone);
        $edit_modal.find('select[name="country"]').val($country_code);

        //show modal
        $edit_modal.modal("show");

        // prept data and call server script for DB action
        $edit_button.on("click", function (e) {
          e.preventDefault();
          $formData = $(this).closest("form").serializeArray();
          // console.log($formData);
          // manually push values from inputs injected into DOM into the array (holy shit I am coming up with magic!)
          $("#planWrapper select, #planWrapper input").each(function () {
            $formData.push({
              name: $(this).attr("id"),
              value: $(this).val(),
            });
            $formData.push({
              name: "id",
              value: $id_to_edit,
            });
          });
          $jsonData = {};
          $.each($formData, function () {
            $jsonData[this.name] = this.value;
          });
          $jsonString = JSON.stringify($jsonData);
          // console.log($jsonString);
          $.ajax({
            url: "./admin_scripts/admin_php/admin_edit.php",
            type: "POST",
            data: $jsonString,

            success: function (response) {
              console.log(response);
              if (response === "success") {
                $(".modal").modal("hide");
                $("#editSuccessModal").modal("show");
              } else {
                console.log("Errors in database update occurred!");
              }
            },
            error: function (response) {
              console.log(response);
            },
          });
        });

        break;
      case "movie":
        //target elements
        $edit_form = $("#movieEditForm");
        $edit_modal = $("#editMovieModal");
        $edit_button = $edit_form.find(".edit-button");

        //extract data from the page
        $this_row = $(this).closest(".expandable-table-extra");
        $parent_row = $(this).closest(".expandable-table-extra").prev();
        $title = $parent_row.children().eq(1).text();
        $release_date = $parent_row.children().eq(2).text();
        $director = $this_row.find(".field-director").text();
        $genre = $this_row.find(".field-genre").text();
        $language = $this_row.find(".field-language").text();
        $duration = $this_row.find(".field-duration").text();
        $duration_shortened = $duration.substring(
          0,
          $duration.lastIndexOf(":")
        );
        $hours = $duration_shortened.split(":")[0];
        $minutes = $duration_shortened.split(":")[1];
        $summary = $this_row.find(".field-summary").text();
        $link = $this_row.find(".field-link").text();

        // inject data into the form
        $edit_modal.find('input[name="title"]').val($title);
        $edit_modal.find('input[name="director"]').val($director);
        $edit_modal.find('input[name="genre"]').val($genre);
        $edit_modal
          .find('input[name="release_date"]')
          .val($release_date)
          .css("padding", "10px");
        $edit_modal.find('input[name="language"]').val($language);
        $edit_modal.find(".durationInput").val($duration);
        $edit_modal
          .find(".bfh-timepicker-toggle input")
          .val($duration_shortened);
        $edit_modal.find(".hour input").val($hours);
        $edit_modal.find(".minute input").val($minutes);
        $edit_modal.find('textarea[name="summary"]').val($summary);
        $edit_modal.find('input[name="link"]').val($link);
        $edit_modal.find("input[name='edited-type']").val($type_to_edit);

        $timeyButtonsEdit = $edit_form.find(
          ".bfh-timepicker-popover .bfh-number-btn"
        );
        $time_input_edit = $edit_form
          .find(".bfh-timepicker input")
          .eq(0)
          .toArray();
        $target_input_edit = $edit_form.find(".durationInput");

        $timeyButtonsEdit.on("click", function () {
          writeDurationIntoDOM($time_input_edit, $target_input_edit);
        });

        // show modal
        $edit_modal.modal("show");

        // prept data and call server script for DB action
        $edit_button.on("click", function (e) {
          e.preventDefault();

          $formData = $(this).closest("form").serializeArray();
          // console.log($formData);
          $formData.push({
            name: "id",
            value: $id_to_edit,
          });

          $jsonData = {};
          $.each($formData, function () {
            $jsonData[this.name] = this.value;
          });
          $jsonString = JSON.stringify($jsonData);
          console.log($jsonString);
          $.ajax({
            url: "./admin_scripts/admin_php/admin_edit.php",
            type: "POST",
            data: $jsonString,

            success: function (response) {
              console.log(response);
              if (response === "success") {
                $(".modal").modal("hide");
                $("#editSuccessModal").modal("show");
              } else {
                console.log("Errors in database update occurred!");
              }
            },
            error: function (response) {
              console.log(response);
            },
          });
        });

        break;

      case "show":
        //target elements
        $edit_form = $("#showEditForm");
        $edit_modal = $("#editShowModal");
        $edit_button = $edit_form.find(".edit-button");

        //extract data from the page
        $this_row = $(this).closest(".expandable-table-extra");
        $parent_row = $(this).closest(".expandable-table-extra").prev();
        $title = $parent_row.children().eq(1).text();
        $release_date = $parent_row.children().eq(2).text();
        $creator = $this_row.find(".field-creator").text();
        $genre = $this_row.find(".field-genre").text();
        $language = $this_row.find(".field-language").text();
        $seasons_string = $this_row.find(".field-seasons").text();
        $summary = $this_row.find(".field-summary").text();
        $link = $this_row.find(".field-link").text();

        // inject data into the form
        $edit_modal.find('input[name="title"]').val($title);
        $edit_modal.find('input[name="creator"]').val($creator);
        $edit_modal.find('input[name="genre"]').val($genre);
        $edit_modal
          .find('input[name="release_date"]')
          .val($release_date)
          .css("padding", "10px");
        $edit_modal.find('input[name="language"]').val($language);
        $edit_modal
          .find('input[name="seasons_json"]')
          .attr("type", "text")
          .val($seasons_string);
        $edit_modal.find('textarea[name="summary"]').val($summary);
        $edit_modal.find('input[name="link"]').val($link);
        $edit_modal.find("input[name='edited-type']").val($type_to_edit);

        // show modal
        $edit_modal.modal("show");

        $edit_button.on("click", function (e) {
          e.preventDefault();

          $formData = $(this).closest("form").serializeArray();
          // console.log($formData);
          $formData.push({
            name: "id",
            value: $id_to_edit,
          });

          $jsonData = {};
          $.each($formData, function () {
            $jsonData[this.name] = this.value;
          });
          $jsonString = JSON.stringify($jsonData);
          // console.log($jsonString);
          $.ajax({
            url: "./admin_scripts/admin_php/admin_edit.php",
            type: "POST",
            data: $jsonString,

            success: function (response) {
              console.log(response);
              if (response === "success") {
                $(".modal").modal("hide");
                $("#editSuccessModal").modal("show");
              } else {
                console.log("Errors in database update occurred!");
              }
            },
            error: function (response) {
              console.log(response);
            },
          });
        });

        break;
    }

    // $($edit_modal).modal("show");
  });
});
