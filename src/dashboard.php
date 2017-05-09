<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php confirm_user_authentication(); ?>
<?php
  // Remove the user from the chatroom list
  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $username = $_SESSION['username'];
    $room_id = $_POST['room-id'];
    $query = remove_chatroom_user_query($username, $room_id);
    $result = mysqli_query($connection, $query);
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
              <h1>Welcome <?php $_SERVER['HTTP_REFERER']; echo $_SESSION['username']; ?></h1>
              <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
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
                </div>
              </div>

                <!-- Commented out for now
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                -->
            </div>
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "scripts.php"; ?>

    <!-- Menu Toggle Script -->
    <script src="js/sidebar.js"></script>
  </body>
</html>
<?php
  unset($_SESSION['success_message']);
  unset($_SESSION['fail_message']);
  require_once('./database/close-connection.php');
?>
