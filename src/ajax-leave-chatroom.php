<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php confirm_user_authentication(); ?>
<?php

  // Check if the request is an AJAX request
  if(is_ajax_request())
  {
    $room_id = $_POST['room-id'];

    $query = get_chatroom_user_query($room_id);
    $result = mysqli_query($connection, $query);

    $num_of_rows = mysqli_num_rows($result);

    $json = '{ "users" : [';

    while($chatroom_user = mysqli_fetch_assoc($result))
    {
      $json .= '{';

      $json .= '"username" : ' . '"' . $chatroom_user['User'] . '"';

      $json .= '}';

      if($num_of_rows > 1)
      {
        $json .= ', ';
      }

      --$num_of_rows;
    }

    $json .= '] }';

    mysqli_free_result($result);

    // Send the json object to the client
    echo $json;
  }
?>
<?php require_once('./database/close-connection.php'); ?>
