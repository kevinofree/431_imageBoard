<?php

  //*****************************************************
  //**** User Registration and Authentication Queries ***
  //*****************************************************

  // Create new user
  function register_user_query($username, $password, $fullname, $profile_image, $status)
  {
    // Encrypt password using MD5 algorithm
    $hash = md5($password);
    $query  = "INSERT INTO USER (";
    $query .= "Username, Password, Fullname, ProfilePic, Status";
    $query .= ") VALUES (";
    $query .= "'{$username}', '{$hash}', '{$fullname}', '{$profile_image}', $status";
    $query .= ");";

    return $query;
  }

  // Search for the users credentials
  function authenticate_user_query($username, $password)
  {
    // Encrypt password using MD5 algorithm
    $hash = md5($password);

    $query  = "SELECT * ";
    $query .= "FROM USER ";
    $query .= "WHERE Username = '{$username}' AND Password = '{$hash}';";

    return $query;
  }

  // Create new chatroom
  function create_chatroom_query($username, $chatroom_subject)
  {
    $query  = "INSERT INTO CHATROOM (";
    $query .= "RoomName, StartUser";
    $query .= ") VALUES (";
    $query .= "'{$chatroom_subject}', '{$username}'";
    $query .= ");";

    return $query;
  }

  // Get user info
  function get_user($username)
  {
    $query  = "SELECT * ";
    $query .= "FROM USER ";
    $query .= "WHERE Username = '{$username}'";

    return $query;
  }

  // Update profile picture
  function update_profile_image_query($username, $image_data)
  {
    $query = "UPDATE USER ";
    $query .= "SET ProfilePic = '{$image_data}' ";
    $query .= "WHERE Username = '{$username}'";

    return $query;
  }

  function update_status($user, $status)
  {
    $query = "UPDATE USER SET Status = $status WHERE Username='{$user}'";
    return $query;
  }

  //****************************************************
  //************* Chatroom Feature Queries *************
  //****************************************************

  // Retrieve all chatrooms created
  function get_chatrooms_query()
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOM;";

    return $query;
  }

  // Save chat message from the user
  function log_chat_query($username, $room_id, $chat_message)
  {
    $query  = "INSERT INTO CHATROOMLOG (";
    $query .= "ChatEntry, SentBy, RoomNo";
    $query .= ") VALUES (";
    $query .= "'{$chat_message}', '{$username}', $room_id";
    $query .= ");";

    return $query;
  }

  // Retrieve all chats for the particular chatroom
  function get_chatlog_query($room_id)
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOMLOG ";
    $query .= "WHERE RoomNo = $room_id";

    return $query;
  }

  function get_chatroom_user_query($room_id)
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOMUSER ";
    $query .= "WHERE RoomNo = $room_id";

    return $query;
  }

  function add_chatroom_user_query($username, $room_id)
  {
    $query  = "INSERT INTO CHATROOMUSER (";
    $query .= "User, RoomNo";
    $query .= ") VALUES (";
    $query .= "'{$username}', $room_id";
    $query .= ");";

    return $query;
  }

  function remove_chatroom_user_query($username, $room_id)
  {
    $query  = "DELETE FROM CHATROOMUSER ";
    $query .= "WHERE ";
    $query .= "User = '{$username}' AND RoomNo = $room_id";

    return $query;
  }

  //****************************************************
  //************* Mailbox System Queries ***************
  //****************************************************

  // Create new message
  function create_mail_query($subject, $content, $sender, $receiver, $status)
  {
    $query  = "INSERT INTO MAILBOX (";
    $query .= "MsgText, Status, Subject, Sender, Receiver";
    $query .= ") VALUES (";
    $query .= "'{$content}', '{$status}', '{$subject}', '{$sender}', '{$receiver}'";
    $query .= ");";

    return $query;
  }

  // Retrieve all messages sent to user
  function get_message_inbox($username)
  {
    $query  = "SELECT * ";
    $query .= "FROM MAILBOX ";
    $query .= "WHERE Receiver = '{$username}' ";
    $query .= "ORDER BY MsgDate DESC ;";

    return $query;
  }

  // Retrieve all messages sent by user
  function get_message_sent($username)
  {
    $query  = "SELECT * FROM MAILBOX ";
    $query .= "WHERE Sender = '{$username}' ;";

    return $query;
  }

  function get_single_message($messageID)
  {
    $query = "SELECT * FROM MAILBOX ";
    $query .= "WHERE MsgID = $messageID;";

    return $query;
  }

  function update_message_status($messageID, $status)
  {
    $query = "UPDATE MAILBOX ";
    $query .= "SET Status = $status ";
    $query .= "WHERE MsgID = $messageID;";

    return $query;
  }

  //****************************************************
  //***************** Forum Queries ********************
  //****************************************************
  function get_forums()
  {
    $query = "SELECT *";
    $query .= "FROM FORUM";

    return $query;
  }
  function request_forum($forumname, $description, $user)
  {
    $query  = "INSERT INTO REQUESTS (";
    $query .= "FName, Description, RequestedBy";
    $query .= ") VALUES (";
    $query .= "'{$forumname}', '{$description}', '{$user}'";
    $query .= ");";
    return $query;
  }

  function check_ban($user, $fname)
  {
    $query = "SELECT * FROM BANNED WHERE FName='{$fname}' AND User='{$user}'";
    return $query;
  }

  function get_mod($forum)
  {
    $query = "SELECT Moderator FROM FORUM WHERE ForumName='{$forum}'";
    return $query;
  }

  //****************************************************
  //*********** Threads and Posts Queries **************
  //****************************************************
  function get_related_threads($user, $forumName)
  {
    $query = "SELECT * from THREAD LEFT JOIN RANK ON THREAD.ThreadNo = RANK.ThNo AND RANK.Username = '{$user}' WHERE THREAD.FName = '{$forumName}' AND THREAD.Status <> 2";
    return $query;
  }

  function create_thread_query($forumname, $status, $title, $content, $start_user)
  {
    $query  = "INSERT INTO THREAD (";
    $query .= "FName, Status, Title, Content, StartUser";
    $query .= ") VALUES (";
    $query .= "'{$forumname}', '{$status}', '{$title}', '{$content}', '{$start_user}'";
    $query .= ");";
    return $query;
  }

  function get_posts($threadNo)
  {
    $query = "SELECT PostText, PostDate, Poster, PostNo, Image FROM POST WHERE ThreadNo = '{$threadNo}';";
    return $query;
  }

  function post_reply($username, $post, $image, $threadNo)
  {
    $query  = "INSERT INTO POST (";
    $query .= "Poster, PostText, Image, ThreadNo";
    $query .= ") VALUES (";
    $query .= "'{$username}', '{$post}', '{$image}' ,'{$threadNo}'";
    $query .= ");";
    return $query;
  }

  function update_post($content, $postNo)
  {
    $query  = "UPDATE POST SET PostText='{$content}' WHERE PostNo='{$postNo}';";
    return $query;
  }

  function get_thread_info($tNO)
  {
    $query = "SELECT * from THREAD WHERE ThreadNo = $tNO";
    return $query;
  }

  //null = unranked, 1 = thums up, 2 = thumsdown
  function rank_thread($rankID, $user, $status, $threadno)
  {
    if ($rankID == '')
    {
      $query = "INSERT INTO RANK (Username, Ranking, ThNo) VALUES('{$user}', $status, $threadno)";
      $query .= "ON DUPLICATE KEY UPDATE Ranking=$status";
    }
    else {
      $query = "INSERT INTO RANK (RankID, Username, Ranking, ThNo) VALUES($rankID, '{$user}', $status, $threadno)";
      $query .= "ON DUPLICATE KEY UPDATE Ranking=$status";
    }
    return $query;

  }

  //****************************************************
  //**************** Moderator Queries *****************
  //****************************************************

  function delete_post($postid)
  {
    $query = "DELETE FROM POST WHERE PostNo=$postid";
    return $query;
  }

