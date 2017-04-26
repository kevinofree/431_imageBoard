<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php

  // Used for session store and html entities in the form
  $username = "";

  //Do not display the navbar login form on this page
  $_SESSION['register_page'] = 'active';

  // If login in form has been submitted
  if(isset($_POST['login-submit']))
  {
    // Get the users credentials
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create database query
    $query = authenticate_user_query($username, $password);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Return the results from the database in a associative array
    $user_credentials = mysqli_fetch_assoc($result);

    // Check if the query has an error
    if (!$result)
    {
      die("Database query failed. " . mysqli_error($connection));
    }

    // Hash the user's password for comparison
    $hash = md5($password);

    // Check credential matches
    if($user_credentials['username'] === $username &&
      $user_credentials['password'] === $hash)
    {
      // Store username in session
      $_SESSION['username'] = $user_credentials['username'];

      // Release returned data
      mysqli_free_result($result);

      // Access granted. Redirect to the users dashboard
      redirect_to('dashboard.php');
    }
    else
    {
      // If the user enters the wrong username or password, send a fail message to the client
      $_SESSION['fail_message'] = 'Invalid username or password, please try again.';
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
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" maxlength="32" value="<?php echo htmlentities($username);?>" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" maxlength="32" required>
            </div>
            <hr>
            <button type="submit" name="login-submit" class="btn btn-success">Login</button>
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
