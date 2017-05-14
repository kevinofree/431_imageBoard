<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  confirm_mod_auth();

  $tid = $_POST['tid'];
  $action = $_POST['action'];

  if($action == 'lock')
  {
    $query = update_thread_status($tid, 1);
    $result = mysqli_query($connection, $query);

    if($result)
    {
      $_SESSION['success_message'] = "Thread Locked";
    }
    else {
      $_SESSION['fail_message'] = "There was an issue locking this post";
    }

  }else if($action == 'close')
  {
    $query = update_thread_status($tid, 2);
    $result = mysqli_query($connection, $query);

    if($result)
    {
      $_SESSION['success_message'] = "Thread Closed";
    }
    else {
      $_SESSION['fail_message'] = "There was an issue closing this thread";
    }

  }else if($action == 'unlock')
  {
    $query = update_thread_status($tid, 0);
    $result = mysqli_query($connection, $query);

    if($result)
    {
      $_SESSION['success_message'] = "Thread Unlocked";
    }
    else {
      $_SESSION['fail_message'] = "There was an issue unlocking this thread";
    }

  }

  redirect_to("threads.php?thread={$tid}");

?>
