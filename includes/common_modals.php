<!-- bootstrap datepicker plugin -->
<!-- references & documentation: https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
<!-- implementation that was the inspiration: https://bootstrapious.com/p/bootstrap-datepicker -->
<!-- imports source: https://cdnjs.com/libraries/bootstrap-datepicker -->

<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- src https://bootstrapformhelpers.com/country/ -->
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
<!-- own scripts -->
<script type="text/javascript" src="js/datepicker_handler.js"></script>
<script type="text/javascript" src="js/reg.js"></script>

<!-- registraion form modal -->
<div class="modal" id="registerModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Register with us</h2>
      </div> <!-- closing modal-header -->

      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
        <div class="row">
          <div class="col-sm">
            <div class="card mb-3">
              <div class="card-body form-card dirtyBootstrapOverrideFuckingHateIt">
                <form id="regForm"><br>
                  <div id="firstFormWrapper">
                    <div class="header">
                      <h4>Add your account details.</h4>
                      <small class="form-text text-muted formHelp"
                        style="color:#FF6464 !important; display:inline !important;">*</small>
                      <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                        fields.</small><br>

                    </div><br>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="inputemail">Email</label>
                          <input type="email" name="email" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['email']))
                            echo $_POST['email']; ?>">
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group text-center">
                          <label for="inputfirst_name">First Name</label>
                          <input type="text" name="first_name" class="form-control required-input" placeholder="*"
                            value="<?php if (isset($_POST['first_name']))
                              echo $_POST['first_name']; ?>">
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group text-right">
                          <label for="inputlast_name">Last Name</label>
                          <input type="text" name="last_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['last_name']))
                            echo $_POST['last_name']; ?>">
                        </div>
                      </div>
                    </div>

                    <small id="emailHelp" class="form-text text-muted">We will NEVER share your email with any third
                      party.</small><br>

                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="inputpass1">Create New Password</label>
                          <input type="password" name="pass1" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['pass1']))
                            echo $_POST['pass1']; ?>">
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group text-right">
                          <label for="inputpass2">Confirm Password</label>
                          <input type="password" name="pass2" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['pass2']))
                            echo $_POST['pass2']; ?>">
                        </div>
                      </div>
                    </div>


                  </div>
                  <div id="secondFormWrapper" style="display:none;">
                    <div class="header">
                      <h4>Add your account details.</h4>
                      <small class="form-text text-muted formHelp"
                        style="color:#FF6464 !important; display:inline !important;">*</small>
                      <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                        fields.</small><br>

                    </div><br>
                    <div class="row">
                      <div class="container" id="datepickerWrapper"
                        style="display: flex; flex-wrap:wrap;  margin:auto;">
                        <div class="row">
                          <div class="col">
                            <div class="col mx-auto">
                              <div class="py-4 text-left"><i class="fa fa-calendar" style="font-size: 105px;"></i></div>

                              <!-- Date Picker Input -->
                              <div class="form-group text-left" style="width: 100%;">
                                <label for="inputdob">Date of birth</label>
                                <div class="datepicker date input-group p-0">
                                  <input type="text" name="dob" placeholder="*"" class=" dateOfBirth form-control
                                    required-input" value="<?php if (isset($_POST['dob']))
                                      echo $_POST['dob']; ?>">
                                </div>
                              </div><!-- End Date Picker Input -->

                            </div>
                          </div>
                          <div class="col">
                            <div class="row justify-content-end" id="thisCrappyRow"
                              style="margin-right: 11px; width: 99%; height: 64%;  float: right;">
                              <div class="form-group text-right"
                                style="width: 100% !important; margin-top: 10% !important;">
                                <label for="inputphone">Phone number</label>
                                <input title="Provide an 11 digits long valid number." type="text" name="phone"
                                  class="form-control required-input restrict-to-nums" placeholder="*" maxlength="11"
                                  minlength="11" value="<?php if (isset($_POST['phone']))
                                    echo $_POST['phone']; ?>">
                              </div>
                            </div>
                            <div class="row align-items-end" style=" margin-right: 11px; float: right; bottom: 0;">
                              <div class="form-group text-right">
                                <label for="inputcountry">Select your country</label><span>
                                  <p class="country-star">*</p>
                                  <select class="form-control bfh-countries" name="country" value="<?php if (isset($_POST['country']))
                                    echo $_POST['country']; ?>">
                                </span>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              </div>
              <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" value="Continue"
                id="switchRegistrationModals">
              <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Sign up" id="signUp"
                style="display:none;">
              <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" value="Go back"
                id="goBackRegisterModals" style="display:none;">
              <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal"
                value="Close">
              </form>
              <br>
              <p>By creating an account you agree to our <a href="#">Terms & Privacy</a> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



<!-- Register success modal -->
<div class="modal" id="regOKModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">Successful registration!</h2>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
        <p>You can now sign in or pick your subscription plan.</p>
        <div class="row justify-content-center">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit"
            onClick="window.location.replace('login.php')" style="width: 200px;">Sign in</button>
        </div>
        <p></p>
        <div class="row justify-content-center">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" style="width: 200px;"
            data-dismiss="modal" aria-label="Close">Later</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Register error modal -->
<div class="modal" id="regErrModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">The following errors occured:</h2>
      </div>
      <div class="modal-body" id="errMsg"></div>
      <div class="modal-footer">
        <button type="button" class="btn movieCardButton overlay-play-btn modal-submit"
          onClick="$('#regErrModal').modal('hide');$('#registerModal').modal('show');">Try again</button>
        <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
          aria-label="Close" style="width: 200px;">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Logout modal -->
<div class="modal" id="logoutModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">You are now logged out.</h2>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
        <p>Come back soon!</p>
        <div class="row justify-content-center">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" class="close"
            data-dismiss="modal" aria-label="Close">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>