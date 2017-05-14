<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  confirm_mod_auth();

  $user = $_GET['user'];
  $tid = $_GET['tid'];

  //get the forum from thread
  $query = get_forum_from_thread($tid);
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  $forum = $row['FName'];

  unset($query);
  unset($result);

  $query = ban_user($forum, $user);
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection)) ;

  if($result)
  {
    $_SESSION['banned'] = "User was banned from this forum";
  }
  else {
    $_SESSION['banned'] = "There was in issue banning the user";
  }

  redirect_to("threads.php?thread={$tid}");


?>
