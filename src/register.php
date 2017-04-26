<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/database-queries.php'); ?>

<?php

  if(isset($_POST['submit']))
  {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    // New default user
    $status = 0;

    // Call register new user query
    $new_user = register_user_query($username, $password, $fullname, $status);

    // Perform the query to the database
    $result = mysqli_query($connectioin, $new_user);

    // Check if the query contained any errors
    if($result)
    {
      echo "<p>New account created. Sign in to your new account.</p><br />";
    }
    else
    {
      echo "<p style='color:red'>Username taken. Try a different one.</p>";
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
          <h2 class="text-center">Sign Up!</h2>
          <hr>
          <form method="POST" action="<?php $_SERVER["PHP_SELF"];?>">
            <div class="form-group">
              <label for="fullname">Full Name</label>
              <input type="text" class="form-control" name="fullname" maxlength="70" required>
            </div>
            <div class="form-group">
              <label for="userName">Username</label>
              <input type="text" class="form-control" name="username" maxlength="32" required>
            </div>
            <div class="form-group">
              <label for="passWord">Password</label>
              <input type="password" class="form-control" name="password" maxlength="32" required>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <?php include "scripts.php"; ?>
  </body>
</html>
<?php require_once('./database/close-connection.php'); ?>