//0 = normal, 1=locked, 2 = closed
function update_thread_status($tid, $status)
{
  $query = "UPDATE THREAD SET Status=$status WHERE ThreadNo=$tid";
  return $query;
}


  //****************************************************
  //************* Administrator Queries ****************
  //****************************************************
  function view_requests(){
    $query = "SELECT * FROM REQUESTS";
    return $query;
  }

  function get_request($reqID)
  {
    $query = "SELECT * FROM REQUESTS WHERE RequestID ={$reqID}";
    return $query;
  }

  function create_forum($forumname, $mod, $image, $description)
  {
    $query = "INSERT INTO FORUM (ForumName, Moderator, Picture, Description, Status)";
    $query .= "VALUES ('{$forumname}', '{$mod}', '{$image}', '{$description}', 1);";
    return $query;
  }

  function delete_request($reqID)
  {
    $query = "DELETE FROM REQUESTS WHERE RequestID = $reqID";
    return $query;
  }

  function set_mod($forum, $mod)
  {
    $query = "UPDATE FORUM SET Moderator='{$mod}' WHERE ForumName='{$forum}'";
    return $query;
  }

  function get_forum_from_thread($threadNo)
  {
    $query = "SELECT FName from THREAD WHERE ThreadNo=$threadNo";
    return $query;
  }

  function ban_user($forum, $user)
  {
    $query = "INSERT INTO BANNED (Fname, User) VALUES('{$forum}', '{$user}')";
    return $query;
  }

?>
