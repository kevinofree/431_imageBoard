<?php require_once('./include/sessions.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  $_SESSION['username'] = null;

  unset($_SESSION['username']);
  $_SESSION['success_message'] = 'You are successfully logged out.';
  redirect_to("login.php");
?>
