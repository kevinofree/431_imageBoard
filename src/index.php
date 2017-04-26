<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Final Project - Index Page</title>
    <?php include "bootstrap.php"; ?>

    <link href="css/index-style.css" rel="stylesheet">
  </head>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="jumbotron">
        <h1 style="font-family: 'Press Start 2P', cursive;">Welcome to GyroChan!</h1>
        <p class="lead">
          If you don't have an account, please
          <a href="register.php"><span id="register-link">register</span></a>
        </p>
      </div>
      <hr>
    </div>
    <?php include "scripts.php"; ?>
  </body>
</html>

<?php
  require_once('./database/close-connection.php');
?>
