<!DOCTYPE html>
<html lang="en">

<head>

  <!-- admin template src https://codepen.io/satjeet_sandhu/pen/oGJQKd -->

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Webflix Admin</title>
  <link rel="icon" type="image/x-icon" href="./admin_assets/favicon.png">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./admin_css/AdminStyleSheet.css" />

  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>


  <script type="text/javascript" src="./admin_scripts/admin_js/datepicker_handler.js"></script>


  <script type="text/javascript" src="./admin_scripts/admin_js/admin_page.js"></script>

</head>

<body>
  <?php include './admin_scripts/admin_php/admin_data.php'; ?>
  <!--header-->
  <div class="page-header">
    <div class="col-sm-10">
      <div id="homelink" style="display:flex">
        <span class="webflix-logo"><a href="../index.php"><img alt="webflix-logo" src="admin_assets/wf_admin_logo.png"
              style="height: 50px;"></a></span>
        <h2> ADMIN DASHBOARD</h2>
        <span class="glyphicon glyphicon-cog" id="gear"></span>
      </div>
    </div>
    <div class="col-md-2 ">
      <div class="dropdown create">
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="true">
          Add new
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a type="button" data-toggle="modal" data-target="#addUserModal">Add a user</a></li>
          <li><a type="button" data-toggle="modal" data-target="#addMovieModal">Add a movie</a></li>
          <li><a type="button" data-toggle="modal" data-target="#addShowModal">Add a show</a></li>
        </ul>
      </div>
    </div>
  </div>



  <!-- //! main section-->
  <div class="container" id="page-container">
    <div class="row">
      <div class="col-md-3" id="nav-list">
        <div class="list-group animated zoomIn">
          <button id="nav-dashboard" class="list-group-item nav-title">
            <span class="glyphicon glyphicon-cog"></span> Overview
          </button>
          <button id="nav-users" class="list-group-item"><span class="badge">
              <?php echo $user_count; ?>
            </span><span class="glyphicon glyphicon-list-alt"></span> Users</button>
          <button id="nav-movies" class="list-group-item"><span class="badge">
              <?php echo $movie_count; ?>
            </span><span class="glyphicon glyphicon-pencil"></span> Movies</button>
          <button id="nav-shows" class="list-group-item"><span class="badge">
              <?php echo $show_count; ?>
            </span><span class="glyphicon glyphicon-user"></span> Shows</button>

        </div>
      </div>
      <div class="col-md-9 updating-col">
        <section id="main">
          <div class="panel panel-default animated zoomIn">
            <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Website Overview</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-user"></span>
                    <?php echo $user_count; ?>
                  </h2>
                  <h4>Users</h4>
                </div>
              </div>
              <div class="col-md-3 dash-box">
                <div class="well">
                  <h2><span class="glyphicon glyphicon-list-alt"></span>
                    <?php echo $movie_count; ?>
                  </h2>
                  <h4>Movies</h4>
                </div>
              </div>
              <div class="col-md-3 dash-box">
                <div class="well">
                  <h2><span class="glyphicon glyphicon-pencil"></span>
                    <?php echo $show_count; ?>
                  </h2>
                  <h4>Shows</h4>
                </div>
              </div>
              <div class="col-md-3 dash-box">
                <div class="well">
                  <h2><span class="glyphicon glyphicon-stats"></span>
                    <?php echo $review_count; ?>
                  </h2>
                  <h4>Reviews</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default animated zoomIn">
            <!-- Default panel contents -->
            <div class="panel-heading main-color-bg">Latest Users</div>
            <div class="panel-body">
              <!-- Table -->
              <table class="table table-striped table-hover">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Joined</th>
                </tr>
                <tr>
                  <td>
                    <?php echo $recent_users[0]->name; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[0]->email; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[0]->reg_date; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $recent_users[1]->name; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[1]->email; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[1]->reg_date; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $recent_users[2]->name; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[2]->email; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[2]->reg_date; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $recent_users[3]->name; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[3]->email; ?>
                  </td>
                  <td>
                    <?php echo $recent_users[3]->reg_date; ?>
                  </td>
                </tr>

              </table>
            </div>
          </div>
          <div class="panel panel-default animated zoomIn">
            <!-- Default panel contents -->
            <div class="panel-heading main-color-bg">Top Movies</div>
            <div class="panel-body">
              <!-- Table -->
              <table class="table table-striped table-hover">
                <tr>
                  <th>Title</th>
                  <th>Genre</th>
                  <th>Reviews</th>
                  <th>Average</th>
                </tr>
                <tr>
                  <td>
                    <?php echo $movies_stats[0]->title; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[0]->genre; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[0]->count; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[0]->average_rating; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $movies_stats[1]->title; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[1]->genre; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[1]->count; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[1]->average_rating; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $movies_stats[2]->title; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[2]->genre; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[2]->count; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[2]->average_rating; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $movies_stats[3]->title; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[3]->genre; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[3]->count; ?>
                  </td>
                  <td>
                    <?php echo $movies_stats[3]->average_rating; ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="panel panel-default animated zoomIn">
            <!-- Default panel contents -->
            <div class="panel-heading main-color-bg">Top Shows</div>
            <div class="panel-body">
              <!-- Table -->
              <table class="table table-striped table-hover">
                <tr>
                  <th>Title</th>
                  <th>Genre</th>
                  <th>Reviews</th>
                  <th>Average</th>
                </tr>
                <tr>
                  <td>
                    <?php echo $shows_stats[0]->title; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[0]->genre; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[0]->count; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[0]->average_rating; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $shows_stats[1]->title; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[1]->genre; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[1]->count; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[1]->average_rating; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $shows_stats[2]->title; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[2]->genre; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[2]->count; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[2]->average_rating; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $shows_stats[3]->title; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[3]->genre; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[3]->count; ?>
                  </td>
                  <td>
                    <?php echo $shows_stats[3]->average_rating; ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </section>


        <!-- //! users section -->
        <section id="users">
          <div class="container user-table table-responsive animated fadeInDown">
            <table class="table table-condensed">
              <thead>
                <tr class="main-color-bg">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>

                <?php include('./admin_scripts/admin_php/admin_user_data.php') ?>

              </tbody>
            </table>
          </div>
        </section>


        <!-- //! movies section -->

        <section id="movies">
          <div class="container user-table table-responsive animated fadeInDown">
            <table class="table table-condensed">
              <thead>
                <tr class="main-color-bg">
                  <th>ID</th>
                  <th>Title</th>
                  <th>Released</th>
                </tr>
              </thead>
              <tbody>

                <?php include('./admin_scripts/admin_php/admin_movies_data.php') ?>

              </tbody>
            </table>
          </div>
        </section>


        <!-- //! shows section -->

        <section id="shows">
          <div class="container user-table table-responsive animated fadeInDown">
            <table class="table table-condensed">
              <thead>
                <tr class="main-color-bg">
                  <th>ID</th>
                  <th>Title</th>
                  <th>Released</th>
                </tr>
              </thead>
              <tbody>

                <?php include('./admin_scripts/admin_php/admin_shows_data.php') ?>

              </tbody>
            </table>
          </div>
        </section>

      </div>
    </div>
  </div>


  <!-- footer -->
  <footer id="footer">
    <p>Adapted from<strong><a href="https://codepen.io/satjeet_sandhu/pen/oGJQKd"> CODEPEN SOURCE 2 </a></strong> and
      <strong><a href="https://codepen.io/selbekk/pen/qqNEGg"> CODEPEN SOURCE 1 </a></strong> by
      Tomasz Gora.
    </p>
  </footer>

  <?php require('./admin_scripts/admin_php/admin_modals.php'); ?>
</body>

</html>