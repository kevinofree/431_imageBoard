<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  if (isset($_POST['request-submit'])) {
    // Get form data
    $forum_name = $_POST['name'];
    $description = $_POST['description'];
    $user= $_SESSION['username'];

    // Create database query for the user request
    $query = request_forum($forum_name, $description, $user);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Check if the query contained any errors
    if ($result) {
        $_SESSION['success_message'] = "Your request has been sent!";
    } else {
        $_SESSION['fail_message'] = "Could not submit your request.";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <link href="css/styles.css" rel="stylesheet">

    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <?php include "navbar.php" ?>
    <?php include "header.html"; ?>
    <?php
    ?>
    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>Request a New Forum</h1>
    </div>
    <div class="col-lg-5 col-lg-offset-3">
      <form method="POST">
         <br>
         <?php
           if (isset($_SESSION['success_message'])) {
               echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
           }
           if (isset($_SESSION['fail_message'])) {
               echo '<div class="alert alert-danger text-center">' . $_SESSION['fail_message'] . '</div>';
           }
         ?>
        <div class="form-group">
          <label for="name">Forum Name:</label>
          <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
            <textarea class="form-control" rows="5" name="description" placeholder="What is this forum about?" required></textarea>
        </div>
        <hr>
        <button type="submit" name="request-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
  <!DOCTYPE html>
  </html>
  <?php
    require_once('./database/close-connection.php');
    unset($_SESSION['success_message']);
    unset($_SESSION['fail_message']);
  ?>
