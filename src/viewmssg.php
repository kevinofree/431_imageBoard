<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  // Create database query
  $messageID = $_GET['id'];
  $query = get_single_message($messageID);
  $user = $_SESSION['username'];

  // Perform the query on the database
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $row = mysqli_fetch_assoc($result);
  if($row['Receiver'] != $user || $row['Sender'] != $user)
  {
    redirect_to('inbox.php');
  }

  if($row['Status'] == 0)
  {
    $query = update_message_status($messageID, 1);
    $changed = mysqli_query($connection, $query) or die(mysqli_error($connection));
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
        <div class="form-group">
          <h4>Sender: <?php echo $row['Sender']?></h4>
        </div>
        <div class="form-group">
          <h4>Subject: <?php echo $row['Subject']?></h4>
        </div>
        <div class="form-group">
          <textarea readonly class="form-control" rows=15><?php echo $row['MsgText'];?></textarea>
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
<?php require_once('./database/close-connection.php'); ?>
