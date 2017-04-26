<?php
  // Creating database connection
    $dbhost = "localhost";
    $dbuser = "noe";
    $dbpass = "messier_108";
    $dbname = "GyroChan";

    // Connect to database
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Test if the database connection occurred
    if(mysqli_connect_errno()) {
      die("Database connection failed: " . mysqli_connect_error() .
           " (" . mysqli_connect_errno() . ")"
      );
    }
?>
