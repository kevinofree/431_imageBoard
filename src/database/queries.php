<?php

  function register_user_query($username, $password, $fullname, $status)
  {
    // Encrypt password using MD5 algorithm
    $hash = md5($password);

    $query  = "INSERT INTO USER (";
    $query .= "  username, password, fullname, status";
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
    $query .= "WHERE username = '{$username}' AND password = '{$hash}';";
    return $query;
  }


?>
