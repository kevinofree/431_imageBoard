<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  confirm_mod_auth();

  $pid = $_GET['pid'];
  $tid = $_GET['tid'];

  //get the forum from thread
  $query = delete_post($pid);
  $result = mysqli_query($connection, $query);

  if($result)
  {
    $_SESSION['success_message'] = "POST DELTED";
  }
  else {
    $_SESSION['fail_message'] = "There was an issue deleting this post";
  }

  redirect_to("threads.php?thread={$tid}");


?>
