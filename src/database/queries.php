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
    $query  = "INSERT INTO CHATROOM (";
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
    $query .= "WHERE RoomID = $room_id";

    return $query;
  }

  //****************************************************
  //************* Mailbox System Queries **************
  //****************************************************









  //****************************************************
  //*********** Threads and Posts Queries **************
  //****************************************************









?>
