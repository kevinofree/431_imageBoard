<?php

  // Redirect to a new page
  function redirect_to($new_location)
  {
    header("Location: " . $new_location);
    exit;
  }

  // Check is username is set
  function logged_in()
  {
    return isset($_SESSION['username']);
  }

  // Redirect the user if they try to access a page without authenticating first
  function user_authenticated()
  {
    if(!logged_in())
    {
      $_SESSION['fail_message'] = 'You need to be logged in.';
      redirect_to("login.php");
    }
  }

?>
