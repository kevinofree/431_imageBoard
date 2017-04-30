<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php

  // If user is on the register page do not display the login area in the navbar
  $_SESSION['register_page'] = 'active';
  if(isset($_SESSION['username']))
    redirect_to('index.php');

  if(isset($_POST['register-submit']))
  {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    // New default user
    $status = 0;

    // Create database query for a newly registered user
    $query = register_user_query($username, $password, $fullname, $status);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Check if the query contained any errors
    if($result)
    {
      $_SESSION['success_message'] = "You are now registered and can login.";

      // If successful redirect the client to the login page
      redirect_to('login.php');
    }
    else
    {
      $_SESSION['fail_message'] = "The username is already taken. Please try again.";
    }
  }
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

          <h2 class="text-center">Join GyroChan!</h2>
          <hr>
          <form method="POST">
            <div class="form-group">
              <label for="fullname">Full Name</label>
              <input type="text" class="form-control" name="fullname" maxlength="70" required>
            </div>
            <div class="form-group">
              <label for="userName">Username</label>
              <input type="text" class="form-control" name="username" maxlength="32" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" maxlength="64" required>
            </div>
            <hr>
            <button type="submit" name="register-submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <?php include "scripts.php"; ?>
  </body>
</html>
<?php
  unset($_SESSION['register_page']);
  unset($_SESSION['fail_message']);
  require_once('./database/close-connection.php');
?>
