<!-- //! add a user group of modals -->

<!-- //? add a user form modal -->
<div class="modal" id="addUserModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add a user</h2>
                <small id="emailHelp" class="form-text text-muted"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                <small id="emailHelp" class="form-text text-muted" style="display:inline !important;"> Required
                    fields.</small>
            </div> <!-- closing modal-header -->
            <div class="modal-body">
                <form id="userAddForm">
                    <div class="form-group">
                        <label for="inputemail">Email</label>
                        <input type="email" name="email" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['email']))
                            echo $_POST['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputfirst_name">First Name</label>
                        <input type="text" name="first_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['first_name']))
                            echo $_POST['first_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputlast_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['last_name']))
                            echo $_POST['last_name']; ?>">
                    </div>
                    <div class="row" style="display: flex; justify-content: space-evenly;">
                        <div class="container" id="datepickerWrapper">
                            <div class="py-4 text-left"><i class="fa fa-calendar"></i>
                            </div>
                            <!-- Date Picker Input -->
                            <div class="form-group">
                                <label for="inputdob">Date of birth</label>
                                <div class="datepicker date input-group">
                                    <input type="text" name="dob" placeholder="*"" class=" form-control required-input"
                                        id="dateOfBirth" value="<?php if (isset($_POST['dob']))
                                            echo $_POST['dob']; ?>">
                                </div>
                            </div><!-- End Date Picker Input -->
                        </div>
                        <div class="col" style="margin-right: 15px;">
                            <div class="form-group">
                                <label for="inputpass1">Create New Password</label>
                                <input type="password" name="pass1" class="form-control required-input" placeholder="*"
                                    value="<?php if (isset($_POST['pass1']))
                                        echo $_POST['pass1']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputpass2">Confirm Password</label>
                                <input type="password" name="pass2" class="form-control required-input" placeholder="*"
                                    value="<?php if (isset($_POST['pass2']))
                                        echo $_POST['pass2']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputphone">Phone number</label>
                                <input title="Provide an 11 digits long valid number." type="text" name="phone"
                                    class="form-control required-input restrict-to-nums" placeholder="*" maxlength="11"
                                    minlength="11" value="<?php if (isset($_POST['phone']))
                                        echo $_POST['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputcountry">Select your country</label><span>
                                    <p class="country-star">*</p>
                                    <select class="form-control bfh-countries" name="country" value="<?php if (isset($_POST['country']))
                                        echo $_POST['country']; ?>">
                                </span>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Add this user">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- //? add a user  success modal -->
<div class="modal" id="addUserModalOK">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" class="mr-auto">User added</h2>
            </div>
            <div class="modal-footer">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-info"
                        onClick="window.location.reload(); $('input,select,textarea').val('');"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- //? add a user  error modal -->
<div class="modal" id="addUserModalErr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" class="mr-auto">The following errors occured:</h2>
            </div>
            <div class="modal-body" id="errMsg"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    onClick="$('#addUserModalErr').modal('hide');$('#addUserModal').modal('show');">Try again</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- //! add a movie group of modals -->

<!-- //? add a movie form modal -->
<div class="modal" id="addMovieModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add a movie</h2>
                <small id="emailHelp" class="form-text text-muted"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                <small id="emailHelp" class="form-text text-muted" style="display:inline !important;"> Required
                    fields.</small><br><br>
            </div> <!-- closing modal-header -->
            <div class="modal-body">
                <form id="movieAddForm">
                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['title']))
                            echo $_POST['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDirector">Director</label>
                        <input type="text" name="director" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['director']))
                            echo $_POST['director']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputGenre">Genre</label>
                        <input type="text" name="genre" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['genre']))
                            echo $_POST['genre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputReleaseDate">Release Date</label>
                        <p class="country-star">*</p>
                        <input type="date" name="release_date" class="form-control required-input" placeholder="*"
                            value="<?php if (isset($_POST['release_date']))
                                echo $_POST['release_date']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputLanguage">Language</label>
                        <input type="text" name="language" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['language']))
                            echo $_POST['language']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDuration">Duration</label>
                        <input type="hidden" name="duration" class="form-control required-input durationInput"
                            placeholder="*" value="<?php if (isset($_POST['language']))
                                echo $_POST['duration']; ?>">
                        <p class="country-star" style="z-index: 10; transform: translate(18px, -6px);">*</p>
                        <div class="bfh-timepicker" data-time="00:00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSummary">Summary</label>
                        <textarea name="summary" class="form-control required-input" placeholder="*" rows="3"><?php if (isset($_POST['summary']))
                            echo $_POST['summary']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputLink">Link</label>
                        <input type="text" name="link" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['link']))
                            echo $_POST['link']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="edited-type" value="">
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Add this movie">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- //? add moviesuccess modal -->
<div class="modal" id="addMovieModalOK">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" class="mr-auto">Movie added successfuly</h2>
            </div>
            <div class="modal-footer">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-info"
                        onClick="window.location.reload(); $('input,select,textarea').val('');"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- //! add a show group of modals -->

