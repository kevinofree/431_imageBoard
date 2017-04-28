<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
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
    <link href="css/chatroom-style.css" rel="stylesheet">

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
              <h1 class="page-header">Chat Room: "subject"</h1><br>
                <!--
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                -->
                <div class="row">
                  <div class="col-md-3">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Connected Users
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;
                            <span class="connected-user">SAMPLE_USER10</span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;
                            <span class="connected-user">SAMPLE USER11</span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;
                            <span class="connected-user">SAMPLE USER12</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-8">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        Conversations&nbsp;&nbsp;<span class="glyphicon glyphicon-comment"></span>
                      </div>
                    </div>
                    <div class="panel-body">
                      <ul id="chat" class="chat">
                      <!--
                        CHAT LOGS HERE..
                      -->
                      </ul>
                    </div>
                  <div class="panel-footer">
                    <div class="input-group">

                      <input id="chat-input" type="text" class="form-control" placeholder="Type your message here..." />

                      <span class="input-group-btn">
                        <button class="btn btn-success" id="sendChat">Send</button>
                      </span>
                    </div>
                  </div>
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
    <script src="js/chatroom.js"></script>
  </body>
</html>
<?php require_once('./database/close-connection.php'); ?>
