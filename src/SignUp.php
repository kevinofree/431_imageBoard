<?php
include "Navbar.php";
if(isset($_POST['submit'])){

  $name = $_POST['fullName'];
  $usrname = $_POST['userName'];
  $password = $_POST['passWord'];

  // connect to the db
  $link = mysqli_connect('localhost', 'admin', 'homework', 'test');

  $insert = "INSERT INTO USER (Username, Password, FullName, Status) VALUES ('$name','$usrname', '$password', '0')";
  if(mysqli_query($link, $insert)){
    echo "<p>New account created. Sign in to your new account.</p><br />";
  }
  else{
    echo "<p style='color:red'>Username taken. Try a different one.</p>";
  }
  mysqli_close($link);
}
?>

<html>
  <head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="../public/css/style.css" type="text/css">
  </head>
  <body>
    <div class='container'>
      <div class='centered'>
        <h2 class="text-center">Sign Up!</h2>
        <hr>
        <form method="post" action="<?php $_SERVER["PHP_SELF"];?>">
          <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" name="fullName" maxlength="30"required>
          </div>
            <div class="form-group">
              <label for="userName">Username</label>
              <input type="text" class="form-control" name="userName" maxlength="20"required>
            </div>
            <div class="form-group">
              <label for="passWord">Password</label>
              <input type="password" class="form-control" name="passWord" maxlength="20"required>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
    </div>
  </body>
</html>
