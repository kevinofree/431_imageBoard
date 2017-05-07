<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();

  $forum_name = '';
  if (isset($_GET['forum'])) {
      $forum_name = $_GET['forum'];
  }

  if (isset($_POST['thread-submit'])) {
    // Get form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $start_user= $_SESSION['username'];

    // ThreadStatuses:
    // New = 0
    // Closed = 1
    // Purged = 2

    $status = 0;

    // Create database query for the newly created thread
    $query = create_thread_query($forum_name, $status, $title, $content, $start_user);

    // Perform the query on the database
    $result = mysqli_query($connection, $query);

    // Check if the query contained any errors
    if ($result) {
        $_SESSION['success_message'] = "Thread created!";
        redirect_to("forums.php?forum={$forum_name}");
    } else {
        $_SESSION['fail_message'] = "Could not create thread.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <link href="css/styles.css" rel="stylesheet">

    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <?php include "navbar.php" ?>
    <?php include "header.html"; ?>
    <?php
    ?>
    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>Create a Thread in <?php echo $forum_name; ?></h1>
    </div>
    <div class="col-lg-5 col-lg-offset-3">
      <form method="POST">
         <br>
         <?php
           if (isset($_SESSION['success_message'])) {
               echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
           }
           if (isset($_SESSION['fail_message'])) {
               echo '<div class="alert alert-danger text-center">' . $_SESSION['fail_message'] . '</div>';
           }
         ?>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
          <label for="content">Comment</label>
            <textarea class="form-control" rows="5" name ="content" placeholder="Comment text here..." required></textarea>
        </div>
        <hr>
        <button type="submit" name="thread-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
  <!DOCTYPE html>
  </html>
  <?php
    require_once('./database/close-connection.php');
    unset($_SESSION['success_message']);
    unset($_SESSION['fail_message']);
  ?>
