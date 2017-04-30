<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php confirm_user_authentication(); ?>
<?php
  // Check if the request is an AJAX request
  if(is_ajax_request())
  {
    // Get the username thats logged in (the user that sent the chat message)
    $room_id = $_POST['room-id'];

    // Retrieve the entire chat log from the database
    $query = get_chatlog_query($room_id);
    $result = mysqli_query($connection, $query);

    // Create the json object
    $json = '{ "chatlog" : [';

    // Get the number of row entrys in the database result query
    $num_of_rows = mysqli_num_rows($result);

    while($chatlog = mysqli_fetch_assoc($result))
    {
      $json .= '{';

      $json .= '"chatID" : ' . $chatlog['ChatID'] . ', ';
      $json .= '"roomID" : ' . $chatlog['RoomNo'] . ', ';
      $json .= '"chatText" : ' . '"' . $chatlog['ChatEntry'] . '"' . ', ';
      $json .= '"chatSentBy" : ' . '"' . $chatlog['SentBy'] . '"' . ', ';
      $json .= '"chatTimeSent" : ' . '"' . $chatlog['TimeChatSent'] . '"';

      $json .= '}';

      if($num_of_rows > 1)
      {
        $json .= ', ';
      }

      --$num_of_rows;
    }

    $json .= '] }';

    // Release the data from the database
    mysqli_free_result($result);

    // Send the json object to the client
    echo $json;
  }
  else
  {
    exit;
  }
?>
<?php require_once('./database/close-connection.php'); ?>
