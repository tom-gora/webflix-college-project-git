<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>WebFlix - Movies</title>
    <link rel="icon" type="image/x-icon" href="resources/favicon.png">
    <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, shrink-to-fit=no"
        charset="utf-8">

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!--CSS -->
    <link href="css/StyleSheet.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script type="text/javascript" src="js/movies_page.js"></script>
</head>

<body>
    <?php include 'includes/top_bar.php' ?>

    <?php include 'includes/bottom_bar.html' ?>
    <div class="container">
        <div class="row" id="movies-container" style="width:100%; margin-top: 60px;"></div>
    </div>

    <?php include 'includes/footer.html' ?>

</body>

</html>