<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php confirm_user_authentication(); ?>
<?php

  // Detect whether the request is AJAX
  function is_ajax_request()
  {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  // If the POST data is defined assign it to to variables
  $room_id = isset($_POST['room-id']) ? $_POST['room-id'] : '';
  $room_name = isset($_POST['room-name']) ? $_POST['room-name'] : '';
  $chat_text = isset($_POST['chat-text']) ? $_POST['chat-text'] : '';

  if(is_ajax_request())
  {
    // Testing JSON that will be used for the AJAX call
    $user = '"noe"';
    $json = '{"chat" : ' . $user . '}';
    echo $json;
  }
  else
  {
    exit;
  }


?>
