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
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

  <script src="js/login.js"></script>


  <!--CSS -->
  <link href="css/StyleSheet.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body>


  <?php include 'includes/top_bar.php' ?>

  <?php include 'includes/bottom_bar.html' ?>

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
        <input type="submit" class="btn btn-dark btn-lg btn-block modal-submit" value="Login"
          style="width: 100px; background-color: #000 !important;">
        <div class="container" id="jumboContainer"> <!-- container to write php response into -->
        </div>
      </form>
    </div>
  </div>

  <div style="height:105px;"></div>


  <?php include 'includes/footer.html' ?>

</body>

</html>