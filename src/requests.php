<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  confirm_admin_authentication();

  $query = view_requests();
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
        <script src="https://oss.maxcdn.com/libs/respond.js/2.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include "navbar.php" ?>
    <div id="wrapper">
      <?php include "sidebar.php"; ?>
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <h1>Forum Requests</h1>
              <br>
              <div class="row">
                <div class="col-md-9">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                           Forum Request
                        </th>
                        <th>
                          Requested By
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                        while($requests = mysqli_fetch_assoc($result))
                        {
                          // Subject
                          echo '<tr>';
                          echo '<td>';
                          echo '<form method="GET" action="viewreq.php">';
                          echo '<input type="hidden" name="reqID" value="' . $requests['RequestID'] . '">';
                          echo '<button type="submit" class="btn btn-link">';
                          echo $requests['FName'];
                          echo '</button>';
                          echo '</form>';
                          echo '</td>';

                          // Sender
                          echo '<td>';
                          echo $requests['RequestedBy'];
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
    <?php include "scripts.php"; ?>
    <script src="js/sidebar.js"></script>
  </body>
</html>
<?php require_once('./database/close-connection.php'); ?>
