<?php require_once('./include/sessions.php'); ?>
<?php require_once('./database/open-connection.php'); ?>
<?php require_once('./database/queries.php'); ?>
<?php require_once('./include/functions.php'); ?>
<?php
  // Check whether the user is logged in.
  confirm_user_authentication();
  $forumtype = $_GET['forum'];
  $query = get_related_threads($forumtype);
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <link href="css/styles.css" rel="stylesheet">

    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <?php include "navbar.php" ?>
    <?php include "header.html"; ?>
    <?php
    ?>
    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!-- Content here -->
    <div class="container-fluid">
      <h1><?php echo $forumtype ?></h1>
      <a id="post_thread"  class="btn btn-default pull-right" href="newthread.php?forum=<?php echo $forumtype ?>">POST THREAD</a>
      <table class="table table-striped table-bordered">
        <thead class="thead-inverse">
        <th>Thread</th>
        <th>Description</th>
        <th>Created By</th>
        </thead>
      <tbody>
      <?php
        while($threads=mysqli_fetch_assoc($result))
        {
          echo "<tr>";
          echo "<td><a href='threads.php?thread={$threads['ThreadNo']}'>{$threads['Title']}</a></td>";
          echo "<td>{$threads['Content']}</td>";
          echo "<td><a href='profile.php?thread={$threads['StartUser']}'>{$threads['StartUser']}</a></td>";
          echo "</tr>";
        }
      ?>
      </tbody>
      </table>
    </div>

    <?php include "scripts.php"; ?>
  </body>
</html>

<?php
  require_once('./database/close-connection.php');
?>
