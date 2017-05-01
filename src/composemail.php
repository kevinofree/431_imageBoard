<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  $recipient = '';
  if (isset($_GET['user'])) {
      $recipient = $_GET['user'];
  }


  if (isset($_POST['mail-submit'])) {
      // Get form data
      $receiver = $_POST['receiver'];
      $sender = $_SESSION['username'];
      $subject = $_POST['subject'];
      $content = $_POST['content'];

    // Message Statuses:
    // New = 0
    // Read = 1
    // Delete = 2
    $status = 0;

    // Create database query for the newly created message
    $query = create_mail_query($subject, $content, $sender, $receiver, $status);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);


    // Check if the query contained any errors
    if ($result) {
        $_SESSION['success_message'] = "Message Sent!";
    } else {
        $_SESSION['fail_message'] = "Message could not be sent.";
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
                 <div class="container">
                  <div class="row">
                      <div class="col-lg-5 col-lg-offset-3">
                        <h1 class="text-center">Create a Message</h1>
                        <br>
                        <?php
                          if (isset($_SESSION['success_message'])) {
                              echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
                          }
                          if (isset($_SESSION['fail_message'])) {
                              echo '<div class="alert alert-danger text-center">' . $_SESSION['fail_message'] . '</div>';
                          }
                        ?>
                        <form method="post">
                          <div class="form-group">
                            <input type="text" class="form-control" name="receiver" placeholder="Recipient" value="<?php echo $recipient; ?>" required>
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                          </div>
                          <hr>
                          <div class="form-group">
                            <textarea class="form-control" rows="5" name ="content" placeholder="Message text here..." required></textarea>
                          </div>
                          <button type="submit" name="mail-submit" class="btn btn-primary">Send Message</button>
                        </form>
                      </div>
                    </div>
                </div>
                <?php //include "mailform.php"?>
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
  require_once('./database/close-connection.php');
  unset($_SESSION['success_message']);
  unset($_SESSION['fail_message']);
?>
