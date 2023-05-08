<!DOCTYPE html>
<html lang="en">

<head>
  <title>WebFlix - Login</title>
  <link rel="icon" type="image/x-icon" href="resources/favicon.png">
  <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, shrink-to-fit=no"
    charset="utf-8">

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
    integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
    crossorigin="anonymous"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="js/datepicker_handler.js"></script>

  <script src="js/login.js"></script>

  <!--CSS -->
  <link href="css/StyleSheet.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>


  <?php include 'includes/top_bar.php';
  include 'includes/bottom_bar.html';
  include 'includes/common_modals.php';
  ?>


  <!-- Bootstrap Jumbotron -->
  <div class="jumbotron jumbotron-fluid" id="login-jumbo">
    <img src="resources/login_background.png" id="login-background">
    <div class="container" id="login-container">
      <small id="emailHelp" class="form-text text-muted"
        style="color:#FF6464 !important; display:inline !important;">*</small>
      <small id="emailHelp" class="form-text text-muted" style="display:inline !important;"> Required
        fields.</small><br>
      <form action="includes/login_action.php" method="post" id="loginForm">
        <div class="form-group">
          <label for="inputemail">Email</label>
          <input type="text" class="form-control required-input" placeholder="*" name="email">
        </div>
        <div class="form-group">
          <label for="inputpassword">Password</label>
          <input type="password" class="form-control required-input" placeholder="*" name="pass">
        </div>
        <div style="display: flex; flex-direction: row; gap: 5%;">
          <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Login"
            style="width: fit-content; height: fit-content; background-color: #000 !important;  border-color: #ff5800 !important; color: #ff5800 !important;">
          <button type="button" class="btn btn-dark btn-lg btn-block movieCardButton overlay-play-btn"
            style="width: fit-content !important; background-color: #000 !important; margin: 0 !important;"
            data-toggle="modal" data-target="#registerModal">Register
            if no accout</button>
          <button type="button" class="btn btn-dark btn-lg btn-block red-button"
            style="width: fit-content !important; background-color: #000 !important; margin: 0 !important;"
            data-toggle="modal" data-target="#forgotPassModal">Forgot my password</button>
        </div>
        <div class="container" id="jumboContainer"> <!-- container to write php response into -->
        </div>
      </form>
    </div>
  </div>


  <div style="height:105px;"></div>

  <div class="modal" id="forgotPassModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h2 class="modal-title" id="forgot-password-modal-label">Forgot Password</h2><br><br>
        </div>
        <form id="forgotPassForm">

          <div class="modal-body">
            <div class="header">
              <h4>Confirm these to change password</h4>
              <small class="form-text text-muted formHelp"
                style="color:#FF6464 !important; display:inline !important;">*</small>
              <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                fields.</small><br><br>

            </div>
            <div class="row align-items-end">
              <div class="col-md-6">
                <div class="form-group text-center">
                  <label for="inputemail">Email</label>
                  <input type="email" name="email" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['email']))
                    echo $_POST['email']; ?>">
                </div>
                <div class="form-group text-center" style="width: 100% !important; margin-top: 10% !important;">
                  <label for="inputphone">Phone number</label>
                  <input title="Provide an 11 digits long valid number." type="text" name="phone"
                    class="form-control required-input restrict-to-nums" placeholder="*" maxlength="11" minlength="11"
                    value="<?php if (isset($_POST['phone']))
                      echo $_POST['phone']; ?>">
                </div>
              </div>
              <div class="col-md-6 pr-3">
                <div class="row" style="display:flex; flex-direction: column;">
                  <div class="py-4 text-center"><i class="fa fa-calendar" style="font-size: 105px;"></i></div>
                  <!-- Date Picker Input -->
                  <div class="form-group text-center mr-3">
                    <label for="inputdob">Date of birth</label>
                    <div class="datepicker date input-group p-0">
                      <input type="text" name="dob" placeholder="*"" class=" form-control required-input dateOfBirth"
                        value="<?php if (isset($_POST['dob']))
                          echo $_POST['dob']; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="submit" class="btn movieCardButton overlay-play-btn">Submit</button>
            <button type="button" class="btn movieCardButton overlay-play-btn" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="forgotResponse">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" class="mr-auto">The following errors occured:</h2>
        </div>
        <div class="modal-body" id="forgotRes"></div>
        <div class="modal-footer">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit"
            onClick="$('.modal').modal('hide');$('#forgotPassModal').modal('show');">Try again</button>
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
            aria-label="Close" style="width: 200px;">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- password update form modal -->
  <div class="modal" id="passUpdModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h2 class="modal-title">Change your password.</h2>
        </div> <!-- closing modal-header -->

        <div class="modal-body">
          <div class="row">
            <div class="col-sm">
              <div class="card mb-3">
                <div class="card-body form-card">

                  <small id="emailHelp" class="form-text text-muted"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                  <small id="emailHelp" class="form-text text-muted" style="display:inline !important;"> Required
                    fields.</small><br>

                  <form id="passUpdForm"><br>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="inputpass1">Create New Password</label>
                          <input type="password" name="pass1" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['pass1']))
                            echo $_POST['pass1']; ?>">
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                          <label for="inputpass2">Confirm New Password</label>
                          <input type="password" name="pass2" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['pass2']))
                            echo $_POST['pass2']; ?>">
                        </div>
                        <input type="hidden" name="id" class="form-control required-input" value="<?php if (isset($_POST['id']))
                          echo $_POST['id']; ?>">
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <input type="submit" class="btn movieCardButton overlay-play-btn modal-submit" value="Update">
                      <input type="submit" class="btn movieCardButton overlay-play-btn modal-submit"
                        data-dismiss="modal" value="Close">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>

  <!-- pass success modal -->
  <div class="modal" id="passUpdOKModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" class="mr-auto">Password updated!</h2>
        </div>
        <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
          <p>You can now sign in again.</p>

          <div class="row justify-content-center">
            <button type="button" class="btn movieCardButton overlay-play-btn"
              onClick="window.location.replace('includes/logout.php')">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- pass error modal -->
  <div class="modal" id="pupdErrModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" class="mr-auto">The following errors occured:</h2>
        </div>
        <div class="modal-body" id="errMsgPass"></div>
        <div class="modal-footer">
          <div class="row justify-content-center">
            <button type="button" class="btn movieCardButton overlay-play-btn modal-submit"
              onClick="$('#pupdErrModal').modal('hide');$('#passUpdModal').modal('show');">Try
              again</button>
            <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
              aria-label="Close">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <?php include 'includes/footer.html' ?>

</body>

</html>