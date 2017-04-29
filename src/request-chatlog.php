<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php confirm_user_authentication(); ?>
<?php
  // Check if the request is an AJAX request
  if(is_ajax_request())
  {
    // If the POST data is defined assign it to to variables
    $room_id = isset($_POST['room-id']) ? $_POST['room-id'] : '';
    $room_name = isset($_POST['room-name']) ? $_POST['room-name'] : '';
    $chat_text = isset($_POST['chat-text']) ? $_POST['chat-text'] : '';

    // Get the username thats logged in (the user that sent the chat message)
    $username = $_SESSION['username'];

    // Save the chat message to the database
    $query = log_chat_query($username, $room_id, $chat_text);
    $result = mysqli_query($connection, $query);

    if(!$result)
    {
      echo 'A database error has occured.';
    }

    // Retrieve the entire chat log from the database
    $query = get_chatlog_query($room_id);
    $result = mysqli_query($connection, $query);

    /*
      NOTE: The school's server only supports PHP 5.1
            json_encode() is only available for PHP 5.2 and above


      Working Progress, still needs more work April 29, 2017
    */

    $json_start = '{';

    while($chatlog = mysqli_fetch_assoc($result))
    {
      $json_inner_start = '{';

      $chat_id = '"chatID : "' . $chatlog['ChatID'] . ', ';
      $chat_text = '"chatText : "' . $chatlog['ChatEntry'] . ', ';
      $chat_sent_by = '"chatSentBy : "' . $chatlog['SentBy'] . ', ';
      $chat_time_sent = '"chatTimeSent" :' . $chatlog['TimeChatSent'];

      $json_inner_end = '}';

    }

    $json_end = '}';


    // Release the data from the database
    mysqli_free_result($result);

  }
  else
  {
    exit;
  }
?>
<?php require_once('./database/close-connection.php'); ?>
