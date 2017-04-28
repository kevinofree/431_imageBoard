<?php

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

  function get_chatrooms_query()
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOM;";
    return $query;
  }
?>
