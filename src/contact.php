<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GyroChan</title>
    <?php include "bootstrap.php"; ?>
    <link href="css/index-style.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>
    <?php include "navbar.php"; ?>
    <div class="container-fluid">
      <div class="jumbotron">
        <h1 style="font-family: 'Press Start 2P', cursive;">Welcome to GyroChan!</h1>
        <?php
          if(!isset($_SESSION['username']))
          {
            echo "<p class='lead'>
                  If you don't have an account, please <a href='register.php'><span id='register-link'>register</span></a>
                 </p>";
          }
        ?>
      </div>
      <hr>
    </div>

    <div class="container-fluid text-center">
      <h1>GyroChan Was Created By</h1>
      <ul class="list-group">
        <li class="list-group-item">Noe Rojas</li>
        <li class="list-group-item">Luis Covarrubias</li>
        <li class="list-group-item">Kevin Ochoa</li>
    </ul>
    </div>


    <?php include "scripts.php"; ?>
  </body>
</html>

<?php
  require_once('./database/close-connection.php');
?>
