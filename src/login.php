<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
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
