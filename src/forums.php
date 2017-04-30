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
    <?php include "scripts.php"; ?>
    <link href="css/styles.css" rel="stylesheet">

    <!-- use jquery datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('#threadtable').DataTable();
    } );
    </script>

    <title>GyroChan</title>
    <!-- Bootstrap Core CSS -->
    <?php include "bootstrap.php"; ?>
    <?php include "navbar.php" ?>
    <?php include "header.html"; ?>
    <?php
    ?>

  </head>
  <body>
    <div class="container-fluid">
      <h1><?php echo $forumtype ?></h1>
      <a id="post_thread"  class="btn btn-default pull-right" href="newthread.php?forum=<?php echo $forumtype ?>">POST THREAD</a>
      <table class="display" cellspacing-"0" width="100%" id="threadtable">
        <thead class="thead-inverse">
        <th>Thread</th>
        <th>Description</th>
        <th>Created By</th>
        </thead>
      <tbody>
      <?php
        while ($threads=mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><a href='threads.php?thread={$threads['ThreadNo']}'>{$threads['Title']}</a></td>";
            echo "<td>{$threads['Content']}</td>";
            echo "<td><a href='profile.php?user={$threads['StartUser']}'>{$threads['StartUser']}</a></td>";
            echo "</tr>";
        }
      ?>
      </tbody>
      </table>
    </div>

  </body>
</html>

<?php
  require_once('./database/close-connection.php');
?>
