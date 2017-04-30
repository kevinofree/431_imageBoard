<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  // Create database query
  $query = get_message_sent();

  // Perform the query on the database
  $result = mysqli_query($connection, $query);
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
              <h1>Mailbox: Sent Mail</h1>
              <br>
<div class="row">
  <div class="col-md-9">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>
            Receiver
          </th>
          <th>
            Subject
          </th>
          <th>
            Content
          </th>
          <th>
            Date
          </th>
        </tr>
      </thead>
      <tbody>
        <?php

          // Loop and print the contents from the CHATROOM table from the db
          while($sent = mysqli_fetch_assoc($result))
          {
            echo '<tr>';

            // Receiver
            echo '<td>';
            echo '<form method="GET" action="">';
            echo '<input type="hidden" name="msg-id" value="' . $sent['MsgID'] . '">';
            echo '<button type="submit" class="btn btn-link">';
            echo $sent['Receiver'];
            echo '</button>';
            echo '</form>';
            echo '</td>';

            // Subject
            echo '<td>';
            echo '<span class="msg-subject">';
            echo $sent['Subject'];
            echo '</span>';
            echo '</td>';

            // Content
            echo '<td>';
            echo '<span class="msg-content">';
            echo $sent['MsgText'];
            echo '</span>';
            echo '</td>';

            // Date
            echo '<td>';
            echo '<span class="msg-date">';
            echo $sent['MsgDate'];
            echo '</span>';
            echo '</td>';

            echo '</tr>';
          }

          // Release the data from the database
          mysqli_free_result($result);
        ?>
      </tbody>
              <!--
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
<?php require_once('./database/close-connection.php'); ?>
