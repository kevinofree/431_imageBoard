<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
?>
<?php

  // Testing JSON that will be used for the AJAX call
  $user = '"noe"';
  $json = '{"chat" : ' . $user . '}';

  echo $json;
?>
