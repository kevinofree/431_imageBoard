<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php
  // Temporary to hide
  $_SESSION['username'] = 'true';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <?php include "bootstrap.php"; ?>
  </head>
  <body>
  <?php include "navbar.php" ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 main">
          <h1>Welcome to your dashboard</h1>
        </div>
      </div>
    </div>
    <?php include "scripts.php"; ?>
  </body>
</html>
<?php require_once('./database/close-connection.php');
