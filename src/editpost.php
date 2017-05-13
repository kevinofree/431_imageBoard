<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();


  if(isset($_POST['edit-submit']))
  {
      // get the post id
      $postNo = $_GET['pid'];

      // get the thread id
      $threadNo = $_GET['tid'];

      // retreive updated post
      $content = $_POST['content'];

      // create a query for new post
      $query = update_post($content, $postNo);

      // Perform the query on the database
      $result = mysqli_query($connection, $query);

      // Check if the query contained any errors
      if($result)
      {
        // Post created success message
        $_SESSION['success_message'] = 'Post Submitted!';
        redirect_to("threads.php?thread={$threadNo}");
      }
      else
      {
        // Post failed to be created
        $_SESSION['fail_message'] = "Failed to Submit.";

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
  </head>
  <body>
    <div class="col-lg-5 col-lg-offset-3">
      <form method="POST">
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
        <br>
        <div class="form-group">
          <label for="content">Reply</label>
            <textarea class="form-control" rows="5" name ="content" placeholder="Edit post here..." required></textarea>
        </div>
        <hr>
        <button type="submit" name="edit-submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
<!DOCTYPE html>
</html>
<?php
  unset($_SESSION['register_page']);
  unset($_SESSION['success_message']);
  unset($_SESSION['fail_message']);

  require_once('./database/close-connection.php');
?>