<!-- //? add a show form modal -->
<div class="modal" id="addShowModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add a show</h2>
                <small id="emailHelp" class="form-text text-muted"
                    style="color:#FF6464 !important; display:inline !important;">*</small>
                <small id="emailHelp" class="form-text text-muted" style="display:inline !important;"> Required
                    fields.</small><br><br>
            </div> <!-- closing modal-header -->
            <div class="modal-body">
                <form id="showAddForm">
                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['title']))
                            echo $_POST['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDirector">Creator / Showrunner</label>
                        <input type="text" name="creator" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['creator']))
                            echo $_POST['creator']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputGenre">Genre</label>
                        <input type="text" name="genre" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['genre']))
                            echo $_POST['genre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputReleaseDate">Release Date</label>
                        <p class="country-star">*</p>
                        <input type="date" name="release_date" class="form-control required-input" placeholder="*"
                            value="<?php if (isset($_POST['release_date']))
                                echo $_POST['release_date']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputLanguage">Language</label>
                        <input type="text" name="language" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['language']))
                            echo $_POST['language']; ?>">
                    </div>
                    <div class="form-group" id="reloadableBFHparent">
                        <label for="seasons">Select number of seasons:</label>
                        <input type="text" class="form-control bfh-number required-input" value="1" data-min="1"
                            data-max="15" name="seasons" id="seasonsInput">
                        <div id="season-inputs"></div>
                    </div>
                    <div class="form-group">
                        <label for="seasons_json" style="display: none;">Edit seasons data:</label>
                        <input type="hidden" name="seasons_json" id="seasons-json" class="form-control required-input">
                    </div>
                    <div class="form-group">
                        <label for="inputSummary">Summary</label>
                        <textarea name="summary" class="form-control required-input" placeholder="*" rows="3"><?php if (isset($_POST['summary']))
                            echo $_POST['summary']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputLink">Link</label>
                        <input type="text" name="link" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['link']))
                            echo $_POST['link']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="edited-type" value="">
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Add this Show">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">

                </form>
            </div>
        </div>
    </div>
</div>

<!-- //? add show ok modal -->
<div class="modal" id="addShowModalOK">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" class="mr-auto">Show added successfuly</h2>
            </div>
            <div class="modal-footer">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-info"
                        onClick="window.location.reload(); $('input,select,textarea').val('');"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- //! delete group of modals -->

<!-- //? delete form modal -->
<div class="modal fade" id="deleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="deleteUserModalLabel">Are you sure you want to delete this?</h2>
            </div>
            <form id="deleteForm">
                <div class="modal-body">
                    <input type="hidden" name="item-to-delete" id="item-to-delete" value="">
                    <input type="hidden" name="item-id" id="item-id" value="">
                    <div style="display: flex; justify-content: flex-start">
                        <p>Are you sure you want to delete&nbsp;</p>
                        <p id="thingToDelete"></p>
                        <p>?</p>
                    </div>
                    <div style="display: flex; justify-content: flex-start">
                        <p>ID:</p>
                        <p id="idToDelete"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Delete">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- //? delete success modal -->
<div class="modal" id="deleteSuccessModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" class="mr-auto">Deletion successful</h2>
            </div>
            <div class="modal-footer">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-info" onClick="window.location.reload();"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- //! edition group of modals -->

