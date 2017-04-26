<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php
  //Do not display the navbar login form on this page
  $_SESSION['register_page'] = 'active';


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
        <div class="col-lg-5 col-lg-offset-3">
          <?php
            if(isset($_SESSION['success_message']))
            {
              echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
            }
            if(isset($_SESSION['fail_message']))
            {
              echo '<div class="alert alert-danger text-center">' . $_SESSION['fail_message'] . '</div>';
            }
          ?>
          <h2 class="text-center">Login</h2>
          <hr>
          <form method="POST"">
            <div class="form-group">
              <label for="userName">Username</label>
              <input type="text" class="form-control" name="username" maxlength="32" required>
            </div>
            <div class="form-group">
              <label for="passWord">Password</label>
              <input type="password" class="form-control" name="password" maxlength="32" required>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-success">Login</button>
          </form>
        </div>
      </div>
    </div>
    <?php include "scripts.php"; ?>
  </body>
</html>
<?php
  unset($_SESSION['register_page']);
  unset($_SESSION['success_message']);
  unset($_SESSION['fail_message']);

  require_once('./database/close-connection.php');
?>
