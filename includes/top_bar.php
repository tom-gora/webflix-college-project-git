<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="topnav">
  <a class="navbar-brand" href="index.php"><img src="resources/wf.png" alt="CP Logo"
      style="margin:-10px 0 0 20px;width:140px;height:124px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto" id="nav-buttons-wrapper">
      <li class="nav-item">
        <button type="button" class="btn btn-primary navbutton" onclick="window.location.href='index.php'"><i
            class="fa fa-home"></i><br>Home</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-primary navbutton" onclick="window.location.href='movies.php'"><i
            class="fa fa-film"></i><br>Movies</button>
      </li>
      <li class="nav-item">
        <button type="button" class="btn btn-primary navbutton" onclick="window.location.href='series.php'"><i
            class="fa fa-tv"></i><br>Shows</button>
      </li>
      <!-- <li class="nav-item">
        <button type="button" class="btn btn-primary navbutton" onclick="window.location.href='reviews.php'"><i
            class="fa fa-star"></i><br>Reviews</button>
      </li> -->
      <li class="nav-item">
        <button type="button" class="btn btn-primary navbutton" onclick="window.location.href='subscribe.php'">
          <i class="fa fa-solid fa-arrows-spin" style="color: #fff"></i><br>Subscribtions</button>
      </li>
      <?php include 'includes/navbar_options.php'; ?>
      <li class="nav-item">
        <button type="button" class="btn btn-primary navbutton" id="mainSearch" onclick="window.location.href='#'"><i
            class="fa fa-search" style="font-size: 30px !important;"></i><br>Search</button>
      </li>
    </ul>
  </div>
  <div class="navbar-border"></div>
</nav>