<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Final Project - Index Page</title>
    <?php include "bootstrap.php"; ?>
    <link href="css/chatroom-style.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <?php include "navbar.php"; ?>

    <div class="container">
      <div class="row">
        <h3 class="page-header">Chat Room: "subject"</h3>

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


            <?php

              echo "hello worllllrd";

              $name = $_POST['data'];
              //echo $name;
            ?>


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



    <?php include "scripts.php"; ?>
    <script src="js/chatroom.js"></script>
  </body>
</html>
<?php require_once('./include/close-connection.php');