<!-- //? edit a user form modal -->
<div class="modal" id="editUserModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit a user</h2>
            </div> <!-- closing modal-header -->
            <div class="modal-body">
                <form id="userEditForm">
                    <div class="form-group">
                        <label for="inputemail">Email</label>
                        <input type="email" name="email" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['email']))
                            echo $_POST['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputfirst_name">First Name</label>
                        <input type="text" name="first_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['first_name']))
                            echo $_POST['first_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputlast_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['last_name']))
                            echo $_POST['last_name']; ?>">
                    </div>
                    <div class="row" style="display: flex; justify-content: space-evenly;">
                        <div class="container" id="planWrapper">
                            <div class="form-group">
                                <label for="plan-status">Plan status:</label>
                                <select class="form-control" id="plan-status">
                                    <option value="1">1</option>
                                    <option value="0">0</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="plan-type">Plan type:</label>
                                <select class="form-control" id="plan-type">
                                    <option value="m1">m1</option>
                                    <option value="m2">m2</option>
                                    <option value="m3">m3</option>
                                    <option value="y1">y1</option>
                                    <option value="y2">y2</option>
                                    <option value="y3">y3</option>
                                    <option value="none">none</option>
                                </select>
                                <input type="hidden" id="edited-type" value="">
                            </div><!-- End Date Picker Input -->
                        </div>
                        <div class="col" style="margin-right: 15px;">
                            <div class="form-group">
                                <label for="inputphone">Phone number</label>
                                <input title="Provide an 11 digits long valid number." type="text" name="phone"
                                    class="form-control required-input restrict-to-nums" placeholder="*" maxlength="11"
                                    minlength="11" value="<?php if (isset($_POST['phone']))
                                        echo $_POST['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputcountry">Select your country</label><span>
                                    <select class="form-control bfh-countries" name="country" value="<?php if (isset($_POST['country']))
                                        echo $_POST['country']; ?>">
                                </span>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit edit-button"
                        value="Edit this user">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- //? edit a movie form modal -->
<div class="modal" id="editMovieModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit a movie</h2>
            </div> <!-- closing modal-header -->
            <div class="modal-body">
                <form id="movieEditForm">
                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['title']))
                            echo $_POST['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDirector">Director</label>
                        <input type="text" name="director" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['director']))
                            echo $_POST['director']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputGenre">Genre</label>
                        <input type="text" name="genre" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['genre']))
                            echo $_POST['genre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputReleaseDate">Release Date</label>
                        <input type="date" name="release_date" class="form-control required-input" placeholder="*"
                            value="<?php if (isset($_POST['release_date']))
                                echo $_POST['release_date']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputLanguage">Language</label>
                        <input type="text" name="language" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['language']))
                            echo $_POST['language']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDuration">Duration</label>
                        <input type="hidden" name="duration" class="form-control required-input durationInput"
                            placeholder="*" value="<?php if (isset($_POST['language']))
                                echo $_POST['duration']; ?>">
                        <div class="bfh-timepicker" data-time="00:00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSummary">Summary</label>
                        <textarea name="summary" class="form-control required-input" placeholder="*" rows="3"><?php if (isset($_POST['summary']))
                            echo $_POST['summary']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputLink">Link</label>
                        <input type="text" name="link" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['link']))
                            echo $_POST['link']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="edited-type" value="">
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit edit-button"
                        value="Edit this movie">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- //? edit a show form modal -->
<div class="modal" id="editShowModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit a show</h2>
            </div> <!-- closing modal-header -->
            <div class="modal-body">
                <form id="showEditForm">
                    <div class="form-group">
                        <label for="inputTitle">Title</label>
                        <input type="text" name="title" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['title']))
                            echo $_POST['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputDirector">Creator / Showrunner</label>
                        <input type="text" name="creator" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['creator']))
                            echo $_POST['creator']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputGenre">Genre</label>
                        <input type="text" name="genre" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['genre']))
                            echo $_POST['genre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputReleaseDate">Release Date</label>
                        <input type="date" name="release_date" class="form-control required-input" placeholder="*"
                            value="<?php if (isset($_POST['release_date']))
                                echo $_POST['release_date']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputLanguage">Language</label>
                        <input type="text" name="language" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['language']))
                            echo $_POST['language']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="seasons_json">Edit seasons data:</label>
                        <input type="hidden" name="seasons_json" id="seasons-json" class="form-control required-input">
                    </div>
                    <div class="form-group">
                        <label for="inputSummary">Summary</label>
                        <textarea name="summary" class="form-control required-input" placeholder="*" rows="3"><?php if (isset($_POST['summary']))
                            echo $_POST['summary']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputLink">Link</label>
                        <input type="text" name="link" class="form-control required-input" placeholder="*" value="<?php if (isset($_POST['link']))
                            echo $_POST['link']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="edited-type" value="">
                    </div>
                    <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit edit-button"
                        value="Edit this Show">
                    <input type="button" class="btn btn-danger btn-lg btn-block modal-submit" data-dismiss="modal"
                        value="Close">

                </form>
            </div>
        </div>
    </div>
</div>


<!-- //? edit success modal -->
<div class="modal" id="editSuccessModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" class="mr-auto">Details updated</h2>
            </div>
            <div class="modal-footer">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-info"
                        onClick="window.location.reload(); $('input,select,textarea').val('');"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>