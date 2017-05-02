<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  // Create database query
  $query = get_chatrooms_query();

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
              <h1>Chatrooms Available</h1>
              <br>
              <div class="row">
                <div class="col-md-9">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          Chatroom Name
                        </th>
                        <th>
                          Created By User
                        </th>
                        <th>
                          Date Created
                        </th>
                        <th>
                          Room Number
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php

                      // Loop and print the contents from the CHATROOM table from the db
                      while($chatroom = mysqli_fetch_assoc($result))
                      {
                        echo '<tr>';

                        // subject
                        echo '<td>';
                        echo '<form method="GET" action="chatroom.php">';
                        echo '<input type="hidden" name="room-id" value="' . $chatroom['RoomNo'] . '">';
                        echo '<input type="hidden" name="room-name" value="' . $chatroom['RoomName'] . '">';
                        echo '<span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;';
                        echo '<button type="submit" class="btn btn-link">';
                        echo $chatroom['RoomName'];
                        echo '</button>';
                        echo '</form>';
                        echo '</td>';

                        // username
                        echo '<td>';
                        echo '<span class="start-user">';
                        echo $chatroom['StartUser'];
                        echo '</span>';
                        echo '</td>';

                        // date
                        echo '<td>';
                        echo '<span class="chatroom-date">';
                        echo $chatroom['DateCreated'];
                        echo '</span>';
                        echo '</td>';

                        // room number
                        echo '<td>';
                        echo '<span class="room-number">';
                        echo $chatroom['RoomNo'];
                        echo '</span>';
                        echo '</td>';

                        echo '</tr>';
                      }

                      // Release the data from the database
                      mysqli_free_result($result);
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /#wrapper -->
    <?php include "scripts.php"; ?>
    <!-- Menu Toggle Script -->
    <script src="js/sidebar.js"></script>
  </body>
</html>
<?php require_once('./database/close-connection.php'); ?>
