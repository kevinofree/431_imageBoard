<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  if(isset($_POST['mail-submit']))
  {
    // Get form data
    $receiver = $_POST['receiver'];
    $sender = $_SESSION['username'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    // Default message status
    $status = 0;

    // Create database query for the newly created message
    $query = create_mail_query($subject, $content, $sender, $receiver, $status);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Check if the query contained any errors
    if($result)
    {
      $_SESSION['success_message'] = "Message Sent!";
    }
    else
    {
      $_SESSION['fail_message'] = "Message could not be sent.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>GyroChan</title>
    <?php include "bootstrap.php"; ?>
  </head>
  <body>
  <?php include "navbar.php" ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-lg-offset-3">
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
          <form method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="receiver" placeholder="Recipient" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" placeholder="Subject">
            </div>
            <hr>
            <div class="form-group">
              <textarea class="form-control" rows="5" name ="content"></textarea>
            </div>
            <button type="submit" name="mail-submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <?php include "scripts.php"; ?>
  </body>
</html>
<?php
  unset($_SESSION['success_message']);
  unset($_SESSION['fail_message']);
  require_once('./database/close-connection.php');
?>
