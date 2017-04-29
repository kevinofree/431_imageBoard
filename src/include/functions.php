<?php

  // Redirect to a new page
  function redirect_to($new_location)
  {
    header("Location: " . $new_location);
    exit;
  }

   // Detect whether the request is an AJAX request
  function is_ajax_request()
  {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  // Check if username is set
  function logged_in()
  {
    return isset($_SESSION['username']);
  }

  // Redirect the user if they try to access a page without authenticating first
  function confirm_user_authentication()
  {
    if(!logged_in())
    {
      $_SESSION['fail_message'] = 'You need to be logged in.';
      redirect_to("login.php");
    }
  }

?>
