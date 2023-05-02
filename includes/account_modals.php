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
                    </div>
                  </div>
                  <div class="row justify-content-center">
                    <input type="submit" class="btn movieCardButton overlay-play-btn modal-submit" value="Update">
                    <input type="submit" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
                      value="Close">
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


<!-- Deletion modal -->
<div class="modal" id="deletionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">Account deletion.</h2>
      </div>
      <div class="modal-body">Are you absolutely sure?</div>
      <div class="modal-footer">
        <div class="row justify-content-center">
          <button type="button" class="btn movieCardButton overlay-play-btn" style="border-color: #FF6464 !important;
  color: #FF6464 !important;" onClick="window.location.href='./includes/delete_action.php'">Yes, delete.</button>
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
            aria-label="Close">No, keep it!</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- change first name form modal -->
<div class="modal edit-details-modal" id="editFirstNameModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0px !important;">
        <h4>Change your name.</h4>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2" style="padding-top: 0px !important;">
        <div class="col-md">
          <div class="card mb-3">
            <div class="card-body form-card dirtyBootstrapOverrideFuckingHateIt">
              <form class="edit-details-form">
                <div class="header">
                  <small class="form-text text-muted formHelp"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                  <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                    fields.</small><br>
                </div><br>
                <div class="row">
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="inputfirst_name">First Name</label>
                      <input type="text" name="first_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['first_name']))
                        echo $_POST['first_name']; ?>">
                      <input type="hidden" name="form_id" value="first_name">
                    </div>
                  </div>
                </div>
                <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Change first name">
                <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal"
                  value="Close">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- change last name form modal -->
<div class="modal edit-details-modal" id="editLastNameModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0px !important;">
        <h4>Change your name.</h4>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2" style="padding-top: 0px !important;">
        <div class="col-md">
          <div class="card mb-3">
            <div class="card-body form-card dirtyBootstrapOverrideFuckingHateIt">
              <form class="edit-details-form">
                <div class="header">
                  <small class="form-text text-muted formHelp"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                  <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                    fields.</small><br>
                </div><br>
                <div class="row">
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="inputlast_name">Last Name</label>
                      <input type="text" name="last_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['first_name']))
                        echo $_POST['last_name']; ?>">
                      <input type="hidden" name="form_id" value="last_name">
                    </div>
                  </div>
                </div>
                <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Change last name">
                <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal"
                  value="Close">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- change email form modal -->
<div class="modal edit-details-modal" id="editEmailModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0px !important;">
        <h4>Change your email.</h4>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2" style="padding-top: 0px !important;">
        <div class="col-md">
          <div class="card mb-3">
            <div class="card-body form-card dirtyBootstrapOverrideFuckingHateIt">
              <form class="edit-details-form">
                <div class="header">
                  <small class="form-text text-muted formHelp"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                  <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                    fields.</small><br>
                </div><br>
                <div class="row">
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="inputemail">Email</label>
                      <input type="email" name="email" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['email']))
                        echo $_POST['email']; ?>">
                      <input type="hidden" name="form_id" value="email">
                    </div>
                  </div>
                </div>
                <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Change email">
                <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal"
                  value="Close">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- change phone form modal -->
<div class="modal edit-details-modal" id="editPhoneModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0px !important;">
        <h4>Change your phone number.</h4>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2" style="padding-top: 0px !important;">
        <div class="col-md">
          <div class="card mb-3">
            <div class="card-body form-card dirtyBootstrapOverrideFuckingHateIt">
              <form class="edit-details-form">
                <div class="header">
                  <small class="form-text text-muted formHelp"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                  <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                    fields.</small><br>
                </div><br>
                <div class="row">
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="inputphone">Phone number</label>
                      <input title="Provide an 11 digits long valid number." type="text" name="phone"
                        class="form-control required-input restrict-to-nums" placeholder="*" maxlength="11"
                        minlength="11" value="<?php if (isset($_POST['phone']))
                          echo $_POST['phone']; ?>">
                      <input type="hidden" name="form_id" value="phone">
                    </div>
                  </div>
                </div>
                <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Change phone number">
                <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal"
                  value="Close">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- change country modal -->
<div class="modal edit-details-modal" id="editCountryModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0px !important;">
        <h4>Change your country of residence.</h4>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2" style="padding-top: 0px !important;">
        <div class="col-md">
          <div class="card mb-3">
            <div class="card-body form-card dirtyBootstrapOverrideFuckingHateIt">
              <form class="edit-details-form">
                <div class="header">
                  <small class="form-text text-muted formHelp"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                  <small class="form-text text-muted formHelp" style="display:inline !important;"> Required
                    fields.</small><br>
                </div><br>
                <div class="row">
                  <div class="col">
                    <div class="form-group text-center">
                      <label for="inputcountry">Select your country</label><span>
                        <p class="country-star">*</p>
                        <select class="form-control bfh-countries" name="country" value="<?php if (isset($_POST['country']))
                          echo $_POST['country']; ?>"></select>
                      </span>
                      <input type="hidden" name="form_id" value="country">
                    </div>
                  </div>
                </div>
                <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Change country">
                <input type="button" class="btn btn-dark btn-lg btn-block modal-submit" data-dismiss="modal"
                  value="Close">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Change success modal -->
<div class="modal" id="editOKModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">Success!</h2>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
        <p>Your changes have been applied to your account.</p>
        <div class="row justify-content-center">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit"
            onClick="window.location.reload();">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- edit error modal -->
<div class="modal" id="editErrModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">The following errors occured:</h2>
      </div>
      <div class="modal-body" id="editErrMsg"></div>
      <div class="modal-footer">
        <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" id="try_again_btn">Try
          again</button>
        <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
          aria-label="Close" style="width: 200px;">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Plan update modal -->
<div class="modal" id="subOKModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h2 class="modal-title" class="mr-auto">Successully subscribed!</h2>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
        <div class="row justify-content-center">
          <p>Your new plan:</p>
        </div>
        <div class="row justify-content-center">
          <h2 id="new-plan-title" class="plan-name text-center"></h2>
        </div>
        <div class="row justify-content-center">
          <p>View its details on your profile page.</p>
        </div>
        <div class="row justify-content-center">
          <p class="font-weight-bold">Happy watching!</p>
        </div>
        <div class="row justify-content-center text-center">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-close" data-dismiss="modal"
            aria-label="Close" style="width: 200px;">Close</button>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
</div>

<!-- sub cancelled modal -->

<div class="modal" id="subCancelledModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">Puchase cancelled</h2>
      </div>
      <div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
        <p>You can still select another subscription.</p>

        <div class="row justify-content-center">
          <button type="button" class="btn movieCardButton overlay-play-btn modal-close"
            data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Deletion modal -->
<div class="modal" id="cancelModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" class="mr-auto">Cancel your plan.</h2>
      </div>
      <div class="modal-body">Are you absolutely sure?</div>
      <div class="modal-footer">
        <div class="row justify-content-center">
          <button type="button" id="cancel-sub-btn" class="btn movieCardButton overlay-play-btn" style="border-color: #FF6464 !important;
  color: #FF6464 !important;">Yes, cancel.</button>
          <button type="button" class="btn movieCardButton overlay-play-btn modal-submit" data-dismiss="modal"
            aria-label="Close">No, keep it!</button>
        </div>
      </div>
    </div>
  </div>
</div>