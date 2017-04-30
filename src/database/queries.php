<?php

  //*****************************************************
  //**** User Registration and Authentication Queries ***
  //*****************************************************

  // Create new user
  function register_user_query($username, $password, $fullname, $status)
  {
    // Encrypt password using MD5 algorithm
    $hash = md5($password);
    $query  = "INSERT INTO USER (";
    $query .= "Username, Password, Fullname, Status";
    $query .= ") VALUES (";
    $query .= "'{$username}', '{$hash}', '{$fullname}', $status";
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

  //select users
  function get_user($username)
  {
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

  function get_forums()
  {
    $query = "SELECT *";
    $query .= "FROM FORUM";

    return $query;
  }

  function get_forum_names()
  {
    $query = "SELECT ForumName";
    $query .= "FROM FORUM";

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
  function get_message_inbox()
  {
    $query  = "SELECT MsgID, MsgText, Subject, MsgDate, Sender, Status FROM MAILBOX ";
    $query .= "WHERE Receiver = '{$_SESSION['username']}' ORDER BY MsgDate DESC ;";

    return $query;
  }

  // Retrieve all messages sent by user
  function get_message_sent()
  {
    $query  = "SELECT MsgID, MsgText, Subject, MsgDate, Receiver FROM MAILBOX ";
    $query .= "WHERE Sender = '{$_SESSION['username']}' ORDER BY MsgDate DESC ;";

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
  //*********** Threads and Posts Queries **************
  //****************************************************
  function get_related_threads($forumName){
    $query = "SELECT * FROM THREAD WHERE FName = '{$forumName}';";
    return $query;
  }

  //****************************************************
  //**************** Moderator Queries *****************
  //****************************************************



  //****************************************************
  //************* Administrator Queries ****************
  //****************************************************


?>
