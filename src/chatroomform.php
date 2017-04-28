<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  if(isset($_POST['chatroom-submit']))
  {
    // Get form data
    $chatroom_subject = $_POST['chatroom-subject'];

    // Get the clients username stored in the session
    $username = $_SESSION['username'];

    $query = create_chatroom_query($username, $chatroom_subject);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Check if the query contained any errors
    if($result)
    {
      // Chatroom created success message
      $_SESSION['success_message'] = 'Chatroom has been created!';

      // Redirect the client to the dashboard
      redirect_to('dashboard.php');
    }
    else
    {
      // Chatroom failed to be created
      $_SESSION['fail_message'] = "Something went wrong.";

      // Redirect the client to the dashboard
      redirect_to('dashboard.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <title>GyroChan</title>

    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>

    <!-- Custom CSS -->
    <link href="css/sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php include "navbar.php" ?>

    <div id="wrapper">
      <?php include "sidebar.php"; ?>

        <!-- Page Content -->
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="text-center">Create a Chatroom</h1><br>
                <!--
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                -->
                <div class="row">
                  <div class="col-lg-4 col-lg-offset-4">
                    <form method="POST">
                      <div class="form-group">
                        <label for="chat-room-subject">Subject Name:</label>
                        <input type="text" class="form-control" name="chatroom-subject" maxlength="64" required>
                      </div>
                      <button type="submit" name="chatroom-submit" class="btn btn-primary">Create Chatroom</button>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "scripts.php"; ?>
    <!-- Menu Toggle Script -->
    <script src="js/sidebar.js"></script>
  </body>
</html>
